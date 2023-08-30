<?php

namespace App\Http\Controllers\API\Authentication;

use App\Models\Patient;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\PatientLoginRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Notifications\OTP;

class PatientAuthenticationController extends Controller
{
    use ImageTrait;  // Store image


//------------------------------Default Authentication Methods----------------------------------//

    // PatientRegisterRequest contain registration rules for patient
    public function register(Request $request) {

        $file_name = $this->saveImage($request->image, 'images/profileImages');

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Patient::class],
                'password' => ['required', 'confirmed','min:8',Password::defaults()],
                'height' => ['required','integer'],
                'weight' => ['required','integer'],
                'age' => ['required','integer'],
                'gender' => ['required', 'string'],
            ]);
        //create Patient
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_name,
            'height' => $request->height,
            'weight' => $request->weight,
            'age' => $request->age,
            'gender' => $request->gender
        ]);

        //create token
        $token = $patient->createToken('patient_token');

        return response([
            'status' => true,
            'message' => 'Registered Successfully!',
            $token,
            $patient,
        ]);
    }

    public function login(PatientLoginRequest $request) {

        $patient = Patient::where('email' , $request->email)->first();
        //check if patient is not found or password not matched with password in DB
        if (!$patient|| !Hash::check($request->password, $patient->password))
        {
            return response([
                'status' => true,
                'message' => 'Email or Password may be wrong, please try again'
            ]);
        }

        //create token
        $token = $patient->createToken('patient_token');

        return response([
            'status' => 'True',
            'message' => 'LoggedIn Successfully!',
            $token,
            $patient,
        ]);
    }

    public function logout() {

        if(Auth::guard('patient')->check()){
            $accessToken = Auth::guard('patient')->user()->token();

                DB::table('oauth_refresh_tokens')
                    ->where('access_token_id', $accessToken->id)
                    ->update(['revoked' => true]);
            $accessToken->revoke();
        return response([
            'status' => true,
            'mesaage' => 'Logged out sucsessfully'
        ]);
        }
    }

    public function restorPassword(Request $request){
        $patient = Patient::where('email',$request->email)->first();
        $patient->generateOtpCode(); //send otp code

        $patient->notify(new OTP());

        $request->validate([
            'password' => ['required', 'confirmed','min:8',Password::defaults()]
        ]);

        if($request->verfication_code == $patient->verfication_code){
            $patient -> update([
                'password' => Hash::make($request->password),
            ]);
            return response([
                'status' => true,
                'message' => 'Your password has been changed'
            ]);
        }
        else{
            return response([
                'status' => true,
                'message' => 'Your verification code not correct'
            ]);
        }
    }

//------------------------------End Default Authentication Methods----------------------------------//






//------------------------------Authentication By Social Network Methods--------------------------------//

    //Redirect Patient to the Provider authentication page
    public function redirectToProvider($provider){
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    //Get Patient information from Provider.
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $patient = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response([
                'status' => true,
                'message' => 'Invalid credentials provided'
            ]);
        }

        $patientCreated = Patient::firstOrCreate(
            [
                'email' => $patient->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $patient->getName(),
                'status' => true,
            ]
        );
        $patientCreated->providers()->updateOrCreate(
            [
                'provider_name' => $provider,
                'provider_id' => $patient->getId(),
            ],
            [
                'avatar' => $patient->getAvatar()
            ]
        );
        $token = $patientCreated->createToken('token-name')->plainTextToken;

        return response([
            'status' => true,
            'message' => $patientCreated,
            'token' => $token
        ]);
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'apple', 'google'])) {
            return response([
                'status' => true,
                'message' => 'Please login using facebook, apple or google'
            ]);
        }
    }

//------------------------------End Authentication By Social Network Methods--------------------------------//






//------------------------------Profile Methods--------------------------------//

    public function show() {
        $patient = Patient::where('id' , Auth::id())->first();
        return response([
            'status' => true,
            $patient
        ]);
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $file_name = $this->saveImage($request->image, 'images/profileImages');

        //create Patient
        $patient -> update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_name,
        ]);

        //create token
        $token = $patient->createToken('patient_token');

        return response([
            'status' => true,
            'message' => 'Profile information has been updated successfully',
            $token,
            $patient
        ]);
    }

    public function destroy(){
        $patient = Patient::where('id' , Auth::id());
        $patient->delete();
        return response([
            'status' => true,
            'mesaage' => 'Your account has been deleted'
        ]);
    }
//------------------------------End Profile Methods--------------------------------//


}

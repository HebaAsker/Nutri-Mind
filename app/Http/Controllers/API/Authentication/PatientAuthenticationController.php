<?php

namespace App\Http\Controllers\API\Authentication;

use App\Models\Patient;
use App\Notifications\OTP;
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
use App\Interfaces\Authentication\PatientAuthRepositoryInterface;

class PatientAuthenticationController extends Controller
{
    use ImageTrait;  // Store image

    private $patientAuthRepository;

    public function __construct(PatientAuthRepositoryInterface $patientAuthRepository)
    {
        $this->patientAuthRepository = $patientAuthRepository;
    }

//------------------------------Default Authentication Methods----------------------------------//

    // PatientRegisterRequest contain registration rules for patient
    public function register(Request $request) {
        return $this->patientAuthRepository->register($request);
    }

    public function login(PatientLoginRequest $request) {
        return $this->patientAuthRepository->login($request);
    }

    public function logout() {
        return $this->patientAuthRepository->logout();
    }

    public function restorPassword(Request $request){
        return $this->patientAuthRepository->restorePassword($request);
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
        return $this->patientAuthRepository->handleProviderCallback($provider);
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
        return $this->patientAuthRepository->update($request,$patient);
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

<?php

namespace App\Http\Controllers\API\Authentication;


use App\Models\Doctor;
use App\Notifications\OTP;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\DoctorLoginRequest;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UpdateDoctorRequest;
use App\Interfaces\Authentication\DoctorAuthRepositoryInterface;

class DoctorAuthenticationController extends Controller
{
    use ImageTrait;  // Store image

    private $doctorAuthRepository;

    public function __construct(DoctorAuthRepositoryInterface $doctorAuthRepository)
    {
        $this->doctorAuthRepository = $doctorAuthRepository;
    }

//------------------------------Default Authentication Methods----------------------------------//

    // DoctorRegisterRequest contain registration rules for Doctor
    public function register(Request $request) {
        return $this->doctorAuthRepository->register($request);
    }

    public function login(DoctorLoginRequest $request) {

        return $this->doctorAuthRepository->login($request);
    }

    public function logout() {
        return $this->doctorAuthRepository->logout();
    }

    public function restorePassword(Request $request){
        return $this->doctorAuthRepository->restorePassword($request);
    }

//------------------------------End Default Authentication Methods----------------------------------//






//------------------------------Authentication By Social Network Methods--------------------------------//

    //Redirect Doctor to the Provider authentication page
    public function redirectToProvider($provider){
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    //Get Doctor information from Provider.
    public function handleProviderCallback($provider)
    {
        return $this->doctorAuthRepository->handleProviderCallback($provider);
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
        $doctor = Doctor::where('id' , Auth::id())->first();
        return response([
            'status' => true,
            $doctor
        ]);

    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        return $this->doctorAuthRepository->update($request,$doctor);
    }

    public function destroy(){
        $doctor = Doctor::where('id' , Auth::id());
        $doctor->delete();
        return response([
            'status' => true,
            'mesaage' => 'Your account has been deleted'
        ]);
    }

//------------------------------End Profile Methods--------------------------------//



}

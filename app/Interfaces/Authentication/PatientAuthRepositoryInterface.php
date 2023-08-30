<?php
namespace App\Interfaces\Authentication;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\PatientLoginRequest;
use App\Http\Requests\UpdatePatientRequest;



interface PatientAuthRepositoryInterface
{
    public function register(Request $request);

    public function login(PatientLoginRequest $request);

    public function logout();

    public function restorePassword(PatientLoginRequest $request);

    public function update(UpdatePatientRequest $request, Patient $patient);

    public function handleProviderCallback($provider);

}

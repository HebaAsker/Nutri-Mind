<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
<<<<<<< HEAD
use Laravel\Passport\Passport;
=======
>>>>>>> 500c997b32e9126b6193db74114324d168009175
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        //guard scope
        Passport::tokensCan([
            'doctor' => 'For Doctor',
            'patient' => 'For Patient',
        ]);
=======
        //
>>>>>>> 500c997b32e9126b6193db74114324d168009175
    }
}

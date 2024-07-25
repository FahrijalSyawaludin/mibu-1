<?php

namespace App\Providers;
use Illuminate\Auth\Notifications\VerifyEmail;

// use Illuminate\Support\Facades\Gate;
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
        // $this->registerPolicies();

        // // Enable email verification for the `DataIbuHamil` model
        // VerifyEmail::createUrlUsing(function ($notifiable) {
        //     return url('/api/email/verify/'.$notifiable->getKey().'/'.sha1($notifiable->getEmailForVerification()));
        // });
    }
}

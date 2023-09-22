<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define("update-delete-post" , function($user , $post){

            if($user->id === $post->user_id){
                return true;
            } else {
                return false;
            }

        });

        Gate::define("admin" , function($user){
            if($user->roll === "admin"){
                return true;
            }
        });

        Gate::define("auth" , function($user){
            if($user){
                return true;
            }
        });
    }
}

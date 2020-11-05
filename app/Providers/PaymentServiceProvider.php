<?php


namespace App\Providers;

use App\Http\Controllers\Acquiring\Payment;
use App\User;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Controllers\Acquiring\PaymentInterface', function () {
            $user = User::auth();
            return new Payment($user->acquiring_login, $user->acquiring_password, $user->acquiring_checking);
        }
        );
    }
}

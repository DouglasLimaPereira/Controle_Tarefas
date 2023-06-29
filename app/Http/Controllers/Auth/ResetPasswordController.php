<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $min = 4;
    
    public static $defaultCallback;

    public static function min($size)
    {
        return new static($size);
    }

    public static function default()
    {
        $password = is_callable(static::$defaultCallback)
                            ? call_user_func(static::$defaultCallback)
                            : static::$defaultCallback;

        return $password instanceof Rule ? $password : static::min(4);
    }
}

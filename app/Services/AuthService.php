<?php

namespace App\Services;

use App\Models\User;
use App\Support\EmailFormatter;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthService
{
    /**
     * @param  array{first_name: string, middle_name: string|null, last_name: string, suffix: string|null, email: string, password: string}  $data
     */
    public function register(array $data, bool $verified = false): User
    {
        $user = new User(Arr::except($data, ['password']));
        $user->password = $data['password'];
        $user->setAttribute('fullname', $user->full_name);

        if ($verified) {
            $user->email_verified_at = \Illuminate\Support\Carbon::now();
        }

        $user->save();

        return $user;
    }

    /**
     * @param  array{email: string, password: string}  $credentials
     */
    public function login(array $credentials, bool $remember = false): User
    {
        $email = EmailFormatter::sanitize($credentials['email']);

        if ($email === null) {
            throw new AuthenticationException('This account is not found');
        }

        $user = User::where('email', $email)->first();

        if ($user === null) {
            throw new AuthenticationException('This account is not found');
        }

        if (! Auth::attempt([
            'email' => $email,
            'password' => $credentials['password'],
        ], $remember)) {
            if (! $remember) {
                $this->forgetRememberCookie();
            }

            throw new AuthenticationException('Incorrect Password');
        }

        if (! $remember) {
            $this->forgetRememberCookie();
        }

        $authenticatedUser = Auth::user();

        if (! $authenticatedUser instanceof User) {
            throw new AuthenticationException('This account is not found');
        }

        return $authenticatedUser;
    }

    private function forgetRememberCookie(): void
    {
        Cookie::queue(Cookie::forget(Auth::getRecallerName()));
    }

    public function logout(): void
    {
        Auth::logout();
    }
}

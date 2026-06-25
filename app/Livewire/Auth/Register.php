<?php

namespace App\Livewire\Auth;

use App\Services\OtpService;
use App\Support\EmailFormatter;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class Register extends Component
{
    public string $first_name = '';

    public string $middle_name = '';

    public string $last_name = '';

    public string $suffix = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $turnstile_token = '';

    private OtpService $otpService;

    public function boot(OtpService $otpService): void
    {
        $this->otpService = $otpService;
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'turnstile_token' => ['required', function (string $attribute, mixed $value, \Closure $fail): void {
            //     try {
            //         $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            //             'secret' => config('services.turnstile.secret_key'),
            //             'response' => $value,
            //             'remoteip' => request()->ip(),
            //         ]);
            //         if (! $response->json('success')) {
            //             $fail('The security check failed. Please try again.');
            //         }
            //     } catch (ConnectionException) {
            //         $fail('Unable to verify security check. Please try again later.');
            //     }
            // }],
        ];
    }

    public function submit(): void
    {
        $this->email = EmailFormatter::sanitize($this->email) ?? '';

        $data = $this->validate();

        $this->otpService->sendForRegistration($data['email']);

        session()->put('registration_data', $data);
        session()->put('registration_email', $data['email']);

        $this->redirect(route('register.verify'));
    }

    public function render(): View
    {
        return view('livewire.auth.register')
            ->layout('layouts.auth');
    }
}

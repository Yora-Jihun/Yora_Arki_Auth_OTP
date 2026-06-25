<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use App\Services\OtpService;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;

class RegisterVerify extends Component
{
    /**
     * @var array<int, string>
     */
    protected $listeners = ['verifyOtp'];

    public string $email = '';

    public string $otp = '';

    public int $cooldown = 0;

    private AuthService $authService;

    private OtpService $otpService;

    public function boot(AuthService $authService, OtpService $otpService): void
    {
        $this->authService = $authService;
        $this->otpService = $otpService;
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'otp' => ['required', 'digits:6'],
        ];
    }

    public function mount(): void
    {
        $this->email = session()->get('registration_email', '');

        if (! $this->email || ! session()->has('registration_data')) {
            $this->redirect(route('register'));
        }

        $this->cooldown = $this->otpService->getResendCooldownRemaining($this->email);
    }

    public function updatedOtp(): void
    {
        $this->otp = preg_replace('/[^0-9]/', '', $this->otp);
    }

    public function verify(): void
    {
        $this->validate();

        $registrationData = session()->get('registration_data');

        if (! $this->otpService->verify($this->email, $this->otp, 'registration', request()->ip())) {
            $this->addError('otp', 'Invalid or expired verification code.');
            $this->otp = '';

            return;
        }

        $user = $this->authService->register($registrationData, true);

        session()->forget(['registration_data', 'registration_email']);

        auth()->login($user);
        $this->redirect(route('dashboard'));
    }

    public function resend(): void
    {
        $registrationData = session()->get('registration_data');

        if (! $registrationData) {
            $this->redirect(route('register'));

            return;
        }

        try {
            $this->otpService->sendForRegistration($this->email);
            $this->otp = '';
            $this->cooldown = 60;
            $this->dispatch('otp-resended');
        } catch (ValidationException $e) {
            $this->addError('otp', $e->getMessage());
        }
    }

    public function tick(): void
    {
        if ($this->cooldown > 0) {
            $this->cooldown--;
        }
    }

    public function goBack(): void
    {
        session()->forget(['registration_data', 'registration_email']);
        $this->redirect(route('register'));
    }

    public function render(): View
    {
        return view('livewire.auth.register-verify')
            ->layout('layouts.auth');
    }
}

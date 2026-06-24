<?php

namespace App\Livewire\Auth;

use App\Services\OtpService;
use App\Support\EmailFormatter;
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

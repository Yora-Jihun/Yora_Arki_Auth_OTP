<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use App\Support\EmailFormatter;
use Illuminate\Auth\AuthenticationException;
use Illuminate\View\View;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    private AuthService $authService;

    public function boot(AuthService $authService): void
    {
        $this->authService = $authService;
    }

    public function mount(): void
    {
        $this->remember = (bool) config('auth.defaults.remember_default', false);
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email:rfc,dns'],
            'password' => ['required', 'string'],
        ];
    }

    public function submit(): void
    {
        $this->email = EmailFormatter::sanitize($this->email) ?? '';

        $this->validate();

        try {
            $this->authService->login([
                'email' => $this->email,
                'password' => $this->password,
            ], $this->remember);
        } catch (AuthenticationException $e) {
            $this->addError('auth', $e->getMessage());

            return;
        }

        session()->regenerate();

        $this->redirect(route('dashboard'));
    }

    public function render(): View
    {
        return view('livewire.auth.login')
            ->layout('layouts.auth');
    }
}

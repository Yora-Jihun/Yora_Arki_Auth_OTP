<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
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

    private AuthService $authService;

    public function boot(AuthService $authService): void
    {
        $this->authService = $authService;
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
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function submit(): void
    {
        $this->email = EmailFormatter::sanitize($this->email) ?? '';

        $data = $this->validate();

        $user = $this->authService->register([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?: null,
            'last_name' => $data['last_name'],
            'suffix' => $data['suffix'] ?: null,
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        auth()->login($user);

        $this->redirect(route('dashboard'));
    }

    public function render(): View
    {
        return view('livewire.auth.register')
            ->layout('layouts.auth');
    }
}

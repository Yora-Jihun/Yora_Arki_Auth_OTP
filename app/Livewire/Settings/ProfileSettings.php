<?php

namespace App\Livewire\Settings;

use App\Support\NameFormatter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProfileSettings extends Component
{
    use WithFileUploads;

    public string $first_name = '';

    public string $middle_name = '';

    public string $last_name = '';

    public string $suffix = '';

    public string $email = '';

    public string $country_code = '+63';

    public string $contact_to = '';

    public ?TemporaryUploadedFile $avatar = null;

    public ?string $oldAvatar = null;

    public function mount(): void
    {
        $user = auth()->user();

        if ($user) {
            $this->first_name = (string) $user->first_name;
            $this->middle_name = (string) ($user->middle_name ?? '');
            $this->last_name = (string) $user->last_name;
            $this->suffix = (string) ($user->suffix ?? '');
            $this->email = (string) $user->email;
            $this->country_code = (string) ($user->country_code ?? '+63');
            $this->contact_to = (string) ($user->contact_to ?? '');
            $this->oldAvatar = $user->avatar;
        }
    }

    public function updatedAvatar(): void
    {
        $this->validate([
            'avatar' => 'nullable|image|max:2048',
        ]);
    }

    public function avatarPreviewUrl(): string
    {
        if ($this->avatar instanceof TemporaryUploadedFile) {
            return $this->avatar->temporaryUrl();
        }

        if (auth()->user()?->avatar) {
            return Storage::disk('public')->url('avatars/'.auth()->user()->avatar);
        }

        return asset('assets/images/Jerome_Edica.jpg');
    }

    public function removeAvatar(): void
    {
        $user = auth()->user();

        if ($user && $user->avatar) {
            Storage::disk('public')->delete('avatars/'.$user->avatar);

            $user->update(['avatar' => null]);
            $this->dispatch('profile-updated');
            $this->oldAvatar = null;
            $this->avatar = null;
        }
    }

    public function submit(): void
    {
        $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'email' => ['required', 'email'],
            'country_code' => ['required', 'string', 'max:10'],
            'contact_to' => ['nullable', 'string', 'max:255'],
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();

        if ($user) {
            $data = [
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name ?: null,
                'last_name' => $this->last_name,
                'suffix' => $this->suffix ?: null,
                'email' => $this->email,
                'country_code' => $this->country_code,
                'contact_to' => $this->contact_to,
                'fullname' => NameFormatter::full($this->first_name, $this->middle_name, $this->last_name, $this->suffix ?: null),
            ];

            if ($this->avatar) {
                if ($this->oldAvatar) {
                    Storage::disk('public')->delete('avatars/'.$this->oldAvatar);
                }

                $filename = uniqid().'.'.$this->avatar->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('avatars', $this->avatar, $filename);
                $data['avatar'] = $filename;
            }

            $user->update($data);
            $this->dispatch('profile-updated');
            $this->oldAvatar = $user->avatar;
            $this->avatar = null;
        }

        session()->flash('status', 'Profile updated successfully.');
        $this->redirect(route('profile-settings'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.settings.profile-settings')
            ->layout('layouts.dashboard');
    }
}

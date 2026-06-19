<main class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Security Settings</h1>
            <p class="text-sm text-gray-500 mt-0.5">Update your password to keep your account secure</p>
        </div>
    </div>

    <div class="bg-white border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Change Password</h3>

        @include('partials.alerts', [
            'type' => 'success',
            'message' => session('status'),
            'class' => 'mb-4',
        ])

        <form wire:submit="submit" class="space-y-4 max-w-md">
            @error('auth')
                @include('partials.alerts', [
                    'type' => 'error',
                    'message' => $message,
                    'class' => 'mb-4',
                ])
            @enderror

            <div>
                <label for="current_password" class="block text-xs font-medium text-gray-500 mb-1.5">Current Password</label>
                <input id="current_password" type="password" wire:model="current_password" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-none focus:outline-none focus:border-blue-300 focus:bg-white transition">
                @error('current_password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-medium text-gray-500 mb-1.5">New Password</label>
                <input id="password" type="password" wire:model="password" placeholder="At least 8 characters" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-none focus:outline-none focus:border-blue-300 focus:bg-white transition">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-medium text-gray-500 mb-1.5">Confirm New Password</label>
                <input id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="Re-enter new password" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 rounded-none focus:outline-none focus:border-blue-300 focus:bg-white transition">
                @error('password_confirmation')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-none hover:bg-blue-700 transition">Update Password</button>
            </div>
        </form>
    </div>

    @script
    <script>
        Livewire.on('notify', (message) => alert(message));
    </script>
    @endscript
</main>

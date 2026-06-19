<main class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage your account information and preferences</p>
        </div>
    </div>

    @include('partials.alerts', [
        'type' => 'success',
        'message' => session('status'),
    ])

    <div class="bg-white border border-gray-100 p-6">
        <div class="flex items-center gap-5 mb-6">
            <label for="avatarInput" class="cursor-pointer relative group flex-shrink-0">
                @if(auth()->user()->avatar)
                    <img id="avatarPreview" src="{{ $this->avatarPreviewUrl() }}" class="w-16 h-16 rounded-full object-cover border border-gray-200" alt="Avatar">
                @else
                    <img id="avatarPreview" src="{{ $this->avatarPreviewUrl() }}" class="w-16 h-16 rounded-full object-cover border border-gray-200" alt="Jerome Edica">
                @endif
                <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </label>
            <input type="file" id="avatarInput" wire:model="avatar" class="hidden" accept="image/png,image/jpeg,image/jpg">
            @error('avatar')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-semibold text-gray-900">{{ auth()->user()->fullname ?? 'User' }}</h3>
                    <span class="inline-block px-2.5 py-0.5 text-xs font-medium bg-blue-50 text-blue-700">Employee</span>
                </div>
                <p class="text-xs text-gray-500 mt-0.5">Joined {{ auth()->user()->created_at?->format('F j, Y') }}</p>
                @if(auth()->user()->avatar)
                    <button type="button" wire:click="removeAvatar" class="text-xs text-red-600 hover:text-red-700 mt-1">Remove photo</button>
                @endif
            </div>
        </div>

        <form wire:submit="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-xs font-medium text-gray-500 mb-1.5">First Name</label>
                    <input id="first_name" type="text" wire:model="first_name" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('first_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="middle_name" class="block text-xs font-medium text-gray-500 mb-1.5">Middle Name</label>
                    <input id="middle_name" type="text" wire:model="middle_name" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('middle_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-xs font-medium text-gray-500 mb-1.5">Last Name</label>
                    <input id="last_name" type="text" wire:model="last_name" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('last_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <label for="suffix" class="block text-xs font-medium text-gray-500 mb-1.5">Suffix</label>
                    <select id="suffix" wire:model="suffix" class="w-full bg-gray-50 px-3 py-2 pr-10 text-sm text-gray-900 border border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition appearance-none" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2716%27 height=%2716%27 fill=%27none%27 stroke=%27%239ca3af%27 stroke-width=%272%27 viewBox=%270 0 24 24%27%3E%3Cpath d=%27M6 9l6 6 6-6%27/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px;">
                        <option value="">None</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                    </select>
                    @error('suffix')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
                    <input id="email" type="email" wire:model="email" class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <label for="contact_to" class="block text-xs font-medium text-gray-500 mb-1.5">Contact Number</label>
                    <div class="flex">
                        <select id="country_code" wire:model="country_code" class="inline-flex items-center px-3 py-2 pr-8 text-sm text-gray-900 bg-gray-50 border border-r-0 border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition appearance-none w-28" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2716%27 height=%2716%27 fill=%27none%27 stroke=%27%239ca3af%27 stroke-width=%272%27 viewBox=%270 0 24 24%27%3E%3Cpath d=%27M6 9l6 6 6-6%27/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 8px center; background-size: 14px;">
                            <option value="+63">+63</option>
                            <option value="+1">+1</option>
                            <option value="+44">+44</option>
                            <option value="+81">+81</option>
                            <option value="+82">+82</option>
                            <option value="+86">+86</option>
                            <option value="+91">+91</option>
                            <option value="+65">+65</option>
                            <option value="+852">+852</option>
                            <option value="+880">+880</option>
                        </select>
                        <input id="contact_to" type="text" wire:model="contact_to" class="min-w-0 flex-1 bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100  focus:outline-none focus:border-blue-300 focus:bg-white transition">
                    </div>
                    @error('contact_to')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Save Changes</button>
            </div>
        </form>
    </div>

    @script
    <script>
        Livewire.on('notify', (message) => alert(message));
    </script>
    <script>
        const mainContent = document.getElementById('mainContent');

        Livewire.on('toggleSidebar', () => {
            const body = document.body;
            body.classList.toggle('sidebar-open');
            body.classList.toggle('sidebar-closed');

            if (body.classList.contains('sidebar-open')) {
                mainContent.style.marginLeft = '250px';
            } else {
                mainContent.style.marginLeft = '0px';
            }
        });
    </script>
    @endscript
</main>
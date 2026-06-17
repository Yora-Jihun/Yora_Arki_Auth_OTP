<div class="w-full">
    <div class="overflow-hidden bg-white shadow-2xl shadow-slate-200/70 ring-1 ring-slate-900/5 transition-all duration-300 ease-out">
        <div class="grid h-[960px] grid-cols-1 lg:grid-cols-2">
            <section class="flex items-center justify-center bg-white p-8 sm:p-12 lg:p-16">
                <div class="w-full max-w-md space-y-6">
                    <div class="space-y-6">
                        <a href="{{ route('welcome') }}" wire:navigate class="inline-flex items-center gap-3 transition-all duration-200 ease-out hover:opacity-90" aria-label="Home">
                            <span class="grid h-11 w-11 place-items-center bg-blue-600 text-sm font-bold text-white">
                                YA
                            </span>
                            <span class="text-lg font-semibold tracking-tight text-slate-950">Yora Arki</span>
                        </a>

                        <div class="space-y-2">
                            <h1 class="text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">
                                Welcome back
                            </h1>
                            <p class="text-sm leading-6 text-slate-500">
                                Sign in to continue to your secure workspace.
                            </p>
                        </div>
                    </div>

                    <form wire:submit="submit" class="space-y-4">
                        @error('auth')
                        <div class="border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ $message }}
                        </div>
                        @enderror

                        @include('livewire.auth.partials.input-field', [
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                        'placeholder' => 'you@example.com',
                        'autocomplete' => 'email',
                        'attributes' => new \Illuminate\View\ComponentAttributeBag([
                        'wire:model' => 'email',
                        'required' => true,
                        'autofocus' => true,
                        ]),
                        ])

                        @include('livewire.auth.partials.input-field', [
                        'name' => 'password',
                        'label' => 'Password',
                        'type' => 'password',
                        'placeholder' => 'Enter your password',
                        'autocomplete' => 'current-password',
                        'attributes' => new \Illuminate\View\ComponentAttributeBag([
                        'wire:model' => 'password',
                        'required' => true,
                        ]),
                        ])

                        <div class="flex items-center justify-between gap-3">
                            <label for="remember" class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" wire:model="remember" id="remember" class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center bg-[#0A5FFF] px-4 py-3.5 text-sm font-semibold text-white transition-all duration-200 ease-out hover:bg-[#0757E8] focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                            Sign in
                        </button>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-slate-500">or</span>
                            </div>
                        </div>

                        <button type="button" class="inline-flex w-full items-center justify-center gap-3 border border-slate-200 bg-white px-4 py-3.5 text-sm font-semibold text-slate-700 transition-all duration-200 ease-out hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-200">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="#4285F4" d="M23.77 12.27c0-.83-.07-1.64-.2-2.42H12v4.57h6.64a5.68 5.68 0 0 1-2.47 3.72v3.04h3.99c2.33-2.14 3.61-5.3 3.61-8.91Z" />
                                <path fill="#34A853" d="M12 24c3.32 0 6.11-1.1 8.16-2.99l-3.99-3.04c-1.11.75-2.53 1.19-4.17 1.19-3.2 0-5.91-2.16-6.88-5.07H1.03v3.15A12 12 0 0 0 12 24Z" />
                                <path fill="#FBBC05" d="M5.12 14.09A7.44 7.44 0 0 1 4.75 12c0-.72.13-1.42.37-2.09V6.76H1.03A12 12 0 0 0 0 12c0 1.87.43 3.64 1.2 5.24l3.92-3.15Z" />
                                <path fill="#EA4335" d="M12 4.84c1.81 0 3.43.62 4.71 1.84l3.54-3.54C18.11 1.17 15.32 0 12 0A12 12 0 0 0 1.03 6.76l4.09 3.15C6.09 7 8.8 4.84 12 4.84Z" />
                            </svg>
                            Sign in with Google
                        </button>
                    </form>

                    <p class="text-center text-sm text-slate-500 mt-4">
                        Don't have an account?
                        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-[#0A5FFF] transition-all duration-200 ease-out hover:text-[#0757E8]">
                            Register here
                        </a>
                    </p>
                </div>
            </section>

            @include('livewire.auth.partials.side-landing')
        </div>
    </div>
</div>
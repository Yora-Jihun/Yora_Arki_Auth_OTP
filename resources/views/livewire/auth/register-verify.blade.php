<div class="w-full">
    <div class="overflow-hidden bg-white shadow-2xl shadow-slate-200/70 ring-1 ring-slate-900/5 transition-all duration-300 ease-out">
        <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2 lg:min-h-0">
            @include('livewire.auth.partials.side-landing')

            <section class="flex items-center justify-center bg-white p-8 sm:p-12 lg:p-16">
                <div class="w-full max-w-md space-y-6">
                    <div class="space-y-6">
                        <a href="{{ route('welcome') }}" wire:navigate class="inline-flex items-center gap-3 transition-all duration-200 ease-out hover:opacity-90">
                            <span class="grid h-11 w-11 place-items-center bg-blue-600 text-sm font-bold text-white">
                                YA
                            </span>
                            <span class="text-lg font-semibold tracking-tight text-slate-950">Yora Arki</span>
                        </a>

                        <div class="space-y-2">
                            <h1 class="text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">
                                Verify Your Email
                            </h1>
                            <p class="text-sm leading-6 text-slate-500">
                                Enter the 6-digit code sent to {{ $email }}
                            </p>
                        </div>
                    </div>

                    <form wire:submit="verify" class="space-y-4">
                        @error('otp')
                            @include('partials.alerts', [
                                'type' => 'error',
                                'message' => $message,
                                'class' => 'mb-4',
                            ])
                        @enderror

                        <div>
                            @include('livewire.auth.partials.input-field', [
                                'name' => 'otp',
                                'label' => 'Verification Code',
                                'type' => 'text',
                                'placeholder' => '123456',
                                'autocomplete' => 'one-time-code',
                                'attributes' => new \Illuminate\View\ComponentAttributeBag([
                                    'wire:model' => 'otp',
                                    'required' => true,
                                    'maxlength' => '6',
                                    'autofocus' => true,
                                ]),
                            ])
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center bg-[#0A5FFF] px-4 py-3.5 text-sm font-semibold text-white transition duration-200 hover:bg-[#0757E8] focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                        >
                            Verify & Create Account
                        </button>

                        <div class="flex justify-between text-sm">
                            <button type="button" wire:click="goBack" class="text-slate-600 hover:underline">
                                Change Email
                            </button>
                            <button type="button" wire:click="resend" class="text-[#0A5FFF] hover:underline">
                                Resend Code
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
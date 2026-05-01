<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden rounded-[2.5rem] border border-slate-100 relative z-10">
        
        <div class="flex flex-col items-center mb-10">
            <a href="/" class="mb-6 transform hover:scale-105 transition-transform duration-300">
                <x-application-logo class="w-24 h-auto" />
            </a>
            <h2 class="text-3xl font-black italic tracking-tighter uppercase text-slate-900 leading-none">
                Welcome <span class="text-primary text-glow">Back</span>
            </h2>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-3">Elite Member Access</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Account Email</label>
                <x-text-input id="email" class="w-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex justify-between items-center ml-1">
                    <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Secure Password</label>
                    @if (Route::has('password.request'))
                        <a class="text-[9px] font-black uppercase tracking-widest text-primary hover:text-slate-900 transition-colors" href="{{ route('password.request') }}">
                            Lost Access?
                        </a>
                    @endif
                </div>
                <x-text-input id="password" class="w-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all duration-300"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-slate-200 text-primary focus:ring-primary/20 transition-all duration-300" name="remember">
                    <span class="ms-3 text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-600 transition-colors">{{ __('Keep me logged in') }}</span>
                </label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-primary hover:text-slate-900 transition-all duration-500 shadow-xl shadow-slate-900/10 hover:shadow-primary/30 transform hover:-translate-y-1 active:scale-95">
                    {{ __('Authenticate') }}
                </button>
            </div>

            <div class="text-center pt-8 border-t border-slate-50">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">New to the Academy?</p>
                <a href="{{ route('register.trial') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-primary hover:text-slate-900 transition-all duration-300">
                    Join the Ranks <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

<style>
    .text-glow {
        text-shadow: 0 0 15px rgba(0, 255, 65, 0.3);
    }
</style>

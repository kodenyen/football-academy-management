<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden rounded-[2.5rem] border border-slate-100 relative z-10">
        
        <div class="flex flex-col items-center mb-10">
            <a href="/" class="mb-6 transform hover:scale-105 transition-transform duration-300">
                <x-application-logo class="w-24 h-auto" />
            </a>
            <h2 class="text-3xl font-black italic tracking-tighter uppercase text-slate-900 leading-none">
                Create <span class="text-primary">Account</span>
            </h2>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-3">Start Your Football Journey</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Full Name</label>
                <x-text-input id="name" class="w-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Email Address</label>
                <x-text-input id="email" class="w-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Password</label>
                <x-text-input id="password" class="w-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all duration-300"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Confirm Password</label>
                <x-text-input id="password_confirmation" class="w-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all duration-300"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-primary hover:text-slate-900 transition-all duration-500 shadow-xl shadow-slate-900/10 hover:shadow-primary/30 transform hover:-translate-y-1 active:scale-95">
                    {{ __('Register Now') }}
                </button>
            </div>

            <div class="text-center pt-8 border-t border-slate-50">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Already a member?</p>
                <a href="{{ route('login') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-primary hover:text-slate-900 transition-all duration-300">
                    Sign In to Dashboard <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

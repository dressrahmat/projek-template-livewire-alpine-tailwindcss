<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="card-body" method="POST" action="{{ route('login') }}">
        @csrf
    
        <div class="form-control">
            <label class="label">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input id="email" type="email" placeholder="{{ __('Email') }}" class="input input-bordered" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <span class="error text-red-500">{{ $message }}</span> 
            @enderror
        </div>
    
        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">{{ __('Password') }}</span>
            </label>
            <input id="password" type="password" placeholder="{{ __('Password') }}" class="input input-bordered" name="password" required autocomplete="current-password" />
            @error('password')
                <span class="error text-red-500">{{ $message }}</span> 
            @enderror
            @if (Route::has('password.request'))
                <label class="label">
                    <a href="{{ route('password.request') }}" class="label-text-alt link link-hover">{{ __('Forgot password?') }}</a>
                </label>
            @endif
        </div>
    
        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
            <p class="text-sm text-center">Anda belum mendaftarkan akun ? <a href="{{route('register')}}" class="text-secondary">Daftar</a></p>
        </div>
    </form>
    
</x-guest-layout>

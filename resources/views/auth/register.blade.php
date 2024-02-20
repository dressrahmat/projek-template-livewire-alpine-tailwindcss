<x-guest-layout>
    <form class="card-body" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-control">
            <label class="label">
                <span class="label-text">{{ __('Name') }}</span>
            </label>
            <input id="name" type="text" placeholder="{{ __('Name') }}" class="input input-bordered" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <x-input-error :message="$message" class="text-red-500 mt-1" />
            @enderror
        </div>

        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input id="email" type="email" placeholder="{{ __('Email') }}" class="input input-bordered" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <x-input-error :message="$message" class="text-red-500 mt-1" />
            @enderror
        </div>

        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">{{ __('Password') }}</span>
            </label>
            <input id="password" type="password" placeholder="{{ __('Password') }}" class="input input-bordered" name="password" required autocomplete="new-password" />
            @error('password')
                <x-input-error :message="$message" class="text-red-500 mt-1" />
            @enderror
        </div>

        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">{{ __('Confirm Password') }}</span>
            </label>
            <input id="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" class="input input-bordered" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <x-input-error :message="$message" class="text-red-500 mt-1" />
            @enderror
        </div>

        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
            <p class="text-sm text-center">Anda sudah punya akun ? <a href="{{route('login')}}" class="text-secondary">Login</a></p>
        </div>
    </form>
</x-guest-layout>

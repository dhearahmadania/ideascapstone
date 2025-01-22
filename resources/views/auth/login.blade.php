@extends('layouts.auth')

@section('content')
<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">
            Masuk ke akun Anda
        </h2>
        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf

            <x-input name="email" :value="old('email')" placeholder="anda@email.com" required="true"/>

            <x-input type="password" name="password" label="Kata Sandi" placeholder="Kata sandi Anda" required="true"/>

            <div class="mb-2">
                <label for="remember" class="form-check">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input"/>
                    <span class="form-check-label">Ingat saya di perangkat ini</span>
                </label>
            </div>

            <div class="form-footer">
                <x-button type="submit" class="w-100">
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>
    </div>
</div>

<div class="text-center mt-3 text-gray-600">
    <p>Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 focus:outline-none focus:underline" tabindex="-1">
            Daftar
        </a>
    </p>

    <p class="mt-2">
        <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:underline">
            Lupa kata sandi
        </a>
    </p>
</div>

@endsection
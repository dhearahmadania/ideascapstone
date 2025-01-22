@extends('layouts.auth')

@section('content')
<form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off">
    @csrf

    <div class="card-body">
        <h2 class="card-title text-center mb-4">Buat akun baru</h2>

        <x-input name="name" label="Nama" :value="old('name')" placeholder="Nama Anda" required="true"/>

        <x-input name="email" :value="old('email')" placeholder="anda@email.com" required="true"/>

        <x-input name="username" label="Nama Pengguna" :value="old('username')" placeholder="Nama Pengguna Anda" required="true"/>

        <x-input name="password" label="Kata Sandi" :value="old('password')" placeholder="Kata Sandi" required="true"/>

        <x-input name="password_confirmation" label="Konfirmasi Kata Sandi" :value="old('password_confirmation')" placeholder="Konfirmasi Kata Sandi" required="true" label="Konfirmasi Kata Sandi"/>

        <div class="mb-3">
            <label class="form-check">
                <input type="checkbox" name="terms-of-service" id="terms-of-service"
                       class="form-check-input @error('terms-of-service') is-invalid @enderror"
                >
                <span class="form-check-label">
                    Setujui <a href="./terms-of-service.html" tabindex="-1">
                        ketentuan dan kebijakan</a>.
                </span>
            </label>
        </div>

        <div class="form-footer">
            <x-button type="submit" class="w-100">
                {{ __('Buat akun baru') }}
            </x-button>
        </div>
    </div>
</form>

<div class="text-center text-secondary mt-3">
    Sudah punya akun? <a href="{{ route('login') }}" tabindex="-1">
        Masuk
    </a>
</div>
@endsection

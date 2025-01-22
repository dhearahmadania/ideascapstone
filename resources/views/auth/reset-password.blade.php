@extends('layouts.auth')

@section('content')
    <form class="card card-md" action="{{ route('password.store') }}" method="POST" autocomplete="off">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="card-body">
            <h2 class="card-title text-center mb-4">
                Atur Ulang Kata Sandi
            </h2>
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $request->email) }}"
                       placeholder="Enter email"
                >

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi Baru</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Kata Sandi"
                           autocomplete="off"
                    >

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Konfirmasi Kata Sandi"
                           autocomplete="off"
                    >

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Atur Ulang Kata Sandi
                </button>
            </div>
        </div>
    </form>
@endsection

@extends('layouts.auth')

@section('content')
<div class="text-center">
    <div class="my-5">
        <p class="fs-h3 text-secondary">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email lainnya.') }}
        </p>
    </div>
</div>


<form action="{{ route('verification.send') }}" method="POST" autocomplete="off">
    @csrf

    <button type="submit" class="btn btn-primary w-100">
        {{ __('Kirim Ulang Email Verifikasi') }}
    </button>

    <div class="mt-4">
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>
                        <div class="text-secondary">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</form>

<form action="{{ route('logout') }}" method="POST" autocomplete="off">
    @csrf

    <div class="form-footer">
        <button type="submit" class="btn btn-primary w-100">
            {{ __('Keluar') }}
        </button>
    </div>
</form>
@endsection

@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Ubah Data Pengguna') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs', ['model' => $user])
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <div class="col-lg-4">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Foto Profil') }}
                                </h3>

                                <img class="img-account-profile mb-2" src="{{ $user->photo ? asset('storage/profile/'.$user->photo) : asset('assets/img/demo/user-placeholder.svg') }}" alt="" id="image-preview" />

                                <div class="small font-italic text-muted mb-2">Format JPG atau PNG, maksimal 1 MB</div>

                                <input class="form-control form-control-solid mb-2 @error('photo') is-invalid @enderror" type="file"  id="image" name="photo" accept="image/*" onchange="previewImage();">

                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row row-cards">

                    <div class="col-12">
                        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Data Pengguna') }}
                                    </h3>
                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <x-input name="name" :value="old('name', $user->name)" label="Nama" required="true"/>

                                            <x-input name="username" :value="old('username', $user->username)" label="Nama Pengguna" required="true"/>

                                            <x-input name="email" :value="old('name', $user->email)" label="Alamat Email" required="true"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <x-button.save type="submit">
                                        {{ __('Simpan') }}
                                    </x-button.save>

                                    <x-button.back route="{{ route('users.index') }}">
                                        {{ __('Batal') }}
                                    </x-button.back>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12">
                        <form action="{{ route('users.updatePassword', $user) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Ubah Kata Sandi') }}
                                    </h3>

                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
                                            <x-input type="password" name="password" label="Kata Sandi"/>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <x-input type="password" name="password_confirmation" label="Konfirmasi Kata Sandi"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <x-button.save type="submit">
                                        {{ __('Perbarui') }}
                                    </x-button.save>

                                    <x-button.back route="{{ route('users.index') }}">
                                        {{ __('Batal') }}
                                    </x-button.back>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce

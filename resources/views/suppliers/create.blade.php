@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Buat Pemasok') }}
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Foto Profil') }}
                                </h3>

                                <img
                                    class="img-account-profile mb-2"
                                    src="{{ asset('assets/img/demo/user-placeholder.svg') }}"
                                    id="image-preview"
                                />

                                <div class="small font-italic text-muted mb-2">Format JPG atau PNG, maksimal 1 MB</div>

                                <input class="form-control @error('photo') is-invalid @enderror" type="file"  id="image" name="photo" accept="image/*" onchange="previewImage();">

                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Data Pemasok') }}
                                </h3>

                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <x-input name="name" label="Nama" :required="true" />

                                        <x-input name="email" label="Alamat Email" :required="true" />

                                        <x-input name="shopname" label="Nama Toko" :required="true" />

                                        <x-input name="phone" label="Nomor Telepon" :required="true" />
                                    </div>


                                    <div class="col-sm-6 col-md-6">
                                        <label for="type" class="form-label required">
                                            Tipe pemasok
                                        </label>

                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                            <option selected="" disabled="">Pilih tipe:</option>

                                            @foreach(\App\Enums\SupplierType::cases() as $supplierType)
                                                <option value="{{ $supplierType->value }}" @selected(old('type') == $supplierType->value)>
                                                    {{ $supplierType->label() }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <label for="bank_name" class="form-label required">
                                            Nama Bank
                                        </label>

                                        <select class="form-select @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name">
                                            <option selected="" disabled="">Pilih bank:</option>
                                            <option value="BRI" @if(old('bank_name') == 'BRI')selected="selected"@endif>BRI</option>
                                            <option value="BNI" @if(old('bank_name') == 'BNI')selected="selected"@endif>BNI</option>
                                            <option value="BCA" @if(old('bank_name') == 'BCA')selected="selected"@endif>BCA</option>
                                            <option value="BSI" @if(old('bank_name') == 'BSI')selected="selected"@endif>BSI</option>
                                            <option value="Mandiri" @if(old('bank_name') == 'Mandiri')selected="selected"@endif>Mandiri</option>
                                        </select>
                                        @error('bank_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input name="account_holder" label="Pemegang Akun"/>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input name="account_number" label="Nomor Akun"/>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">
                                                {{ __('Alamat') }}
                                            </label>

                                            <textarea id="address"
                                                      name="address"
                                                      rows="3"
                                                      class="form-control @error('address') is-invalid @enderror"
                                            >{{ old('address') }}</textarea>

                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <x-button.save type="submit">
                                    {{ __('Simpan') }}
                                </x-button.save>

                                <x-button.back route="{{ route('suppliers.index') }}">
                                    {{ __('Batal') }}
                                </x-button.back>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce

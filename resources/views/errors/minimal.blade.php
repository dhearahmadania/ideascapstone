<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

        <title>@yield('title')</title>

        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet"/>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
            .content {
                text-align: left;
            }
        </style>
    </head>
    <body class="border-top-wide border-primary d-flex flex-column">
        <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

        <div class="page page-center">
            <div class="container-tight py-4">
                <div class="empty">
                    <div class="empty-header">
                        <h2 class="empty-title">Ketentuan dan Kebijakan Pembuatan Akun</h2>
                    </div>
                    <div class="content">
                        <p><strong>Ketentuan Pembuatan Akun:</strong><br>
                            1. Setiap pengguna wajib mendaftar dengan informasi yang valid dan akurat.<br>
                            2. Email yang digunakan untuk mendaftar harus aktif dan dapat diakses untuk verifikasi akun.<br>
                            3. Kata sandi harus memenuhi standar keamanan minimum, termasuk panjang minimal 8 karakter.<br>
                            4. Pengguna bertanggung jawab untuk menjaga kerahasiaan kredensial akun mereka.<br>
                            5. Akun yang dibuat hanya boleh digunakan untuk tujuan manajemen inventori yang sesuai dengan ketentuan aplikasi.<br><br>

                            <strong>Kebijakan Penggunaan Akun:</strong><br>
                            1. Pengguna tidak diperbolehkan membagikan akses akun mereka kepada pihak lain.<br>
                            2. Segala aktivitas yang dilakukan melalui akun pengguna menjadi tanggung jawab pemilik akun tersebut.<br>
                            3. Aplikasi berhak menonaktifkan atau menghapus akun yang melanggar kebijakan atau ditemukan menggunakan data palsu.<br>
                            4. Data pengguna akan dijaga kerahasiaannya sesuai dengan kebijakan privasi aplikasi.<br><br>
                        </p>
                    </div>
                    <div class="empty-action">
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                    <div class="empty-action mt-4">
                        <a href="/register" class="btn btn-primary">Buat Akun</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    </body>
</html>

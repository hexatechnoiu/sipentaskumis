@extends('layouts.main')

@section('head')
@section('title')
    Login
@endsection
@endsection

@section('container')
<section class="bg-white dark:bg-gray-900 flex justify-center min-h-screen">
    <form method="POST" action="{{ route('login.authenticate') }}" class="flex flex-col px-4 py-8 lg:py-16 sm:w-[700px]"
        autocomplete="on">
        @csrf
        <div class="flex flex-col justify-center text-center mb-6">
            <a href="/" class="absolute top-8 left-5 text-gray-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="sr-only">Back</span>
            </a>
            <img src="{{ $image }}" alt="" class="mx-auto w-32 mb-2">
            <h1 class="font-semibold text-3xl text-primary-20">{{ $header_text }}</h1>
            <p class="text-gray-500 mt-2">{{ $username_text }}</p>
        </div>
        <div class="mb-4">
            <label for="nama"
                class="block mb-2 font-medium text-black dark:text-white">{{ $text_input_name }}</label>
            <select id="nama" autocomplete="username" name="email"
                class="border border-gray-400 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" required>
                <option value="Cari Pengguna">Cari nama Anda</option>
                @foreach ($users as $u)
                    <option value="{{ $u->email }}">
                        {{ (isset($halaman) && $halaman == 'guru' ? $u->role : $u->email) . ' | ' . $u->name . ($u->kelas != null || $u->kelas != '-' ? ' | ' . $u->kelas : '') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-2 font-medium text-black dark:text-white">{{ $password_text }}</label>
            <div class="relative flex items-center">
                <x-login-input type="password" name="token" id="password"
                    class="border border-gray-400 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Token" required autocomplete="password" />
                <span onclick="togglePasswordField('password', 'eyeIcon')" id="togglePassword"
                    class="toggle-password cursor-pointer absolute right-4 top-1/2 transform -translate-y-1/2">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </span>
            </div>
        </div>
        <button type="submit"
            class="w-full text-white bg-primary-20 hover:text-primary-20 hover:bg-primary-10 duration-300 font-normal rounded-lg px-5 py-3 text-center">
            Submit
        </button>
    </form>

</section>
<style>
    .select2-container .select2-selection {
        display: flex;
        justify-content: space-between;
        height: 50px !important;
        font-size: 16px !important;
        padding: 5px !important;
    }

    .select2-container .select2-selection {
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
    }
</style>



<link href="/css/select2.min.css" rel="stylesheet" />
<script src="/js/select2.min.js"></script>
<script>
    window.crsf_token = "{{ csrf_token() }}";
    $(document).ready(function() {
        var dia = $('#nama').select2();
        // Tambahkan class "rounded" ke input Select2
        dia.next(".select2-container").find(".select2-selection").addClass("rounded");

        // Tambahkan class "centered" ke input Select2 untuk mengatur teks di tengah secara vertikal
        dia.next(".select2-container").find(".select2-selection").addClass("centered");
    })

    // Show Password
    window.togglePasswordField = (fieldId, iconId) => {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(iconId);

        if (eyeIcon && passwordField) {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    }
</script>
@endsection

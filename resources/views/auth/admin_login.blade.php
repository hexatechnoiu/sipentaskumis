@extends('layouts.main')

@section('title')
    Login
@endsection


@section('container')
<section class="bg-white dark:bg-gray-900 flex justify-center">
    <form method="POST" action="{{ route('login.authenticate-admin') }}"
        class="flex flex-col px-4 py-8 lg:py-16 sm:w-[700px]">
        @csrf
        <div class="flex flex-col justify-center text-center mb-10">
            <a href="/" class="absolute top-8 left-5 text-gray-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="sr-only">Back</span>
            </a>
            <img src="{{ asset('img/tendik.webp') }}" class="mx-auto w-32 mb-2">
            <h1 class="font-semibold text-3xl text-primary-20">Login Admin</h1>
            <p class="text-gray-500 mt-2">Masukkan Email atau Nama Anda</p>
        </div>
        <div class="mb-6">
            <label for="nama" class="block mb-2 font-medium text-black dark:text-white">Email</label>
            <input id="nama" name="email"
                class="border border-gray-400 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ketik Email atau Nama" required>
        </div>
        <label for="password" class="block mb-2 font-medium text-black dark:text-white">Password</label>
        <div class="mb-6 relative flex items-center">
            <input type="password" name="password" id="password"
                class="border border-gray-400 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ketik Password" required>
            <span onclick="togglePasswordField('password', 'eyeIcon')" id="togglePassword"
                class="toggle-password cursor-pointer absolute right-4 top-1/2 transform -translate-y-1/2">
                <i id="eyeIcon" class="fas fa-eye"></i>
            </span>
        </div>
        <button type="submit"
            class="mt-4 w-full text-white bg-primary-20 hover:text-primary-20 hover:bg-secondary-20 duration-300 font-normal rounded-lg px-5 py-3 text-center">
            Submit
        </button>
    </form>

</section>
@endsection

<script>
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

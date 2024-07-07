@extends('layouts.main')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

@section('container')
@section('title')
    Beranda
@endsection

@include('partials.sidebar')

<section class="bg-gray-200 min-h-screen sm:ml-[78px]">
    <div class="max-w-screen-xl py-5 px-4 text-center lg:text-start mx-auto">
        <div class="flex justify-between mx-0">
            <div>
                <h2 class="text-2xl font-normal text-black">Dashboard</h2>
            </div>
        </div>
        <div
            class="flex flex-col md:flex-row md:justify-normal gap-5 w-full md:w-auto md:gap-3 py-3 md:py-6 relative overflow-hidden">
            <a href="{{ route('export-excel') . '?tipe=guru' }}"
                class="flex w-full duration-300 transition-all flex-row bg-white hover:bg-primary-20 items-center p-4 h-28 gap-3 group rounded-lg">
                <div
                    class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 rounded-full group-hover:bg-white">
                    <i class="fas fa-chalkboard-teacher text-primary-20 group-hover:text-primary-20"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight group-hover:text-white">Guru</h5>
                    <p class="font-normal text-gray-500 group-hover:text-primary-10">Unduh token disini</p>
                </div>
            </a>
            <a href="{{ route('export-excel') . '?tipe=siswa' }}"
                class="flex w-full duration-300 transition-all flex-row bg-white hover:bg-primary-20 items-center p-4 h-28 gap-3 group rounded-lg">
                <div
                    class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 rounded-full group-hover:bg-white">
                    <i class="fas fa-users text-primary-20 group-hover:text-primary-20"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight group-hover:text-white">Siswa</h5>
                    <p class="font-normal text-gray-500 group-hover:text-primary-10">Unduh token disini</p>
                </div>
            </a>
            <a href="{{ route('export-excel') . '?tipe=vote' }}"
                class="flex w-full duration-300 transition-all flex-row bg-white hover:bg-primary-20 items-center p-4 h-28 gap-3 group rounded-lg">
                <div
                    class="flex items-center justify-center text-xl text-primary-40 w-14 h-14 rounded-full group-hover:bg-white">
                    <i class="fas fa-id-card text-primary-20 group-hover:text-primary-20"></i>
                </div>
                <div class="flex flex-col items-start leading-normal">
                    <h5 class="text-xl font-semibold tracking-tight group-hover:text-white">Hasil Vote</h5>
                    <p class="font-normal text-gray-500 group-hover:text-primary-10">Unduh hasil disini</p>
                </div>
            </a>
        </div>
        <div class="flex flex-row md:flex-row justify-around min-w-full max-w-full py-6">
            <form action="{{ route('dashboard.update_settings') }}" method="POST"
                class="flex flex-col w-full px-4 py-5 gap-3 bg-white rounded-lg">
                @csrf
                @method('PUT')
                @foreach ($settings as $set)
                    <div class="mb-2">
                        <label for="{{ $set['key'] }}"
                            class="block mb-2 text-sm font-medium text-gray-900">{{ $set['key'] }}</label>
                        @switch($set['type'])
                            @case('boolean')
                                <select name="{{ $set['key'] }}"
                                    class="bg-gray-50 border outline-none border-none p-3 appearance-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="false">false</option>
                                    <option value="true">true</option>
                                </select>
                                <script>
                                    document.querySelector('[name="{{ $set['key'] }}"]').value = '<?php echo $set['value']; ?>';
                                </script>
                            @break

                            @case('text')
                                <input type="text" name="{{ $set['key'] }}"
                                    class="bg-gray-50 border outline-none border-none p-3 appearance-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $set['value'] }}" required>
                            @break

                            @default
                                null
                        @endswitch
                    </div>
                @endforeach
                <button type="submit"
                    class="text-white bg-primary-20 hover:bg-primary-10 hover:text-primary-20 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-2">Save
                    changes</button>
            </form>
        </div>
        <div class="bg-white shadow-sm rounded p-5">
            <div class="flex items-end gap-2 mb-2">

                <h2 class="text-md font-semibold">Batch Import Data (Dari Excel)</h2>
                <small class="text-xs">Max file: {{ (int) ini_get('upload_max_filesize') / 1024 }} MiB</small>
            </div>
            <small class="text-xs">XLS/X File example (leave token null for autogenerate):
                <a class="text-blue-800 hover:bg-gray-200 rounded py-1 px-2"
                    href="{{ asset('/import/Format-Guru.xlsx') }}">Guru</a>
                <a class="text-blue-800 hover:bg-gray-200 rounded py-1 px-2"
                    href="{{ asset('/import/Format-Siswa.xlsx') }}">Siswa</a>
            </small>

            <form method="POST" action="{{ route('dashboard.import.excel') }}" enctype="multipart/form-data"
                class="flex flex-col justify-center gap-2 my-4">
                @csrf
                <x-select class="mb-2" name="type" placeholder="Tipe Import">
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </x-select>

                <x-input type="file" class="mb-2" placeholder="Berkas Excel" name="file" />
                <button type="submit"
                    class="text-white bg-primary-20 hover:bg-primary-10 hover:text-primary-20 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-2">Import</button>
            </form>
        </div>
        <x-bottom-nav />
</section>
@endsection

@extends('layouts.main')


@section('title')
    Kelola pengguna
@endsection

@section('head')
    <link href="https://cdn.datatables.net/v/zf/dt-1.13.8/b-2.4.2/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/zf/dt-1.13.8/b-2.4.2/datatables.min.js"></script>
@endsection

@include('partials.sidebar')
@section('container')
    <div x-data="userData">

        <!-- Start block -->
        {{-- <div id="user-dropdown" class="z-[99999] w-44 bg-white rounded divide-y divide-gray-20 shadow">
            <ul class="py-1 text-sm">
                <li>
                    <button type="button"
                        class="flex w-full items-center py-2 px-4 hover:bg-gray-20 duration-[400ms]     text-black    ">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                        <span>Ubah</span>
                    </button>
                </li>
                <li>
                    <button type="button"
                        class="flex w-full items-center py-2 px-4 hover:bg-gray-20 duration-[400ms] text-red-500">
                        <i class="fa-solid fa-trash-can mr-2"></i>
                        Hapus
                    </button>
                </li>
            </ul>
        </div> --}}

        <section class="bg-gray-50 sm:p-5 antialiased sm:ml-[78px]">
            <div class="mx-auto pb-28 sm:px-4">
                <div class="flex flex-col w-full sm:w-auto justify-center text-center mb-10">
                    <h1 class="font-semibold text-xl text-primary-20">Pengguna Terdaftar</h1>
                </div>
                <!-- Start coding here -->
                <div class="bg-white relative shadow sm:rounded-lg  overflow-auto sm:overflow-hidden ">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <form method="GET" class="w-full md:w-1/2 flex justify-center items-center ml-7">
                            <input name="search" placeholder="Ketik disini dan klik Enter untuk Mencari"
                                class="transition-all duration-500 border block w-full border-gray-300 text-gray-900 focus:outline-none h-full text-sm rounded-lg border-1 px-4 py-1.5 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:border-2 focus:border-blue-600 peer valid:border-blue-600" />
                            <input type="button">
                        </form>
                        <div
                            class="flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" id="createUserButton" x-on:click="createUser=true"
                                class="flex sm:w-full items-center justify-center text-white bg-primary-20 hover:text-black hover:bg-secondary-20 focus:ring-4 focus:ring-secondary-10 duration-[400ms] font-medium rounded-lg text-sm px-4 py-2 mr-6">
                                <i class="fa-solid fa-plus mr-2"></i>
                                <span>Tambah Pengguna</span>
                            </button>
                        </div>
                    </div>

                    <div class="px-10 mb-5">
                        <table id="userTable" class="w-full text-xs md:text-sm text-left     text-black     hidden">
                            <thead class="text-sm     text-black     uppercase bg-gray-50">
                                <tr>
                                    {{-- <th class="px-4 py-4">Profile Picture</th> --}}
                                    <th class="md:px-4 md:py-3">NIS / NIK</th>
                                    <th class="md:px-4 md:py-3">Nama Lengkap</th>
                                    <th class="md:px-4 md:py-3">Kelas</th>
                                    <th class="md:px-4 md:py-3">Status</th>
                                    <th class="md:px-4 md:py-3">Vote</th>
                                    <th class="md:px-4 md:py-3">
                                        <span>Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr class="border-b">
                                        {{-- <td class="px-4 py-3"><img class="max-w-[5rem]" src="{{ asset('img/hafiz.webp') }}"></td> --}}
                                        <td class="px-4 py-3">{{ $u->email }}</td>
                                        <td class="px-4 py-3 max-w-[10rem]">{{ $u->name }}</td>
                                        <td class="px-4 py-3">
                                            {{ isset($u->kelas) ? $u->kelas : '-' }}
                                        </td>
                                        <td class="px-4 py-3">{{ $u->role }}</td>

                                        <td class="px-4 py-3">
                                            {{ $u->voteStatus() }}
                                        </td>
                                        <td class="p-4 py-3">
                                            <button
                                                class="font-medium hover:bg-gray-20 py-1.5 px-2 text-center     text-black     hover:text-black duration-[400ms] rounded-lg focus:ring-2 focus:ring-primary-10 focus:border-primary-10"
                                                type="button" x-on:click="user={{ $u }},updateUser=!updateUser">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                    viewBox="0 -960 960 960" fill="currentColor">
                                                    <path
                                                        d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                                </svg>
                                            </button>
                                            <button
                                                class="font-medium hover:bg-gray-20 py-1.5 px-2 text-center     text-black     hover:text-black duration-[400ms] rounded-lg focus:ring-2 focus:ring-primary-10 focus:border-primary-10"
                                                type="button" x-on:click="user={{ $u }},deleteUser=!deleteUser">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                                                    width="24px" fill="currentColor">
                                                    <path
                                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="md:mt-5 mb-10">
                            {{ $users->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End block -->

        <!-- Create modal -->
        <div id="createUser" tabindex="-1" x-show="createUser" aria-hidden="true"
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 max-h-full h-screen z-50">
            <div class="relative p-4 w-full flex justify-center items-center max-w-4xl max-h-full h-screen z-50">
                <!-- Modal content -->
                <div x-show="createUser" x-transition.duration.300ms class="relative p-4 bg-white rounded-lg shadow sm:p-5"
                    x-on:click.outside="createUser=!createUser">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="font-medium text-xl">Tambah Pengguna</h3>
                        <button type="button" x-on:click="createUser=!createUser"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center"
                            x-on:click="createUser=!createUser">
                            <i class="fa-solid fa-xmark fa-xl"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form id="createUserForm" method="POST" action="{{ route('dashboard.store_users') }}">
                        @method('POST')
                        @csrf
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">

                            <x-input required name="email" placeholder="NIS / NIK" />
                            <x-input required name="name" placeholder="Nama Lengkap" />
                            <x-select required name="kelas" placeholder="Kelas">
                                <option value="-">Guru/TU/Staff/Admin</option>
                                @foreach ($kelas as $class)
                                    <option value="{{ $class }}">{{ $class }}</option>
                                @endforeach
                            </x-select>

                            <x-input required name="password" placeholder="Password" />
                            <x-select name="role" id="role" placeholder="Role" required>
                                @foreach ($role as $r)
                                    <option value="{{ $r }}">{{ $r }}</option>
                                @endforeach
                            </x-select>

                        </div>
                        <div class="flex justify-end items-center">
                            <button type="submit"
                                class="inline-flex items-center text-white bg-primary-20 hover:text-black hover:bg-secondary-20 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-secondary-10 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Update Modal --}}
        <div id="updateUserModal" x-show="updateUser" tabindex="-1" aria-hidden="true"
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full h-screen">
            <div class="relative flex justify-center items-center p-4 w-full max-w-4xl max-h-full h-screen z-50">
                <!-- Modal content -->
                <div x-show="updateUser" x-transition.duration.300ms class="relative p-4 bg-white rounded-lg shadow sm:p-5"
                    x-on:click.outside="updateUser=!updateUser">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="font-medium text-xl">Ubah Pengguna</h3>
                        <button type="button" x-on:click="updateUser=!updateUser"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center">
                            <i class="fa-solid fa-xmark fa-xl"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form id="updateUserForm" method="POST" x-bind:action="route.update + '/' + user.id">

                        @method('PUT')
                        @csrf
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <x-input type="text" name="email" id="email"
                                placeholder="NIS
                                    / NIK" x-model="user.email"
                                required />
                            <x-input type="text" name="name" id="update_name" placeholder="Nama lengkap"
                                x-model="user.name" required />
                            <x-select x-bind:value="user.kelas" placeholder="Kelas" name="kelas">
                                <option value="-"
                                    x-text="user.role.toLowerCase() !== 'siswa' ? user.role : 'Guru | Tata Usaha | Panitia | Admin'">
                                </option>
                                @foreach ($kelas as $class)
                                    <option value="{{ $class }}">{{ $class }}</option>
                                @endforeach
                            </x-select>

                            <x-input name="password" id="update_password" placeholder="Password" x-model="user.sandi"
                                required />
                            {{-- <div class="relative">
                                <input type="text" name="password" id="update_password" x-model="user.sandi"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="update_password"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password</label>
                            </div> --}}
                            <x-select x-bind:value="user.role" placeholder="Sebagai" name="role">
                                @foreach ($role as $r)
                                    <option value="{{ $r }}">{{ $r }}</option>
                                @endforeach
                            </x-select>

                        </div>
                        <div class="flex justify-end items-center">
                            <button type="submit"
                                class="inline-flex items-center text-white bg-primary-20 hover:text-black hover:bg-secondary-20 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-secondary-10 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Ubah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete modal -->
        <div id="deleteModal" x-show="deleteUser" tabindex="-1" aria-hidden="true"
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full h-screen">
            <div x-show="deleteUser" x-transition.duration.300ms
                class="relative p-4 flex justify-center items-center w-full max-w-lg max-h-full h-screen z-50">
                <!-- Modal content -->
                <div x-on:click.outside="deleteUser=!deleteUser"
                    class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                    <button type="button" x-on:click="deleteUser=!deleteUser"
                        class="    text-black     absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-20 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center">
                        <i class="fa-solid fa-xmark fa-xl"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="    text-black     w-11 h-11 my-3.5 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
                            <path
                                d="M600-240v-80h160v80H600Zm0-320v-80h280v80H600Zm0 160v-80h240v80H600ZM120-640H80v-80h160v-60h160v60h160v80h-40v360q0 33-23.5 56.5T440-200H200q-33 0-56.5-23.5T120-280v-360Zm80 0v360h240v-360H200Zm0 0v360-360Z" />
                        </svg>
                    </div>
                    <form id="user_delete_form" method="POST" x-bind:action="route.delete + '/' + user.id">
                        @csrf
                        @method('DELETE')
                        <p class="text-stone-800">Apakah Anda yakin ingin menghapus pengguna ini?
                        </p>
                        <div class="flex text-nowrap my-4 gap-2 bg-opacity-15 bg-red-800 p-2 py-1 rounded-md justify-between">
                            <div x-text="user.email"></div>
                            <div x-text="user.name"></div>
                            <div x-show="user.kelas !== '-'" x-text="user.kelas"></div>
                            <div x-show="user.role !== 'Siswa'" x-text="user.role"></div>
                        </div>
                        <div class="flex justify-center items-center space-x-4">
                            <button type="button" x-on:click="deleteUser=!deleteUser"
                                class="py-2 px-3 w-20 text-sm font-medium     text-black     bg-white rounded-lg border border-gray-30 hover:bg-gray-20 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-primary-10 hover:text-black focus:z-10">Tidak</button>
                            <button type="submit"
                                class="py-2 px-3 w-20 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-red-300">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function userData() {
            return {
                user: {
                    role: ''
                },
                updateUser: false,
                deleteUser: false,
                createUser: false,
                route: {
                    update: '{{ route('dashboard.update_users', '') }}',
                    delete: '{{ route('dashboard.delete_users', '') }}'
                }
            }
        }
        $(document).ready(function() {
            $('#userTable').removeClass("hidden");
        });
        $('#userTable').DataTable({
            searching: false,
            paging: false,
            info: false
        });
    </script>
    <x-bottom-nav />
@endsection

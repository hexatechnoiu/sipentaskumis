@extends('layouts.main')
@section('title')
    Kelola kandidat
@endsection

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/trix@2.1.1/dist/trix.umd.min.js"
        integrity="sha256-vCKCTk4D/3d9qJDGsn8t1MDYoLJMgi0w50Lb0n+AMGo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.1.1/dist/trix.min.css">
@endsection

@include('partials.sidebar')
@section('container')
    <div x-data="QPD">
        <!-- Start block -->
        <section class="bg-gray-50 p-3 sm:p-5 antialiased sm:ml-[78px]">
            <div class="mx-auto pb-28 px-4">
                <div class="flex flex-col justify-center text-center mb-10">
                    <h1 class="font-semibold text-xl text-primary-20">Calon Kandidat OSIS & MPK</h1>
                </div>
                <!-- Start coding here -->
                <div class="bg-white relative shadow-none sm:rounded-lg overflow-hidden p-5 pb-10">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center" method="GET">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-magnifying-glass w-5 h-5     text-black    "></i>
                                    </div>
                                    <input type="text" id="simple-search" name="search"
                                        class="bg-white border border-gray-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-ring-primary-40 flex w-full pl-10 p-2"
                                        placeholder="Cari Kandidat" value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                        <div
                            class="md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0 sm:w-full">

                            <button type="button" id="createKandidatButton" @click="createKandidat=!createKandidat"
                                class="flex sm:w-full items-center justify-center text-white bg-primary-20 hover:text-black hover:bg-secondary-20 focus:ring-4 focus:ring-secondary-10 duration-[400ms] font-medium rounded-lg text-sm px-4 py-2">
                                <i class="fa-solid fa-plus mr-2"></i>
                                <span>Tambah Kandidat</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left     text-black    ">
                            <thead class="text-sm     text-black     uppercase">
                                <tr>
                                    <th scope="col" class="px-4 py-4 text-center">Nomor urut</th>
                                    <th scope="col" class="px-4 py-3 text-center">Foto kandidat</th>
                                    <th scope="col" class="px-4 py-3">Nama kandidat</th>
                                    <th scope="col" class="px-4 py-3 text-center">Organisasi</th>
                                    <th scope="col" class="px-4 py-3 text-center">Jumlah vote</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kandidats as $k)
                                    <tr class="border-b">
                                        <td class="px-4 py-3 font-semibold text-lg text-center">{{ $k->nomor_urut }}</td>
                                        <td class="px-4 py-3 flex justify-center"><img class="object-cover w-14 h-14"
                                                src="{{ Storage::url($k->photo) }}">
                                        </td>
                                        <td class="px-4 py-3 max-w-[10rem]">{{ $k->name }}</td>
                                        <td class="px-4 py-3 text-center">{{ $k->org }}</td>
                                        <td class="px-4 py-3 max-w-[12rem] truncate text-center">{{ $k->vote->count() }}
                                        </td>
                                        <td class="p-4 py-3">
                                            <button
                                                class="font-medium hover:bg-gray-200 py-1.5 px-2 text-center     text-black     hover:text-black duration-[400ms] rounded-lg focus:ring-2 focus:ring-primary-10 focus:border-primary-10"
                                                type="button"
                                                x-on:click="kandidat={{ $k }},updateKandidat=!updateKandidat">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                    viewBox="0 -960 960 960" fill="currentColor">
                                                    <path
                                                        d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                                </svg>
                                            </button>
                                            <button
                                                class="font-medium hover:bg-gray-200 py-1.5 px-2 text-center     text-black     hover:text-black duration-[400ms] rounded-lg focus:ring-2 focus:ring-primary-10 focus:border-primary-10"
                                                type="button"
                                                x-on:click="kandidat={{ $k }},deleteKandidat=!deleteKandidat">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                                                    width="24px" fill="currentColor">
                                                    <path
                                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                                </svg>
                                            </button>
                                            <button
                                                class="font-medium hover:bg-gray-200 py-1.5 px-2 text-center     text-black     hover:text-black duration-[400ms] rounded-lg focus:ring-2 focus:ring-primary-10 focus:border-primary-10"
                                                type="button"
                                                x-on:click="kandidat={{ $k }},showKandidat=!showKandidat">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                    viewBox="0 -960 960 960" fill="currentColor">
                                                    <path
                                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-480H200v480Zm280-80q-82 0-146.5-44.5T240-440q29-71 93.5-115.5T480-600q82 0 146.5 44.5T720-440q-29 71-93.5 115.5T480-280Zm0-60q56 0 102-26.5t72-73.5q-26-47-72-73.5T480-540q-56 0-102 26.5T306-440q26 47 72 73.5T480-340Zm0-100Zm0 60q25 0 42.5-17.5T540-440q0-25-17.5-42.5T480-500q-25 0-42.5 17.5T420-440q0 25 17.5 42.5T480-380Z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- End block -->

        <!-- Create modal -->
        <div id="createKandidatModal" x-show="createKandidat" tabindex="-1" x-transition.duration.300ms aria-hidden="true"
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
            <div class="relative p-4 w-full max-w-4xl max-h-full"
                x-on:click.outside="createKandidat=!createKandidat,imageSrc=''">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="text-2xl font-semibold text-black">Tambah Kandidat</h3>
                        <button type="button" x-on:click="createKandidat=!createKandidat,imageSrc=''"
                            class="    text-black     bg-transparent hover:bg-gray-200 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center">
                            <i class="fa-solid fa-xmark fa-xl"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form id="createKandidatForm" method="POST" action="{{ route('dashboard.store_kandidat') }}"
                        class="flex flex-col gap-4 justify-content-end items-start text-sm md:text-base"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col md:flex-row justify-around gap-4 md:gap-0">
                            <div class="md:h-[23%] md:w-[23%] rounded-full object-cover overflow-hidden">
                                <img x-bind:src="imageSrc === '' ? '{{ asset('img/admin.webp') }}' : imageSrc"
                                    id="PreviewImagecreate" class="w-full h-full hover:scale-150 duration-300">
                            </div>
                            <div class="flex flex-col gap-4">
                                <div class="flex gap-4">
                                    <x-input type="number" name="nomor_urut" id="no" placeholder="Nomor urut"
                                        required />
                                    <x-input id="fotoKandidat" @change="updatePreview" placeholder="Foto kandidat"
                                        type="file" name="photo" />
                                </div>
                                <div class="flex gap-4">
                                    <x-input type="text" name="name" placeholder="Nama kandidat" required />
                                    <x-select name="Organisasi" placeholder="Organisasi">
                                        <option value="OSIS">OSIS</option>
                                        <option value="MPK">MPK</option>
                                    </x-select>
                                </div>
                                <div class="flex gap-4">
                                    <x-input name="motto" placeholder="Motto" required />
                                    <x-input name="visi" placeholder="Visi" required />
                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="flex w-full">
                                <div class="relative w-full md:px-4">
                                    <textarea rows="6" name="misi"
                                        class="w-full peer transition-all duration-500 border border-gray-300 text-gray-900 placeholder-transparent focus:outline-none h-full auto px-2.5 pb-2.5 pt-4  text-sm  bg-transparent rounded-lg border-1  appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:border-2 focus:border-blue-600"
                                        required></textarea>
                                    <label for="misi"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                        Misi</label>
                                </div>
                            </div>
                            <div class="flex justify-end items-center mt-2">
                                <button type="submit"
                                    class="inline-flex items-center text-white bg-primary-20 hover:text-black hover:bg-secondary-20 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-secondary-10 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Tambah
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Update modal -->
        <div id="updateKandidatModal" x-show="updateKandidat" tabindex="-1" x-transition.duration.300ms
            aria-hidden="true"
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
            <div class="relative p-4 w-full max-w-4xl max-h-full"
                x-on:click.outside="updateKandidat=!updateKandidat,imageSrc=''">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="text-2xl font-semibold text-black">Ubah Kandidat</h3>
                        <button type="button" x-on:click="updateKandidat=!updateKandidat,imageSrc=''"
                            class="    text-black     bg-transparent hover:bg-gray-200 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center">
                            <i class="fa-solid fa-xmark fa-xl"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form id="updateKandidatForm" method="POST" x-bind:action="route.update + '/' + kandidat.id"
                        class="flex flex-col gap-4 justify-content-end items-start text-sm md:text-base"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="flex flex-col md:flex-row justify-around gap-4 md:gap-0">
                            <div class="md:h-[23%] md:w-[23%] rounded-full object-cover overflow-hidden">
                                <img x-bind:src="imageSrc == '' ? '/storage/' + kandidat.photo : imageSrc"
                                    id="PreviewImageUpdate" class="w-full h-full hover:scale-150 duration-300">
                            </div>
                            <div class="flex flex-col gap-4">
                                <div class="flex gap-4">
                                    <x-input type="number" name="nomor_urut" id="no" placeholder="Nomor urut"
                                        x-model="kandidat.nomor_urut" required />
                                    <x-input id="fotoKandidat" @change="updatePreview" placeholder="Foto kandidat"
                                        type="file" name="photo" />
                                </div>
                                <div class="flex gap-4">
                                    <x-input type="text" x-model="kandidat.name" name="name"
                                        placeholder="Nama kandidat" required />
                                    <x-select name="Organisasi" placeholder="Organisasi">
                                        <option value="OSIS">OSIS</option>
                                        <option value="MPK">MPK</option>
                                    </x-select>
                                </div>
                                <div class="flex gap-4">
                                    <x-input name="motto" x-model="kandidat.motto" placeholder="Motto" required />
                                    <x-input name="visi" x-model="kandidat.visi" placeholder="Visi" required />
                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="flex w-full">
                                <div class="relative w-full md:px-4">
                                    <textarea rows="6" name="misi" x-html="kandidat.misi"
                                        class="w-full peer transition-all duration-500 border border-gray-300 text-gray-900 placeholder-transparent focus:outline-none h-full auto px-2.5 pb-2.5 pt-4  text-sm  bg-transparent rounded-lg border-1  appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:border-2 focus:border-blue-600"
                                        required></textarea>
                                    <label for="misi"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                        Misi</label>
                                </div>
                            </div>
                            <div class="flex justify-end items-center mt-2">
                                <button type="submit"
                                    class="inline-flex items-center text-white bg-primary-20 hover:text-black hover:bg-secondary-20 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-secondary-10 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Ubah
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Read modal -->
        <div id="readKandidatModal" x-show="showKandidat" tabindex="-1" aria-hidden="true" x-transition.duration.300ms
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
            <div class="relative p-4 w-full max-w-3xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5" @click.outside="showKandidat=!showKandidat">
                    <!-- Modal header -->
                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                        <img class="mx-auto mb-4 w-36 h-36 rounded-full justify-center object-cover" x-bind:src="'/storage/' + kandidat.photo">
                        <div>
                            <button type="button" @click="showKandidat=!showKandidat"
                                class="absolute right-4     text-black     bg-transparent hover:bg-gray-200 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 inline-flex">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-6 text-xl text-black font-semibold">NO URUT : 1</h3>
                        <dl>
                            <dt class="mt-2 font-semibold leading-none text-black">Nama Kandidat</dt>
                            <dd class="mb-4 font-light text-base     text-black     sm:mb-5" x-text="kandidat.name"></dd>
                        </dl>
                        <dl>
                            <dt class="mt-2 font-semibold leading-none text-black">Organisasi</dt>
                            <dd class="mb-4 font-light text-base     text-black     sm:mb-5" x-text="kandidat.org"></dd>
                        </dl>
                        <dl>
                            <dt class="mt-2 font-semibold leading-none text-black">Motto</dt>
                            <dd class="mb-4 font-light text-base     text-black     sm:mb-5" x-text="kandidat.motto">
                            </dd>
                        </dl>
                        <dl>
                            <dt class="mt-2 font-semibold leading-none text-black">Visi</dt>
                            <dd class="mb-4 font-light text-base     text-black     sm:mb-5" x-text="kandidat.visi">
                            </dd>
                        </dl>
                        <dl>
                            <dt class="mt-2 font-semibold leading-none text-black">Misi</dt>
                            <pre class="font-[Poppins] text-wrap mb-4 font-light text-base     text-black     sm:mb-5" x-text="kandidat.misi">
                            </pre>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete modal -->
        <div id="deleteModal" tabindex="-1" x-show="deleteKandidat" aria-hidden="true" x-transition.duration.300ms
            class="flex bg-black bg-opacity-45 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5"
                    @click.outside="deleteKandidat=!deleteKandidat">
                    <button type="button"
                        class="    text-black     absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center"
                        @click="deleteKandidat=!deleteKandidat">
                        <i class="fa-solid fa-xmark fa-xl"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="    text-black     w-11 h-11 my-3.5 mx-auto">
                        <i class="fa-solid fa-trash-can fa-2xl"></i>
                    </div>
                    <form id="kandidat_delete_form" method="POST" enctype="multipart/form-data"
                        x-bind:action="route.delete + '/' + kandidat.id">
                        @csrf
                        @method('DELETE')
                        <p class="mb-4     text-stone-800    ">Apakah Anda yakin ingin menghapus kandidat ini?</p>
                        <div class="flex justify-center items-center space-x-4">
                            <button type="button"
                                class="py-2 px-3 w-20 text-sm font-medium     text-black     bg-white rounded-lg border border-gray-30 hover:bg-gray-200 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-primary-10 hover:text-black focus:z-10"
                                @click="deleteKandidat=!deleteKandidat">
                                Tidak
                            </button>
                            <button type="submit"
                                class="py-2 px-3 w-20 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 duration-[400ms] focus:ring-4 focus:outline-none focus:ring-red-300">
                                Ya
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-bottom-nav />

    <script>
        function QPD() {
            return {
                imageSrc: '',
                kandidat: {},
                updateKandidat: false,
                deleteKandidat: false,
                showKandidat: false,
                createKandidat: false,
                route: {
                    update: '{{ route('dashboard.update_kandidat', '') }}',
                    delete: '{{ route('dashboard.destroy_kandidat', '') }}',
                },
                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imageSrc = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        this.imageSrc = '';
                    }
                }
            }
        }
    </script>
@endsection

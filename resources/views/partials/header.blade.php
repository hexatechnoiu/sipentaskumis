<nav class="navbar bg-primary-20 sticky lg:fixed w-full z-50 top-0 left-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3 sm:px-6">
        <a href="/" class="flex items-center">
            <img src="{{ asset('img/logo.svg') }}" class="h-8 mr-4" alt="LOGO" />
            <span class="text-2xl text-white font-semibold">SIPENTAS KUMIS</span>
        </a>
        <div class="flex lg:order-2">
            @auth
            <form method="POST" action="{{ route('logout') }}" class="flex justify-end">
                @csrf
                <button type="submit" class="flex text-white bg-transparent hover:text-primary-20 hover:bg-white border border-white duration-[400ms] text-sm rounded-lg p-2 text-center">
                    Logout
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-sm h-5 ml-2 -mr-1" fill="currentColor" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                    </svg>
                </button>
            </form>
            @endauth
        </div>
        <div class="items-center justify-end w-full lg:flex lg:w-auto" id="navbar-search">
            {{-- <ul
                class="flex flex-col p-4 lg:p-0 mt-4 border rounded-sm lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:ml-20">
                <li><a href="/"
                        class="nav {{ $active === 'beranda' ? 'nav-active text-secondary-40' : 'text-white' }} block py-2 pl-3 lg:hover:text-secondary-40 duration-[400ms] lg:p-0">Beranda</a>
                </li>
                <li><a href="/produk"
                        class="nav {{ $active === 'produk' ? 'nav-active text-secondary-40' : 'text-white' }} block py-2 pl-3 lg:hover:text-secondary-40 duration-[400ms] lg:p-0">Produk</a>
                </li>
                <li><a href="/tentang"
                        class="nav {{ $active === 'tentang' ? 'nav-active text-secondary-40' : 'text-white' }} block py-2 pl-3 lg:hover:text-secondary-40 duration-[400ms] lg:p-0">Tentang
                        Kami</a></li>
                <li><a href="/kontak"
                        class="nav {{ $active === 'kontak' ? 'nav-active text-secondary-40' : 'text-white' }} block py-2 pl-3 lg:hover:text-secondary-40 duration-[400ms] lg:p-0">Kontak</a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>

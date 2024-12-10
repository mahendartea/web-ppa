<nav
    class="dark:bg-gray-900 md:fixed md:w-full md:px-10 z-50 md:top-0 md:start-0 dark:border-gray-600 bg-[#faec04] py-5">
    <div class="lg:max-w-screen-2xl max-h-16 flex flex-wrap items-center justify-between mx-auto bg-[#faec04] mb-5">
        <a href="/"
            class="md:flex md:items-center md:space-x-3 md:space-y-0 space-y-2 rtl:space-x-reverse md:ml-0 ml-4 z-30">
            <img src="/assets/img/logobiru.jpeg" class="h-28 md:h-32 bg-transparent no-border rounded-b-xl"
                alt="PPA
            Logo">
            <span
                class="self-center text-xl md:text-[#040181] font-semibold whitespace-nowrap dark:text-white
            hidden md:block uppercase">Partai
                Perjuangan
                Aceh</span>
        </a>

        <div x-data="{ open: false }" class="items-center justify-between flex xl:hidden mr-5">
            <button type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                @click="open = !open">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        fill-rule="evenodd"></path>
                </svg>
            </button>

            <div x-show="open" class="absolute top-0 left-0 w-full z-20 mt-28 shadow-lg">
                <div class="p-4 mt-4 text-white bg-[#faec04] rounded-lg">
                    <ul class="space-y-4">
                        <li class="block py-2">
                            <a href="/tentang"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Tentang</a>
                        </li>
                        <li class="block py-2">
                            <a href="/berita"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Berita</a>
                        </li>
                        {{-- <li class="block py-2">
                            <a href="/agenda"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Agenda</a>
                        </li> --}}
                        {{-- <li class="block py-2">
                            <a href="/aksi"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Aksi</a>
                        </li> --}}
                        <li class="block py-2">
                            <a href="/galeri"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Galeri</a>
                        </li>
                        <li class="block py-2">
                            <a href="/seputar-partai"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Seputar Partai</a>
                        </li>
                        <li class="block py-2">
                            <a href="https://jdih.kpu.go.id/aceh/peraturan-kpu" target="_blank"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Peraturan KPU</a>
                        </li>
                        <li class="block py-2">
                            <a href="/informasi-publik"
                                class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                                aria-current="page">Informasi Publik</a>
                        </li>
                        <!--[if ENDBLOCK]><![endif]-->
                        <li class="block py-2">
                            <a href="/register"
                                class="block py-2 px-3 text-white font-extrabold bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500">Pendaftaran
                                Anggota</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="items-center justify-between hidden w-full xl:flex md:w-auto md:order-1 " id="navbar-sticky">
            <ul
                class="xl:flex flex-col hidden p-4 md:p-0 mt-4 font-medium border border-gray-100 bg-[#faec04] rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#faec04] dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="/tentang"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Tentang</a>
                </li>
                {{-- <li>
                    <a href="/agenda"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Agenda</a>
                </li> --}}
                {{-- <li>
                    <a href="/aksi"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Aksi</a>
                </li> --}}
                <li>
                    <a href="/berita"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Berita</a>
                </li>
                <li>
                    <a href="/galeri"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Galeri</a>
                </li>
                <li>
                    <a href="/seputar-partai"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Seputar Partai</a>
                </li>
                <li>
                    <a href="/informasi-publik"
                        class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                        aria-current="page">Informasi Publik</a>
                </li>
                <li>
                    <a href="https://jdih.kpu.go.id/aceh/peraturan-kpu" target="_blank"
                        class="bg-[#ff8100] text-white px-1 py-1 rounded-md hover:bg-[#ffa500] hover:text-white"
                        aria-current="page">Peraturan KPU</a>
                </li>
                <!--[if ENDBLOCK]><![endif]-->
                <li>
                    <a href="/register"
                        class="block py-2 px-3 text-white font-extrabold bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500">Pendaftaran
                        Anggota</a>
                </li>
                {{-- @foreach ($menu as $m)
                    <li>
                        <a href="{{ $m->link }}"
                            class="block py-2 px-3 text-white bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500"
                            aria-current="page">{{ $m->name }}</a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('registerasi') }}"
                        class="block py-2 px-3 text-white font-extrabold bg-yellow-700 md:hover:border-b md:border-yellow-500 md:bg-transparent md:text-[#040181] md:hover:text-yellow-500 md:p-0 md:dark:text-yellow-500">Pendaftaran
                        Anggota</a>
                </li> --}}
            </ul>
        </div>
</nav>

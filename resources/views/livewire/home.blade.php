<div>

    <div id="default-carousel" class="relative w-full lg:mt-18 z-0" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative overflow-hidden rounded-lg lg:h-[90vh] md:h[60vh] h-[30vh]">
            @foreach ($sliders as $slider)
                <!-- Item -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>

                    <img src="{{ asset('storage/' . $slider->image) }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="{{ $slider->title }}">
                </div>
            @endforeach
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            @foreach ($sliders as $index => $slider)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
            @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-6xl px-6 py-10 mx-auto">
            <div class="flex flex-wrap w-full mb-4 p-4">
                <div class="w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-4xl text-5xl font-medium  title-font mb-2 text-[#040181]">Ketua Umum Partai
                    </h1>
                    <span class="inline-block w-16 h-1 bg-[#040181] rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-[#040181] rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-[#040181] rounded-full"></span>
                </div>
            </div>

            <main class="relative z-10 w-full mt-8 md:flex md:items-center xl:mt-12">
                <div class="absolute w-full bg-[#040181] -z-10 md:h-96 rounded-2xl"></div>

                <div
                    class="w-full p-6 bg-blue-600 md:flex md:items-center rounded-2xl md:bg-transparent md:p-0 lg:px-12 md:justify-evenly">
                    <img class="h-24 md:w-24 md:mx-6 md:object-cover md:h-[32rem] md:w-80
                    lg:h-[36rem] lg:w-[26rem] md:rounded-2xl"
                        src="/assets/img/pimpinan.png" alt="client photo" />

                    <div class="mt-2 md:mx-6">
                        <div>
                            <p class="text-xl font-medium tracking-tight text-white" id="title">Prof. Adjunct Dr.
                                Marniati, S.E., M.Kes</p>
                            <p class="text-blue-200 " id="subtitle">Ketua Umum Partai Perjuangan Aceh</p>
                        </div>

                        <p class="mt-4 text-lg leading-relaxed text-white md:text-xl capitalize" id="paragraf">
                            “Harapan akan berubah menjadi jawaban, Jika diiringi dengan Usaha”.
                        </p>

                        <div class="flex items-center justify-between mt-6 md:justify-start">

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <section class="grid lg:grid-cols-2 grid-cols-1 w-full bg-white dark:bg-gray-900 h-[500px]">
        <div
            style="background-image:url(/assets/img/slideempat.jpeg);
        background-size:cover; background-position:center; height:100%">
        </div>
        <div class="flex flex-col items-center justify-center p-10 bg-[#feec03]">
            <h2 class="text-3xl font-bold text-[#040181]">Visi</h2>
            <p class="mt-4 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                Visi Partai Perjuangan Aceh adalah menjadi partai yang mengedepankan nilai-nilai
                Islam dan Pancasila dalam pembangunan masyarakat Aceh yang berkeadilan,
                sejahtera, dan berbudaya.
            </p>
            <h2 class="mt-10 text-3xl font-bold text-[#040181]">Misi</h2>
            <ul class="mt-4 list-disc list-inside text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                <li>Menciptakan suasana sosial dan politik yang mendukung agar rakyat bisa memiliki suara dan
                    mendapatkan kesejahteraan.</li>
                <li>Mendukung pembangunan nasional yang fokus pada ekonomi yang bermanfaat bagi masyarakat dan
                    menjaga pertumbuhan yang berkelanjutan.</li>
                <li>Meraih kekuasaan pemerintahan melalui pemilihan umum (Pemilu) yang jujur dan adil, baik itu
                    Pemilu Legislatif maupun Pemilu Kepala Daerah, untuk memastikan ada pemimpin yang kuat dan
                    bersih di setiap tingkat pemerintahan.</li>
                <li>Mengangkat martabat Aceh di dunia internasional dan aktif terlibat dalam hubungan internasional
                    untuk memastikan Aceh dikenal dan dihargai oleh negara-negara lain.</li>
                <li>Menjadi suara masyarakat Aceh, berjuang dan mendengarkan aspirasi dan kebutuhan rakyat, serta
                    bekerja keras untuk mewujudkannya.</li>
            </ul>
        </div>
    </section>
    <section class="grid lg:grid-cols-2 grid-cols-1 w-full bg-white dark:bg-gray-900 h-[500px] mb-20">
        <div class="flex flex-col items-center justify-center p-10 bg-[#feec03] border-r-2 border-[#040181]">
            <h2 class="text-3xl font-bold text-[#040181]">Sejarah Partai</h2>
            <p class="mt-4 text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                Partai Perjuangan Aceh (PPA) didirikan dengan latar belakang kesadaran mendalam bahwa
                Aceh memiliki potensi besar dan beragam untuk menjadi daerah yang maju dan sejahtera.
                Keinginan untuk menciptakan perubahan yang nyata dan memperjuangkan hak-hak
                masyarakat, khususnya kaum perempuan, mendorong terbentuknya partai ini....
            </p>
            <a href="/tentang"
                class="mt-4 inline-block px-6 py-2 text-base font-semibold leading-6 text-white transition duration-150 ease-in-out bg-[#040181] border border-transparent rounded-md hover:bg-[#040181] focus:outline-none focus:border-[#040181] focus:ring-0 active:bg-[#040181]">
                Selengkapnya
            </a>
        </div>
        <div class="bg-[#040181] bg-no-repeat bg-center flex items-center justify-center">
            <img src="/assets/img/logobesar.jpeg" class="md:h-[500px] md:object-cover" alt="sejarah partai" />
        </div>
    </section>
    <!-- component -->
    <section class="text-gray-600 body-font ">
        <div class="container px-5 py-24 mx-auto max-w-7x1">
            <div class="flex flex-wrap w-full mb-4 p-4">
                <div class="w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-4xl text-5xl font-medium  title-font mb-2 text-[#040181]">Liputan Kegiatan
                    </h1>
                    <span class="inline-block w-16 h-1 bg-[#040181] rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-[#040181] rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-[#040181] rounded-full"></span>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($news as $berita)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="{{ $berita->image ?? '' }}" alt="">

                        <div class="flex flex-col justify-between p-5">
                            <div>
                                <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                    {{ $berita->title }}
                                </h1>

                                <p class="mt-2 text-gray-500 dark:text-gray-400 text-justify">
                                    {!! Str::limit($berita->content, 500) !!}
                                </p>
                            </div>

                            <div class="flex items-center justify-between mt-5">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    @php
                                        $result = $berita->created_at->locale('id_ID')->isoFormat('DD MMMM YYYY');
                                    @endphp

                                    {{ $result }}

                                </p>
                                <a href="{{ route('berita.detail', $berita->slug) }}"
                                    class="inline-block text-blue-500">Selengkapnya</a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="flex justify-center pb-10">
            <a href="/berita"
                class="px-4 py-2 bg-[#040181] text-white font-semibold rounded-lg shadow-md hover:bg-blue-700
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Selengkapnya
            </a>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900 pb-10">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-[#040181]">
                Galeri Kegiatan
            </h1>
            <span class="inline-block w-16 h-1 bg-[#040181] rounded-full"></span>
            <span class="inline-block w-3 h-1 mx-1 bg-[#040181] rounded-full"></span>
            <span class="inline-block w-1 h-1 bg-[#040181] rounded-full"></span>

            <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
                <button type="button" wire:click="filterKategori"
                    class="text-[#040181] hover:text-white border bg-white hover:bg-[#040181] focus:ring-4
                    focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3
                    {{ is_null($selectedKategori) ? 'text-[#040181] bg-white border-2  border-[#040181]' : '' }}">
                    Semua
                </button>
                <button type="button" wire:click="filterKategori('sosialisasi')"
                    class="text-[#040181] border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900
                    dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full
                    text-base font-medium px-5 py-2.5 text-center me-3 mb-3
                    {{ $selectedKategori === 'sosialisasi' ? 'text-[#040181] bg-white border-2  border-[#040181]' : '' }}">
                    Sosialisasi
                </button>
                <button type="button" wire:click="filterKategori('kepartaian')"
                    class="text-[#040181] border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900
                    dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full
                    text-base font-medium px-5 py-2.5 text-center me-3 mb-3
                    {{ $selectedKategori === 'kepartaian' ? 'text-[#040181] bg-white border-2  border-[#040181]' : '' }}">
                    Kepartaian
                </button>
                <button type="button" wire:click="filterKategori('solidaritas')"
                    class="text-[#040181] border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900
                    dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full
                    text-base font-medium px-5 py-2.5 text-center me-3 mb-3
                    {{ $selectedKategori === 'solidaritas' ? 'text-[#040181] bg-white border-2  border-[#040181]' : '' }}">
                    Solidaritas
                </button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($galeri as $gal)
                    <div class="relative group">
                        @if (is_array($gal->image))
                            <div class="relative w-full h-64">
                                @foreach ($gal->image as $index => $image)
                                    <img class="absolute inset-0 h-full w-full object-cover rounded-lg {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-300 group-hover:opacity-100"
                                        src="{{ Storage::url($image) }}"
                                        alt="{{ $gal->name }} - Image {{ $index + 1 }}"
                                        style="transition-delay: {{ $index * 200 }}ms">
                                @endforeach
                            </div>
                        @else
                            <img class="h-64 w-full object-cover rounded-lg" src="{{ Storage::url($gal->image) }}"
                                alt="{{ $gal->name }}">
                        @endif
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <div class="text-white text-center p-4">
                                <h3 class="text-xl font-bold mb-2">{{ $gal->name }}</h3>
                                <p class="text-sm">{{ $gal->caption }}</p>
                                @if (is_array($gal->image))
                                    <span class="inline-block mt-2 text-sm bg-white/20 px-2 py-1 rounded">
                                        {{ count($gal->image) }} Gambar
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{ route('galeri') }}"
                class="px-4 py-2 bg-[#040181] text-white font-semibold rounded-lg shadow-md hover:bg-blue-700
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Selengkapnya
            </a>
        </div>
    </section>

</div>

<div>
    <!-- component -->
    <section class="text-gray-600 body-font md:mt-28">
        <div class="container px-5 py-24 mx-auto max-w-7x1">
            <div class="flex flex-wrap w-full mb-4 p-4">
                <div class="w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-[#040181]">Berita Partai
                    </h1>
                    <div class="h-1 w-20 bg-[#040181] rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($berita as $news)
                    <div class="xl:w-1/3 md:w-1/2 p-4">
                        <div class="bg-white rounded-lg shadow-md">
                            <img class="lg:h-60 xl:h-56 md:h-64 sm:h-72 xs:h-72 w-full rounded object-cover object-center mb-6"
                                src="{{ $news->image }}" alt="Image Size 720x400">
                            {{-- <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">
                                {{ $news->title }}</h3> --}}
                            <h2 class="text-lg text-[#040181] font-extrabold title-font mb-3 px-5">{{ $news->title }}
                            </h2>
                            <div class="leading-relaxed text-[#040181] px-5 py-5 text-justify prose max-w-none">
                                {!! Str::limit(strip_tags($news->content), 500) !!}
                            </div>
                            <div class="px-5 py-5 text-right">
                                <a href="{{ route('berita.detail', $news->slug) }}"
                                    class="inline-block px-6 py-2 text-base font-semibold leading-6 text-white transition duration-150 ease-in-out bg-[#040181] border border-transparent rounded-md hover:bg-[#faec04] hover:text-[#040181] focus:outline-none focus:border-[#040181] focus:shadow-outline-[#040181]">
                                    Lihat Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-10 shadow-sm bg-white py-1">
                @if ($berita->onFirstPage())
                    <a href="#"
                        class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-white rounded-md cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                        Sebelumnya
                    </a>
                @else
                    <a href="{{ $berita->previousPageUrl() }}"
                        class="items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-600 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                        previous
                    </a>
                @endif

                @for ($i = 1; $i <= $berita->lastPage(); $i++)
                    @if ($i == $berita->currentPage())
                        <a href="#"
                            class="flex items-center px-4 py-2 mx-1 text-white bg-blue-600 rounded-md dark:bg-blue-500 dark:text-gray-200">
                            {{ $i }}
                        </a>
                    @else
                        <a href="{{ $berita->url($i) }}"
                            class="items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-600 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                @if ($berita->hasMorePages())
                    <a href="{{ $berita->nextPageUrl() }}"
                        class="items-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-600 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                        Berikutnya
                    </a>
                @else
                    <a href="#"
                        class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-white rounded-md cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                        Berikutnya
                    </a>
                @endif
            </div>
        </div>
    </section>
</div>

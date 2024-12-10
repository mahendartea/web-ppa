<div>
    <section class="dark:bg-gray-900 md:mt-28">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-[#040181] capitalize lg:text-3xl dark:text-white">
                <span class="text-[#faec04]">Galeri</span> Partai Perjuangan Aceh
            </h1>

            <!-- Category Filter -->
            <div class="flex flex-col items-center gap-2 md:flex-row md:justify-center md:gap-4 mt-8">
                <button wire:click="filterCategory('all')"
                    class="px-4 py-2 rounded-lg w-28 {{ $selectedCategory === 'all' ? 'bg-[#040181] text-white' : 'bg-gray-200' }}">
                    Semua
                </button>
                @foreach ($categories as $category)
                    <button wire:click="filterCategory('{{ $category }}')"
                        class="px-4 py-2 rounded-lg w-28 {{ $selectedCategory === $category ? 'bg-[#040181] text-white' : 'bg-gray-200' }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 lg:grid-cols-2">
                @foreach ($galeri as $item)
                    <div class="group relative overflow-hidden rounded-lg h-96">
                        @if (is_array($item->image) && count($item->image) > 1)
                            <div class="swiper-container h-full w-full">
                                <div class="swiper-wrapper">
                                    @foreach ($item->image as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::url($image) }}" alt="{{ $item->title }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        @else
                            <img src="{{ Storage::url($item->image[0] ?? $item->image) }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @endif

                        <div class="absolute inset-0 flex flex-col justify-end">
                            <div class="p-6 backdrop-blur-sm bg-gradient-to-t from-black/80 to-transparent">
                                <h2 class="text-xl font-bold text-white">
                                    {{ $item->title }}
                                </h2>
                                <p class="mt-2 text-sm text-gray-300">
                                    {{ $item->caption }}
                                </p>
                                <div class="flex items-center gap-3 mt-4">
                                    <span class="px-3 py-1 text-sm text-white bg-[#040181] rounded-full">
                                        {{ ucfirst($item->kategori) }}
                                    </span>
                                    @if (is_array($item->image) && count($item->image) > 1)
                                        <span class="px-3 py-1 text-sm text-white bg-[#040181]/80 rounded-full">
                                            {{ count($item->image) }} Gambar
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $galeri->links() }}
            </div>
        </div>
    </section>
</div>

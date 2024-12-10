<div>
    <section class="text-gray-600 body-font md:mt-28">
        <div class="container px-5 py-24 mx-auto max-w-7x1">
            <div class="flex flex-wrap w-full mb-4 p-4">
                <div class="w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-[#040181]">{{ $berita->title }}</h1>
                    <div class="h-1 w-20 bg-[#040181] rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                <div class="w-full p-4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <img class="w-full h-96 object-cover object-center mb-6 rounded" src="/{{ $berita->image }}"
                            alt="{{ $berita->title }}">
                        <div class="text-gray-500 text-sm mb-4">
                            {{ $berita->created_at->format('d F Y') }}
                        </div>
                        <div class="prose prose-lg max-w-none text-[#040181] text-justify">
                            {!! $berita->content !!}
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('berita') }}"
                                class="inline-block px-6 py-2 text-base font-semibold leading-6 text-white transition duration-150 ease-in-out bg-[#040181] border border-transparent rounded-md hover:bg-[#faec04] hover:text-[#040181] focus:outline-none focus:border-[#040181] focus:shadow-outline-[#040181]">
                                Kembali ke Berita
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

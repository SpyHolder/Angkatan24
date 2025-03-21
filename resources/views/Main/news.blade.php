<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- header content --}}

    <div class="flex justify-center gap-4 py-32 border-b-2 border-black">
        {{-- Content --}}
        <div class="">
            <div class="w-[600px]">
                <img src="https://placehold.co/700x400" alt="Berita Eksklusif" class="rounded-2xl">
                <div class="px-2 mt-2">
                    <p class="text-right text-sm">Holder, Tanjungpinang | 14 Desember 2024 13:55</p>
                    <p class="text-2xl font-bold mt-4">Kunjungan Tim Infrastruktur Penyiaran Pitalebar Kekomdigi ke TVRI
                        Lampung</p>
                    <p class="text-md">This conventional wisdom ignores one of the most important and ironic legacies of
                        Carters career: the powerful brand of civic populism he brought to the presidency, but later
                        abandoned in favor of the “expert-knows-best” technocratic culture that had already come to
                        dominate much of Washington.</p>
                </div>
            </div>
        </div>

        {{-- Acara --}}
        <div class="hidden md:block">
            <img src="https://placehold.co/400x600" alt="" class="rounded-xl">
        </div>
    </div>

    {{-- grid content --}}
    <div class="px-10 mt-6">

        <div class="flex justify-between">
            <div class="border-l-8 border-black px-2 text-center">
                <p class="text-2xl font-extrabold">Terbaru</p>
            </div>
            {{-- Search Input --}}
            <form class="w-96 px-5">
                <div class="relative">
                    <input type="search" id="search"
                        class="block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search..." required />
                    <button type="submit"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white p-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="flex">
            <div class="p-5 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-0 sm:gap-8">
                    @foreach ($data as $news)
                        
                        {{-- Card Grid --}}
                        <div class="break-inside-avoid bg-white border border-gray-200 rounded-lg shadow-sm  dark:border-gray-700 overflow-hidden group">
                            <a href="#">
                                <div class=" overflow-hidden">
                                    <img class="rounded-t-lg scale-[7/4] object-fill group-hover:scale-110"
                                        src="{{ asset('img/news/'.$news->picture_news) }}" alt="Berita terbaru"/>
                                </div>
                                    <div class="p-3">
                                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-black group-hover:underline">
                                            {{ $news->headline_news }}
                                        </h5>
                                        <a href="#"
                                            class="inline-flex items-center mt-2 px-3 py-2 text-sm font-medium text-center text-black rounded-lg hover:bg-black hover:text-white border border-black">
                                            Read more
                                            <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- Iklan --}}
            <div class="hidden md:block p-5 sm:p-8">
                <img src="https://placehold.co/600x1000" alt="" class="rounded-xl object-cover">
            </div>
        </div>

</x-main-layout>

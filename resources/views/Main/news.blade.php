<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- header content --}}

    <div class="flex justify-center gap-10 py-10 border-b-2 border-black">
        @php
            $firstNews = $data->first();
        @endphp

        @if (!empty($firstNews->status))    
            @if($firstNews->status === 1) 
            {{-- Content --}}
            <a href="{{ route('detail-news', $firstNews->news_id) }}" class="group ">
                <div class="w-full md:px-0 md:w-[800px] animate-fade-right animate-duration-1000 animate-delay-[600ms]">
                    <div class="px-2">
                        <div class="overflow-hidden rounded-2xl">
                            <img src="{{ asset('img/news/' . $firstNews->picture_news) }}" alt="Berita Eksklusif"
                                class="object-fill group-hover:scale-110 transition-transform duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="px-2 mt-2">
                        <p class="text-right text-xs md:text-base">{{ $firstNews->login->username }},
                            {{ $firstNews->covarage_area }}
                            | {{ $firstNews->date_publish->translatedFormat('d F Y') }},
                            {{ $firstNews->time_publish }}
                        </p>
                        <p class="text-xl md:text-3xl font-bold mt-4 group-hover:underline px-2">{{ $firstNews->headline_news }}</p>
                        <p class="text-sm md:text-lg mt-2 line-clamp-3 px-2">
                            {{ str_replace('&nbsp;', ' ', strip_tags($firstNews->content_news)) }}</p>
                    </div>
                </div>
            </a>
            @endif
        @else
            {{-- Content --}}
            <a href="" class="group ">
                <div class="w-full md:px-0  animate-fade-right animate-duration-1000 animate-delay-[600ms]">
                    <div class="px-2">
                        <div class="overflow-hidden rounded-2xl  object-cover">
                            <img src="https://placehold.co/700x900" alt="Berita Eksklusif"
                                class="object-cover h-[300px] md:w-[700px] md:h-[400px] group-hover:scale-110 transition-transform duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="px-2 mt-2">
                        <p class="text-right text-xs md:text-base">
                        </p>
                        <p class="text-xl md:text-3xl font-bold mt-4 group-hover:underline px-2"></p>
                        <p class="text-sm md:text-lg mt-2 line-clamp-3 px-2"></p>
                    </div>
                </div>
            </a>
        @endif
        {{-- Acara --}}
        <div class="hidden md:block animate-fade-left animate-duration-1000 animate-delay-[400ms]">
            <img src="https://placehold.co/400x600" alt="" class="rounded-xl">
        </div>
    </div>

    {{-- grid content --}}
    <div class="px-4 md:px-10 mt-6">

        <div class="block md:flex justify-between">
            <div class="border-l-8 border-black px-2">
                <p class="text-2xl font-extrabold">Terbaru</p>
            </div>
            {{-- Search Input --}}
            <form class="w-full md:w-96 md:px-5 mt-7 md:mt-0">
                <div class="relative">
                    <input type="search" id="search" onkeyup="searchMember()"
                        class="block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-black focus:border-black"
                        placeholder="Search..." required />
                    <button type="submit"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white p-2 rounded-lg hover:bg-black focus:ring-4 focus:outline-none focus:ring-black">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-6 w-full mt-5 md:mt-0">
            <div class="md:p-5 sm:p-8 col-span-4 md:col-span-4">
                <div class="columns-1 md:columns-3 gap-2 md:gap-4 space-y-4" id="grid-container">
                    @foreach ($data as $news)
                        @if ($news->status==1)    
                            {{-- Card Grid --}}
                            <div class="break-inside-avoid bg-white border border-gray-200 rounded-lg shadow-sm  dark:border-gray-700 overflow-hidden group flex md:block grid-item"
                                id="grid-item">
                                <a href="{{ route('detail-news', $news->news_id) }}" class="">
                                    <div class=" overflow-hidden w-36 md:w-full">
                                        <img class="md:rounded-t-lg w-full h-44 object-cover group-hover:scale-110 transition-transform duration-200 ease-in-out"
                                            src="{{ asset('img/news/' . $news->picture_news) }}" alt="Berita terbaru" />
                                    </div>
                                    <div class="p-2 md:p-3">
                                        <h5
                                            class="mb-2 text-sm md:text-xl font-bold line-clamp-3 md:line-clamp-none tracking-tight text-gray-900 dark:text-black group-hover:underline member-name">
                                            {{ $news->headline_news }}
                                        </h5>
                                        <a href="{{ route('detail-news', $news->news_id) }}"
                                            class="inline-flex items-center mt-0 md:mt-2 px-3 py-2 text-xs md:text-sm font-medium text-center text-black rounded-lg group-hover:bg-black group-hover:text-white border border-black md:static absolute right-2 bottom-2">
                                            Read more
                                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>

            {{-- Iklan --}}
            <div class="hidden md:block p-5 sm:p-8 animate-fade-left animate-duration-1000 col-span-2">
                <img src="https://placehold.co/600x1000" alt="" class="rounded-xl object-cover">
            </div>
        </div>
    </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let gridItems = document.querySelectorAll("#grid-container #grid-item");

                gridItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.add("animate-fade-up", "animate-duration-700");
                        item.classList.remove("hidden");
                    }, index * 200); // Delay tiap item 200ms
                });
            });
            function searchMember() {
            const query = document.getElementById('search').value.toLowerCase();
            document.querySelectorAll('.grid-item').forEach(item => {
                const name = item.querySelector('.member-name').innerText.toLowerCase();
                item.style.display = name.includes(query) ? "block" : "none";
            });
        }
        </script>
</x-main-layout>

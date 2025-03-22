<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-3 md:px-52 mt-10">
        <div class="border-b-2 border-black md:w-3/4">
            <img src="{{ asset('img/news/' . $dataDetail->picture_news) }}" alt="{{ $dataDetail->headline_news }}"
                class=" rounded-lg">
            <div class="flex justify-between py-2 px-2">
                <div>
                    <p class="text-xl md:text-3xl font-bold ">{{ $dataDetail->headline_news }}</p>
                    <p class="text-sm">{{ $dataDetail->login->username }}, {{ $dataDetail->covarage_area }} |
                        {{ $dataDetail->date_publish->translatedFormat('d F Y') }}, {{ $dataDetail->time_publish }}</p>
                </div>
            </div>
        </div>
        <div class="border-b-2 border-black px-2 py-7 text-base md:text-lg md:w-10/12">
            {!! $dataDetail->content_news !!}
        </div>

        <div class="mt-6">

            <div class="block md:flex justify-between">
                <div class="border-l-8 border-black px-2">
                    <p class="text-2xl font-extrabold">Terkait</p>
                </div>
            </div>

            <div class="grid grid-cols-3 w-full mt-5 md:mt-0">
                <div class="md:p-5 sm:p-8 col-span-4 md:col-span-3">
                    <div class="columns-1 md:columns-3 gap-2 md:gap-4 space-y-4" id="grid-container">
                        @foreach ($dataNews as $news)
                            {{-- Card Grid --}}
                            <div class="break-inside-avoid bg-white border border-gray-200 rounded-lg shadow-sm  dark:border-gray-700 overflow-hidden group flex md:block"
                                id="grid-item">
                                <a href="{{ route('detail-news', $news->news_id) }}" class="">
                                    <div class=" overflow-hidden w-48 md:w-full">
                                        <img class="rounded-t-lg w-full h-auto object-cover group-hover:scale-110 transition-transform duration-200 ease-in-out"
                                            src="{{ asset('img/news/' . $news->picture_news) }}"
                                            alt="Berita terbaru" />
                                    </div>
                                    <div class="p-2 md:p-3">
                                        <h5
                                            class="mb-2 md:text-xl font-bold line-clamp-2 md:line-clamp-none tracking-tight text-gray-900 dark:text-black group-hover:underline">
                                            {{ $news->headline_news }}
                                        </h5>
                                        <a href="{{ route('detail-news', $news->news_id) }}"
                                            class="inline-flex items-center mt-0 md:mt-2 px-3 py-2 text-xs md:text-sm font-medium text-center text-black rounded-lg group-hover:bg-black group-hover:text-white border border-black md:static absolute right-2">
                                            Read more
                                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
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
    </script>
</x-main-layout>

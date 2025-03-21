<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="text-center mt-8 px-14 md:px-80 w-full">
        <div class="border-b-2 border-gray-500">
            <input type="text" class="border-none text-center focus:placeholder-transparent opacity-50"
                placeholder="Search Someone?">
        </div>
    </div>

    <div class="flex mt-6">

        {{-- member grid --}}
        <div class="p-5 sm:p-8 mx-auto max-w-7xl">
            <div class="columns-1 sm:columns-2 md:columns-3 gap-4 space-y-4" id="grid-container">
                @foreach ($datas as $data)
                    @if ($data->status == 1)
                        
                        <!-- Card -->
                        <div class="relative w-full md:w-72 bg-white rounded-lg shadow-lg overflow-hidden break-inside-avoid mx-auto cursor-pointer hover:shadow-xl transition-shadow hidden"
                            id="grid-item"
                            onclick="showMemberModal('modalMember{{ $data->member_id }}', 'modalContent{{ $data->member_id }}')">

                            <!-- Rank Badge -->
                            @if ($data->rank)
                                <div class="absolute top-2 left-2 z-10">
                                    <div
                                        class="bg-gradient-to-r from-yellow-300 via-purple-300 to-blue-300 p-[2px] rounded-xl">
                                        <div class="bg-white rounded-xl px-2 py-1">
                                            <span
                                                class="bg-gradient-to-r from-yellow-300 via-purple-300 to-blue-300 bg-clip-text text-transparent text-base font-semibold">
                                                {{ $data->rank }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Rarity Badge -->
                            @if ($data->rarity)
                                <div class="absolute top-2 right-3 z-10">
                                    <span
                                        class="text-3xl font-extrabold bg-gradient-to-tr {{ $data->rarity == 'N' ? 'from-black' : ($data->rarity == 'R' ? 'from-blue-800' : 'from-yellow-300 via-purple-300 to-blue-300') }} bg-clip-text text-transparent">
                                        {{ $data->rarity }}
                                    </span>
                                </div>
                            @endif

                            <!-- Member Image -->
                            <div class="aspect-[4/5] bg-gray-100 relative">
                                <img src="{{ asset('img/member/' . $data->relasiMany->first()->member_picture) }}"
                                    alt="{{ $data->full_name }}" class="w-full h-full object-cover" loading="lazy">
                            </div>

                            <!-- Member Info -->
                            <div class="p-4 text-center space-y-2">
                                <h2 class="text-lg font-bold text-gray-900">{{ $data->full_name }}</h2>
                                <p class="text-gray-600 text-sm">{{ $data->year_in }}
                                    {{ $data->year_out ? ' - ' . $data->year_out : '' }}</p>
                                <blockquote class="text-sm text-gray-700 italic">
                                    "{{ $data->quote }}"
                                </blockquote>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div id="modalMember{{ $data->member_id }}"
                            class="fixed -inset-9 z-[999] flex items-center justify-center bg-black/30 hidden">
                            <div id="modalContent{{ $data->member_id }}"
                                class="bg-white p-6 rounded-lg shadow-xl w-[430px] md:w-full max-w-4xl relative max-h-[95vh] overflow-y-auto animate-jump animate-ease-linear animate-once animate-duration-300">

                                <div class="flex flex-col md:flex-row gap-6 overflow-hidden">
                                    <button
                                        onclick="closeModal('modalMember{{ $data->member_id }}', 'modalContent{{ $data->member_id }}')"
                                        class=" transition-colors right-4 text-2xl top-3 absolute font-extrabold">
                                        ✕
                                    </button>
                                    <!-- Left Column -->
                                    <div class="w-full mt-8 md:mt-0 md:w-6/12 flex-shrink-0">
                                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden">

                                            @if ($data->rank)
                                                <div class="absolute top-2 left-2 z-40">
                                                    <div
                                                        class="bg-gradient-to-r from-yellow-300 via-purple-300 to-blue-300 p-[2px] rounded-xl">
                                                        <div class="bg-white rounded-xl px-2 py-1">
                                                            <span
                                                                class="bg-gradient-to-r from-yellow-300 via-purple-300 to-blue-300 bg-clip-text text-transparent text-base font-semibold">
                                                                {{ $data->rank }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($data->rarity)
                                                <div class="absolute top-2 right-4 z-40">
                                                    <span
                                                        class="text-3xl font-extrabold bg-gradient-to-tr 
                                        {{ $data->rarity == 'N'
                                            ? 'from-black'
                                            : ($data->rarity == 'R'
                                                ? 'from-blue-800'
                                                : 'from-yellow-300 via-purple-300 to-blue-300') }} 
                                        bg-clip-text text-transparent">
                                                        {{ $data->rarity }}
                                                    </span>
                                                </div>
                                            @endif

                                            <div id="indicators-carousel" class="relative w-full z-10" data-carousel="static">
                                                <!-- Carousel wrapper -->
                                                <div class="relative overflow-hidden rounded-lg aspect-[4/5] object-cover">
                                                    <!-- Item 1 -->
                                                    @foreach ($data->relasiMany as $key => $picture)
                                                        
                                                        <div class="hidden duration-700 ease-in-out " {{ $key==0 ? 'data-carousel-item="active"' : 'data-carousel-item' }}>
                                                            <img src="{{ asset('img/member/'.$picture->member_picture) }}"
                                                                class="h-full w-full object-cover"
                                                                alt="...">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Slider indicators -->
                                                <div
                                                    class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                                                    @foreach ($data->relasiMany as $key => $picture)
                                                    <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $key==0 ? 'true' : 'false' }}"
                                                        aria-label="Slide {{ $key+1 }}" data-carousel-slide-to="{{ $key }}"></button>
                                                    @endforeach
                                                </div>
                                                <!-- Slider controls -->
                                                <button type="button"
                                                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                                    data-carousel-prev>
                                                    <span
                                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 6 10">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
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
                                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 6 10">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 9 4-4-4-4" />
                                                        </svg>
                                                        <span class="sr-only">Next</span>
                                                    </span>
                                                </button>
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="w-full md:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="space-y-2">
                                            <h1 class="text-3xl font-bold text-gray-900">{{ $data->full_name }}</h1>

                                            <div class="flex justify-between w-full">
                                                <p class="text-gray-600 font-light">{{ $data->nim }}</p>
                                                <p class="text-gray-600 font-light">{{ $data->year_in }}
                                                    {{ $data->year_out ? ' - ' . $data->year_out : '' }}</p>
                                            </div>
                                        </div>

                                        <blockquote class="text-gray-700 italic border-l-4 border-gray-200 pl-4">
                                            "{{ $data->quote }}"
                                        </blockquote>

                                        <div class="space-y-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
                                                <p class="text-gray-600 text-sm leading-relaxed">
                                                    {{ $data->description }}
                                                </p>
                                            </div>

                                            @if ($data->instagram || $data->linkedin || $data->github || $data->website)
                                                <div class="pt-4 border-t border-gray-200">
                                                    <h4 class="text-sm font-semibold text-gray-500 mb-3 text-center">Find
                                                        me
                                                        on:</h4>
                                                    <div class="flex gap-4 justify-center">
                                                        @if ($data->instagram)
                                                            <a href="{{ $data->instagram }}" target="_blank"
                                                                class="p-2 hover:scale-110 transition-transform">
                                                                <img src="{{ asset('template/image/instagram.svg') }}"
                                                                    alt="Instagram" class="w-8 h-8">
                                                            </a>
                                                        @endif

                                                        @if ($data->linkedid)
                                                            <a href="{{ $data->linkedid }}" target="_blank"
                                                                class="p-2 hover:scale-110 transition-transform">
                                                                <img src="{{ asset('template/image/linkedid.svg') }}"
                                                                    alt="LinkedId" class="w-8 h-8">
                                                            </a>
                                                        @endif

                                                        @if ($data->github)
                                                            <a href="{{ $data->github }}" target="_blank"
                                                                class="p-2 hover:scale-110 transition-transform">
                                                                <img src="{{ asset('template/image/github.svg') }}"
                                                                    alt="GitHub" class="w-8 h-8">
                                                            </a>
                                                        @endif

                                                        @if ($data->website)
                                                            <a href="{{ $data->website }}" target="_blank"
                                                                class="p-2 hover:scale-110 transition-transform">
                                                                <img src="{{ asset('template/image/website.svg') }}"
                                                                    alt="Website" class="w-8 h-8">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
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

        function showMemberModal(modalId, modalContentId) {
            let modalContent = document.getElementById(modalContentId);
            let modal = document.getElementById(modalId);


            modalContent.classList.add("animate-jump");
            modalContent.classList.add("animate-duration-300");
            modalContent.classList.remove("animate-jump-out");
            modalContent.classList.remove("animate-duration-500");

            setTimeout(() => {
                modal.classList.remove("hidden");
                modalContent.classList.add("animate-jump"); // Reset animasi untuk penggunaan berikutnya
            }, 100);
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId, modalContentId) {
            let modalContent = document.getElementById(modalContentId);
            let modal = document.getElementById(modalId);

            modalContent.classList.remove("animate-jump");
            modalContent.classList.remove("animate-duration-300");
            modalContent.classList.add("animate-jump-out");
            modalContent.classList.add("animate-duration-500");

            setTimeout(() => {
                modal.classList.add("hidden");
                modalContent.classList.remove("animate-jump-out"); // Reset animasi untuk penggunaan berikutnya
            }, 300);
            document.body.classList.remove('overflow-hidden');
        }
    </script>
</x-main-layout>

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
                            onclick="showMemberModal('modalMember{{ $data->member_id }}', 'modalContent{{ $data->member_id }}', '{{ $data->member_id }}')">

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
                                class="bg-white p-3 md:p-6 rounded-lg shadow-xl w-[350px] md:w-full max-w-4xl relative max-h-[95vh] overflow-y-auto">

                                <div class="flex flex-col md:flex-row gap-6 overflow-hidden md:mt-0 mt-9">
                                    <button
                                        onclick="closeModal('modalMember{{ $data->member_id }}', 'modalContent{{ $data->member_id }}')"
                                        class=" transition-colors right-5 text-2xl top-2 absolute font-extrabold z-[9999]">
                                        ✕
                                    </button>
                                    <!-- Left Column -->
                                    <div class="w-full md:mt-0 md:w-5/12 flex-shrink-0">
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

                                            <!-- Carousel dengan ID unik -->
                                            <div id="indicators-carousel-{{ $data->member_id }}" class="relative w-full z-10">
                                                <!-- Carousel wrapper -->
                                                <div class="relative carousel-wrapper h-[500px] overflow-hidden rounded-lg">
                                                    @foreach ($data->relasiMany as $key => $picture)
                                                        <div class="hidden duration-700 ease-in-out {{ $key == 0 ? '!block' : '' }}">
                                                            <img src="{{ asset('img/member/' . $picture->member_picture) }}"
                                                                class="absolute block h-full w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover"
                                                                alt="Slide {{ $key + 1 }}">
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Slider indicators -->
                                                <div
                                                    class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                                                    @foreach ($data->relasiMany as $key => $picture)
                                                        <button type="button"
                                                            class="w-3 h-3 rounded-full {{ $key == 0 ? 'bg-white' : 'bg-white/50' }}"
                                                            aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                                                            aria-label="Slide {{ $key + 1 }}"
                                                            data-carousel-indicator="{{ $key }}"></button>
                                                    @endforeach
                                                </div>

                                                <!-- Slider controls -->
                                                <button type="button"
                                                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                                    data-carousel-prev>
                                                    <span
                                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white/70">
                                                        <svg class="w-4 h-4 text-white rtl:rotate-180"
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
                                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white/70">
                                                        <svg class="w-4 h-4 text-white rtl:rotate-180"
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

    <script>
        // Inisialisasi Animasi Grid
        document.addEventListener("DOMContentLoaded", function() {
            let gridItems = document.querySelectorAll("#grid-container #grid-item");
            gridItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add("animate-fade-up", "animate-duration-700");
                    item.classList.remove("hidden");
                }, index * 200);
            });
        });

        // Fungsi Carousel Custom
        function initCarousel(carouselId) {
            const carousel = document.getElementById(carouselId);
            const slides = carousel.querySelectorAll('[data-carousel-indicator]');
            const prevButton = carousel.querySelector('[data-carousel-prev]');
            const nextButton = carousel.querySelector('[data-carousel-next]');
            const indicators = carousel.querySelectorAll('[data-carousel-indicator]');
            
            let currentIndex = 0;

            function updateSlide(index) {
                // Update slides
                carousel.querySelectorAll('.carousel-wrapper > div').forEach((slide, i) => {
                    slide.classList.toggle('hidden', i !== index);
                });
                
                // Update indicators
                indicators.forEach((indicator, i) => {
                    indicator.classList.toggle('bg-white', i === index);
                    indicator.classList.toggle('bg-white/50', i !== index);
                });
            }

            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                updateSlide(currentIndex);
            });

            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % slides.length;
                updateSlide(currentIndex);
            });

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateSlide(currentIndex);
                });
            });
        }

        // Fungsi Modal
        function showMemberModal(modalId, modalContentId, memberId) {
            const modal = document.getElementById(modalId);
            const modalContent = document.getElementById(modalContentId);
            
            modalContent.classList.add("animate-jump", "animate-duration-300");
            modalContent.classList.remove("animate-jump-out");
            
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            // Inisialisasi carousel setelah modal muncul
            setTimeout(() => {
                initCarousel(`indicators-carousel-${memberId}`);
            }, 100);
        }

        function closeModal(modalId, modalContentId) {
            const modal = document.getElementById(modalId);
            const modalContent = document.getElementById(modalContentId);
            
            modalContent.classList.remove("animate-jump");
            modalContent.classList.add("animate-jump-out", "animate-duration-500");
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }
    </script>
</x-main-layout>
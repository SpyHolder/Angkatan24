<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex">
        {{-- search --}}
        <div></div>

        {{-- member grid --}}
        <div class="p-5 sm:p-8 mx-auto max-w-7xl">
            <div class="columns-1 sm:columns-2 md:columns-3 gap-4 space-y-4">
                
                <!-- Card -->
                @foreach (range(1,5) as $items)
                    <div class="relative w-full md:w-72 bg-white rounded-lg shadow-lg overflow-hidden break-inside-avoid mx-auto">

                        <!-- Pangkat -->
                        <div class="absolute top-2 rounded-xl left-2 bg-gradient-to-r from-yellow-300 via-purple-300 to-blue-300 p-[2px]">
                            <div class="h-full w-full bg-white rounded-xl">
                                <div class="bg-gradient-to-r from-yellow-300 via-purple-300 to-blue-300 text-transparent bg-clip-text text-sm font-semibold px-2 py-1">
                                    KETUA ANGKATAN
                                </div>
                            </div>
                        </div>
                        
                        <!-- Rarity -->
                        <div class="absolute top-0 right-1 bg-gradient-to-tr from-yellow-300 via-purple-300 to-blue-300 text-2xl font-extrabold md:text-4xl text-transparent bg-clip-text px-2 py-1">
                            SSR
                        </div>
                        
                        <!-- Foto Member -->
                        <div class="aspect-[4/5] bg-gray-100">
                            <img src="https://placehold.co/400x500" alt="Character" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Deskripsi Member -->
                        <div class="p-4 text-center">
                            <h2 class="md:text-lg text-base font-bold text-gray-900 leading-tight">THEO FILUS GIBRAN GABE FORTUNA ESONG</h2>
                            <p class="text-gray-600 text-sm">2023 - 2028</p>
                            <blockquote class="mt-2 text-xs md:text-sm text-gray-700 italic ">
                                "KEMBANGKAN KESUKSESAN DARI KEGAGALAN. KEPUTUSASAAN DAN KEGAGALAN ADALAH DUA BATU LONCATAN MENUJU SUKSES"
                            </blockquote>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</x-main-layout>

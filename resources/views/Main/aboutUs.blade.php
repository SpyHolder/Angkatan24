<x-main-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="px-32 mt-10">
        <div class="flex ">
            <div class="pr-36 my-auto">
                <h1 class="text-5xl font-extrabold animate-fade-right animate-duration-500">DIVERSI-TI</h1>
                <p class="text-xl mt-2 animate-fade-right animate-duration-500 animate-delay-[600ms]">Diversi-TI : Istilah diversity berasal dari bahasa Inggris yang berarti keberagaman. Sederhananya, diversity merupakan kondisi yang terdiri dari unsur-unsur yang berbeda.Dalam konteks pembelajaran, diversity dapat diartikan sebagai perbedaan berbagai hal dari siswa, seperti segi bahasa, budaya, sosial ekonomi, gaya belajar, dan kemampuan. "Unity In Diversity" yaitu tetap bersatu walaupun berbeda suku, ras, agama.</p>
            </div>
            <img src="{{ asset('template/image/aboutUs.svg') }}" alt="Diversi-TI" class="animate-fade-left animate-duration-500">
        </div>
    </div>

</x-main-layout>
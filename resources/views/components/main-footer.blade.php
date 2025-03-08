<footer class="relative w-full">
    <!-- Background Image (Pertahankan positioning asli) -->
    <img src="{{ asset('template/image/mainFooter.svg') }}" alt=""
        class="w-full absolute bottom-11 md:bottom-0 h-[150px] md:h-auto object-cover">

    <!-- Social Icons Container (Pertahankan style dasar) -->
    <div class="flex justify-center relative mt-3 md:mt-14 lg:mt-[110px] px-4">
        <div class="flex items-center gap-2 md:gap-4"> <!-- Tambahkan gap untuk responsivitas -->
            <a href="" target="_blank" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('template/image/facebook.svg') }}" alt="Facebook"
                    class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10">
            </a>
            <a href="https://www.instagram.com/diversiti.24/" target="_blank" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('template/image/instagram.svg') }}" alt="Instagram"
                    class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10">
            </a>
            <a href="https://discord.gg/5hAUJR2Z" target="_blank" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('template/image/discord.svg') }}" alt="Discord"
                    class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10">
            </a>
            <a href="https://chat.whatsapp.com/FEb6VWsjPcq78iG9L5Ah4x" target="_blank" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('template/image/whatsapp.svg') }}" alt="Whatsapp"
                    class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10">
            </a>
            <a href="" target="_blank" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('template/image/tiktok.svg') }}" alt="Tiktok"
                    class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10">
            </a>
        </div>
    </div>

    <!-- Copyright Text (Pertahankan positioning relatif) -->
    <p class="text-center m-2 md:m-4 md:text-lg relative z-10 text-sm font-semibold">
        Copyright &copy; Diversi-TI 2024
    </p>
</footer>

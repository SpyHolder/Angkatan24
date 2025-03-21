<footer class="relative w-full z-40 min-h-[100px]">

    <!-- Background Image -->
    <div class="absolute inset-0 h-full w-full overflow-hidden">
        <img src="{{ asset('template/image/mainFooter.svg') }}" alt="Footer Background"
            class="w-full h-full object-cover object-center opacity-90"
            loading="lazy"> <!-- Tambahkan lazy loading -->
    </div>

    <!-- Content Container -->
    <div class="container relative mx-auto px-4 h-full pt-20 pb-8">
        <!-- Social Icons -->
        <div class="flex flex-col items-center justify-center gap-6">
            <div class="flex justify-center items-center gap-4 md:gap-6">
                <a href="#" target="_blank" class="p-2 hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('template/image/facebook.svg') }}" alt="Facebook" 
                         class="w-8 h-8 md:w-10 md:h-10 hover:opacity-80">
                </a>
                <a href="https://www.instagram.com/diversiti.24/" target="_blank" class="p-2 hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('template/image/instagram.svg') }}" alt="Instagram"
                         class="w-8 h-8 md:w-10 md:h-10 hover:opacity-80">
                </a>
                <a href="https://discord.gg/5hAUJR2Z" target="_blank" class="p-2 hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('template/image/discord.svg') }}" alt="Discord"
                         class="w-8 h-8 md:w-10 md:h-10 hover:opacity-80">
                </a>
                <a href="https://chat.whatsapp.com/FEb6VWsjPcq78iG9L5Ah4x" target="_blank" class="p-2 hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('template/image/whatsapp.svg') }}" alt="Whatsapp"
                         class="w-8 h-8 md:w-10 md:h-10 hover:opacity-80">
                </a>
                <a href="#" target="_blank" class="p-2 hover:scale-110 transition-transform duration-300">
                    <img src="{{ asset('template/image/tiktok.svg') }}" alt="Tiktok"
                         class="w-8 h-8 md:w-10 md:h-10 hover:opacity-80">
                </a>
            </div>

            <!-- Copyright -->
            <div class=" text-center">
                <p class="text-black text-sm md:text-base font-medium tracking-wide">
                    Copyright &copy; Diversi-TI 2024<br>
                    <span class="text-xs opacity-90">All Rights Reserved</span>
                </p>
            </div>
        </div>
    </div>
</footer>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="{{ asset('template/userCostum.js') }}"></script>
</head>

<body>
    <div class="flex flex-col justify-between">
        <x-main-navbar></x-main-navbar>
        
        <main class="flex-grow">
            {{ $slot }}
        </main>
    
        <div class="">
            <x-main-footer></x-main-footer>
        </div>
    </div>
</body>

</html>

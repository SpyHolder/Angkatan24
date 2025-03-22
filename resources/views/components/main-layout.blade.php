<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
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

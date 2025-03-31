<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>masuk akun</title>
    <link rel="icon" href="{{ asset('template/image/diversiti.svg') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style type="text/css">
        body    {
            height:  80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            
        }
        .form-login {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(5, 5, 5, 0.1);
            border-radius: 10px;
            background-color: transparent;
            border: 1px solid #000000;
        }
        .btn-custom {
    background: transparent;
    border: 1px solid black; 
    color: black;
    transition: 0.3s;
}

.btn-custom:hover {
    background: white;
    color: black;
}
    </style>
</head>
<body>
    <div class="container-fluid" >   
        <form action="{{ route('loginAuth') }}" method="post" enctype="multipart/form-data"
            class="form-login">
            @csrf
            <h3 class=" fw-normal text-center">Login</h3>
            <!-- email-->
            <div class="mb-4">
                <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" required autofocus>
                @error('email')
                    <p class="text-danger ms-2" style="font-size: 12px">*{{ $message }}</p>
                @enderror
            </div>
            <!-- email end-->
            <!-- Password-->
            <div class="mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <span class="input-group-text" onclick="togglePassword('password', 'eyeIcon1')">
                        <i id="eyeIcon1" class="bi bi-eye"></i>
                    </span>
                </div>
                 @error('password')
                    <p class="text-danger ms-2" style="font-size: 12px">*{{ $message }}</p>
                @enderror
            </div>
            <!-- Password end-->
            <!-- Button-->
            <button class="btn btn-custom w-100 mb-2" type="submit">Login</button>
            <p>Belum mempunyai akun? <a href="{{ route('regis') }}">daftar</a></p>
            <!-- Button end -->
        </form> 
    </div>
        <!-- Tanda Mata -->
        <script>
            function togglePassword(inputId, iconId) {
                let passwordInput = document.getElementById(inputId);
                let icon = document.getElementById(iconId);
                
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.classList.remove("bi-eye");
                    icon.classList.add("bi-eye-slash");
                } else {
                    passwordInput.type = "password";
                    icon.classList.remove("bi-eye-slash");
                    icon.classList.add("bi-eye");
                }
            }
            </script>
        
        <!--icon Tanda Mata -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
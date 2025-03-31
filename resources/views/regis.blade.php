<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="icon" href="{{ asset('template/image/diversiti.svg') }}" type="image/x-icon" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style type="text/css">
        body {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f7f7;

        }

        .form-login {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            background-color: transparent;
            border-radius: 10px;
            color: #121212;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
            border: 1px solid #000000;
        }

        .btn-custom {
            background: transparent;
            border: 1px solid black;
            /* Garis luar putih */
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
    <div class="container-fluid">
        <form class="form-login d-flex flex-column gap-2" action="{{ route('proses-regis') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <h3 class="fw-normal text-center">Daftar Akun</h3>
            <!-- Nama -->
            <div>
                <input type="text" class="form-control" id="nama" placeholder="Username"
                    name="username"equired autofocus>
                @error('username')
                    <p class="text-danger mb-2 ms-2" style="font-size: 12px">*{{ $message }}</p>
                @enderror
            </div>
            <!-- Email -->
            <div>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                    required>
                @error('email')
                    <p class="text-danger mb-2 ms-2" style="font-size: 12px">*{{ $message }}</p>
                @enderror
            </div>
            <!-- Password -->
            <div>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                        required>
                    <span class="input-group-text" onclick="togglePassword('password', 'eyeIcon1')">
                        <i id="eyeIcon1" class="bi bi-eye"></i>
                    </span>
                </div>
                @error('password')
                    <p class="text-danger mb-2 ms-2" style="font-size: 12px">*{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="input-group">
                <input type="password" class="form-control" id="confirm-password" name="password_confirmation"
                    placeholder="Konfirmasi Password" required>
                <span class="input-group-text" onclick="togglePassword('confirm-password', 'eyeIcon2')">
                    <i id="eyeIcon2" class="bi bi-eye"></i>
                </span>
            </div>
            <!-- Button -->
            <button class="btn btn-custom w-100" type="submit">Daftar</button>
            <!-- Button end -->
            <p class="text-center">Sudah mempunyai akun? <a href="{{ route('login') }}">masuk</a></p>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form action="{{ route('proses-regis') }}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>
                    <label for="username">Username</label>
                    @error('username')
                        <p>{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email</label>
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="email" name="email">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password</label>
                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password_confirmation">Konfirmasi Password</label>
                </td>
                <td>
                    <input type="password" name="password_confirmation">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Register</button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>
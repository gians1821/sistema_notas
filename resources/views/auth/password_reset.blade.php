<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="/../login/recovery.css">
    <style>
        .error-message {
            color: darkred; 
            font-size: 0.8em; 
            margin-top: 20px; 
            display: block;
        }
    </style>
</head>

<body class="">
    <div class="main-content">
        <div class="wrapper">
            <div class="form-box login">
                <h2>Reestablecer Contraseña</h2>
                <form method="POST" action="{{ route('password.resetPassword') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input type="password" name="password" id="password" required>
                        <label for="password">Nueva Contraseña</label>
                    </div>
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        @error('password')
                            <span class="error-message"><b>{{ $message }}</b></span>
                        @enderror
                        @error('token')
                            <span class="error-message"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn">Restablecer</button>
                </form>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>



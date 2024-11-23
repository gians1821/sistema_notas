<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="/login/login.css">
    <style>
        .error-message {
            color: darkred; 
            font-size: 0.8em; 
            margin-top: 15px; 
        }
        .alert-success {
            color: green;
            font-size: 1.0em;
            margin-top: 15px;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="">
    <header>
        <h2 class="logo">School</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <button class="btnLogin">Login</button>
        </nav>
    </header>
    <div class="main-content">
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close">
            </ion-icon>
        </span>
        <div class="form-box login">
            <h2>Login</h2>
            <form method="POST" action="{{ route ('User.Login')}}">
                @csrf
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person">
                        </ion-icon>
                    </span>
                    <input class="form-control" required id="email" name="email" value="{{old('email')}}">
                    <label>Correo Electronico</label>
                    @if ($errors->has('email'))
                        <span class="error-message"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input class="form-control" type="password" required id="password" name="password" value="{{old('password')}}">
                    <label>Contraseña</label>
                    @if ($errors->has('password'))
                        <span class="error-message"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
                <form action="{{ route('User.Login') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Login</button>
                </form>
                <div class="login-register">
                    <p>¿Se te olvido la contreseña?
                        <a href="#" class="register-link">
                            Reestablecer
                        </a>
                    </p>
                </div>
                <div class="login-register">
                    @if(session('statusconfirm'))
                        <div class="alert-success">
                            <strong>{{ session('statusconfirm') }}</strong>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Reestablecer Contraseña</h2>
            
            <form method="POST" action="{{ route('password.sendRecoveryEmail') }}">
                @csrf
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input class="form-control" id="emailrecovery" name="emailrecovery">
                    <label>Correo Electrónico</label>
                    @error('emailrecovery')
                        <span class="error-message"><b>{{ $message }}</b></span>
                    @enderror
                </div>
                <div class="remenber-forgot">
                    <label>Estaremos enviando un mensaje a su correo 
                        para que pueda reestablecer su contraseña.
                    </label>
                </div>
                <button type="submit" class="btn">Enviar</button>
                <div class="login-register">
                    <p>¿Volver al inicio de sesión?
                        <a href="#" class="login-link">
                            Login
                        </a>
                    </p>
                </div>
                <div class="login-register">
                    @if(session('status'))
                        <div class="alert-success">
                            <strong>{{ session('status') }}</strong>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    </div>

    <script src="/login/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
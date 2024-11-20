<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="/login/login.css">
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
                    <input class="form-control" type="text" required id="name" name="name" value="{{old('name')}}">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input class="form-control" type="password" required id="password" name="password" value="{{old('password')}}">
                    <label>Password</label>
                </div>
                <div class="remenber-forgot">
                    <label><input type="checkbox">
                        Remenber me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <form action="{{ route('User.Login') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Login</button>
                </form>
                <div class="login-register">
                    <p>Don' t have an account?
                        <a href="#" class="register-link">
                            Register
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person">
                        </ion-icon>
                    </span>
                    <input type="text" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail">
                        </ion-icon>
                    </span>
                    <input type="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" required>
                    <label>Password</label>
                </div>
                <div class="remenber-forgot">
                    <label><input type="checkbox">
                        agree to the terms & conditions
                    </label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have an account?
                        <a href="#" class="login-link">
                            Login
                        </a>
                    </p>
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
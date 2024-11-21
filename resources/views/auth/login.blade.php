<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-color: #5c3e10; /* Background gradient start */
            --bg-color-dark: #5c076d; /* Background gradient end */
            --bubble-color-1: rgba(211, 245, 17, 0.4);
            --bubble-color-2: rgba(177, 8, 8, 0.5);
            --bubble-color-3: rgba(90, 3, 76, 0.596);
            --bubble-color-4: rgba(23, 32, 42, 0.7);
            --bubble-color-5: rgba(18, 10, 107, 0.8);
            --form-bg: rgba(255, 255, 255, 0.1); /* Transparent form background */
            --form-border: rgba(255, 255, 255, 0.3); /* Border for the form */
            --form-shadow: rgba(0, 0, 0, 0.2); /* Shadow for form */
            --text-color-light: #ffffff; /* Light text color */
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            font-family: Arial, sans-serif;
            position: relative;
            background: linear-gradient(120deg, var(--bg-color), var(--bg-color-dark));
        }

        .container {
            z-index: 2; /* Keep form above background bubbles */
            max-width: 400px;
            width: 90%;
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(15px); /* Glass effect */
            background-color: var(--form-bg);
            border: 1px solid var(--form-border);
            box-shadow: 0 8px 25px var(--form-shadow);
            text-align: center;
            color: var(--text-color-light);
        }

        .container h1 {
            margin-bottom: 10px;
            font-size: 32px;
            font-weight: bold;
            color: var(--text-color-light);
        }

        .container p.text-muted {
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.7);
        }

        .input-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .input-group-text {
            background-color: var(--form-border);
            border: none;
            border-radius: 5px 0 0 5px;
            color: var(--text-color-light);
        }

        .form-control {
            height: 45px;
            border: none;
            border-radius: 0 5px 5px 0;
            padding-left: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: var(--text-color-light); /* Ensure white text */
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Light placeholder */
        }

        .form-control:focus {
            border-color: var(--text-color-light);
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px var(--text-color-light);
        }

        .btn-primary {
            width: 100%;
            height: 45px;
            background-color: var(--bubble-color-3);
            border: none;
            border-radius: 5px;
            color: var(--text-color-light);
            font-weight: bold;
            transition: transform 0.3s, background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--bubble-color-4);
            transform: translateY(-3px);
        }

        .btn-link {
            color: var(--text-color-light);
            text-decoration: underline;
        }

        .lead {
            margin-top: 30px;
            color: var(--text-color-light);
        }

        /* Background bubbles */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background-color: var(--bubble-color-1);
            animation: moveBubble 10s infinite ease-in-out;
        }

        @keyframes moveBubble {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 0.5;
            }
            25% {
                transform: translate(40vw, -30vh) scale(0.8);
                opacity: 0.7;
            }
            50% {
                transform: translate(-50vw, 60vh) scale(1.2);
                opacity: 0.9;
            }
            75% {
                transform: translate(30vw, -50vh) scale(1);
                opacity: 0.8;
            }
            100% {
                transform: translate(0, 0) scale(1.1);
                opacity: 0.5;
            }
        }

        .logo {
            width: 150px;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body>
<div class="background">
    <div class="bubble" style="width: 50px; height: 50px; background-color: var(--bubble-color-1); animation-duration: 12s; left: 10%; top: 20%;"></div>
    <div class="bubble" style="width: 70px; height: 70px; background-color: var(--bubble-color-2); animation-duration: 10s; left: 30%; top: 50%;"></div>
    <div class="bubble" style="width: 40px; height: 40px; background-color: var(--bubble-color-3); animation-duration: 14s; left: 50%; top: 30%;"></div>
    <div class="bubble" style="width: 100px; height: 100px; background-color: var(--bubble-color-4); animation-duration: 16s; left: 70%; top: 60%;"></div>
    <div class="bubble" style="width: 60px; height: 60px; background-color: var(--bubble-color-5); animation-duration: 18s; left: 80%; top: 10%;"></div>
</div>

<div class="container">
    <img class="logo" src="{{ asset('images/logo-dark.png') }}" alt="Logo">
    <h1>Login</h1>
    <p class="text-muted">Sign In to your account</p>
    <form id="login" method="post" action="{{ url('/login') }}">
        @csrf
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
            </div>
            <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" placeholder="Email" required style="color: white;">
        </div>
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
            </div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" name="password" required  style="color: white;">
        </div>
        <button id="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="lead">
        Developed By
        <a href="https://sosense.co.in/" class="font-weight-bold btn-link">Sosense.co.in</a>
    </p>
</div>

</body>
</html>

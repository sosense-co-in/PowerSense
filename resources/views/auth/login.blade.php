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
            --bg-color: #f8f9fa; /* Background color for body */
            --container-bg: #ffffff; /* Background color for container */
            --primary-color: #007bff; /* Primary button color */
            --text-color: #343a40; /* Main text color */
            --muted-text-color: #6c757d; /* Muted text color */
            --border-color: #ced4da; /* Border color for inputs */
            --shadow-color: rgba(0, 0, 0, 0.1); /* Shadow color */
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--bg-color);
            margin: 0; /* Remove default body margin */
            font-family: Arial, sans-serif; /* Set a default font family */
        }

        .container {
            max-width: 400px; /* Limit the width of the container */
            width: 90%; /* Ensure responsiveness on small screens */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px var(--shadow-color); /* Soft shadow */
            background-color: var(--container-bg);
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px; /* Slightly larger font size for the heading */
            color: var(--text-color);
        }

        p.text-muted {
            text-align: center;
            color: var(--muted-text-color);
        }

        .input-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .input-group-text {
            background-color: var(--border-color);
            border: 1px solid var(--border-color);
            border-radius: 5px 0 0 5px; /* Rounded left corners */
        }

        .form-control {
            height: 45px; /* Height of input fields */
            border: 1px solid var(--border-color);
            border-radius: 0 5px 5px 0; /* Rounded right corners */
            flex: 1; /* Allow the input to grow */
            padding-left: 10px; /* Add padding for input text */
        }

        .form-control:focus {
            border-color: var(--primary-color); /* Change border color on focus */
            box-shadow: 0 0 5px var(--primary-color); /* Add a slight glow */
        }

        .btn-primary {
            width: 100%; /* Full width button */
            height: 45px; /* Same height as input fields */
            background-color: var(--primary-color);
            color: #ffffff; /* White text */
            border: none;
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        .btn-primary:hover {
            background-color: darken(var(--primary-color), 10%); /* Darker on hover */
        }

        .btn-link {
            color: var(--primary-color);
        }

        .lead {
            text-align: center;
            margin-top: 30px; /* Space above the lead text */
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 24px; /* Smaller font size on mobile */
            }

            .container {
                padding: 15px; /* Reduced padding on small screens */
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <img width="200" src="{{ asset('images/logo-dark.png') }}" alt="Logo">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('account_deactivated'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('account_deactivated') }}
                </div>
            @endif
            <div class="card p-4 border-0 shadow-sm">
                <div class="card-body">
                    <form id="login" method="post" action="{{ url('/login') }}">
                        @csrf
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password" name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button id="submit" class="btn btn-primary d-flex align-items-center"
                                        type="submit">
                                    Login
                                    <div id="spinner" class="spinner-border text-info" role="status"
                                         style="height: 20px; width: 20px; margin-left: 5px; display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                            <div class="col-12 text-right mt-2">
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="lead">
                Developed By
                <a href="https://sosense.co.in/" class="font-weight-bold text-primary">Sosense.co.in</a>
            </p>
        </div>
    </div>
</div>

<!-- CoreUI -->
<script src="{{ mix('js/app.js') }}" defer></script>
<script>
    let login = document.getElementById('login');
    let submit = document.getElementById('submit');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let spinner = document.getElementById('spinner');

    login.addEventListener('submit', (e) => {
        submit.disabled = true;
        email.readOnly = true;
        password.readOnly = true;

        spinner.style.display = 'block';

        login.submit();
    });

    setTimeout(() => {
        submit.disabled = false;
        email.readOnly = false;
        password.readOnly = false;

        spinner.style.display = 'none';
    }, 3000);
</script>

</body>
</html>

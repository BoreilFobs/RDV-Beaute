<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Glow & Chic</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <div class="login-container">
        <!-- Session Status -->
        <x-auth-session-status class="session-status" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-header">
                <h2>Bienvenue</h2>
                <p>Connectez vous a votre compte</p>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Remember Me -->
            {{-- <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div> --}}

            <button type="submit" class="login-btn">Se Connecter</button>
            <div class="signup-link forgot-password">
                <p class="light">Vous n'avez pas de compte? <a href="{{ route('register') }}">créer un compte</a></p>
            </div>
            @if (Route::has('password.request'))
                {{-- <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </div> --}}
            @endif
        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Glow & Chic</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <div class="register-container">
        <!-- Session Status -->
        <x-auth-session-status class="session-status" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="register-header">
                <h2>Créer votre compte</h2>
                <p>rejoignier notre belle communauté</p>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Nom Complet</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="error-message" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required
                    autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone">Telephone</label>
                <input id="phone" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Mot-de-pass</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirmer Mot-de-passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>

            <button type="submit" class="register-btn">Créer</button>

            <div class="login-link">
                <a href="{{ route('login') }}">Vous avez un compte? Se connecter</a>
            </div>
        </form>
    </div>
</body>

</html>

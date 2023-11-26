<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        @if ($errors->has('loginError'))
            <span class="text-danger">{{ $errors->first('loginError') }}</span>
        @endif
        <br>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a>.</p>
</body>
</html>
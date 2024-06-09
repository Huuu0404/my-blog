<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            max-width: 90%;
            text-align: center;
        }
        .login-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-button {
            width: 100%;
            padding: 10px;
            background-color: #0070c9;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-button:hover {
            background-color: #005ba3;
        }
        .error-message {
            background-color: #ffcccc;
            color: #cc0000;
            border: 1px solid #cc0000;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
        }
        .additional-links {
            margin-top: 20px;
        }
        .additional-link {
            color: #0070c9;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin: 0 10px;
        }
        .additional-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <form method="POST" action="/login">
            @csrf
            <input type="email" name="email" id="email" class="form-input" placeholder="Email" required>
            <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
            <button type="submit" class="form-button">Login</button>
        </form>

        <div class="additional-links">
            <a href="/register" class="additional-link">Sign Up</a>
            {{-- <a href="/forgot-password" class="additional-link">Change Password</a> --}}
        </div>

        @if($error_message)
            <div class="error-message">{{ $error_message }}</div>
        @endif
    </div>
</body>

</html>


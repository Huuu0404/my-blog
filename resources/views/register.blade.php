<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            max-width: 90%;
            text-align: center;
        }
        .register-title {
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
    <div class="register-container">
        <h2 class="register-title">Register</h2>
        <form id="register-form">
            @csrf
            <input type="text" name="name" id="name" class="form-input" placeholder="Name" required>
            <input type="email" name="email" id="email" class="form-input" placeholder="Email" required>
            <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm Password" required>
            <button type="submit" class="form-button">Sign Up</button>
        </form>

        <div class="additional-links">
            <a href="/login" class="additional-link">Login</a>
        </div>

        <div id="error-message" class="error-message" style="display: none;"></div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#register-form').on('submit', function(e) {
            e.preventDefault();

            let name = $('#name').val().trim();
            let email = $('#email').val().trim();
            let password = $('#password').val();
            let passwordConfirmation = $('#password_confirmation').val();
            let errorMessage = '';

            // validation
            if (name.length < 3)
            {
                errorMessage = 'Name must be at least 3 characters long.';
            }
            else if (!validateEmail(email))
            {
                errorMessage = 'Invalid email format.';
            } 
            else if (password.length < 6)
            {
                errorMessage = 'Password must be at least 6 characters long.';
            }
            else if (password !== passwordConfirmation)
            {
                errorMessage = 'Passwords do not match.';
            }

            if (errorMessage)
            {
                $('#error-message').text(errorMessage).show();
                return;
            }

            $.ajax({
                url: '/register',
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    name: name,
                    email: email,
                    password: password,
                },
                success: function(response) {
                    if(response['code']=='200')
                    {
                        alert('Register successfully');
                        window.location.href = '/login';
                    }
                    else
                    {
                        alert(response['message']);
                        console.log(response);
                    }
                },
                error: function(xhr) {
                    let error = xhr.responseJSON.message || 'An error occurred. Please try again.';
                    $('#error-message').text(error).show();
                }
            });
        });

        function validateEmail(email)
        {
            let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
</script>

</html>

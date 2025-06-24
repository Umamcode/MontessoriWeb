<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            max-width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .login-header h2 {
            margin-bottom: 0;
            font-weight: bold;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 50px;
        }

        .btn-login {
            width: 100%;
            border-radius: 50px;
            padding: 10px;
        }

        .text-center {
            margin-top: 20px;
        }

        .text-center a {
            color: #007bff;
        }
         body {
        background: linear-gradient(135deg, #6f42c1, #5bc0de);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
        background-color: #fff;
        padding: 2rem 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 420px;
        text-align: center;
    }

    .login-header img {
        width: 80px;
        margin-bottom: 1rem;
    }

    .login-header h2 {
        font-size: 1.4rem;
        color: #343a40;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem;
    }

    .btn-login {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        background-color: #6f42c1;
        border: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #5a34a5;
    }

    .text-center a {
        color: #6f42c1;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    .alert {
        margin-top: 0.5rem;
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
    </style>
</head>

<body>
    {{ $slot }}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7C93C3, #ffdde1);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .login-card {
            border-radius: 20px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        .login-card .form-control {
            border-radius: 30px;
            padding: 10px 15px;
        }
        .login-card .btn-primary {
            background: #1E2A5E;
            border: none;
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }
        .login-card .btn-primary:hover {
            background: #7C93C3;
        }
        .login-card .form-text {
            color: #6c757d;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post" action="<?= site_url('user/login'); ?>">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="form-text mt-3">Don't have an account? <a href="/register" class="text-decoration-none">Register</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

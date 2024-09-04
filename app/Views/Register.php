<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #7C93C3, #ffdde1);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }
        .register-card {
            border-radius: 20px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .register-card .form-control {
            border-radius: 30px;
            padding: 10px 15px;
        }
        .register-card .btn-primary {
            background: #1E2A5E;
            border: none;
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        .register-card .btn-primary:hover {
            background: #7C93C3;
        }
        .register-card .form-text {
            color: #6c757d;
            text-align: center;
            margin-top: 10px;
        }
        .register-card h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2 class="text-center">Register</h2>
        <form method="post" action="<?= site_url('user/store'); ?>">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="mb-3">
                <select name="role" class="form-control" required>
                    <option value="" disabled selected>Select a role</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="photographer">Photographer</option>
                    <option value="fbteam">FB Team</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="form-text">Already have an account? <a href="/login" class="text-decoration-none">Login</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

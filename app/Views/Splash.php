<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .splash-container {
            text-align: center;
        }
        .splash-logo {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 20px;
        }
        .splash-text {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 30px;
        }
        .splash-btn {
            font-size: 1rem;
            padding: 10px 20px;
        }
        .splash-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script>
      
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 5000);
    </script>
</head>
<body>
    <div class="splash-container">
        <div class="splash-logo">
            <i class="bi bi-house-door"></i> Draw Upload
        </div>
        <div class="splash-text">
            Welcome to DLB Draw Manage..!
        </div>
       
        <div>
            <a href="/login" class="btn btn-primary splash-btn">Go to Login</a>
        </div>
    </div>
</body>
</html>

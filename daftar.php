<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN IN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('login.png');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        h1 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .register-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
        }
        .register-btn:hover {
            background-color: #005f6b;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>SIGN IN</h1>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="nim" placeholder="NIM" required>
            <input type="password" name="password" placeholder="Password Baru" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <button type="submit" class="register-btn">SIGN IN</button>
        </form>
    </div>
</body>
</html>

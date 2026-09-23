<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan Politeknik Negeri Medan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('login.png'); /* Pastikan gambar ini ada di folder yang sama */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
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
        .login-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-btn:hover {
            background-color: #005f6b;
        }
        .link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Perpustakaan Politeknik Negeri Medan</h1>
        <form action="proses.php" method="POST">
    <input type="text" name="nim" placeholder="NIM" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" class="login-btn">Log In</button>
</form>

        <a href="lupapassword.php" class="link">Lupa Password</a>
        <a href="daftar.php" class="link">Create New Account</a>
    </div>
</body>
</html>

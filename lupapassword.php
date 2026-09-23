<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Perpustakaan Politeknik Negeri Medan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('polmedd.jpg'); /* Ubah ini ke latar belakang yang sesuai */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .forgot-password-container {
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
        .reset-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
        }
        .reset-btn:hover {
            background-color: #005f6b;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h1>Reset Password</h1>
        <form action="lupa.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="new_password" placeholder="Password Baru" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <button type="submit" class="reset-btn">Log In</button>
        </form>
    </div>
</body>
</html>

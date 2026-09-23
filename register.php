<?php

$host = 'localhost';
$dbname = 'perpus';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$user = $_POST['username'];
$nim = $_POST['nim'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];

// Validasi apakah NIM hanya berisi angka
if (!ctype_digit($nim)) {
    echo "<script>
            alert('NIM tidak valid. Silakan masukkan NIM Anda yang hanya berisi angka.');
            window.history.back();
          </script>";
    exit();
}

if (strlen($nim) !== 10) {
    echo "<script>
            alert('NIM harus terdiri dari 10 digit angka.');
            window.history.back();
          </script>";
    exit();
}

if (strlen($pass) < 8) {
    echo "<script>
            alert('Password harus memiliki minimal 8 karakter.');
            window.history.back();
          </script>";
    exit();
}

// Validasi kecocokan password
if ($pass !== $confirm_pass) {
    echo "<script>
            alert('Password tidak cocok.');
            window.history.back();
          </script>";
    exit();
}

// Cek apakah NIM sudah terdaftar
$sql_check_nim = "SELECT * FROM users WHERE nim = '$nim'";
$result = $conn->query($sql_check_nim);

if ($result->num_rows > 0) {
    echo "<script>alert('NIM sudah terdaftar!'); window.location.href = 'register.php';</script>";
} else {
    // Hash password dan masukkan data ke database
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, nim, password) VALUES ('$user', '$nim', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href = 'login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>

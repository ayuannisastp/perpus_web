<?php
session_start(); // Memulai session

// Konfigurasi database
$host = 'localhost';
$dbname = 'perpus';
$username = 'root';
$password = '';

// Buat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir login
$nim = $_POST['nim'];
$pass = $_POST['password'];

// Cek data di database
$sql = "SELECT * FROM users WHERE nim = '$nim'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verifikasi password
    if (password_verify($pass, $row['password'])) {
        // Set session untuk status login
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['nim'] = $row['nim'];

        // Redirect ke halaman utama (ganti dengan halaman utama Anda)
        header("Location: utama.php");
        exit();
    } else {
        // Jika password salah, tampilkan pop-up
        echo "<script>alert('Password salah.'); window.location.href='login.php';</script>";
    }
} else {
    // Jika NIM tidak ditemukan, tampilkan pop-up
    echo "<script>alert('NIM tidak ditemukan.'); window.location.href='login.php';</script>";
}

// Tutup koneksi
$conn->close();
?>

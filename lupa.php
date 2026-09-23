<?php
// Konfigurasi database langsung di file ini
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

// Ambil data dari formulir
$username = $_POST['username'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Periksa apakah password baru dan konfirmasi password cocok
if ($new_password !== $confirm_password) {
    echo "<script>alert('Password dan konfirmasi password tidak cocok.'); window.location.href='lupapassword.php';</script>";
    exit();
}

// Cek apakah username ada di database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Enkripsi password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password di database
    $update_sql = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Password berhasil direset. Silakan login dengan password baru.'); window.location.href='login.php';</script>";
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "<script>alert('Username tidak ditemukan.'); window.location.href='lupapassword.php';</script>";
}

// Tutup koneksi
$conn->close();
?>

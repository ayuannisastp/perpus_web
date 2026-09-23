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

// Ambil NIM peminjam dari session login
$nimPeminjam = $_SESSION['nim']; // Mengambil NIM peminjam yang sedang login

// Query untuk mengambil data peminjaman berdasarkan NIM
$sql = "SELECT * FROM peminjaman WHERE nim = '$nimPeminjam'";
$result = $conn->query($sql);

// HTML untuk menampilkan daftar bacaan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bacaan</title>
    <style>
        /* Style untuk halaman */
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg'); /* Pastikan gambar ini ada */
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            flex-direction: column;
            align-items: flex-start;
        }
        .container {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: white;
        }
        .header {
            width: 95%;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #transparent;
        }
        .header h1 {
            font-size: 24px;
            color: #fff;
        }
        .home {
            color: #fff;
            font-size: 18px;
            text-decoration: none;
        }
        h2 {
            color: #333;
            font-size: 24px;
            text-align: left;
            margin-bottom: 20px;
        }
        .empty-message {
            font-size: 16px;
            color: #666;
            text-align: center;
            padding: 20px;
        }
        .book-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .book-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Daftar Bacaan</h1>
        <a href="utama.php" class="home">HOME</a>
    </div>
    <div class="container">
        <h2>Buku yang Dipinjam</h2>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="book-item">';
                echo '<p><strong>Judul Buku:</strong> ' . $row['judul_buku'] . '</p>';
                echo '<p><strong>Tanggal Peminjaman:</strong> ' . $row['tanggal_peminjaman'] . '</p>';
                echo '<p><strong>Tenggat Pengembalian:</strong> ' . $row['tenggat_pengembalian'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p class="empty-message">Anda belum meminjam buku.</p>';
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </div>
</body>
</html>

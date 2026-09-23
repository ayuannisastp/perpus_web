<?php
session_start(); // Memulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil NIM dan username dari session
$nimPeminjam = $_SESSION['nim'];
$namaPeminjam = $_SESSION['username']; // Ambil nama dari session (username)

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

// Validasi jika data dari form ada
if (isset($_POST['judul-buku']) && isset($_POST['kode-pinjam']) && isset($_POST['jumlah-hari']) && isset($_POST['tanggal-peminjaman']) && isset($_POST['tenggat-pengembalian'])) {
    // Ambil data dari form
    $judulBuku = $_POST['judul-buku'];
    $kodePinjam = $_POST['kode-pinjam'];
    $jumlahHari = $_POST['jumlah-hari'];
    $tanggalPeminjaman = $_POST['tanggal-peminjaman'];
    $tenggatPengembalian = $_POST['tenggat-pengembalian'];

    // Query untuk mendapatkan data buku berdasarkan judul
    $result = $conn->query("SELECT * FROM buku WHERE judul = '$judulBuku'");
    
    if ($result->num_rows > 0) {
        $buku = $result->fetch_assoc();
        $idBuku = $buku['id']; // Mendapatkan id buku
        $coverBuku = $buku['gambar']; 
    } else {
        echo "Buku tidak ditemukan.";
        exit;
    }

    // Masukkan data peminjaman ke dalam tabel peminjaman
    $sql_peminjaman = "INSERT INTO peminjaman (nim, kode_pinjam, judul_buku, id_buku, tanggal_peminjaman, tenggat_pengembalian, jumlah_hari) 
                       VALUES ('$nimPeminjam', '$kodePinjam', '$judulBuku', '$idBuku', '$tanggalPeminjaman', '$tenggatPengembalian', '$jumlahHari')";

    if ($conn->query($sql_peminjaman) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Data peminjaman tidak lengkap.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peminjaman Buku</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('bg.jpg'); /* Pastikan gambar ini ada di folder yang sama */
        background-size: cover;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding-top: 60px; /* Adjust for header height */
    }

    .header {
    background-color: #transparent;
    color: black;
    padding: 0 20px;
    display: flex;
    align-items: center; /* Vertically centers the content */
    justify-content: space-between; /* Aligns items on opposite sides */
    height: 60px; /* Set a consistent height */
    font-weight: bold;
    font-size: 20px;
    position: fixed;
    top: 0;
    left: 0;
    width: 95%;
    z-index: 1000;
}

    .header a {
        color: black;
        text-decoration: none;
        font-size: 18px;
    }

    .container {
        width: 1000px;
        background-color: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .content {
        display: flex;
    padding: 20px 20px 20px 40px; 
    }

    .book-cover {
        width: 210px;
        height: 270px;
        margin-right: 60px;
    }

    .details {
        margin-left: 20px;
    }

    .details h2 {
        font-size: 22px;
        margin: 0 0 20px;
    }

    .checkmark {
        color: #00BCD4;
    }

    .details p {
        margin: 8px 0;
        font-size: 16px;
        color: #333;
    }

    .note {
        background-color: #FFF3E0;
        padding: 15px 20px;
        font-size: 14px;
        color: #795548;
        border-top: 1px solid #FFA726;
    }
</style>
</head>
<body>

<div class="header">
        <p>&gt; MEMINJAM BUKU</p>
        <a href="utama.php">HOME</a>
    </div>
    <div class="container">
        <div class="content">
        <img src="<?php echo $coverBuku; ?>" alt="Book Cover" class="book-cover">
            <div class="details">
                <h2>BERHASIL MEMINJAM <span class="checkmark">✔</span></h2>
                <p><strong>NAMA :</strong> <?php echo $namaPeminjam; ?></p>
                <p><strong>NIM :</strong> <?php echo $nimPeminjam; ?></p>
                <p><strong>JUDUL BUKU :</strong> <?php echo $judulBuku; ?></p>
                <p><strong>JUMLAH HARI :</strong> <?php echo $jumlahHari; ?> HARI</p>
                <p><strong>TANGGAL PEMINJAMAN :</strong> <?php echo $tanggalPeminjaman; ?></p>
                <p><strong>PENGEMBALIAN :</strong> <?php echo $tenggatPengembalian; ?></p>
                <p><strong>ID BUKU :</strong> <?php echo $idBuku; ?></p>
                <p><strong>KODE PEMINJAM :</strong> <?php echo $kodePinjam; ?></p>
            </div>
        </div>
        <div class="note">
            <p>CATATAN : Setiap keterlambatan pada pengembalian buku akan dikenakan sanksi atau denda.</p>
        </div>
    </div>
</body>
</html>
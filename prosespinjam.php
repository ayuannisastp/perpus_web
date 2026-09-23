<?php
session_start();
include 'koneksi.php';

$kodeBatang = isset($_GET['code']) ? $_GET['code'] : null;

if ($kodeBatang) {
    $stmt = $conn->prepare("SELECT * FROM buku WHERE kode_batang = ?");
    if ($stmt) {
        $stmt->bind_param("s", $kodeBatang);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['buku'] = $result->fetch_assoc();
            header("Location: form.php");
            exit;
        } else {
            echo "<p>Kode batang tidak valid atau buku tidak ditemukan.</p>";
            echo "<a href='scan.php'><button>Kembali ke scan</button></a>";
        }
        $stmt->close();
    } else {
        echo "<p>Gagal memproses permintaan. Silakan coba lagi.</p>";
    }
} else {
    echo "<p>Kode batang tidak tersedia.</p>";
    echo "<a href='scan.php'><button>Kembali ke scan</button></a>";
}

$conn->close();
?>

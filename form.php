<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

// Mendapatkan judul buku dari URL
$judulBuku = isset($_GET['book']) ? $_GET['book'] : null;
$buku = null;

if ($judulBuku) {
    // Query untuk mencari buku berdasarkan judul
    $stmt = $conn->prepare("SELECT * FROM buku WHERE judul = ?");
    $stmt->bind_param("s", $judulBuku);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $buku = $result->fetch_assoc();
    } else {
        echo "<p>Buku tidak ditemukan.</p>";
    }
    $stmt->close();
}

// Membuat kode pinjam
date_default_timezone_set('Asia/Jakarta');
$kodePinjam = 'KP-' . date('Ymd') . '-' . date('His');

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg'); /* Pastikan gambar ini ada di folder yang sama */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        
        .header {
            width: 90%;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-image: url('bg.jpg');
            background-size: cover;
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

        .container {
            background-color: transparent;
            width: 90%;
            max-width: 600px;
            padding: 20px;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .container h1 {
            background-color: #c88e4a;
            color: white;
            padding: 10px;
            margin-top: 0;
            border-radius: 10px 10px 0 0;
            font-size: 24px;
            text-align: center;
        }

        .book-cover {
            max-width: 270px;
            border-radius: 25px;
            margin-bottom: 15px;
        }
        
        .form-content {
            flex: 1;
        }

        .form-group {
            margin: 15px 0;
            text-align: left;
        }
        
        .form-group label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 25px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        
        .form-group input:disabled {
            background-color: #f0f4f8;
            color: #888;
        }
        
        .confirm-btn {
            display: inline-block;
            width: 100%;
            background-color: #c88e4a;
            color: white;
            padding: 12px;
            font-size: 18px;
            text-align: center;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .confirm-btn:hover {
            background-color: #a8723b;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>MEMINJAM BUKU</h1>
        <a href="utama.php" class="home">HOME</a>
    </header>

    <div class="container">
        <!-- Tampilkan gambar buku dan detail di sebelah kiri -->
        <?php if ($buku): ?>
            <img src="<?php echo htmlspecialchars($buku['gambar']); ?>" alt="Book Cover" class="book-cover">
        <?php else: ?>
            <p>Buku tidak ditemukan.</p>
        <?php endif; ?>
        
        <!-- Form Content di sebelah kanan -->
        <div class="form-content">
            <?php if ($buku): ?>
                <h1><?php echo htmlspecialchars($buku['judul']); ?></h1>
               
            <?php else: ?>
                <h1>Buku Tidak Ditemukan</h1>
            <?php endif; ?>
            
            <!-- Formulir dengan action menuju scan.php -->
            <form action="buktipemijaman.php" method="POST">
            <input type="hidden" id="judul-buku" name="judul-buku" value="<?php echo htmlspecialchars($buku['judul'] ?? ''); ?>">
    
    <div class="form-group">
        <label for="kode-pinjam">Kode Pinjam:</label>
        <input type="text" id="kode-pinjam" name="kode-pinjam" value="<?php echo $kodePinjam; ?>" readonly>
    </div>
    
    <div class="form-group">
        <label for="jumlah-hari">Jumlah Hari:</label>
        <select id="jumlah-hari" name="jumlah-hari" required>
            <option value="" disabled selected>Pilih salah satu</option>
            <option value="7">7 Hari</option>
            <option value="14">14 Hari</option>
            <option value="30">30 Hari</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="tanggal-peminjaman">Tanggal Peminjaman:</label>
        <input type="date" id="tanggal-peminjaman" name="tanggal-peminjaman" required>
    </div>
    
    <div class="form-group">
        <label for="tenggat-pengembalian">Tenggat Pengembalian:</label>
        <input type="date" id="tenggat-pengembalian" name="tenggat-pengembalian" required>
    </div>
    
    <button type="submit" class="confirm-btn">Konfirmasi</button>
</form>

        </div>
    </div>

    <script>
    function updateReturnDate() {
        const selectedDays = parseInt(document.getElementById('jumlah-hari').value);
        const borrowDateInput = document.getElementById('tanggal-peminjaman');
        const returnDateInput = document.getElementById('tenggat-pengembalian');

        if (!isNaN(selectedDays) && borrowDateInput.value) {
            const borrowDate = new Date(borrowDateInput.value);
            borrowDate.setDate(borrowDate.getDate() + selectedDays);

            const returnDate = borrowDate.toISOString().split('T')[0];
            returnDateInput.value = returnDate;
        }
    }

    // Event listener untuk jumlah hari dan tanggal peminjaman
    document.getElementById('jumlah-hari').addEventListener('change', updateReturnDate);
    document.getElementById('tanggal-peminjaman').addEventListener('change', updateReturnDate);
</script>

</body>
</html>
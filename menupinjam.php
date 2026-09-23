<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pinjam Buku</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('bg.jpg'); /* Pastikan gambar ini ada di folder yang sama */
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Header */
        .header {
            width: 100%;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-image: url('bg.jpg'); /* Pastikan gambar ini ada di folder yang sama */
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

        /* Search Bar */
        .search-container {
            display: flex;
            justify-content: flex-start; /* Mengatur kolom pencarian ke sebelah kiri */
            padding: 20px; /* Padding untuk spasi di sekitar pencarian */
            width: 100%; /* Pastikan lebar penuh untuk container */
            margin-left: 20px; /* Tambahkan margin kiri untuk jarak */
        }

        .search-container input[type="text"] {
            padding: 10px;
            border-radius: 20px;
            border: none;
            width: 200px; /* Lebar input pencarian */
            padding-left: 35px; /* Ruang untuk ikon pencarian */
            margin-right: 10px; /* Jarak antara input dan ikon */
        }

        .search-container i {
            position: relative; /* Menjaga ikon pencarian di dalam input */
            left: 10px; /* Penempatan ikon */
            color: #999;
        }

        /* Book List Section */
        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            padding: 20px;
            width: 90%;
            max-width: 1200px;
        }

        .book {
            background-color: transparent;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .book img {
    max-width: 100%;
    height: 200px; /* Atur tinggi tetap untuk semua gambar */
    object-fit: cover; /* Memastikan gambar terpotong dengan baik */
    border-radius: 5px;
}

        .book h3 {
            font-size: 16px;
            margin: 10px 0 5px;
        }

        .book .status {
            display: inline-block;
            padding: 5px 15px;
            background-color: #D9862D;
            color: #fff;
            border-radius: 20px;
            font-size: 12px;
            text-decoration: none;
        }

        /* Navigation Arrows */
        .nav-arrows {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .nav-arrows a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #00C4CC;
            border-radius: 50%;
            color: #fff;
            text-align: center;
            line-height: 40px;
            font-size: 24px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php
include 'koneksi.php'; // Menghubungkan ke database

// Initialize an empty result set
$result = null;

// Check if there is a search query
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM buku WHERE judul LIKE ? OR penulis LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set
} else {
    // If no search query, get all books
    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);
}
?>

<!-- Header -->
<header class="header">
    <h1>MEMINJAM BUKU</h1>
    <a href="utama.php" class="home">HOME</a>
</header>

<!-- Search Bar -->
<div class="search-container">
    <form method="GET" action="menupinjam.php">
        <input type="text" name="query" placeholder="Cari" required>
        <button type="submit">🔍</button>
    </form>
</div>

<!-- Book List -->
<div class="book-list">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="book">
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>">
                <h3><?php echo htmlspecialchars($row['judul']) . " - " . htmlspecialchars($row['penulis']); ?></h3>
                <a href="form.php?book=<?php echo urlencode($row['judul']); ?>" class="status">
                    <?php echo htmlspecialchars($row['status']); ?>
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Tidak ada buku yang tersedia.</p>
    <?php endif; ?>
</div>

<!-- Navigation Arrows -->
<div class="nav-arrows">
    <a href="#">&lt;</a>
    <a href="#">&gt;</a>
</div>

<?php $conn->close(); // Menutup koneksi ?>
</body>
</html>
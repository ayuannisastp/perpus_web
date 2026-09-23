<?php
session_start();
include 'koneksi.php'; 

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg'); /* Pastikan gambar ini ada di folder yang sama */
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-weight: bold;
        }
        .header .user-icon {
            display: flex;
            align-items: center;
        }
        .header .user-icon::before {
            content: "👤";
            margin-right: 8px;
            font-size: 20px;
        }
        .menu {
            display: flex;
            gap: 30px;
            font-size: 16px;
        }
        .menu a {
            color: rgb(0, 0, 0);
            text-decoration: none;
        }
        .welcome-section {
            background-image: url('bg2.jpg');
            background-size: cover;
            background-position: center;
            padding: 50px 0;
            text-align: center;
            color: white;
            position: relative;
        }
        .welcome-section h1 {
            font-size: 48px;
            font-weight: bold;
            margin: 0;
        }
        .search-container {
    display: flex-start;
    justify-content: center; /* Centering the search bar */
    width: 100%; /* Full width */
    padding: 10px; /* Padding around the search bar */
}

.search-container input[type="text"] {
    padding: 10px;
    border-radius: 20px;
    border: none;
    width: 100%; /* Full width */
    max-width: 400px; /* Max width */
    padding-left: 50px; /* Padding for the search icon */
    margin-right: 0px; /* Spacing between input and button */
}

.search-container button {
    padding: 10px 5px; /* Padding untuk tombol */
    border-radius: 0 30px 20px 0; /* Membuat sudut kanan tombol melengkung */
    border: none; /* Menghilangkan border */
    background-color: transparent; /* Warna latar belakang tombol */
    color: white; /* Warna teks tombol */
    cursor: pointer; /* Mengubah kursor saat hover */
}
        .main-content {
            display: flex;
            margin-top: 20px;
        }
        .sidebar {
            flex: 1;
            margin-right: 20px;
        }
        .sidebar .categories {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .categories button {
            background-color: #d4a017;
            border: none;
            padding: 10px;
            border-radius: 20px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            text-align: left;
            transition: background-color 0.3s;
            width: 100%;
        }
        .categories button:hover {
            background-color: #b38a0f;
        }
        .book-list {
            flex: 3;
            display: flex; /* Mengatur tampilan menjadi flex untuk buku kesamping */
            overflow-x: auto; /* Menambahkan scroll horizontal jika diperlukan */
            gap: 20px; /* Jarak antar buku */
            justify-content: start;
            flex-wrap: nowrap; /* Tidak membungkus ke baris baru */
            position: relative; /* Menjadi parent untuk posisi absolute arrow */
            padding: 10px 0; /* Menambahkan padding agar panah tidak terlalu menempel */
        }
        .book-item {
            width: 150px;
            text-align: center;
            color: #333;
            flex-shrink: 0; /* Mencegah penyusutan */
        }
        .book-item img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .book-item p {
            margin: 10px 0 5px;
            font-size: 14px;
        }
        /* Styling untuk tombol Baca */
        .book-item a {
            text-decoration: none;
        }
        .book-item a button {
            background-color: #d4a017;
            border: none;
            padding: 5px 20px;
            border-radius: 20px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .book-item a button:hover {
            background-color: #b38a0f;
        }
        /* Tombol panah */
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            z-index: 10;
            transition: opacity 0.3s; /* Tambahan transisi */
        }
        .arrow.left {
            left: 5px; /* Menyesuaikan posisi panah kiri */
        }
        .arrow.right {
            right: 5px; /* Menyesuaikan posisi panah kanan */
        }
        .new-arrivals {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="user-icon"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
        <div class="menu">
            <a href="kembalikan.php">PENGEMBALIAN BUKU</a>
            <a href="menupinjam.php">MEMINJAM BUKU</a>
            <a href="daftarbacaan.php">DAFTAR BACAAN</a>
        </div>
    </div>

    <div class="welcome-section">
        <h1>SELAMAT DATANG</h1>
        <div class="search-container">
    <form method="GET" action="menupinjam.php"> <!-- Change to the correct action page -->
        <input type="text" name="query" placeholder="Cari" required>
        <button type="submit">🔍</button>
    </form>
</div>
    </div>

    <div class="main-content">
        <!-- Sidebar Kategori -->
        <div class="sidebar">
            <div class="categories">
                <button onclick="showBooks('new')">Buku Terbaru</button>
                <button onclick="showBooks('psikologi')">Psikologi</button>
                <button onclick="showBooks('fiksi')">Fiksi</button>
                <button onclick="showBooks('sains')">Sains</button>
            </div>
        </div>

        <!-- Daftar Buku Terbaru -->
        <div class="book-list" id="new">
            <button class="arrow left" onclick="scrollBooks('new', -1)">&#9664;</button>
            <button class="arrow right" onclick="scrollBooks('new', 1)">&#9654;</button>
            
            <?php
            // Query untuk kategori "Buku Terbaru"
            $sql = "SELECT * FROM buku WHERE kategori LIKE '%new%'";
$result = $conn->query($sql);

// Cek apakah query berhasil dijalankan
if ($result === false) {
    die("Error executing query: " . $conn->error); // Menampilkan error query jika gagal
}

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-item'>
                            <img src='".htmlspecialchars($row['gambar'])."' alt='".htmlspecialchars($row['judul'])."'>
                            <p>".htmlspecialchars($row['judul'])."<br><small>".htmlspecialchars($row['penulis'])."</small></p>
                            <a href='form.php?book=".urlencode($row['judul'])."'>
                                <button>Pinjam</button>
                            </a>
                          </div>";
                }
            } else {
                echo "<p>Tidak ada buku terbaru tersedia.</p>";
            }
            ?>
        </div>

        <!-- Daftar Buku Psikologi -->
        <div class="book-list" id="psikologi" style="display: none;">
            <button class="arrow left" onclick="scrollBooks('psikologi', -1)">&#9664;</button>
            <button class="arrow right" onclick="scrollBooks('psikologi', 1)">&#9654;</button>
            
            <?php
            // Query untuk kategori "Psikologi"
            $sql = "SELECT * FROM buku WHERE kategori LIKE '%psikologi%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-item'>
                            <img src='".htmlspecialchars($row['gambar'])."' alt='".htmlspecialchars($row['judul'])."'>
                            <p>".htmlspecialchars($row['judul'])."<br><small>".htmlspecialchars($row['penulis'])."</small></p>
                            <a href='form.php?book=".urlencode($row['judul'])."'>
                                <button>Baca</button>
                            </a>
                          </div>";
                }
            } else {
                echo "<p>Tidak ada buku psikologi tersedia.</p>";
            }
            ?>
        </div>

        <!-- Daftar Buku Fiksi -->
        <div class="book-list" id="fiksi" style="display: none;">
            <button class="arrow left" onclick="scrollBooks('fiksi', -1)">&#9664;</button>
            <button class="arrow right" onclick="scrollBooks('fiksi', 1)">&#9654;</button>
            
            <?php
            // Query untuk kategori "Fiksi"
            $sql = "SELECT * FROM buku WHERE kategori LIKE '%fiksi%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-item'>
                            <img src='".htmlspecialchars($row['gambar'])."' alt='".htmlspecialchars($row['judul'])."'>
                            <p>".htmlspecialchars($row['judul'])."<br><small>".htmlspecialchars($row['penulis'])."</small></p>
                            <a href='form.php?book=".urlencode($row['judul'])."'>
                                <button>Baca</button>
                            </a>
                          </div>";
                }
            } else {
                echo "<p>Tidak ada buku fiksi tersedia.</p>";
            }
            ?>
        </div>

        <!-- Daftar Buku Sains -->
        <div class="book-list" id="sains" style="display: none;">
            <button class="arrow left" onclick="scrollBooks('sains', -1)">&#9664;</button>
            <button class="arrow right" onclick="scrollBooks('sains', 1)">&#9654;</button>
            
            <?php
            // Query untuk kategori "Sains"
            $sql = "SELECT * FROM buku WHERE kategori LIKE '%sains%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-item'>
                            <img src='".htmlspecialchars($row['gambar'])."' alt='".htmlspecialchars($row['judul'])."'>
                            <p>".htmlspecialchars($row['judul'])."<br><small>".htmlspecialchars($row['penulis'])."</small></p>
                            <a href='form.php?book=".urlencode($row['judul'])."'>
                                <button>Baca</button>
                            </a>
                          </div>";
                }
            } else {
                echo "<p>Tidak ada buku sains tersedia.</p>";
            }
            ?>
        </div>
    </div>
</div>

<script>
// JavaScript untuk menampilkan kategori buku
function showBooks(category) {
    document.querySelectorAll('.book-list').forEach(list => list.style.display = 'none');
    document.getElementById(category).style.display = 'flex';
}

// JavaScript untuk scroll buku secara horizontal
function scrollBooks(category, direction) {
    const bookList = document.getElementById(category);
    bookList.scrollLeft += direction * 200;
}
</script>

<?php $conn->close(); // Menutup koneksi ?>
</body>
</html>
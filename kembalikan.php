<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bacaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg'); /* Make sure the image exists in the same folder */
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            flex-direction: column; /* Stack items vertically */
            align-items: flex-start;
        }
        .container {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: ;
        }
        .header {
            width: 90%;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-image: url('bg.jpg'); /* Make sure the image exists in the same folder */
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
        .book-cover {
            width: 80px;
            height: auto;
            margin-right: 15px;
        }
        .book-details {
            flex: 1;
        }
        .book-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #00796b;
        }
        .book-category, .book-pages, .book-description {
            margin: 5px 0;
            font-size: 14px;
        }
        .read-more-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #ff7043;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PENGEMBALIAN BUKU</h1>
        <a href="utama.php" class="home">HOME</a>
    </div>
    <div class="container">
        <h2></h2>

        <?php
        // Array of books; empty for now
        $books = [];

        if (empty($books)) {
            echo '<p class="empty-message">KAMU BELUM MEMINJAM BUKUg</p>';
        } else {
            foreach ($books as $book) {
                echo '<div class="book-item">';
                echo '<img src="' . $book['cover'] . '" alt="Book Cover" class="book-cover">';
                echo '<div class="book-details">';
                echo '<p class="book-title">' . $book['title'] . '</p>';
                echo '<p class="book-category"><strong>Kategori:</strong> ' . $book['category'] . '</p>';
                echo '<p class="book-pages"><strong>Halaman:</strong> ' . $book['pages'] . '</p>';
                echo '<p class="book-description"><strong>Deskripsi:</strong> ' . $book['description'] . '</p>';
                echo '<a href="#" class="read-more-btn">Baca lagi</a>';
                echo '</div></div>';
            }
        }
        ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pinjam Buku</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="container">
        <h1>Form Peminjaman Buku</h1>
        <form action="/pinjam" method="POST">
            <label for="user">Nama Peminjam:</label>
            <input type="text" id="user" name="user" required>
            
            <label for="book">Judul Buku:</label>
            <input type="text" id="book" name="book" required>
            
            <label for="date">Tanggal Pinjam:</label>
            <input type="date" id="date" name="date" required>
            
            <button type="submit">Pinjam Buku</button>
        </form>
    </div>
</body>
</html>

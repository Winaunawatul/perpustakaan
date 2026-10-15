<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus.app</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
        }

        .navbar {
            background: #2563eb;
            color: white;
            padding: 20px 50px;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            padding: 50px;
        }

        h1 {
            color: #1e293b;
        }

        .menu {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            width: 180px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .card h3 {
            color: #2563eb;
        }
    </style>
</head>

<body>

    <div class="navbar">
        📚 Perpus.app
    </div>

    <div class="container">
        <h1>Selamat Datang di Perpustakaan</h1>
        <p>Kelola data buku, anggota, dan peminjaman dengan mudah.</p>

        <div class="menu">

            <div class="card">
                <h3>📚 Data Buku</h3>
                <p>Kelola koleksi buku.</p>
            </div>

            <div class="card">
                <h3>👥 Anggota</h3>
                <p>Kelola anggota perpustakaan.</p>
            </div>

            <div class="card">
                <h3>📖 Peminjaman</h3>
                <p>Kelola peminjaman buku.</p>
            </div>

        </div>
    </div>

</body>
</html>
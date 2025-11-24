<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Job Portal</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1e40af;
            color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            position: relative;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
        }

        /* Tombol logout di pojok kiri atas */
        .logout-btn {
            position: absolute;
            right: 30px;
            top: 15px;
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }

        main {
            max-width: 800px;
            margin: 60px auto;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <header>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
        <h1>JobPortal Dashboard</h1>
    </header>
    <main>
        <h2>Selamat Datang, {{ Auth::user()->name }} di Profil Anda!</h2>
        <p>Nama: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
    </main>
</body>
</html>

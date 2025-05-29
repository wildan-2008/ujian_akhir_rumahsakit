<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cav Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Logos RS.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ancizar+Serif:ital,wght@0,300..900;1,300..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
            font-family: 'Open sans', sans-serif;
        }
        h2 {
            font-family: 'lato', sans-serif;
            font-weight: 700;
            font-style: normal;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        .logo {
            width: 150x;
            height: 60px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="bg-light text-white p-3 sidebar" style="width: 220px;">
        <div class="text-center mb-4">
            <img src="{{ asset('RS.png') }}" alt="Logo Rumah Sakit" class="logo mb-2">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/" class="nav-link text-black">Dashboard</a></li>
            <li class="nav-item"><a href="/pasien" class="nav-link text-black">Pasien</a></li>
            <li class="nav-item"><a href="/dokter" class="nav-link text-black">Dokter</a></li>
            <li class="nav-item"><a href="/kunjungan" class="nav-link text-black">Kunjungan</a></li>
            <li class="nav-item"><a href="/tindakan" class="nav-link text-black">Tindakan</a></li>
            <li class="nav-item"><a href="/detailtindakan" class="nav-link text-black">Detail Tindakan</a></li>
        </ul>
    </div>

    <div class="content w-100">
        @yield('content')
    </div>
</div>
</body>
</html>

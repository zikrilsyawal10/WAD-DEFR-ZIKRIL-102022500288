<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Venue Olahraga</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Venue Olahraga</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="mb-3">Selamat Datang, {{ Auth::user()->nama }}! 👋</h2>
                        <p class="text-muted">Anda berhasil masuk ke sistem menggunakan data dari database lama (tabel <code>pelanggan</code>).</p>
                        
                        <hr>

                        <h5 class="mb-3">Profil Anda:</h5>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span><strong>Email:</strong></span>
                                <span>{{ Auth::user()->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><strong>No Telepon:</strong></span>
                                <span>{{ Auth::user()->no_telepon ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><strong>Level Member:</strong></span>
                                <span class="badge bg-primary">{{ Auth::user()->level_member ?? 'Standard' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><strong>Alamat:</strong></span>
                                <span>{{ Auth::user()->alamat ?? '-' }}</span>
                            </li>
                        </ul>

                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="button" disabled>Kelola Data Venue (Segera Hadir)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
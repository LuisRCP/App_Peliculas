<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - App Películas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap PRIMERO -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- TU CSS AL FINAL -->
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-dark px-3" style="background:#0b0b0b;border-bottom:1px solid #222;">
    <span class="navbar-brand fw-semibold">
        <i class="fa-solid fa-gauge me-2"></i> Panel Administrador
    </span>

    <div>
        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-light btn-sm me-2">
            <i class="fa-solid fa-house"></i> Inicio
        </a>

        <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">
            <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
        </a>
    </div>
</nav>

<div class="container mt-4">

    <!-- ===== HEADER ===== -->
    <div class="mb-4">
        <h3 class="fw-semibold mb-1">
            <i class="fa-solid fa-chart-line me-2"></i>Bienvenido al Dashboard
        </h3>
        <p class="text-secondary mb-0">
            Panel de administración del sistema de películas
        </p>
        <hr style="border-color:#222;">
    </div>

    <!-- ===== CARDS ===== -->
    <div class="row g-4 mt-2">

        <!-- Películas -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100 border-0">
                <div class="card-body py-4">

                    <div class="mb-3">
                        <i class="fa-solid fa-film fa-2x text-primary"></i>
                    </div>

                    <h5 class="card-title fw-semibold">Películas</h5>
                    <p class="card-text text-secondary">
                        Administrar catálogo de películas
                    </p>

                    <a href="<?= base_url('admin/peliculas') ?>" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-right"></i> Ir
                    </a>

                </div>
            </div>
        </div>

        <!-- Clientes -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100 border-0">
                <div class="card-body py-4">

                    <div class="mb-3">
                        <i class="fa-solid fa-users fa-2x text-success"></i>
                    </div>

                    <h5 class="card-title fw-semibold">Clientes</h5>
                    <p class="card-text text-secondary">
                        Administrar usuarios del sistema
                    </p>

                    <a href="<?= base_url('admin/clientes') ?>" class="btn btn-success">
                        <i class="fa-solid fa-arrow-right"></i> Ir
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
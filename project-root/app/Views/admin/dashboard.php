<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - App Películas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">
        <i class="fa-solid fa-gauge"></i> Panel Administrador
    </span>

    <div>
        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm me-2">
            <i class="fa-solid fa-house"></i> Inicio
        </a>

        <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">
            <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
        </a>
    </div>
</nav>

<div class="container mt-4">

    <h3 class="mb-3">
        <i class="fa-solid fa-chart-line"></i> Bienvenido al Dashboard
    </h3>

    <hr>

    <div class="row mt-4">

        <!-- Películas -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fa-solid fa-film fa-2x mb-3 text-primary"></i>
                    <h5 class="card-title">Películas</h5>
                    <p class="card-text">Administrar películas</p>
                    <a href="<?= base_url('admin/peliculas') ?>" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-right"></i> Ir
                    </a>
                </div>
            </div>
        </div>

        <!-- Usuarios -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fa-solid fa-users fa-2x mb-3 text-success"></i>
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Administrar usuarios</p>
                    <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-success">
                        <i class="fa-solid fa-arrow-right"></i> Ir
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
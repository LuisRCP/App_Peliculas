<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - App Películas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Tu CSS -->
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">

</head>

<body class="dark-cinema d-flex justify-content-center align-items-center">
<div class="login-card p-4 p-md-5">

    <!-- LOGO / TITULO -->
    <h3 class="text-center mb-4 fw-semibold brand-title">
        <i class="fa-solid fa-film me-2 text-danger"></i>
        App Películas
    </h3>

    <!-- ERROR -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login') ?>">

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label small text-secondary">Correo electrónico</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="form-label small text-secondary">Contraseña</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" name="clave" id="inputPassword" class="form-control" required>

                <button class="input-group-text" type="button" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <!-- BOTÓN -->
        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="fa-solid fa-right-to-bracket me-2"></i>
            Iniciar Sesión
        </button>

    </form>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function togglePassword() {
    const input = document.getElementById('inputPassword');
    const icon = document.getElementById('eyeIcon');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>
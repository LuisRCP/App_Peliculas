<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
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

<body class="dark-cinema">

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-dark navbar-dark-pro px-3">
    <span class="navbar-brand fw-semibold">
        <i class="fa-solid fa-users me-2"></i> Gestión de Clientes
    </span>
    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-light btn-sm">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
</nav>

<div class="container mt-4">

    <!-- ===== ALERTA CLAVE ===== -->
    <?php if(session()->getFlashdata('claveGenerada')): ?>
        <div class="alert alert-info alert-dismissible fade show">
            <strong>Cliente creado correctamente.</strong><br>
            Clave generada:
            <span class="fw-bold text-danger">
                <?= session()->getFlashdata('claveGenerada') ?>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- ===== CARD CONTENEDORA ===== -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="fa-solid fa-table me-2"></i>Listado de Clientes
                </h5>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="fa-solid fa-plus"></i> Nuevo Cliente
                </button>
            </div>

            <!-- ===== TABLA ===== -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th width="160">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clientes as $c): ?>
                        <tr>
                            <td>
                                <?= $c['nombre'] . ' ' . $c['apellido_paterno'] . ' ' . $c['apellido_materno'] ?>
                            </td>
                            <td><?= $c['email'] ?></td>
                            <td><?= $c['fecha_registro'] ?></td>
                            <td>
                                <?php if($c['esta_Activo']): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>

                                <!-- Editar -->
                                <button class="btn btn-warning btn-sm"
                                    onclick="editarCliente(<?= htmlspecialchars(json_encode($c)) ?>)">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <!-- Toggle -->
                                <a href="<?= base_url('admin/clientes/toggle/'.$c['usuario_Id']) ?>"
                                   class="btn btn-secondary btn-sm">
                                    <i class="fa-solid fa-power-off"></i>
                                </a>

                                <!-- Reset password -->
                                <a href="<?= base_url('admin/clientes/reset-password/'.$c['usuario_Id'])?>"
                                   class="btn btn-info btn-sm"
                                   onclick="return confirm('¿Generar nueva contraseña?')">
                                   <i class="fa-solid fa-rotate"></i>
                                </a>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- ================= MODAL CREAR ================= -->
<div class="modal fade" id="modalCrear">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?= base_url('admin/clientes/store') ?>" method="post">

        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">
                <i class="fa-solid fa-plus"></i> Nuevo Cliente
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre" required>

            <input type="text" name="apellido_paterno" class="form-control mb-2" placeholder="Apellido Paterno" required>

            <input type="text" name="apellido_materno" class="form-control mb-2" placeholder="Apellido Materno">

            <input type="email" name="email" class="form-control mb-2" placeholder="Correo electrónico" required>

        </div>

        <div class="modal-footer">
            <button class="btn btn-success">
                <i class="fa-solid fa-save"></i> Registrar
            </button>
        </div>

      </form>

    </div>
  </div>
</div>

<!-- ================= MODAL EDITAR ================= -->
<div class="modal fade" id="modalEditar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="formEditar" method="post">

        <div class="modal-header bg-warning">
            <h5 class="modal-title">
                <i class="fa-solid fa-pen"></i> Editar Cliente
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <input type="text" name="nombre" id="editNombre" class="form-control mb-2" required>

            <input type="text" name="apellido_paterno" id="editApellidoP" class="form-control mb-2" required>

            <input type="text" name="apellido_materno" id="editApellidoM" class="form-control mb-2">

            <input type="email" name="email" id="editEmail" class="form-control mb-2" required>

        </div>

        <div class="modal-footer">
            <button class="btn btn-warning">
                <i class="fa-solid fa-save"></i> Actualizar
            </button>
        </div>

      </form>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function editarCliente(cliente) {

    document.getElementById('editNombre').value = cliente.nombre;
    document.getElementById('editApellidoP').value = cliente.apellido_paterno;
    document.getElementById('editApellidoM').value = cliente.apellido_materno;
    document.getElementById('editEmail').value = cliente.email;

    document.getElementById('formEditar').action =
        "<?= base_url('admin/clientes/update/') ?>" + cliente.usuario_Id;

    var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
    modal.show();
}
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
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
        <i class="fa-solid fa-film me-2"></i> Gestión de Películas
    </span>
    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-light btn-sm">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
</nav>

<div class="container mt-4">

    <!-- ===== CARD ===== -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="fa-solid fa-table me-2"></i>Listado de Películas
                </h5>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="fa-solid fa-plus"></i> Nueva Película
                </button>
            </div>

            <!-- ===== TABLA ===== -->
            <div class="table-responsive rounded-4 overflow-hidden">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="190">Imagen</th>
                            <th>Nombre</th>
                            <th>Género</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th width="140">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($peliculas as $p): ?>
                            <tr>
                                <td>
                                    <?php if($p['imagen_url']): ?>
                                        <img src="<?= base_url('public/' . $p['imagen_url']) ?>" class="movie-thumb">
                                    <?php endif; ?>
                                </td>

                                <td class="fw-semibold"><?= $p['nombre'] ?></td>

                                <td>
                                    <span class="badge bg-secondary">
                                        <?= $p['genero'] ?>
                                    </span>
                                </td>

                                <td style="max-width:320px;">
                                    <?= strlen($p['descripcion']) > 90
                                        ? substr($p['descripcion'], 0, 90) . '...'
                                        : $p['descripcion']; ?>
                                </td>

                                <td>
                                    <?php if($p['esta_Activo']): ?>
                                        <span class="badge bg-success">Activa</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactiva</span>
                                    <?php endif; ?>
                                </td>

                                <td>

                                    <!-- Editar -->
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editarPelicula(<?= htmlspecialchars(json_encode($p)) ?>)">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <!-- Toggle -->
                                    <a href="<?= base_url('admin/peliculas/toggle/'.$p['pelicula_Id']) ?>"
                                       class="btn btn-secondary btn-sm"
                                       onclick="return confirm('¿Cambiar estado de la película?')">
                                        <i class="fa-solid fa-power-off"></i>
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

      <form action="<?= base_url('admin/peliculas/store') ?>" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">
                <i class="fa-solid fa-plus"></i> Nueva Película
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre" required>

            <select name="genero_Id" class="form-control mb-2" required>
                <option value="">Seleccione género</option>
                <?php foreach($generos as $g): ?>
                    <option value="<?= $g['genero_Id'] ?>">
                        <?= $g['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="file" name="imagen" class="form-control mb-2">

            <textarea name="descripcion" class="form-control mb-2" placeholder="Descripción"></textarea>

            <input type="text" name="trailer_url" class="form-control mb-2" placeholder="URL Trailer">

        </div>

        <div class="modal-footer">
            <button class="btn btn-success">
                <i class="fa-solid fa-save"></i> Guardar
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

      <form id="formEditar" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-warning">
            <h5 class="modal-title">
                <i class="fa-solid fa-pen"></i> Editar Película
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <input type="text" name="nombre" id="editNombre" class="form-control mb-2" required>

            <select name="genero_Id" id="editGenero" class="form-control mb-2" required>
                <?php foreach($generos as $g): ?>
                    <option value="<?= $g['genero_Id'] ?>">
                        <?= $g['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="file" name="imagen" class="form-control mb-2">

            <textarea name="descripcion" id="editDescripcion" class="form-control mb-2"></textarea>

            <input type="text" name="trailer_url" id="editTrailer" class="form-control mb-2">

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function editarPelicula(pelicula) {

    document.getElementById('editNombre').value = pelicula.nombre;
    document.getElementById('editGenero').value = pelicula.genero_Id;
    document.getElementById('editDescripcion').value = pelicula.descripcion;
    document.getElementById('editTrailer').value = pelicula.trailer_url;

    document.getElementById('formEditar').action =
        "<?= base_url('admin/peliculas/update/') ?>" + pelicula.pelicula_Id;

    var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
    modal.show();
}
</script>

</body>
</html>
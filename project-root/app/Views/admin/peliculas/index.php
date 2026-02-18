<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">
        <i class="fa-solid fa-film"></i> Gestión de Películas
    </span>
    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
</nav>

<div class="container mt-4">

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrear">
        <i class="fa-solid fa-plus"></i> Nueva Película
    </button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($peliculas as $p): ?>
                <tr>
                    <td>
                        <?php if($p['imagen_url']): ?>
                            <img src="<?= base_url($p['imagen_url']) ?>" width="60">
                        <?php endif; ?>
                    </td>
                    <td><?= $p['nombre'] ?></td>
                    <td><?= $p['genero'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="editarPelicula(<?= htmlspecialchars(json_encode($p)) ?>)">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <a href="<?= base_url('admin/peliculas/delete/'.$p['pelicula_Id']) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar esta película?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- MODAL CREAR -->
<div class="modal fade" id="modalCrear">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('admin/peliculas/store') ?>" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title"><i class="fa-solid fa-plus"></i> Nueva Película</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditar">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditar" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-warning">
            <h5 class="modal-title"><i class="fa-solid fa-pen"></i> Editar Película</h5>
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
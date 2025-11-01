<?php
require __DIR__ . "/../controllers/estudiantes-controller.php";

use App\Controllers\EstudiantesController;

$estudiantesController = new EstudiantesController();
$estudiantes = $estudiantesController->getEstudiantes();

$estudiantesPorPrograma = [];
foreach ($estudiantes as $estudiante) {
    $programa = $estudiante->get('nombrePrograma') ?: 'Sin Programa Asignado';
    if (!isset($estudiantesPorPrograma[$programa])) {
        $estudiantesPorPrograma[$programa] = [];
    }
    $estudiantesPorPrograma[$programa][] = $estudiante;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <link rel="stylesheet" href="../public/css/modals.css">
    <link rel="stylesheet" href="../public/css/diseno.css">
</head>
<body>
    <h2>Modulo de estudiantes</h2>
    <br>
    <a href="../index.php">Volver</a>
    <section>
        <div>
            <img class="icono" src="../public/res/local_library.svg" alt="imagen" />
            <div class="id">Nuevo Estudiante</div>
            <div class="name">
                <a href="estudiantes-form.php">Crear estudiante</a>
            </div>
        </div>
        <?php
         if (count($estudiantesPorPrograma) > 0) {
            foreach ($estudiantesPorPrograma as $programa => $estudiantesPrograma) {
                echo '<h3>Programa: ' . $programa . '</h3>';
                foreach ($estudiantesPrograma as $estudiante) {
                    echo '<div>';
                    echo '  <img class="icono" src="../public/res/person_book.svg" alt="imagen" />';
                    echo '  <div class="codigo">Código: ' . $estudiante->get('codigo') . '</div>';
                    echo '  <div class="nombre">Nombre: ' . $estudiante->get('nombre') . '</div>';
                    echo '  <div class="email">Email: ' . $estudiante->get('email') . '</div>';
                    echo '  <div class="programa">Programa: ' . $estudiante->get('nombrePrograma') . '</div>';
                    echo '  <div class="btns">';
                    echo '      <a href="estudiantes-form.php?cod=' . urlencode($estudiante->get('codigo')) . '">';
                    echo '          <img class="icono" src="../public/res/edit.svg" alt="imagen"/>';
                    echo '      </a>';
                    echo '      <button onclick="borrarEstudiante(\'' . addslashes($estudiante->get('codigo')) . '\')">';
                    echo '          <img class="icono" src="../public/res/delete.svg" alt="imagen"/>';
                    echo '      </button>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
        } else {
            echo '<div>No hay estudiantes registrados</div>';
        }
        ?>
    </section>
    <div id="borrarModalEstudiantes" class="modal">
        <div>
            <h3 class="titulo">Eliminar el Estudiante</h3>
            <p class="descripcion">¿Desea eliminar al estudiante?</p>
            <form name="borrarEstudiantesForm" action="operaciones/borrar-estudiantes.php" method="post">
                <input type="hidden" name="codigo" value="">
                <button type="submit">Continuar</button>
                <button type="reset">Cancelar</button>
            </form>
        </div>
    </div>
    <script src="../public/js/modal-users.js"></script>
</body>
</html>
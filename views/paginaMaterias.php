<?php
require_once __DIR__ . "/../controllers/materias-controller.php";

use App\Controllers\MateriasController;

$materiasController = new MateriasController();
$materias = $materiasController->getMaterias();

$materiasPorPrograma = [];
foreach ($materias as $materia) {
    $programa = $materia->get('nombrePrograma') ?: 'Sin Programa Asignado';
    if (!isset($materiasPorPrograma[$programa])) {
        $materiasPorPrograma[$programa] = [];
    }
    $materiasPorPrograma[$programa][] = $materia;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
    <link rel="stylesheet" href="../public/css/modals.css">
    <link rel="stylesheet" href="../public/css/diseno.css">
</head>
<body>
    <h2>Módulo de materias</h2>
    <br>
    <a href="../index.php">Volver</a>
    <section>
        <div>
            <img class="icono" src="../public/res/menu_book.svg" alt="imagen" />
            <div class="id">Nueva materia</div>
            <div class="name">
                <a href="materias-form.php">Crear materias</a>
            </div>
        </div>
        <?php
         if (count($materiasPorPrograma) > 0) {
            foreach ($materiasPorPrograma as $programa => $materiasPrograma) {
                echo '<h3>Programa: ' . $programa . '</h3>';
                foreach ($materiasPrograma as $materia) {
                    echo '<div>';
                    echo '  <img class="icono" src="../public/res/checkbook.svg" alt="imagen" />';
                    echo '  <div class="codigo">Código: ' . $materia->get('codigo') . '</div>';
                    echo '  <div class="nombre">Nombre: ' . $materia->get('nombre') . '</div>';
                    echo '  <div class="programa">Programa: ' . $materia->get('nombrePrograma') . '</div>';
                    echo '  <div class="btns">';
                    echo '      <a href="materias-form.php?cod=' . urlencode($materia->get('codigo')) . '">';
                    echo '          <img class="icono" src="../public/res/edit.svg" alt="imagen"/>';
                    echo '      </a>';
                    echo '      <button onclick="borrarMateria(\'' . addslashes($materia->get('codigo')) . '\')">';
                    echo '          <img class="icono" src="../public/res/delete.svg" alt="imagen"/>';
                    echo '      </button>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
        } else {
            echo '<div>No hay materias registradas</div>';
        }
        ?>
    </section>
    <div id="borrarModalMaterias" class="modal">
        <div>
            <h3 class="titulo">Eliminar la Materia</h3>
            <p class="descripcion">¿Desea eliminar la Materia?</p>
            <form name="borrarMateriasForm" action="operaciones/borrar-materias.php" method="post">
                <input type="hidden" name="codigo" value="">
                <button type="submit">Continuar</button>
                <button type="reset">Cancelar</button>
            </form>
        </div>
    </div>
    <script src="../public/js/modal-users.js"></script>
</body>
</html>

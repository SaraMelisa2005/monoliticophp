<?php
require_once __DIR__ . "/../controllers/materias-controller.php";

use App\Controllers\MateriasController;

$materiasController = new MateriasController();
$materias = $materiasController->getMaterias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
    <link rel="stylesheet" href="../public/css/modals.css">
</head>
<body>
    <h2>Lista de materias</h2>
    <br>
    <section class="">
        <div class="">
            <img class="icono" src="" alt="imagen" />
            <div class="id">Nueva materia</div>
            <div class="name">
                <a href="materias-form.php">Crear materias</a>
            </div>
        </div>
        <?php
        foreach ($materias as $materia) {
            echo '<div class="">';
            echo '  <img class="icono" src="" alt="imagen" />';
            echo '  <div class="codigo">Código: ' . $materia->get('codigo') . '</div>';
            echo '  <div class="nombre">Nombre: ' . $materia->get('nombre') . '</div>';
            echo '  <div class="programa">Programa: ' . $materia->get('programa') . '</div>';
            echo '  <div class="btns">';
            echo '      <a href="materias-form.php?cod=' . urlencode($materia->get('codigo')) . '">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </a>';
            echo '      <button onclick="borrarMateria(\'' . addslashes($materia->get('codigo')) . '\')">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </button>';
            echo '  </div>';
            echo '</div>';
        }
        if (count($materias) == 0) {
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

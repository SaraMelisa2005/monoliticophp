<?php
require_once __DIR__ . "/../controllers/notas-controller.php";

use App\Controllers\NotasController;
use App\Models\Entities\Notas;

$notasController = new NotasController();
$notas = $notasController->getNotas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
    <link rel="stylesheet" href="../public/css/modals.css">
    <link rel="stylesheet" href="../public/css/notas.css">
</head>
<body>
    <h2>Módulo de notas</h2>
    <br>
    <section class="">
        <div class="">
            <img class="icono" src="../public/res/playlist.svg" alt="imagen" />
            <div class="id">Nueva nota</div>
            <div class="name">
                <a href="notas-form.php">Crear nota</a>
            </div>
        </div>
        <?php
        foreach ($notas as $nota) {
            echo '<div class="">';
            echo '  <img class="icono" src="../public/res/check.svg" alt="Nota" />';
            echo '  <div class="materia"><strong>Materia:</strong> ' . $nota->get('materia') . '</div>';
            echo '  <div class="estudiante"><strong>Estudiante:</strong> ' . $nota->get('estudiante') . '</div>';
            echo '  <div class="actividad"><strong>Actividad:</strong> ' . $nota->get('actividad') . '</div>';
            echo '  <div class="nota"><strong>Nota:</strong> ' . $nota->get('nota') . '</div>';
            echo '  <div class="btns">';
            echo '      <a href="notas-form.php?materia=' . urlencode($nota->get('materia')) . '&estudiante=' . urlencode($nota->get('estudiante')) . '">';
            echo '          <img class="icono" src="../public/res/edit.svg" alt="Editar"/>';
            echo '      </a>';
            echo '      <button onclick="borrarNota(\'' . addslashes($nota->get('materia')) . '\', \'' . addslashes($nota->get('estudiante')) . '\')">';
            echo '          <img class="icono" src="../public/res/delete.svg" alt="Eliminar"/>';
            echo '      </button>';
            echo '  </div>';
            echo '</div>';
        }
        if (count($notas) == 0) {
            echo '<div>No hay notas registradas</div>';
        }
        ?>
    </section>
    <div id="borrarModalNotas" class="modal">
        <div>
            <h3 class="titulo">Eliminar la Nota</h3>
            <p class="descripcion">¿Desea eliminar la Nota?</p>
            <form name="borrarNotasForm" action="operaciones/borrar-notas.php" method="post">
                <input type="hidden" name="materia" value="">
                <input type="hidden" name="estudiante" value="">
                <button type="submit">Continuar</button>
                <button type="reset">Cancelar</button>
            </form>
        </div>
    </div>
    <script src="../public/js/modal-users.js"></script>
</body>
</html>
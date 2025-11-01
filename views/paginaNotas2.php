<?php
require_once __DIR__ . "/../controllers/notas-controller.php";

use App\Controllers\NotasController;

$notasController = new NotasController();
$notas = $notasController->getNotas();
$promedios = $notasController->getPromedios();
$promediosMap = [];

foreach ($promedios as $p) {
    $key = $p['estudiante'] . '-' . $p['materia'];
    $promediosMap[$key] = $p['promedio'];
}

$notasPorEstudiante = [];
foreach ($notas as $nota) {
    $estudiante = $nota->get('nombreEstudiante') ?: 'Sin Estudiante Asignado';
    if (!isset($notasPorEstudiante[$estudiante])) {
        $notasPorEstudiante[$estudiante] = [];
    }
    $notasPorEstudiante[$estudiante][] = $nota;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
    <link rel="stylesheet" href="../public/css/diseno.css">
    <link rel="stylesheet" href="../public/css/modals.css">
</head>
<body>
    <h2>Lista de notas</h2>
    <br>
    <a href="paginaNotas.php">volver</a>
    <br>
    <a href="../index.php">inicio</a>
    <section>
        <div>
            <img class="icono" src="../public/res/playlist.svg" alt="imagen" />
            <div class="id">Nueva nota</div>
            <div class="name">
                <a href="notas-form.php">Crear nota</a>
            </div>
        </div>
        <?php
        if (count($notasPorEstudiante) > 0) {
            foreach ($notasPorEstudiante as $estudiante => $notasEstudiante) {
                echo '<h3>Estudiante: ' . $estudiante . '</h3>';
                foreach ($notasEstudiante as $nota) {
                    $key = $nota->get('estudiante') . '-' . $nota->get('materia');
                    $promedio = isset($promediosMap[$key]) ? $promediosMap[$key] : 0;
                    echo '<div>';
                    echo '  <img class="icono" src="../public/res/check.svg" alt="imagen" />';
                    echo '  <div class="materia">Materia: ' . $nota->get('nombreMateria') . '</div>';
                    echo '  <div class="estudiante">Estudiante: ' . $nota->get('nombreEstudiante') . '</div>';
                    echo '  <div class="actividad">Actividad: ' . $nota->get('actividad') . '</div>';
                    echo '  <div class="nota">Nota: ' . $nota->get('nota') . '</div>';
                    echo '  <div class="promedio">Promedio: ' . $promedio . '</div>';
                    echo '  <div class="btns">';
                    echo '      <a href="notas-form.php?materia=' . urlencode($nota->get('materia')) . '&estudiante=' . urlencode($nota->get('estudiante')) . '">';
                    echo '          <img class="icono" src="../public/res/edit.svg" alt="imagen"/>';
                    echo '      </a>';
                    echo '      <button onclick="borrarNota(\'' . addslashes($nota->get('materia')) . '\', \'' . addslashes($nota->get('estudiante')) . '\')">';
                    echo '          <img class="icono" src="../public/res/delete.svg" alt="imagen"/>';
                    echo '      </button>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
        } else {
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
<?php
require_once __DIR__ . "/../controllers/notas-controller.php";

use App\Controllers\NotasController;

$materia = empty($_GET['materia']) ? null : $_GET['materia'];
$estudiante = empty($_GET['estudiante']) ? null : $_GET['estudiante'];
$titulo = 'Registrar Notas';
$action = 'operaciones/crear-notas.php';
$actividad = '';
$nota = '';
if (!empty($materia) && !empty($estudiante)) {
    $titulo = 'Modificar Notas';
    $action = 'operaciones/editar-notas.php';
    // Precargar valores
    $notasController = new NotasController();
    $existingNota = $notasController->findNota($materia, $estudiante);
    $actividad = $existingNota ? $existingNota->get('actividad') : '';
    $nota = $existingNota ? $existingNota->get('nota') : '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <a href="paginaNotas.php">Volver</a>
    <br>
    <form action="<?php echo $action; ?>" method="post">
        <?php
        if (!empty($materia) && !empty($estudiante)) {
            echo '<input type="hidden" name="materia" value="' . htmlspecialchars($materia) . '">';
            echo '<input type="hidden" name="estudiante" value="' . htmlspecialchars($estudiante) . '">';
        }
        ?>
        <fieldset>
            <legend><?php echo $titulo; ?></legend>
            <div>
                <label for="materia">Materia</label>
                <?php if (!empty($materia)): ?>
                    <input type="text" name="materia_display" id="materia" value="<?php echo htmlspecialchars($materia); ?>" readonly>
                <?php else: ?>
                    <input type="text" name="materia" id="materia" required>
                <?php endif; ?>
            </div>
            <div>
                <label for="estudiante">Estudiante</label>
                <?php if (!empty($estudiante)): ?>
                    <input type="text" name="estudiante_display" id="estudiante" value="<?php echo htmlspecialchars($estudiante); ?>" readonly>
                <?php else: ?>
                    <input type="text" name="estudiante" id="estudiante" required>
                <?php endif; ?>
            </div>
            <div>
                <label for="actividad">Actividad</label>
                <?php if (!empty($materia) && !empty($estudiante)): ?>
                    <input type="text" name="actividad_display" id="actividad" value="<?php echo htmlspecialchars($actividad); ?>" readonly>
                <?php else: ?>
                    <input type="text" name="actividad" id="actividad" required>
                <?php endif; ?>
            </div>
            <div>
                <label for="nota">Nota</label>
                <input type="number" name="nota" id="nota" min="0" max="5" step="0.01" value="<?php echo htmlspecialchars($nota); ?>" required>
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
<?php
require_once __DIR__ . "/../controllers/notas-controller.php";

use App\Controllers\NotasController;

$notasController = new NotasController();
$materias = $notasController->getMaterias();

$notasController = new NotasController();
$estudiantes = $notasController->getEstudiantes();

$materia = empty($_GET['materia']) ? null : $_GET['materia'];
$estudiante = empty($_GET['estudiante']) ? null : $_GET['estudiante'];
$titulo = 'Registrar Notas';
$action = 'operaciones/crear-notas.php';
$actividad = '';
$notas = '';
if (!empty($materia) && !empty($estudiante)) {
    $titulo = 'Modificar Notas';
    $action = 'operaciones/editar-notas.php';

    $notasController = new NotasController();
    $existingNota = $notasController->findNota($materia, $estudiante);
    $actividad = $existingNota ? $existingNota->get('actividad') : '';
    $notas = $existingNota ? $existingNota->get('nota') : '';
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
                <select name="materia" id="materia" required>
                    <option value="">Selecciona una materia</option>
                    <?php foreach ($materias as $materia): ?>
                        <option value="<?php echo htmlspecialchars($materia['codigo']); ?>" 
                        <?php echo (isset($nota) && $nota->get('materia') == $materia['codigo']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($materia['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="estudiante">Estudiante</label>
                <select name="estudiante" id="estudiante" required>
                    <option value="">Selecciona un estudiante</option>
                    <?php foreach ($estudiantes as $estudiante): ?>
                        <option value="<?php echo htmlspecialchars($estudiante['codigo']); ?>" 
                        <?php echo (isset($nota) && $nota->get('estudiante') == $estudiante['codigo']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($estudiante['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="actividad">Actividad</label>
                <?php if (!empty($materia) && !empty($estudiante)): ?>
                    <input type="text" name="actividad_display" id="actividad"
                        value="<?php echo htmlspecialchars($actividad); ?>" readonly>
                <?php else: ?>
                    <input type="text" name="actividad" id="actividad" required>
                <?php endif; ?>
            </div>
            <div>
                <label for="nota">Nota</label>
                <input type="number" name="nota" id="nota" min="0" max="5" step="0.01"
                    value="<?php echo htmlspecialchars($nota); ?>" required>
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>
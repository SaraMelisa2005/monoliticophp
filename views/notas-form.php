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
$existingNota = null;
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
    <link rel="stylesheet" href="../public/css/forms.css">
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
                <?php if (!empty($materia) && !empty($estudiante) && $existingNota): ?>
                    <span>
                        <?php
                        foreach ($materias as $mat) {
                            if ($mat['codigo'] === $existingNota->get('materia')) {
                                echo htmlspecialchars($mat['nombre']);
                                break;
                            }
                        }
                        ?>
                    </span>
                <?php else: ?>
                    <select name="materia" id="materia" required>
                        <option value="">Selecciona una materia</option>
                        <?php foreach ($materias as $mat): ?>
                            <option value="<?php echo htmlspecialchars($mat['codigo']); ?>" 
                            <?php echo (isset($existingNota) && $existingNota->get('materia') == $mat['codigo']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($mat['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
            <div>
                <label for="estudiante">Estudiante</label>
                <?php if (!empty($materia) && !empty($estudiante) && $existingNota): ?>
                    <span>
                        <?php
                        foreach ($estudiantes as $est) {
                            if ($est['codigo'] === $existingNota->get('estudiante')) {
                                echo htmlspecialchars($est['nombre']);
                                break;
                            }
                        }
                        ?>
                    </span>
                <?php else: ?>
                    <select name="estudiante" id="estudiante" required>
                        <option value="">Selecciona un estudiante</option>
                        <?php foreach ($estudiantes as $est): ?>
                            <option value="<?php echo htmlspecialchars($est['codigo']); ?>" 
                            <?php echo (isset($existingNota) && $existingNota->get('estudiante') == $est['codigo']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($est['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
            <div>
                <label for="actividad">Actividad</label>
                <?php if (!empty($materia) && !empty($estudiante)): ?>
                    <input type="text" name="actividad" id="actividad"
                        value="<?php echo htmlspecialchars($actividad); ?>" readonly>
                <?php else: ?>
                    <input type="text" name="actividad" id="actividad" required>
                <?php endif; ?>
            </div>
            <div>
                <label for="nota">Nota</label>
                <input type="number" name="nota" id="nota" min="0" max="5" step="0.01"
                    value="<?php echo htmlspecialchars($notas); ?>" required>
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
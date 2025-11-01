<?php
require __DIR__ . "/../controllers/materias-controller.php";

use App\Controllers\MateriasController;

$materiasiasController = new MateriasController();
$programas = $materiasiasController->getProgramas();

$codigo = empty($_GET['cod']) ? null : $_GET['cod'];
$titulo = 'Registrar Materias';
$action = 'operaciones/crear-materias.php';
if (!empty($codigo)) {
    $titulo = 'Modificar Materias';
    $action = 'operaciones/editar-materias.php';
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
    <a href="paginaMaterias.php">Volver</a>
    <br>
    <form action="<?php echo $action; ?>" method="post">
        <?php
        if (!empty($codigo)) {
            echo '<input type="hidden" name="codigo" value="' . htmlspecialchars($codigo) . '">';
        }
        ?>
        <fieldset>
            <legend><?php echo $titulo; ?></legend>
            <div>
                <label for="codigo">Código de la materia</label>
                <?php if (!empty($codigo)): ?>
                    <input type="number" name="codigo_display" id="codigo" value="<?php echo htmlspecialchars($codigo); ?>" readonly>
                <?php else: ?>
                    <input type="number" name="codigo" id="codigo" max="9999" required>
                <?php endif; ?>
            </div>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div>
                <label for="programa">Programa</label>
                <select name="programa" id="programa" required>
                    <option value="">Selecciona un programa</option>
                    <?php foreach ($programas as $programa): ?>
                        <option value="<?php echo htmlspecialchars($programa['codigo']); ?>" 
                        <?php echo (isset($estudiante) && $materia->get('programa') == $programa['codigo']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($programa['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
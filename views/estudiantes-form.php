<?php
require __DIR__ . "/../controllers/estudiantes-controller.php";
use App\Controllers\EstudiantesController;
$estudiantesController = new EstudiantesController();
$programas = $estudiantesController->getProgramas();

$codigo = empty($_GET['cod']) ? null : $_GET['cod'];
$titulo = 'Registrar estudiante';
$action = 'operaciones/crear-estudiantes.php';
if (!empty($codigo)) {
    $titulo = 'Modificar estudiante';
    $action = 'operaciones/editar-estudiantes.php';
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
    <a href="paginaEstudiantes.php">Volver</a>
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
                <label for="codigo">Código del estudiante</label>
                <?php if (!empty($codigo)): ?>
                    <input type="text" name="codigo_display" id="codigo" value="<?php echo htmlspecialchars($codigo); ?>"
                        readonly>
                <?php else: ?>
                    <input type="text" name="codigo" id="codigo">
                <?php endif; ?>
            </div>
            <div>
                <label for="nombre">Nombre del estudiante</label>
                <input type="text" name="nombre" id="nombre">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="programa">Programa</label>
                <select name="programa" id="programa" required>
                    <option value="">Selecciona un programa</option>
                    <?php foreach ($programas as $programa): ?>
                        <option value="<?php echo htmlspecialchars($programa['codigo']); ?>" 
                        <?php echo (isset($estudiante) && $estudiante->get('programa') == $programa['codigo']) ? 'selected' : ''; ?>>
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
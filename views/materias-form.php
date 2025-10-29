<?php
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
                    <input type="text" name="codigo_display" id="codigo" value="<?php echo htmlspecialchars($codigo); ?>" readonly>
                <?php else: ?>
                    <input type="text" name="codigo" id="codigo">
                <?php endif; ?>
            </div>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre">
            </div>
            <div>
                <label for="programa">Programa</label>
                <input type="text" name="programa" id="programa">
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
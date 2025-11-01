<?php
$codigo = empty($_GET['cod']) ? null : $_GET['cod'];
$titulo = 'Registrar programas';
$action = 'operaciones/crear-programas.php';
if (!empty($codigo)) {
    $titulo = 'Modificar programas';
    $action = 'operaciones/editar-programas.php';
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
    <a href="paginaProgramas.php">Volver</a>
    <link rel="stylesheet" href="../public/css/forms.css">
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
                <label for="codigo">Código del Programa</label>
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
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
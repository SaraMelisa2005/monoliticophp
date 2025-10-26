<?php
$codigo = empty($_GET['cod']) ? null : $_GET['cod'];
$titulo = 'Registar Materias';
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
            echo '<input type="hidden" name="codigo" value="' . $codigo . '">';
        }
        ?>
        <fieldset>
            <legend><?php echo $titulo; ?></legend>
            <div>
                <label for="materias">Codigo de la materia</label>
                <input type="text" name="codigo" id="codigo">
            </div>
            <div>
                <label for="">nombre</label>
                <input type="text" name="nombre" id="nombre">
            </div>
            
            <div>
                <label for="">programa</label>
                <input type="text" name="programa" id="programa">
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>
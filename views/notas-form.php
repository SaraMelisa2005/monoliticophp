<?php
$materia = empty($_GET['cod']) ? null : $_GET['cod'];
$estudiante = empty($_GET['cod']) ? null : $_GET['cod'];
$titulo = 'Registar Notas';
$action = 'operaciones/crear-notas.php';
if (!empty($materia) && !empty($estudiante)) {
    $titulo = 'Modificar Notas';
    $action = 'operaciones/editar-notas.php';
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
            echo '<input type="hidden" name="codigo" value="' . $materia . '">';
            echo '<input type="hidden" name="codigo" value="' . $estudiante . '">';
        }
        ?>
        <fieldset>
            <legend><?php echo $titulo; ?></legend>
            <div>
                <label for="notas">Materia</label>
                <input type="text" name="materia" id="materia">
            </div>
            <div>
                <label for="">Estudiante</label>
                <input type="text" name="estudiante" id="estudiante">
            </div>
            <div>
                <label for="">Actividad</label>
                <input type="text" name="actividad" id="actividad">
            </div>
            
            <div>
                <label for="">Nota</label>
                <input type="number" name="nota" id="nota">
            </div>
        </fieldset>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>
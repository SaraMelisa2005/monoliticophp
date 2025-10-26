<?php
require __DIR__ ."/../../controllers/estudiantes-controller.php";


use App\Controllers\EstudiantesController;

$estudiantesController = new EstudiantesController();


$isSaved = $estudiantesController->updateEstudiantes($_POST);
if ($isSaved) {
    header("Location: ../paginaEstudiantes.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiantes</title>
</head>
<body>
    <h1>Error al editar</h1>
    <p>Se presentó un error al guardar los datos</p>
    <a href="../paginaEstudiantes.php">Volver</a>
</body>
</html>
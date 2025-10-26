<?php

require __DIR__ ."/../../controllers/estudiantes-controller.php";


use App\Controllers\EstudiantesController;
use App\Models\Entities\Estudiantes;

$estudiantesController = new EstudiantesController();

$isSaved = $estudiantesController->saveNewEstudiantes($_POST);
echo $isSaved;
if ($isSaved) {
    header("Location: ../paginaEstudiantes.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear estudiante</title>
</head>
<body>
    <h1>Error al crear</h1>
    <p>Se presentó un error al guardar los datos</p>
    <a href="../estudiantes-form.php">Volver</a>
</body>
</html>
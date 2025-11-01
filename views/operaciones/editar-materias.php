<?php
require __DIR__ ."/../../controllers/materias-controller.php";


use App\Controllers\MateriasController;
use App\Models\Entities\Materias;

$materiasController = new MateriasController();

$isSaved = $materiasController->updateMaterias($_POST);
if ($isSaved) {
    header("Location: ../paginaMaterias.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia</title>
    
</head>
<body>
    <h1>Error al editar</h1>
    <p>Se presentó un error al guardar los datos</p>
    <a href="../paginaMaterias.php">Volver</a>
</body>
</html>
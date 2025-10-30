<?php
require __DIR__ ."/../../controllers/programas-controller.php";

use App\Controllers\ProgramasController;

$programasController = new ProgramasController();
$isSaved = $programasController->updateProgramas($_POST);
if ($isSaved) {
    header("Location: ../paginaProgramas.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar programas</title>
</head>
<body>
    <h1>Error al editar</h1>
    <p>Se presentó un error al guardar los datos</p>
    <a href="../paginaProgramas.php">Volver</a>
</body>
</html>
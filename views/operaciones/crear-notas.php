<?php

require __DIR__ ."/../../controllers/notas-controller.php";


use App\Controllers\NotasController;
use App\Models\Entities\Notas;

$notasController = new NotasController();

$isSaved = $notasController->saveNewNotas($_POST);
echo $isSaved;
if ($isSaved) {
    header("Location: ../paginaNotas.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear notas</title>
</head>
<body>
    <h1>Error al crear</h1>
    <p>Se presentó un error al guardar los datos</p>
    <a href="../notas-form.php">Volver</a>
</body>
</html>
<?php
require __DIR__ . "/../../controllers/materias-controller.php";
use App\Controllers\MateriasController;

$materiasController = new MateriasController();
$isDeleted = $materiasController->deleteMaterias($_POST);
if ($isDeleted) {
    header("Location: ../paginaMaterias.php");
    exit;
} else {
    
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error al Eliminar Materia</title>
    </head>
    <body>
        <h1>Error al Eliminar</h1>
        <p>No se pudo eliminar la materia. Verifica que no tenga notas registradas o estudiantes relacionados.</p>
        <a href="../paginaMaterias.php">Volver a la Lista de Materias</a>
    </body>
    </html>
    <?php
}
?>
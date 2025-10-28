<?php
require_once __DIR__ . "/../../controllers/estudiantes-controller.php";

use App\Controllers\EstudiantesController;

$estudiantesController = new EstudiantesController();
$isDeleted = $estudiantesController->deleteEstudiantes($_POST);
if ($isDeleted) {
    header("Location: ../paginaEstudiantes.php");
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error al Eliminar Estudiante</title>
    </head>
    <body>
        <h1>Error al Eliminar</h1>
        <p>No se pudo eliminar el estudiante. Verifica que no tenga notas registradas.</p>
        <a href="../paginaEstudiantes.php">Volver a la Lista de Estudiantes</a>
    </body>
    </html>
    <?php
}
?>
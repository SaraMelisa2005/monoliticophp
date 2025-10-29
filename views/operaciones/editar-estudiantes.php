<?php
require_once __DIR__ . "/../../controllers/estudiantes-controller.php";

use App\Controllers\EstudiantesController;

$estudiantesController = new EstudiantesController();
$isSaved = $estudiantesController->updateEstudiantes($_POST);
if ($isSaved) {
    header("Location: ../paginaEstudiantes.php");
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error al Editar Estudiante</title>
    </head>
    <body>
        <h1>Error al Editar</h1>
        <p>No se pudo modificar el estudiante. Verifica que no tenga notas registradas.</p>
        <a href="../paginaEstudiantes.php">Volver</a>
    </body>
    </html>
    <?php
}
?>
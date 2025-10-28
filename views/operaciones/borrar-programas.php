<?php
require __DIR__ . "/../../controllers/programas-controller.php";

use App\Controllers\ProgramasController;

$programasController = new ProgramasController();
$isDeleted = $programasController->deleteProgramas($_POST);
if ($isDeleted) {
    header("Location: ../paginaProgramas.php");
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error al Eliminar Programa</title>
    </head>
    <body>
        <h1>Error al Eliminar</h1>
        <p>No se pudo eliminar el programa. Verifica que no tenga estudiantes o materias relacionados.</p>
        <a href="../paginaProgramas.php">Volver a la Lista de Programas</a>
    </body>
    </html>
    <?php
}
?>
<?php

require __DIR__ . "/../../controllers/notas-controller.php";

use App\Controllers\NotasController;

$notasController = new NotasController();

$isDeleted = $notasController->deleteNotas($_POST);

if ($isDeleted) {
    header("Location: ../paginaNotas.php");
    exit;  
} else {
    
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error al Eliminar Nota</title>
    </head>
    <body>
        <h1>Error al Eliminar</h1>
        <p>No se pudo eliminar la nota. Verifica que exista o intenta de nuevo.</p>
        <a href="../paginaNotas.php">Volver a la Lista de Notas</a>
    </body>
    </html>
    <?php
}
?>
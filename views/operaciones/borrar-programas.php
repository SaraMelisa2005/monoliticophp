<?php
require __DIR__ . "/../../controllers/estudiantes-controller.php";
use App\Controllers\ProgramasController;

$programasController = new ProgramasController();
$isDeleted = $programasController->deleteProgramas($_POST);
if ($isDeleted) {
    header("Location: ../paginaProgrmas.php");
    exit;
} else {
    echo "<h1>Error</h1><p>No se puede eliminar (tiene materias registradas o estudiantes relacionados).</p><a href='../paginaProgrmas.php'>Volver</a>";
}
?>
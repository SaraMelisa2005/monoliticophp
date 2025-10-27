<?php
require __DIR__ . "/../../controllers/materias-controller.php";
use App\Controllers\MateriasController;

$materiasController = new MateriasController();
$isDeleted = $materiasController->deleteMaterias($_POST);
if ($isDeleted) {
    header("Location: ../paginaMaterias.php");
    exit;
} else {
    echo "<h1>Error</h1><p>No se puede eliminar (tiene notas registradas o estudiantes relacionados).</p><a href='../paginaMaterias.php'>Volver</a>";
}
?>
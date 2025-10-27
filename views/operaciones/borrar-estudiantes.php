<?php
require __DIR__ . "/../../controllers/estudiantes-controller.php";
use App\Controllers\EstudiantesController;

$estudiantesController = new EstudiantesController();
$isDeleted = $estudiantesController->deleteEstudiantes($_POST);
if ($isDeleted) {
    header("Location: ../paginaEstudiantes.php");
    exit;
} else {
    echo "<h1>Error</h1><p>No se puede eliminar (tiene notas registradas).</p><a href='../paginaEstudiantes.php'>Volver</a>";
}
?>
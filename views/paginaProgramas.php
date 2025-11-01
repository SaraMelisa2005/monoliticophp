<?php
require __DIR__ . "/../controllers/programas-controller.php";

use App\Controllers\ProgramasController;

$programasController = new ProgramasController();
$programas = $programasController->getProgramas();

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
if (!empty($busqueda)) {
    $programas = array_filter($programas, function ($programa) use ($busqueda) {
        $codigo = strtolower($programa->get('codigo'));
        $nombre = strtolower($programa->get('nombre'));
        $busquedaLower = strtolower($busqueda);
        return strpos($codigo, $busquedaLower) !== false || strpos($nombre, $busquedaLower) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas</title>
    <link rel="stylesheet" href="../public/css/diseno.css">
    <link rel="stylesheet" href="../public/css/modals.css">
</head>

<body>
    <h2>Lista de programas</h2>
    <br>
    <a href="../index.php">Volver</a>
    <br>
    <form method="get" action="">
        <label for="busqueda">Buscar por código o nombre:</label>
        <input type="text" name="busqueda" id="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>"
            placeholder="Ingrese término de búsqueda">
        <button type="submit">Buscar</button>
        <?php if (!empty($busqueda)): ?>
            <a href="paginaProgramas.php">Limpiar búsqueda</a>
        <?php endif; ?>
    </form>
    <br>
    <section>
        <div>
            <img class="icono" src="../public/res/school.svg" alt="imagen" />
            <div class="id">Nuevo Programa</div>
            <div class="name">
                <a href="programas-form.php">Crear programa</a>
            </div>
        </div>
        <?php
        foreach ($programas as $programa) {
            echo '<div>';
            echo '  <img class="icono" src="../public/res/history_edu.svg" alt="imagen" />';
            echo '  <div class="codigo">Código: ' . $programa->get('codigo') . '</div>';
            echo '  <div class="nombre">Nombre: ' . $programa->get('nombre') . '</div>';
            echo '  <div class="btns">';
            echo '      <a href="programas-form.php?cod=' . urlencode($programa->get('codigo')) . '">';
            echo '          <img class="icono" src="../public/res/edit.svg" alt="imagen"/>';
            echo '      </a>';
            echo '      <button onclick="borrarPrograma(\'' . addslashes($programa->get('codigo')) . '\')">';
            echo '          <img class="icono" src="../public/res/delete.svg" alt="imagen"/>';
            echo '      </button>';
            echo '  </div>';
            echo '</div>';
        }
        if (count($programas) == 0) {
            echo '<div>No hay programas registrados</div>';
        }
        ?>
    </section>
    <div id="borrarModalProgramas" class="modal">
        <div>
            <h3 class="titulo">Eliminar el Programa</h3>
            <p class="descripcion">¿Desea eliminar el Programa?</p>
            <form name="borrarProgramasForm" action="operaciones/borrar-programas.php" method="post">
                <input type="hidden" name="codigo" value="">
                <button type="submit">Continuar</button>
                <button type="reset">Cancelar</button>
            </form>
        </div>
    </div>
    <script src="../public/js/modal-users.js"></script>
</body>

</html>
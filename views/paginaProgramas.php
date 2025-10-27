<?php

require __DIR__ . "/../controllers/programas-controller.php";



use App\Controllers\ProgramasController;
use App\Models\Entities\Programas;



$programasController = new ProgramasController();
$programas = $programasController->getProgramas();



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas</title>
   
</head>

<body>    
    <h2>Lista de programas</h2>
    <br>
    
    <section class="">
        <div class="">
            <img class="icono" src="" alt="imagen" />

            <div class="id">nuevo Programa</div>
            <div class="name">
                <a href="programas-form.php">Crear programa</a>
            </div>
        </div>
        <?php
        foreach ($programas as $programa) {
            echo '<div class="">';
            echo '  <img class="icono" src="" alt="imagen" />';
            echo '  <div class="codigo">codigo: ' . $programa->get('codigo') . '</div>';
            echo '  <div class="nombre">Nombre: ' . $programa->get('nombre') . '</div>' ;
           
            
            echo '  <div class="btns">';
            echo '      <a href="programas-form.php?cod=' . $programa->get('codigo') . '">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </a>';
            echo '      <button onclick="borrar(' . $programa->get('codigo') . ')">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </button>';
            echo '  </div>';
            echo '</div>';
        }
        if (count($programas) == 0) {
            echo '<div>No hay programas regitrados</div>';
        }
        ?>

        
    </section>
       <div id="borrarModalProgramas" class="modal">
    <h3 class="titulo">Eliminar la nota</h3>
    <p class="descripcion">¿Desea eliminar el programa?</p>
    <form name="borrarProgramasForm" action="operaciones/borrar-programas.php" method="post">
       
       
        <input type="hidden" name="codigo" value="">
        <button type="submit">Continuar</button>
        <button type="reset">Cancelar</button>
    </form>
</div>

    
    <script src="../public/js/modal-users.js"></script>
</body>

</html>
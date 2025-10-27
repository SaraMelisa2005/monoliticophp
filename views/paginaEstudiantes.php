<?php

require __DIR__ . "/../controllers/estudiantes-controller.php";



use App\Controllers\EstudiantesController;
use App\Models\Entities\Estudiantes;



$estudiantesController = new EstudiantesController();
$estudiantes = $estudiantesController->getEstudiantes();



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
   
</head>

<body>    
    <h2>Lista de Estudiantes</h2>
    <br>
    
    <section class="">
        <div class="">
            <img class="icono" src="" alt="imagen" />

            <div class="id">nuevo Estudiante</div>
            <div class="name">
                <a href="estudiantes-form.php">Crear estudiante</a>
            </div>
        </div>
        <?php
        foreach ($estudiantes as $estudiante) {
            echo '<div class="">';
            echo '  <img class="icono" src="" alt="imagen" />';
            echo '  <div class="codigo">codigo: ' . $estudiante->get('codigo') . '</div>';
            echo '  <div class="nombre">Nombre: ' . $estudiante->get('nombre') . '</div>' ;
            echo '  <div class="email">Email: ' . $estudiante->get('email') . '</div>' ;
            echo '  <div class="programa">Programa: ' . $estudiante->get('programa') . '</div>' ;

            echo '  <div class="btns">';
            echo '      <a href="estudiantes-form.php?cod=' . $estudiante->get('codigo') . '">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </a>';
            echo '      <button onclick="borrar(' . $estudiante->get('codigo') . ')">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </button>';
            echo '  </div>';
            echo '</div>';
        }
        if (count($estudiantes) == 0) {
            echo '<div>No hay estudiantes regitrados</div>';
        }
        ?>

        
    </section>
       <div id="borrarModalEstudiantes" class="modal">
    <h3 class="titulo">Eliminar el estidiante</h3>
    <p class="descripcion">¿Desea eliminar al estudiante?</p>
    <form name="borrarEstudiantesForm" action="operaciones/borrar-estudiantes.php" method="post">
       
        <input type="hidden" name="codigo" value="">
        
        <button type="submit">Continuar</button>
        <button type="reset">Cancelar</button>
    </form>
</div>


    <script src="../public/js/modal-users.js"></script>
</body>

</html>
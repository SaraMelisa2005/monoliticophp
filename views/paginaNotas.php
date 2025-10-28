<?php

require __DIR__ . "/../controllers/notas-controller.php";

use App\Controllers\NotasController;


$notasController = new NotasController();
$notas = $notasController->getNotas();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
   
    <link rel="stylesheet" href="../public/css/modals.css">
</head>

<body>    
    <h2>Lista de notas</h2>
    <br>
    
    <section class="">
        <div class="">
            <img class="icono" src="" alt="imagen" />
            
            <div class="id">nueva nota</div>
            <div class="name">
                <a href="notas-form.php">Crear nota</a>
            </div>
        </div>
        <?php
        foreach ($notas as $nota) {
            echo '<div class="">';
            echo '  <img class="icono" src="" alt="imagen" />';
            echo '  <div class="materia">Materia: ' . $nota->get('materia') . '</div>';
            echo '  <div class="estudiante">Estudiante: ' . $nota->get('estudiante') . '</div>' ;
            echo '  <div class="actividad">Actividad: ' . $nota->get('actividad') . '</div>' ;
            echo '  <div class="nota">Nota: ' . $nota->get('nota') . '</div>' ;
            echo '  <div class="btns">';
           
            echo '      <a href="notas-form.php?materia=' . urlencode($nota->get('materia')) . '&estudiante=' . urlencode($nota->get('estudiante')) . '">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </a>';
            
            echo '      <button onclick="borrarNota(\'' . addslashes($nota->get('materia')) . '\', \'' . addslashes($nota->get('estudiante')) . '\')">';
            echo '          <img class="icono" src="" alt="imagen"/>';
            echo '      </button>';
            echo '  </div>';
            echo '</div>';
        }
        if (count($notas) == 0) {
            echo '<div>No hay notas registradas</div>';
        }

        ?>

    </section>

    <div id="borrarModalNotas" class="modal">
        <div> 
            <h3 class="titulo">Eliminar la nota</h3>
            <p class="descripcion">¿Desea eliminar la nota?</p>
            <form name="borrarNotasForm" action="operaciones/borrar-notas.php" method="post">
                <input type="hidden" name="materia" value="">
                <input type="hidden" name="estudiante" value="">
                <button type="submit">Continuar</button>
                <button type="reset">Cancelar</button>
            </form>
        </div>
    </div>

    
    <script src="../public/js/modal-users.js"></script>
</body>

</html>
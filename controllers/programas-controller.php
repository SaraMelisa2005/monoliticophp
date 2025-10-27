<?php

namespace App\Controllers;

require __DIR__ . "/../models/entities/programas.php";


use App\Models\Entities\Programas;
use App\Models\Entities\Estudiantes;
use App\Models\Entities\Materias;


class ProgramasController
{

    
    public function getProgramas()
    {
        $programas = new Programas();
        return $programas->all();
    }

    public function saveNewProgramas($request)
    {
        if (empty($request['codigo']) || empty($request['nombre'])) {
            return false;
        }
        $programas = new Programas();
        $programas->set('codigo', $request['codigo']);
        $programas->set('nombre', $request['nombre']);
        return $programas->save();
    }

    public function updateProgramas($request)
    {

        if (empty($request['codigo']) || empty($request['nombre'])) {
            return false;
        }
        $programas = new Programas();
        $existingPrograma = $programas->find($request['codigo']); 
        if (!$existingPrograma) {
            return false;  
        }
        
        $existingPrograma->set('nombre', $request['nombre']);
        return $existingPrograma->update();
    }
    public function deleteProgramas($request)
{
    if (empty($request['codigo'])) {
        return false;
    }
    
    $estudiantes = new Estudiantes();
    $estudiantesPrograma = $estudiantes->all();
    foreach ($estudiantesPrograma as $est) {
        if ($est->get('programa') === $request['codigo']) {
            return false;
        }
    }
    $materias = new Materias();
    $materiasPrograma = $materias->all();
    foreach ($materiasPrograma as $mat) {
        if ($mat->get('programa') === $request['codigo']) {
            return false;
        }
    }
    $programas = new Programas();
    $programas->set('codigo', $request['codigo']);
    return $programas->delete();
}

   
}
<?php

namespace App\Controllers;

require __DIR__ . "/../models/entities/programas.php";


use App\Models\Entities\Programas;

class ProgramasController
{
    public function getProgramas()
    {
        $programas = new Programas();
        return $programas->all();
    }

    public function saveNewProgramas($request)
    {
        if (empty(trim($request['codigo'] ?? '')) || empty(trim($request['nombre'] ?? ''))) {
            return false;
        }
        
        $programas = new Programas();
        $programas->set('codigo', $request['codigo']);
        $programas->set('nombre', $request['nombre']);
        return $programas->save();
    }

    public function updateProgramas($request)
    {

        if (empty(trim($request['codigo'] ?? '')) || empty(trim($request['nombre'] ?? ''))) {
            return false;
        }

        $programas = new Programas();
        $existingPrograma = $programas->find($request['codigo']); 
        if (!$existingPrograma) {
            return false;  
        }

        $programas = new Programas();
        if ($programas->tieneRelaciones($request['codigo'])) {
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
        
        $programas = new Programas();
        if ($programas->tieneRelaciones($request['codigo'])) {
            return false;
        }

        $programas = new Programas();
        $programas->set('codigo', $request['codigo']);
        return $programas->delete();
    }
}
<?php

namespace App\Controllers;

require __DIR__ . "/../models/entities/programas.php";


use App\Models\Entities\programas;

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
        if (
              empty($request['codigo'])
            || empty($request['nombre'])
            
        ) {
            return false;
        }
        $programas = new Programas();
        $programas->set('codigo', $request['codigo']);
        $programas->set('nombre', $request['nombre']);
        return $programas->update();
    }

    public function deleteProgramas($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }
        $programas = new Programas();
        $programas->set('codigo', $request['codigo']);
        return $programas->delete();
    }
}
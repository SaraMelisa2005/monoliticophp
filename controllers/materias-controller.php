<?php

namespace App\Controllers;

require __DIR__ . "/../models/entities/materias.php";


use App\Models\Entities\Materias;

class MateriasController
{

   

    public function getMaterias()
    {
        $materia = new Materias();
        return $materia->all();
    }

    public function saveNewMaterias($request)
    {
        if (empty($request['codigo']) || empty($request['nombre']) || empty($request['programa'])) {
            return false;
        }
        $materias = new Materias();
        $materias->set('codigo', $request['codigo']);
        $materias->set('nombre', $request['nombre']);
        $materias->set('programa', $request['programa']);
        return $materias->save();
    }

    public function updateMaterias($request)
    {
        
        if (empty($request['codigo']) || empty($request['nombre']) || empty($request['programa'])) {
            return false;
        }
        $materias = new Materias();
        $existingMateria = $materias->find($request['codigo']);
        if (!$existingMateria) {
            return false;
        }
       
        $existingMateria->set('nombre', $request['nombre']);
        $existingMateria->set('programa', $request['programa']);
        return $existingMateria->update();
    }

    public function deleteMaterias($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }
        $materias = new Materias();
        $materias->set('codigo', $request['codigo']);
        return $materias->delete();
    }
}
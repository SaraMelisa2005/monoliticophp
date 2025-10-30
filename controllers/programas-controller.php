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
        
        $existingPrograma->set('nombre', $request['nombre']);
        return $existingPrograma->update();
    }
     public function deleteProgramas($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }
        
        if ($this->tieneRelaciones($request['codigo'])) {
            return false;
        }
        $programas = new Programas();
        $programas->set('codigo', $request['codigo']);
        return $programas->delete();
    }
    private function tieneRelaciones($codigo)
    {
        $sqlEstudiantes = "SELECT COUNT(*) as count FROM estudiantes WHERE programa = ?";
        $db = new \App\Models\Databases\Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sqlEstudiantes, "s", $codigo);
        if ($result && $result->fetch_assoc()['count'] > 0) {
            return true;
        }
        $sqlMaterias = "SELECT COUNT(*) as count FROM materias WHERE programa = ?";
        $result = $db->execSQL($sqlMaterias, "s", $codigo);
        if ($result && $result->fetch_assoc()['count'] > 0) {
            return true;
        }
        return false;
    }

   
}
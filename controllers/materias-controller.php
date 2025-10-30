<?php
namespace App\Controllers;

require_once __DIR__ . "/../models/entities/materias.php";

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
        if (empty(trim($request['codigo'] ?? '')) || empty(trim($request['nombre'] ?? '')) || 
        empty(trim($request['programa'] ?? ''))) {
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
        if (empty(trim($request['codigo'] ?? '')) || empty(trim($request['nombre'] ?? '')) || 
        empty(trim($request['programa'] ?? ''))) {
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
        if ($this->tieneRelaciones($request['codigo'])) {
            return false;
        }
        $materias = new Materias();
        $materias->set('codigo', $request['codigo']);
        return $materias->delete();
    }

    private function tieneRelaciones($codigo)
    {
        $sqlNotas = "SELECT COUNT(*) as count FROM notas WHERE materia = ?";
        $db = new \App\Models\Databases\Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sqlNotas, "s", $codigo);
        if ($result && $result->fetch_assoc()['count'] > 0) {
            return true;
        }
        return false;
    }

    public function getProgramas()
    {
        $materias = new Materias();
        return $materias->getProgramas();
    }
}
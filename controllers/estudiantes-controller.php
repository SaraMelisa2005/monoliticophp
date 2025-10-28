<?php
namespace App\Controllers;

require __DIR__ . "/../models/entities/estudiantes.php";

use App\Models\Entities\Estudiantes;
use App\Models\Entities\Notas;

class EstudiantesController
{
    public function getEstudiantes()
    {
        
        $estudiantes = new Estudiantes();
        return $estudiantes->all();
    }

    public function saveNewEstudiantes($request)
    {
        
        if (empty($request['codigo']) || empty($request['nombre']) || empty($request['email']) || empty($request['programa'])) {
            return false;
        }
        $estudiantes = new Estudiantes();
        $estudiantes->set('codigo', $request['codigo']);
        $estudiantes->set('nombre', $request['nombre']);
        $estudiantes->set('email', $request['email']);
        $estudiantes->set('programa', $request['programa']);
        return $estudiantes->save();
    }

    public function updateEstudiantes($request)
    {
        
        if (empty($request['codigo']) || empty($request['nombre']) || empty($request['email']) || empty($request['programa'])) {
            return false;
        }

        $estudiantes = new Estudiantes();
        $existingEstudiante = $estudiantes->find($request['codigo']);

        if (!$existingEstudiante) {
            return false;
        }

      
        $existingEstudiante->set('nombre', $request['nombre']);
        $existingEstudiante->set('email', $request['email']);
        $existingEstudiante->set('programa', $request['programa']);
        return $existingEstudiante->update();
    }
    public function deleteEstudiantes($request)
    {
        if (empty($request['codigo'])) {
            return false;
        }
        // Validación: No borrar si tiene notas
        if ($this->tieneRelaciones($request['codigo'])) {
            return false;
        }
        $estudiantes = new Estudiantes();
        $estudiantes->set('codigo', $request['codigo']);
        return $estudiantes->delete();
    }
    private function tieneRelaciones($codigo)
    {
        $sqlNotas = "SELECT COUNT(*) as count FROM notas WHERE estudiante = ?";
        $db = new \App\Models\Databases\Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sqlNotas, "s", $codigo);
        if ($result && $result->fetch_assoc()['count'] > 0) {
            return true;
        }
        return false;
    }
}
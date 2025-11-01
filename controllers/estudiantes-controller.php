<?php
namespace App\Controllers;

require_once __DIR__ . "/../models/entities/estudiantes.php";

use App\Models\Entities\Estudiantes;

class EstudiantesController
{
    public function getEstudiantes()
    {
        $estudiantes = new Estudiantes();
        return $estudiantes->all();
    }

    public function saveNewEstudiantes($request)
    {
        if (empty(trim($request['codigo'] ?? '')) || empty(trim($request['nombre'] ?? '')) || 
        empty(trim($request['email'] ?? '')) || empty(trim($request['programa'] ?? ''))) {
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
        if (empty(trim($request['codigo'] ?? '')) || empty(trim($request['nombre'] ?? '')) || 
        empty(trim($request['email'] ?? '')) || empty(trim($request['programa'] ?? ''))) {
            return false;
        }

        $estudiantes = new Estudiantes();
        if ($estudiantes->tieneRelaciones($request['codigo'])) {
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

        $estudiantes = new Estudiantes();
        if ($estudiantes->tieneRelaciones($request['codigo'])) {
            return false;
        }

        $estudiantes = new Estudiantes();
        $estudiantes->set('codigo', $request['codigo']);
        return $estudiantes->delete();
    }

    public function getProgramas()
    {
        $estudiantes = new Estudiantes();
        return $estudiantes->getProgramas();
    }
}
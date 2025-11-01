<?php
namespace App\Controllers;

require_once __DIR__ . "/../models/entities/notas.php";

use App\Models\Entities\Notas;

class NotasController
{
    public function getNotas()
    {
        $nota = new Notas();
        return $nota->all();
    }

    public function saveNewNotas($request)
    {
        if (
            empty(trim($request['materia'] ?? '')) || empty(trim($request['estudiante'] ?? '')) ||
            empty(trim($request['actividad'] ?? '')) || !isset($request['nota'])
        ) {
            return false;
        }
        $notaVal = floatval($request['nota']);
        if ($notaVal < 0 || $notaVal > 5) {
            return false;
        }

        $notas = new Notas();
        if (!$notas->materiaTienePrograma($request['materia'])) {
            return false;
        }
        
        $notas->set('materia', $request['materia']);
        $notas->set('estudiante', $request['estudiante']);
        $notas->set('actividad', $request['actividad']);
        $notas->set('nota', $notaVal);
        return $notas->save();
    }

    public function updateNotas($request)
    {
        if (
            empty(trim($request['materia'] ?? '')) || empty(trim($request['estudiante'] ?? '')) ||
            empty(trim($request['actividad'] ?? '')) || !isset($request['nota'])
        ) {
            return false;
        }
        $notaVal = floatval($request['nota']);
        if ($notaVal < 0 || $notaVal > 5) {
            return false;
        }

        $notas = new Notas();
        $existingNota = $notas->find($request['materia'], $request['estudiante']); 

        if (!$existingNota) {
            return false;
        }

        $existingNota->set('nota', $notaVal);
        return $existingNota->update();
    }

    public function deleteNotas($request)
    {
        if (empty($request['materia']) || empty($request['estudiante'])) {
            return false;
        }
        $notas = new Notas();
        $notas->set('materia', $request['materia']);
        $notas->set('estudiante', $request['estudiante']);
        return $notas->delete();
    }

    public function findNota($materia, $estudiante)
    {
        $notas = new Notas();
        return $notas->find($materia, $estudiante);
    }

    public function getMaterias()
    {
        $notas = new Notas();
        return $notas->getMaterias();
    }

    public function getEstudiantes()
    {
        $notas = new Notas();
        return $notas->getEstudiantes();
    }

    public function getPromedios()
    {
        $notas = new Notas();
        return $notas->getPromedios();
    }
}
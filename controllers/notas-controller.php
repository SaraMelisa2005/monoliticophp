<?php

namespace App\Controllers;

require __DIR__ . "/../models/entities/notas.php";


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
        if (empty($request['materia']) || empty($request['estudiante']) || empty($request['actividad']) || empty($request['nota'])) {
            return false;
        }
        $notas = new Notas();
        $notas->set('materia', $request['materia']);
        $notas->set('estudiante', $request['estudiante']);
        $notas->set('actividad', $request['actividad']);
        $notas->set('nota', $request['nota']);
        return $notas->save();
    }

    public function updateNotas($request)
    {
        if (
              empty($request['materia'])
            || empty($request['estudiante'])
            || empty($request['actividad'])
            || empty($request['nota'])
        ) {
            return false;
        }
        $notas = new Notas();
        $notas->set('materia', $request['materia']);
        $notas->set('estudiante', $request['estudiante']);
        $notas->set('actividad', $request['actividad']);
        $notas->set('nota', $request['nota']);
        return $notas->update();
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
}
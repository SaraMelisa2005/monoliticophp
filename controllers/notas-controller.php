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
        if (empty($request['materia']) || empty($request['estudiante']) || empty($request['actividad']) || !isset($request['nota'])) {
            return false;
        }
        $notaVal = floatval($request['nota']);
        if ($notaVal < 0 || $notaVal > 5) {
            return false;
        }
        $notas = new Notas();
        $notas->set('materia', $request['materia']);
        $notas->set('estudiante', $request['estudiante']);
        $notas->set('actividad', $request['actividad']);
        $notas->set('nota', $notaVal);
        return $notas->save();
    }

    public function updateNotas($request)
    {
        if (empty($request['materia']) || empty($request['estudiante']) || !isset($request['nota'])) {
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

        $existingNota->set('not a', $notaVal);
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
        $existingNota = $notas->find($request['materia'], $request['estudiante']);
        if (!$existingNota) {
            return false;
        }
        $result = $notas->delete();
        if ($result) {
        $this->recalcularPromedio($request['estudiante'], $request['materia']);
        }
        return $result;
    }
    private function recalcularPromedio($estudiante, $materia)
    {
        $notas = new Notas();
        $notasRestantes = $notas->findByEstudianteMateria($estudiante, $materia); // Necesitas este método en Notas
        $promedio = count($notasRestantes) > 0 
            ? round(array_sum(array_map(fn($n) => $n->get('nota'), $notasRestantes)) / count($notasRestantes), 2)
            : 0.0;
        
        
    }
}
?>
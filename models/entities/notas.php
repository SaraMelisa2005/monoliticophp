<?php
namespace App\Models\Entities;

require __DIR__ . '/../utils/model.php';
require __DIR__ . '/../utils/notas-sql.php';
require __DIR__ . '/../database/databasemonoliticos.php';

use App\Models\Utils\Model;
use App\Models\Utils\NotasSQL;
use App\Models\Databases\Databasemonoliticos;

class Notas extends Model
{
    private $materia;
    private $estudiante;
    private $actividad;
    private $nota;

    public function set($prop, $val)
    {
        if ($prop === 'nota') {
            $val = floatval($val);
            if ($val < 0 || $val > 5) {
                throw new \Exception("La nota debe estar entre 0 y 5.");
            }
            $val = round($val, 2);
        }
        $this->{$prop} = $val;
    }
    public function get($prop)
    {
        return $this->{$prop};
    }

    public function all()
    {
        $sql = NotasSQL::selectAll();
        $db = new Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sql);
        
        if (!$result) {
            return [];
        }
        
        $rows = [];
        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                $nota = new Notas();
                $nota->set('materia', $item['materia']);
                $nota->set('estudiante', $item['estudiante']);
                $nota->set('actividad', $item['actividad']);
                $nota->set('nota', $item['nota']);
                array_push($rows, $nota);
            }
        }
        return $rows;
    }

    public function save()
    {
        $sql = NotasSQL::insertInto();
        $db = new Databasemonoliticos();
        $result = $db->execSQL($sql, "sssd", $this->materia, $this->estudiante, $this->actividad, $this->nota);
        return $result;
    }

    public function update()
    {
        $sql = NotasSQL::update();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "dss",
            $this->nota,
            $this->materia,
            $this->estudiante
        );
        return $result;
    }

    public function delete()
    {
        $sql = NotasSQL::delete();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "ss",
            $this->materia,
            $this->estudiante
        );
        return $result;
    }

    public function find($materia, $estudiante)
    {
        $sql = NotasSQL::selectByMateriaEstudiante();
        $db = new Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sql, "ss", $materia, $estudiante);
        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            $nota = new Notas();
            $nota->set('materia', $item['materia']);
            $nota->set('estudiante', $item['estudiante']);
            $nota->set('actividad', $item['actividad']);
            $nota->set('nota', $item['nota']);
            return $nota;
        }
        return null;
    }
}
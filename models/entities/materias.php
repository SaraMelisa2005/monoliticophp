<?php

namespace App\Models\Entities;

require __DIR__ . '/../utils/model.php';
require __DIR__ . '/../utils/materias-sql.php';
require __DIR__ . '/../database/databasemonoliticos.php';

use App\Models\Utils\MateriasSQL;
use App\Models\Utils\Model;
use App\Models\Databases\Databasemonoliticos;


class Materias extends Model
{
    private $codigo;
    private $nombre;
     private $programa;

    public function set($prop, $val)
    {
        $this->{$prop} = $val;
    }
    public function get($prop)
    {
        return $this->{$prop};
    }

    public function all()
    {
        $sql = MateriasSQL::selectAll();
        $db = new Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sql);
        $rows = [];
        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                $materia = new Materias();
                $materia->set('codigo', $item['codigo']);
                $materia->set('nombre', $item['nombre']);
                $materia->set('programa', $item['programa']);
                array_push($rows, $materia);
            }
        }
        return $rows;
    }

    public function save()
    {
        $sql = MateriasSQL::insertInto();
        $db = new Databasemonoliticos();
        $result = $db->execSQL($sql, "ss", $this->codigo, $this->nombre, $this->programa);
        return $result;
    }

    public function update()
    {
        $sql = MateriasSQL::update();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "ssi",
            $this->codigo,
            $this->nombre,
            $this->programa
        );
        return $result;
    }

    public function delete()
    {
        $sql = MateriasSQL::delete();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "i",
            $this->codigo
        );
        return $result;
    }
   

}
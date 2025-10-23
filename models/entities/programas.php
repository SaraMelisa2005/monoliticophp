<?php

namespace App\Models\Entities;

require __DIR__ . '/../utils/model.php';
require __DIR__ . '/../utils/programas-sql.php';
require __DIR__ . '/../database/databasemonoliticos.php';

use App\Models\Utils\Model;
use App\Models\Utils\ProgramasSQL;
use App\Models\Databases\Databasemonoliticos;


class programas extends Model
{
    private $codigo;
    private $nombre;
    

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
        $sql = ProgramasSQL::selectAll();
        $db = new Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sql);
        $rows = [];
        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                $programa = new Programas();
                $programa->set('codigo', $item['codigo']);
                $programa->set('nombre', $item['nombre']);

                array_push($rows, $programa);
            }
        }
        return $rows;
    }

    public function save()
    {
        $sql = ProgramasSQL::insertInto();
        $db = new Databasemonoliticos();
        $result = $db->execSQL($sql, "ss", $this->codigo, $this->nombre);
        return $result;
    }

    public function update()
    {
        $sql = ProgramasSQL::update();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "ssi",
            $this->codigo,
            $this->nombre
        );
        return $result;
    }

    public function delete()
    {
        $sql = ProgramasSQL::delete();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "i",
            $this->codigo,
             $this->nombre
        );
        return $result;
    }
    public function find()
    {
        
    }
}
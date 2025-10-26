<?php

namespace App\Models\Entities;

require __DIR__ . '/../utils/model.php';
require __DIR__ . '/../utils/estudiantes-sql.php';
require __DIR__ . '/../database/databasemonoliticos.php';

use App\Models\Utils\Model;
use App\Models\Utils\EstudiantesSQL;
use App\Models\Databases\Databasemonoliticos;


class Estudiantes extends Model
{
    private $codigo;
    private $nombre;
    private $email;
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
        $sql = EstudiantesSQL::selectAll();
        $db = new Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sql);
        $rows = [];
        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                $estudiante = new Estudiantes();
                $estudiante->set('codigo', $item['codigo']);
                $estudiante->set('nombre', $item['nombre']);
                $estudiante->set('email', $item['email']);
                $estudiante->set('programa', $item['programa']);
                array_push($rows, $estudiante);
            }
        }
        return $rows;
    }

    public function save()
    {
        $sql = EstudiantesSQL::insertInto();
        $db = new Databasemonoliticos();
        $result = $db->execSQL($sql, "ss", $this->codigo, $this->nombre, $this->email, $this->programa);
        return $result;
    }

    public function update()
    {
        $sql = EstudiantesSQL::update();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "ssi",
            $this->codigo,
            $this->nombre,
            $this->email,
            $this->programa
        );
        return $result;
    }

    public function delete()
    {
        $sql = EstudiantesSQL::delete();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "i",
            $this->codigo
        );
        return $result;
    }
    public function find()
    {
        
    }

}
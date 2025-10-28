<?php

namespace App\Models\Entities;

require __DIR__ . '/../utils/model.php';
require __DIR__ . '/../utils/programas-sql.php';
require __DIR__ . '/../database/databasemonoliticos.php';

use App\Models\Utils\Model;
use App\Models\Utils\ProgramasSQL;
use App\Models\Databases\Databasemonoliticos;


class Programas extends Model
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
            "ss",
             $this->nombre,
            $this->codigo
           
        );
        return $result;
    }
    

    public function delete()
    {
        $sql = ProgramasSQL::delete();
        $db = new Databasemonoliticos();
        $result = $db->execSQL(
            $sql,
            "s",
            $this->codigo,
            
        );
        return $result;
    }

        // NUEVO: Implementa find() para buscar por codigo
    public function find($codigo)
    {
        $sql = ProgramasSQL::selectByCodigo();  // Necesitas agregar este método en ProgramasSQL
        $db = new Databasemonoliticos();
        $db->setIsSqlSelect(true);
        $result = $db->execSQL($sql, "s", $codigo);
        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            $programa = new Programas();
            $programa->set('codigo', $item['codigo']);
            $programa->set('nombre', $item['nombre']);
            return $programa;
        }
        return null;  
    }
    
}
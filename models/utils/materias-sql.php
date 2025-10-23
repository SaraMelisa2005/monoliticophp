<?php
namespace App\Models\Utils;
class MateriasSQL
{

    public static function selectAll()
    {
        return "select * from materias";
    }


    public static function insertInto()
    {
        return "insert into materias (codigo,nombre,programa)values(?,?,?)";
    }

    public static function update()
    {
        $sql = "update materias set ";
        $sql .= "nombre=?,";
        $sql .= "programa=? where codigo=?";

        return $sql;
    }

    public static function delete(){
        return "delete from materias where codigo=?";
    }
}

?>
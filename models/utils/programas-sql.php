<?php
namespace App\Models\Utils;
class ProgramasSQL
{

    public static function selectAll()
    {
        return "select * from programas";
    }


    public static function insertInto()
    {
        return "insert into programas (codigo, nombre)values(?,?)";
    }

    public static function update()
    {
        $sql = "update programas set ";
        $sql .= "nombre=? where codigo=?";
        
        return $sql;
    }

    public static function delete(){
        return "delete from programas where codigo=?";
    }
}

?>
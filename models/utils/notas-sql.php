<?php
namespace App\Models\Utils;
class NotasSQL
{

    public static function selectAll()
    {
        return "select * from notas";
    }


    public static function insertInto()
    {
        return "insert into notas (materia, estudiante, actividad ,nota)values(?,?,?,?)";
    }

    public static function update()
    {
        $sql = "update notas set ";
        $sql .= "nota=? where materia=?,estudiante=?";
        return $sql;
    }

    public static function delete(){
        return "delete from notas where materia=?,estudiante=?";
    }
}

?>
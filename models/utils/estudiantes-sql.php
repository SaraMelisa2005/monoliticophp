<?php
namespace App\Models\Utils;
class EstudiantesSQL
{

    public static function selectAll()
    {
        return "select * from estudiantes";
    }


    public static function insertInto()
    {
        return "insert into estudiantes (codigo, nombre, email, programa)values(?,?,?,?)";
    }

    public static function update()
    {
        $sql = "update estudiantes set ";
         $sql .= "nombre=?,";
         $sql .= "email=?,";
         $sql .= "programa=?,";
        $sql .= "descripcion=? where codigo=?";
        return $sql;
    }

    public static function delete(){
        return "delete from estudiantes where codigo=?";
    }
}

?>
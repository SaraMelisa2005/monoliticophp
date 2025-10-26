<?php
namespace App\Models\Utils;
class ProgramasSQL
{

    public static function selectAll()
    {
        return "select * from programas";
    }
    
    public static function selectByCodigo()
    {
        return "select * from programas where codigo = ?";
    }


    public static function insertInto()
    {
        return "insert into programas (codigo, nombre)values(?,?)";
    }


        public static function update()
    {
        return "update programas set nombre = ? where codigo = ?";
    }

    public static function delete(){
        return "delete from programas where codigo=?";
    }
}

?>

<?php
namespace App\Models\Utils;
class MateriasSQL
{
    public static function selectAll()
    {
        // return "select * from materias";
        return "select materias.*, programas.nombre as nombrePrograma from materias inner join programas on materias.programa = programas.codigo";
    }

    public static function insertInto()
    {
        return "insert into materias (codigo, nombre, programa) values (?, ?, ?)";
    }

    public static function update()
    {
        return "update materias set nombre = ?, programa = ? where codigo = ?";
    }

    public static function delete()
    {
        return "delete from materias where codigo = ?";
    }

    public static function selectByCodigo()
    {
        return "select * from materias where codigo = ?";
    }

    public static function selectProgramas()
    {
        return "select codigo, nombre from programas order by nombre";
    }
}
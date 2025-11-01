<?php
namespace App\Models\utils;
class EstudiantesSQL
{

    public static function selectAll()
    {
        // return "select * from estudiantes";
        return "select estudiantes.*, programas.nombre as nombrePrograma from estudiantes inner join programas on estudiantes.programa = programas.codigo";
    }

    public static function insertInto()
    {
        return "insert into estudiantes (codigo, nombre, email, programa)values(?,?,?,?)";
    }

    public static function update()
    {
        return "update estudiantes set nombre = ?, email = ?, programa = ? where codigo = ?";
    }

    public static function delete()
    {
        return "delete from estudiantes where codigo=?";
    }

    public static function selectByCodigo()
    {
        return "select estudiantes.*, programas.nombre as nombrePrograma from estudiantes inner join programas on estudiantes.programa = programas.codigo where estudiantes.codigo = ?";
    }
    public static function selectProgramas()
    {
        return "select codigo, nombre from programas order by nombre";
    }

    public static function selectCountNotasByEstudiante()
    {
        return "SELECT COUNT(*) as count FROM notas WHERE estudiante = ?";
    }
}

?>
<?php
namespace App\Models\Utils;
class NotasSQL
{
    public static function selectAll()
    {
        return "select * from notas";
    }

    public static function selectByMateriaEstudiante()
    {
        return "select * from notas where materia = ? and estudiante = ?";
    }

    public static function insertInto()
    {
        return "insert into notas (materia, estudiante, actividad, nota) values (?, ?, ?, ?)";
    }

    public static function update()
    {
        return "update notas set nota = ? where materia = ? and estudiante = ?";
    }

    public static function delete()
    {
        return "delete from notas where materia = ? and estudiante = ?";
    }

        public static function selectMaterias()
    {
        return "select codigo, nombre from materias order by nombre";
    }
        public static function selectEstudiantes()
    {
        return "select codigo, nombre from estudiantes order by nombre";
    }
}


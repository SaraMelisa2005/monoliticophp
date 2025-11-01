<?php
namespace App\Models\Utils;
class NotasSQL
{
    public static function selectAll()
    {
        return "SELECT notas.*, materias.nombre AS nombreMateria, estudiantes.nombre 
        AS nombreEstudiante FROM notas INNER JOIN materias ON notas.materia = materias.codigo 
        INNER JOIN estudiantes ON notas.estudiante = estudiantes.codigo";
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
    public static function selectPromedios()
    {
        return "SELECT estudiante, materia, ROUND(AVG(nota), 2) as promedio FROM notas GROUP BY estudiante, 
        materia ORDER BY estudiante, materia";
    }
    public static function selectCountMateriaConPrograma()
    {
        return "SELECT COUNT(*) as count FROM materias WHERE codigo = ? AND programa IS NOT NULL AND programa != ''";
    }
}
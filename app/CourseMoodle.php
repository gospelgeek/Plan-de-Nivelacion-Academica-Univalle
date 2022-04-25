<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SessionCourse;
use DB;

class CourseMoodle extends Model
{
    protected $table = 'course_moodles';

    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'fullname',
        'course_id',
        'instance_id',
        'attendance_id',
        'group_id',
        'docente_id',
    ];

    public function sesiones()
    {
        return $this->hasMany(SessionCourse::class, 'attendance_id','attendance_id');
    }

    public static function asistencias($id_group,$id_moodle){

        $asistencias = DB::select("select course_moodles.fullname,COUNT(*) as Total FROM `course_moodles`,session_courses,attendance_students WHERE course_moodles.group_id = '".$id_group."' and session_courses.attendance_id = course_moodles.attendance_id and attendance_students.session_id = session_courses.session_id and attendance_students.grade = 'P' and attendance_students.id_moodle = '".$id_moodle."' GROUP BY course_moodles.fullname");

        if($asistencias != null){
            return $asistencias;
        }else{
            return null;
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\perfilEstudiante;
use App\CourseMoodle;
use App\SessionCourse;
use App\AttendanceStudent;
use App\Group;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth;
use Carbon\Carbon;

class AsistenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('socioeducativo');
    }

    public function ver_asistencias($id_moodle,$id_group){
        $cursos = CourseMoodle::all();
        /*$cursos->map(function($estudiante){
            $estudiante->sesiones;
            dd($estudiante);

        });*/
        
        $asistencias = AttendanceStudent::all()->where('id_moodle',225178);
        $sesiones = SessionCourse::select('attendance_id')->where('session_id', 40522)->first();
        $sesiones = SessionCourse::all()->where('attendance_id', $sesiones->attendance_id);
        dd($asistencias);
    }

    public function cargar_asistencias(Request $request){
        //dd($request,$request->file('sesiones'));
        $verificar_nombre = explode("_", $request->file('sesiones')->getClientOriginalName());
        if($verificar_nombre[0] == "sessionsbycoursereport"){
            $nombre = "sessionsbycoursereport.json";        
            if(Storage::disk('local')->exists($nombre)) {
                Storage::delete($nombre);
            }
            Storage::putFileAs('/', $request->file('sesiones'), $nombre);
            $sesiones =  json_decode(Storage::get($nombre));
            //dd($sesiones);
            $course_moodle = DB::table('course_moodles')->truncate();
            $session_course = DB::table('session_courses')->truncate();

            foreach($sesiones as $sesion){
                //dd($sesion);
                $shortname = explode("-",$sesion->shortname);
                //dd($shortname);
                $shortname[2];
                //dd($grupo);
                if($shortname[2] < 10)
                {
                    $shortname[2] = explode("0",$shortname[2]);
                    $grupo = "Grupo"." ".$shortname[2][1];
                }else{
                    $grupo = "Grupo"." ".$shortname[2];
                }
                switch($shortname[4]){
                    case "A0":
                        $shortname[4] = 1;
                        break;
                    case "TE":
                        $shortname[4] = 2;
                        break;
                    case "TS":
                        $shortname[4] = 3;
                        break;
                    default:
                    echo "NO SE ENCUENTRA LA COHORTE";            
                }
                //dd($shortname); 
                $grupos = Group::select('id')->where('name',$grupo)->where('id_cohort',$shortname[4])->first();
                //dd($grupos->id);
                $course_moodle = CourseMoodle::create([
                    'fullname'    =>   $sesion->fullname,
                    'course_id'   =>   $sesion->courseid,
                    'instance_id' =>   $sesion->instanceid,
                    'attendance_id' => $sesion->attendanceid,
                    'group_id'    =>   $grupos->id,
                ]);

                foreach($sesion->sessions as $course){
                    
                    //dd($date = date('d-m-Y H:i:s', $course->sesstimestamp));
                    $date = Carbon::today();
                    $sessdate = new Carbon();
                    $sessdate->setTimestamp($course->sesstimestamp);
                    //dd($date,$sessdate);
                    //dd($date->setTimestamp($course->sesstimestamp));
                    if($date > $sessdate){
                        $sesion_course = SessionCourse::create([
                        'attendance_id' => $sesion->attendanceid,
                        'session_id'    => $course->id,
                        'sessdate'      => $sessdate,
                        'lasttaken'     => $course->lasttaken,
                        'description'   => " ",
                        'type'          => " ",
                        ]);
                    }
                    
                    //dd($sesion->fullname);
                }           
            }
            return back()->with('status', "el archivo" . " " . $request->file('sesiones')->getClientOriginalName() . " " . "fue importado correctamente");
        }

        if($verificar_nombre[0] == "attendancereport"){
            $nombre = "attendancereport.json";        
            if(Storage::disk('local')->exists($nombre)) {
                Storage::delete($nombre);
                Storage::delete("asistencias_linea_1.json");
                Storage::delete("asistencias_linea_2.json");
                Storage::delete("asistencias_linea_3.json");
            }
            Storage::putFileAs('/', $request->file('sesiones'), $nombre);
            $attendances =  json_decode(Storage::get($nombre));   
            $attendance_student = DB::table('attendance_students')->truncate();
            
            foreach($attendances as $attendance){
            
                foreach($attendance->courses as $course){
                    //dd($course);
                    foreach($course->attendance->fullsessionslog as $sesion){
                        //dump($course, $attendance,$sesion);
                        $attendance_student = AttendanceStudent::create([
                            'id_moodle'     => $attendance->userid,
                            'session_id'    => $sesion->sessionid,
                            'grade'         => $sesion->statusacronym,
                            'notes'         => " ",
                        ]);  
                    }
                    /*$course_session = SessionCourse::where('attendance_id',$course->attendance->attendanceid)->get();
                    foreach($course_session as $sesionid){
                        //dd($sesionid);
                        $attendance_student = AttendanceStudent::where('session_id',$sesionid->session_id)->where('id_moodle',$attendance->userid)->exists();
                        //dd($attendance_student);
                        switch ($attendance_student) {
                            case true:
                                break;
                            case false:
                                $attendance_student = AttendanceStudent::create([
                                                        'id_moodle'     => $attendance->userid,
                                                        'session_id'    => $sesionid->session_id,
                                                        'grade'         => "I",
                                                        'notes'         => " ",
                                                    ]);
                                break;
                            default:
                            echo "i no es igual a 0, 1 ni 2";
                        }
                    }*/
                    //dd($course_session);
                }
                //dd("hecho");
            }
            return back()->with('status', "el archivo" . " " . $request->file('sesiones')->getClientOriginalName() . " " . "fue importado correctamente");
        }else{
            return back()->with('message-error', 'Por favor seleccione un archivo valido');
        }       
    }

}
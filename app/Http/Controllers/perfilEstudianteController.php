<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\perfilEstudiante;
use App\SocioeconomicData;
use App\AcademicDates;
use App\RecordsActionsUpdateDelete;
use App\User;
use App\Gender;
use App\DocumentType;
use App\BirthDepartament;
use App\BirthCity;
use App\Occupation;
use App\CivilStatus;
use App\RecidenceTime;
use App\HousingType;
use App\HealthRegime;
use App\Benefits;
use App\SocialConditions;
use App\Disability;
use App\Ethnicity;
use App\InstitutionType;
use App\Http\Requests\perfilEstudianteRequest;
use App\Http\Requests\DatosSocioeconomicosRequest;
use App\Http\Requests\DatosAcademicosRequest;
use App\Http\Controllers\Auth;
use Illuminate\Support\Carbon;


class perfilEstudianteController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('socioeducativo');
    }

    public function indexPerfilEstudiante(){
        
        $perfilEstudiantes = perfilEstudiante::all();
        //dd($perfilEstudiantes);
        return view('perfilEstudiante.index',compact('perfilEstudiantes'));
    }


    public function crearPerfilEstudiante(){
        $genero = Gender::pluck('name','id');
        $sexo = array('F' => 'Fenemino',
                            'M' => 'Masculino' );
        $tipo_documento = array('1' => 'Cedula de Ciudadania',
                                '2' => 'Tarjeta de Identidad',
                                '3' => 'Cedula Extranjera' );

        $depNacimiento = BirthDepartament::pluck('name','id');
        $muni_nacimiento = BirthCity::pluck('name','id');
        return view("perfilEstudiante.create",compact('genero','sexo','tipo_documento','depNacimiento','muni_nacimiento'), ['editarEstudiante' => new perfilEstudiante()]);
    }

    public function storePerfilEstudiante(perfilEstudianteRequest $request){

        $idPerfilEstudiantes = perfilEstudiante::create([
            'name'                      =>  $request['nombres'],
            'lastname'                  =>  $request['apellidos'],
            'id_document_type'          =>  $request['tipo_documento'],
            'document_number'           =>  $request['numero_documento'],
            'birth_date'                =>  $request['fecha_nacimiento'],
            'document_expedition_date'  =>  $request['departamento_nacimiento'],
            'id_birth_city'             =>  $request['ciudad_nacimiento'],
            'sex'                       =>  $request['sexo'],
            'id_gender'                 =>  $request['genero'],
            'barrio_residencia'         =>  $request['barrio_residencia'],
            'direction'                 =>  $request['direccion'],
            'email'                     =>  $request['email'],
            'cellphone'                 =>  $request['telefono1'],
            'phone'                     =>  $request['telefono2'],
        ]);
        
         return redirect('estudiante')->with('status', 'Perfil guardado exitosamente!');
         
      }

    public function verPerfilEstudiante($id){

        $verDatosPerfil = perfilEstudiante::findOrFail($id);
        //dd($verDatosPerfil);  
        $genero = Gender::pluck('name','id');
        $sexo = array('F' => 'Fenemino',
                            'M' => 'Masculino' );
        $tipo_documento = array('1' => 'Cedula de Ciudadania',
                                '2' => 'Tarjeta de Identidad',
                                '3' => 'Cedula Extranjera' );
        $documento = DocumentType::pluck('name','id');

        $edad = Carbon::parse($verDatosPerfil->birth_date)->age;

        //dd($verDatosPerfil->gender);
        return view('perfilEstudiante.verDatos', compact('verDatosPerfil','genero','sexo','tipo_documento','documento','edad'));   
    }

    public function verDatosSocieconomicos($id) {
        //dd($id_student);
        //$datos = SocioeconomicData::all()->where('id_student', $id_student); 
        $datos = perfilEstudiante::findOrFail($id);
        //dd($datos);

        return view('perfilEstudiante.datosSocioeconomicos', compact('datos'));
    }

    public function editarDatosSocioeconomicos($id) {

        $editarSocioeconomicos = perfilEstudiante::findOrFail($id);
       // dd($editarSocioeconomicos->socioeconomicdata->id);
        $ocupacion = Occupation::pluck('name', 'id');
        $estado_civil = CivilStatus::pluck('name', 'id');
        $tiempo_residencia = RecidenceTime::pluck('name', 'id');
        $tipo_vivienda = HousingType::pluck('name', 'id');
        $regimen_salud = HealthRegime::pluck('name', 'id');
        $categoria_sisben = array('A' => 'A',
                                  'B' => 'B',
                                  'C' => 'C',
                                  'NO' => 'NO');
        $beneficios = Benefits::pluck('name', 'id');
        $posicion_economica = array('dependiente' => 'Dependiente',
                                    'independiente' => 'Independiente');
        $internet_zona = array('1' => 'SI',
                               '2' => 'NO');
        $internet_hogar = array('1' => 'SI',
                                '2' => 'NO');
        $condicion_social = SocialConditions::pluck('name', 'id');
        $discapacidad = Disability::pluck('name', 'id');
        $etnia = Ethnicity::pluck('name', 'id');


        return view('perfilEstudiante.datosSocioeconomicos.editar', compact('editarSocioeconomicos', 'ocupacion', 'estado_civil', 'tiempo_residencia', 'tipo_vivienda', 'regimen_salud', 'beneficios', 'internet_zona', 'internet_hogar', 'condicion_social', 'discapacidad', 'etnia', 'posicion_economica', 'categoria_sisben'));

    }

    public function updateDatosSocioeconomicos (DatosSocioeconomicosRequest $request, $id){
       //dd($id);

        $data = SocioeconomicData::findOrFail($id);
        //dd($request);
        $data->update($request->validated());
        
        return redirect('estudiante')->with('status', 'Datos actualizados exitosamente!');
    }

    public function verDatosAcademicos($id){
        $datos = perfilEstudiante::findOrFail($id);

        return view('perfilEstudiante.verdatosAcademicos', compact('datos'));
    }

    public function editarDatosAcademicos($id) {
        //dd('entro al edit');

        $editarAcademicos = perfilEstudiante::findOrFail($id);
        //dd($editarAcademicos->academicdata->id);
        $tipo_institucion = InstitutionType::pluck('name', 'id');
        
        return view('perfilEstudiante.datosAcademicos.editar', compact('editarAcademicos', 'tipo_institucion'));

//dd('finalizo el edit');
    }

    public function updateDatosAcademicos(DatosAcademicosRequest $request, $id) {
        //dd('gsgsdgsd');
        $data = AcademicDates::findOrFail($id);
        //dd($data);
        $data->update($request->validated());

        return redirect('estudiante')->with('status', 'Datos actualizados exitosamente!');
    }

    public function editarPerfilEstudiante($id){
        
        $editarEstudiante = perfilEstudiante::findOrFail($id);

        //dd($editarEstudiante->gender);
        $genero = Gender::pluck('name','id');
        $sexo = array('F' => 'Fenemino',
                            'M' => 'Masculino' );
        $tipo_documento = array('1' => 'Cedula de Ciudadania',
                                '2' => 'Tarjeta de Identidad',
                                '3' => 'Cedula Extranjera' );

        $depNacimiento = BirthDepartament::pluck('name','id');
        $muni_nacimiento = BirthCity::pluck('name','id');

        //dd($muni_nacimiento);

        
        return view('perfilEstudiante.editar', compact('editarEstudiante','genero','sexo','tipo_documento','depNacimiento','muni_nacimiento'));
    }

    public function updatePerfilEstudiante(perfilEstudianteRequest $request, $id) {

        $depNacimiento = BirthDepartament::pluck('name','id');
        $muni_nacimiento = BirthCity::pluck('name','id');
        $data = perfilEstudiante::findOrFail($id);
        //dd($request);
        $data->update($request->validated());
    
        return redirect('estudiante')->with('status', 'Perfil actualizado exitosamente!');
    }


    public function eliminarPerfilEstudiante(Request $request, $id){

       
       //dd('hola');
       $data = perfilEstudiante::findOrFail($id);

       //$ip = User::getRealIP();
       $data -> delete();
       //$id = auth()->user();
       //dd($id);
            /*$datos = RecordsActionsUpdateDelete::create([
            'identificacion'           => $id['cedula'],
            'nombres'                  => $id['name'],
            'apellidos'                => $id['apellidos_user'],
            'email'                    => $id['email'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $data['id'],
            'nombres_usuario_accion'   => $data['nombres'],
            'apellidos_usuario_accion' => $data['apellidos'],
            'email_usuario_accion'     => $data['email'],
            'actividad_realizada'      => 'SE ELIMINO UN REGISTRO',
            ]); */

        return redirect('estudiante')->with('status', 'Perfil eliminado exitosamente!');
    }

    public function municipios(Request $request, $id)
    {
        $municipios = BirthCity::where('id_departament',$id)->get();
        //dd($municipios);
        if($request->ajax())
        {
         
          return response()->json($municipios);
        }
    }
}



















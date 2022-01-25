<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\UsuarioRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\perfilEstudiante;
use App\SocioeconomicData;
use App\PreviousAcademicData;
use App\LogsCrudActions;
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
use Carbon\Carbon;
Use Session;
Use Redirect;
use DB;

class UsuarioController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sistemas');
        
    }

    public function prueba(){

        dd('usuario Controller');
    }
    
    public function index(){

        $usuario = User::all();

        return view('usuario.index', compact('usuario'));
    }  

        public function crear(){
        $roles =  Role::pluck('nombre_rol','id');
        return view('usuario.crear', compact('roles'), ['editarUsuario' => new User()]);
    } 

    public function store (UsuarioRequest $request) {
        //dd('hola');
        $idUsuario = User::create([
            'name'                 => $request['name'],
            'apellidos_user'       => $request['apellidos_user'], 
            'tipo_documento_user'  => $request['tipo_documento_user'], 
            'cedula'               => $request['cedula'],
            'email'                => $request['email'],
            'rol_id'               => $request['rol_id'], 
            'password'             => bcrypt($request['password']),
        ]);

        return redirect('usuario')->with('status', 'Usuario guardado exitosamente!');
    }

    public function show($id) {
        $verUsuario = User::findOrFail($id);
        return view('usuario.verDatos', compact('verUsuario'));
    }

    public function editar($id){
        $roles =  Role::pluck('nombre_rol','id');
        $editarUsuario = User::findOrFail($id);
        
        return view('usuario.editar', compact('editarUsuario', 'roles'));
    }

    public function update(UsuarioRequest $request, $id) {
        
        $data = User::findOrFail($id);
        //dd($data);
        $data->update($request->validated());
        
        return redirect('usuario')->with('status', 'usuario actualizado exitosamente!');
    }

    public function delete (Request $request, $id){

        $data = User::findOrFail($id);
        $data -> delete();

        return redirect('usuario')->with('status', 'Estudiante eliminado exitosamente!');
    }



    public function indexPerfilEstudiante(){
        
        $perfilEstudiantes = perfilEstudiante::all();
        //dd($perfilEstudiantes);
        return view('usuario.perfilEstudiante.index',compact('perfilEstudiantes'));
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
        return view("usuario.perfilEstudiante.create",compact('genero','sexo','tipo_documento','depNacimiento','muni_nacimiento'), ['editarEstudiante' => new perfilEstudiante()]);
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

        $ip = User::getRealIP();
        $id = auth()->user();
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y h:i:s A');
       //dd($fecha);
            $datos = LogsCrudActions::create([
            'identificacion'           => $id['cedula'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $data['id'],
            'actividad_realizada'      => 'SE CREO UN REGISTRO',
            ]); 
        
         return redirect('estudiantes')->with('status', 'Perfil guardado exitosamente!');
         
      }

    public function verPerfilEstudiante($id){

        $verDatosPerfil = perfilEstudiante::findOrFail($id);
        //dd($verDatosPerfil);  
        $genero = Gender::pluck('name','id');
        $sexo = array('F' => 'Femenino',
                            'M' => 'Masculino' );
        if($verDatosPerfil->socioeconomicdata->sex_document_identidad == 'H'){
           $sexo1 = "Masculino";     
        }elseif($verDatosPerfil->socioeconomicdata->sex_document_identidad == 'M'){
            $sexo1 = "Femenino"; 
        }

        if($verDatosPerfil->socioeconomicdata->internet_home == 0){
            $internet_home = "SI";
        }elseif($verDatosPerfil->socioeconomicdata->internet_home == 1){
            $internet_home = "NO";

        }

        if($verDatosPerfil->socioeconomicdata->internet_zon == 0){
            $internet_zone = "SI";
        }elseif($verDatosPerfil->socioeconomicdata->internet_zon == 1){
            $internet_zone = "NO";

        }
        $tipo_documento = array('1' => 'Cedula de Ciudadania',
                                '2' => 'Tarjeta de Identidad',
                                '3' => 'Cedula Extranjera' );
        $documento = DocumentType::pluck('name','id');

        $edad = Carbon::parse($verDatosPerfil->birth_date)->age;

        //dd($verDatosPerfil->gender);

        $ip = User::getRealIP();
        $id = auth()->user();
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
       //dd($fecha);
            $datos = LogsCrudActions::create([
            'identificacion'           => $id['cedula'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $verDatosPerfil['id'],
            'actividad_realizada'      => 'ANALISIS DE REGISTRO',
            ]);


        return view('usuario.perfilEstudiante.verDatos', compact('verDatosPerfil','internet_zone','internet_home','genero','sexo','sexo1','tipo_documento','documento','edad'));   
    }

    public function verDatosSocieconomicos($id) {
        //dd($id_student);
        //$datos = SocioeconomicData::all()->where('id_student', $id_student); 
        $datos = perfilEstudiante::findOrFail($id);
        //dd($datos);

        return view('usuario.perfilEstudiante.datosSocioeconomicos', compact('datos'));
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


        return view('usuario.perfilEstudiante.datosSocioeconomicos.editar', compact('editarSocioeconomicos', 'ocupacion', 'estado_civil', 'tiempo_residencia', 'tipo_vivienda', 'regimen_salud', 'beneficios', 'internet_zona', 'internet_hogar', 'condicion_social', 'discapacidad', 'etnia', 'posicion_economica', 'categoria_sisben'));

    }

    public function updateDatosSocioeconomicos (DatosSocioeconomicosRequest $request, $id){
       //dd($id);

        $data = SocioeconomicData::findOrFail($id);
        //dd($request);
        $data->update($request->validated());

        $ip = User::getRealIP();
        $id = auth()->user();
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y h:i:s A');
       //dd($fecha);
            $datos = LogsCrudActions::create([
            'identificacion'           => $id['cedula'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $data['id'],
            'actividad_realizada'      => 'SE ACTUALIZO UN REGISTRO',
            ]); 
        
        return redirect('estudiantes')->with('status', 'Datos actualizados exitosamente!');
    }

    public function verDatosAcademicos($id){
        $datos = perfilEstudiante::findOrFail($id);

        return view('usuario.perfilEstudiante.verdatosAcademicos', compact('datos'));
    }

    public function editarDatosAcademicos($id) {
        //dd('entro al edit');

        $editarAcademicos = perfilEstudiante::findOrFail($id);
        //dd($editarAcademicos->academicdata->id);
        $tipo_institucion = InstitutionType::pluck('name', 'id');
        
        return view('usuario.perfilEstudiante.datosAcademicos.editar', compact('editarAcademicos', 'tipo_institucion'));

//dd('finalizo el edit');
    }

    public function updateDatosAcademicos(DatosAcademicosRequest $request, $id) {
        //dd('gsgsdgsd');
        $data = PreviousAcademicData::findOrFail($id);
        //dd($data);
        $data->update($request->validated());

        $ip = User::getRealIP();
        $id = auth()->user();
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y h:i:s A');
       //dd($fecha);
            $datos = LogsCrudActions::create([
            'identificacion'           => $id['cedula'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $data['id'],
            'actividad_realizada'      => 'SE ACTUALIZO UN REGISTRO',
            ]); 

        return redirect('estudiantes')->with('status', 'Datos actualizados exitosamente!');
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

        
        return view('usuario.perfilEstudiante.editar', compact('editarEstudiante','genero','sexo','tipo_documento','depNacimiento','muni_nacimiento'));
    }

    public function updatePerfilEstudiante(perfilEstudianteRequest $request, $id) {

        $depNacimiento = BirthDepartament::pluck('name','id');
        $muni_nacimiento = BirthCity::pluck('name','id');
        $data = perfilEstudiante::findOrFail($id);
        $dataViejo = perfilEstudiante::findOrFail($id);

        $data->update($request->validated());
    
        $ip = User::getRealIP();
        $id = auth()->user();
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y h:i:s A');
       //dd($fecha);
            $datos = LogsCrudActions::create([
            'identificacion'           => $id['cedula'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $data['id'],
            'actividad_realizada'      => 'SE ACTUALIZO UN REGISTRO',
            ]); 
        
       /* if(($data['name']) != ($dataViejo['name'])){

            //dd('name');
            /*$cambio = UpdateInformation::create([
            'id_action'           => $dataViejo['id'],
            'changed_information' => $dataViejo['name'],
            'new_information' => $data['name'],    
            ]);
        }
        if(($data['lastname']) != ($dataViejo['lastname'])){
            //dd('apellido');
            $cambio = UpdateInformation::create([
            'id_action'           => $dataViejo['id'],
            'changed_information' => $dataViejo['lastname'],
            'new_information' => $data['lastname'],    
            ]);
        }
        /*if(($data['id_document_type']) != ($dataViejo['id_document_type'])){
            dd('tipo');
            /*$cambio = UpdateInformation::create([
            'id_action'           => $dataViejo['id'],
            'changed_information' => $dataViejo['id_document_type'],
            'new_information' => $data['id_document_type'],    
            ]);
        }*/



        return redirect('estudiantes')->with('status', 'Perfil actualizado exitosamente!');
    }


    public function eliminarPerfilEstudiante(Request $request, $id){

       $data = perfilEstudiante::findOrFail($id);

       $ip = User::getRealIP();
       $id = auth()->user();
       $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y h:i:s A');
       //dd($fecha);
            $datos = LogsCrudActions::create([
            'identificacion'           => $id['cedula'],
            'rol'                      => $id['rol_id'],   
            'ip'                       => $ip,
            'id_usuario_accion'        => $data['id'],
            'actividad_realizada'      => 'SE ELIMINO UN REGISTRO',
            ]); 

            $data -> delete();

        return redirect('estudiantes')->with('status', 'Perfil eliminado exitosamente!');

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

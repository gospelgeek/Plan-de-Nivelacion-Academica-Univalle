@extends('layouts.app')
@section('title', 'Index')
@section('content')

    

<div class="container">

    <a class="btn btn-success btn-sm mt-3 mb-3 float-right" href="{{route('crear_estudiante')}}">Crear Perfil</a>
    
    <table class="table table-hover">
        <caption>Perfil Estudiantes</caption>
        <thead>
            <tr>
                <td>Nombres y apellidos<td>
                <td>Nº documento</td>
                <td>Fecha de nacimiento</td>
                <td>Ciudad Nacimiento</td>
                <td>Sexo</td>
                <td>Ciudad Residencia</td>
                <td>Direccion</td>
                <td>Email</td>
                <td>Telefono</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($perfilEstudiantes as $perfilEstudiante)
            <tr>

                <td>{{ $perfilEstudiante->name}} {{ $perfilEstudiante->lastname}}</td><td></td>
                <td>@if(isset($perfilEstudiante->documenttype)) {{ $perfilEstudiante->documenttype->name}} @endif</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>
                <td>{{ $perfilEstudiante->id_document_type}}</td>                
                <td>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group">
                            <a href="{{ route('ver_estudiante', $perfilEstudiante->id) }}" class="btn btn-primary">VER</a>    
                        </div>
                        <div class="col-xs-12 col-md-6 form-group">
                            <a href="{{ route('editar_estudiante', $perfilEstudiante->id) }}" class="btn btn-primary">EDT</a>    
                        </div>
                        <div class="col-xs-12 col-md-6 form-group">
                            <form method="POST" action="{{ route('delete_estudiante', $perfilEstudiante->id) }}">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">ELI</button>    
                            </form>    
                        </div>
                    </div>
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $perfilEstudiantes->links() }}
</div>



@endsection
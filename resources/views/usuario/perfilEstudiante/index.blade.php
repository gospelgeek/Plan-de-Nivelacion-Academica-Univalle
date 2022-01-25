@extends('layouts.dashboard')

@section('title', 'Perfil Estudiante')

@section('content')
<h1 style="text-align:center;">ESTUDIANTES</h1>
<div class="container-fluid">    
    
    <div class="card">  
        
        
    <div class="card-body">
        @if(auth()->user()->rol_id == 4 || auth()->user()->rol_id == 1) 
        <div class="row">
            <div  class="col-xs-12 col-md-3 col-sm-3">
                    <a class="btn btn-primary btn-sm mt-3 mb-3 float-left" href="{{route('usuario.crear_estudiante')}}">Crear Perfil</a>            
            </div>
        </div>
        @endif

    <div class="table-responsive">
     <table id="example1" class=" table table-bordered table-striped">
        <thead >
            <tr >
                <td>Nombres y apellidos</td>
                <td>Nº documento</td>
                <td>Fecha de nacimiento</td>
                <td>Sexo</td>
                <td>Email</td>
                <td>Telefono</td>
                <td>Grupo</td>
                <td>Cohorte</td>
                <td>Acciones</td>
            </tr>
        </thead> 

        <tbody>
            @foreach ($perfilEstudiantes as $estudiante)
                <tr data-id="{{$estudiante->id}}">
                    <td>{{ $estudiante->name}} {{ $estudiante->lastname}}</td>
                                        <td>{{ $estudiante->document_number}}</td>
                                        <td>{{ $estudiante->birth_date}}</td>
                                        <td>{{ $estudiante->sex}}</td>
                                        <td>{{ $estudiante->email}}</td>
                                        <td>{{ $estudiante->cellphone }}</td>
                                        <td></td>
                                        <td></td>
                                        <td >
                                        @if(auth()->user()->rol_id == 4 || auth()->user()->rol_id == 1)   
                                            <div class="row">                                  
                                                <div class="col-xs-4 col-sm-4">
                                                    <a title="Ver Informacion" href="{{ route('usuario.ver_estudiante', $estudiante->id) }}" class="btn btn-block btn-sm  fa fa-eye"></a>    
                                                </div>

                                                <div class="col-xs-4 col-sm-4">
                                                    <a title="Editar Informacion" href="{{ route('usuario.editar_estudiante', $estudiante->id) }}" class="btn btn-sm btn-block fa fa-pen"></a>    
                                                </div>
                                                @else
                                                <div class="col-xs-4 col-sm-4">
                                                    <a title="Ver Informacion" href="{{ route('usuario.ver_estudiante', $estudiante->id) }}" class="btn btn-block btn-sm  fa fa-eye"></a>    
                                                </div>
                                            </div>
                                           

                                            @csrf
                    </td>
                </tr>
                
                @endif
            @endforeach    
        </tbody>

      </table>
      </div>
    </div>
    </div>
</div>

@push('scripts')

    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron coincidencias",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate":{
                "next" : "Siguiente",
                "previous": "Anterior"
            }
        },
            });
        });        
    </script>

 
@endpush
@endsection
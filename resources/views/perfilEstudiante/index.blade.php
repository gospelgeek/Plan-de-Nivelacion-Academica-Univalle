@extends('layouts.dashboard')

@section('title', 'Perfil Estudiante')
@section('content')
@include('../alerts.success')
@include('../alerts.request')
{{--<div class="col-xs-12 col-md-8">
    <form method="POST" action="store/save/usuarios" accept-charset="UTF-8" enctype="multipart/form-data"> 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class=" col-xs-12 col-md-8">
                  {!!Form::label('archivo','Seleccione Archivo:')!!}                            
                  {!!Form::file('file',[ 'accept'=>'.xls,.xlsx','class'=>'form-control-file form-group','required'])!!}
                        
                        <button type="submit" class="btn btn-danger bg-lg form-group btn-block">Enviar</button>
                      </div>
    </form>
</div>         
                      
</div>--}}

<div class="container-fluid">
    <input type="hidden" id="roles" value="{{ auth()->user()->rol_id }}">    
    <h1 style="text-align:center;">ESTUDIANTES</h1>
    <div class="card">         
    <div class="card-body">
        @if(auth()->user()->rol_id == 4 || auth()->user()->rol_id == 1 || auth()->user()->rol_id == 5) 
        <div class="btn-group">
            {{--<div class="col-xs-6 col-md-5 col-sm-3">
                    <a class="btn btn-primary btn-sm mt-3 mb-3 float-left" href="{{route('crear_estudiante')}}">Crear Perfil</a>            
            </div>--}}
            <div class="col-xs-6 col-md-12 col-sm-6">


                <a class="btn btn-primary btn-sm mt-3 mb-3 float-left" href="{{route('sabana_export')}}">EXPORTAR S&Aacute;BANA</a>

            </div>
            <div class="filtroCohortes col-xs-6 col-md-12 col-sm-6">
                <label>LINEA 1</label>&nbsp;<input type="checkbox" name="check" value="LINEA 1" id="linea_1">&nbsp;&nbsp;&nbsp;&nbsp;
                <label>LINEA 2</label>&nbsp;<input type="checkbox" name="check" value="LINEA 2" id="linea_2">&nbsp;&nbsp;&nbsp;&nbsp;
                <label>LINEA 3</label>&nbsp;<input type="checkbox" name="check" value="LINEA 3" id="linea_3">&nbsp;&nbsp;&nbsp;&nbsp;
                
            </div>
            
        </div>
        <div class="inactivos_student">
            <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>SÓLO INACTIVOS</label>&nbsp;
            <input type="checkbox" name="filtro" value="ACTIVO" id="inactivos">
            
            </center>  
        </div>
        
        <div class="row justify-content-md-center">
                <col-sm>
                    <h5 class="mr-3 mt-2">DESCARGAR LISTADO DE GRUPOS DE:</h5>
                </col-sm>
                <div class="col-sm">
                    <a class="btn btn-primary btn-sm mr-3 mb-3 float-left" href="/listado_estudiantes_grupo/1">Linea 1</a>  
                     <a class="btn btn-primary btn-sm mr-3 mb-3 float-left" href="/listado_estudiantes_grupo/2">Linea 2</a>
                     <a class="btn btn-primary btn-sm mr-3 mb-3 float-left" href="/listado_estudiantes_grupo/3">Linea 3</a>
           
                </div>

         </div>
        
        @endif
        

    <div class="table-responsive">
    
     <table id="example1" class=" table table-bordered table-striped">
        
        <thead>

            <tr>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Tipo Documento</td>
                <td>Fecha expedicion documento</td>
                <td>Nº Documento</td>
                <td>Codigo</td>
                <td>Email</td>
                <td>Telefono</td>
                <td id="group">Grupo</td>
                <td>Cohorte</td>
                <td>Fecha nacimiento</td>
                <td>Edad</td>
                <td>Dpto. Nacimiento</td>
                <td>Ciudad Nacimiento</td>
                <td>Sexo</td>
                <td>Genero</td>
                <td>Direcion</td>
                <td>Comuna</td>
                <td>Barrio</td>
                <td>Tel. Alternativo</td>
                <td>Tutor</td>
                <td>Estado</td>
                <td>Estado Civil</td>
                <td>Etnia</td>
                <td>Institucion</td>
                <td id="botons" width="15%">Acciones</td>
            </tr>
        </thead>       
    </table>
      </div>
    </div>
    </div>
</div>

@push('scripts')

    <!-- Page specific script -->
<script>

/*$('input[type="checkbox"]').change(function (){
    var ver = $("input[name=filtro]:checked").val();
});*/
     
       

        var table = $("#example1").DataTable({
            
            "ajax":{
                "method":"GET",
                "url": "{{route('datos.estudiantes')}}",
            },

            "columns": [
                {data: 'name'},
                {data: 'lastname'},
                {data: 'tipodocumento', visible: false},
                {data: 'document_expedition_date', visible: false},
                {data: 'document_number'},
                {data: 'student_code'},
                {data: 'email'},
                {data: 'cellphone'},
                {data: 'namegrupo'},
                {data: 'cohorte'},
                {data: 'birth_date', visible: false},
                {data: 'edad', visible: false},
                {data: 'departamentoN', visible: false},
                {data: 'ciudadN', visible: false},
                {data: 'sex', visible: false},
                {data: 'genero', visible: false},
                {data: 'direction', visible: false},
                {data: 'comuna', visible:false},
                {data: 'barrio', visible: false},
                {data: 'phone', visible: false},
                {data: 'tutor', visible: false},
                {data: 'estado', visible: false},
                {data: 'nombreEstadocivil', visible: false},
                {data: 'nombreEtnia', visible: false},
                {data: 'colegio', visible: false},

                {data: null, render:function(data, type, row, meta){
                    var rol = document.getElementById('roles').value;
                    var mstr;
                    if(rol == 4 || rol == 1 || rol == 2 || rol == 6){
                        mstr = '<div class="btn-group">'+
                          '<div class="col-xs-6 col-sm-6 btn-group">'+
                            '<tr id="1">'+'<td">'+'<a href="ver_estudiante/'+data.id+'" class="ver btn btn-block fa fa-eye fa" title="Ver estudiante"></a>'+'</td>'+'</tr>'+
                          '</div>'+                                 
                          '<div class="col-xs-6 col-sm-6 btn-group">'+
                            '<a href="editar_estudiante/'+data.id+'" class="btn btn-block fa fa-pencil-square-o fa" title="Editar seguimiento"></a>'+
                          '</div>'+
                          
                        "</div>"; 
                    }else{
                        mstr = '<div class="btn-group">'+
                          '<div class="col-xs-6 col-sm-6 btn-group">'+
                            '<a href="ver_estudiante/'+data.id+'" class="btn btn-block fa fa-eye fa ver_seguimiento" title="Ver seguimiento"></a>'+
                          "</div>"+
                        "</div>";
                    }

                    return mstr;
                }
            }
                    
            ],

            "deferRender": true,"responsive": true, "lengthChange": false, "autoWidth": false,
            "dom":'Bfrtip',
            "buttons": [
                "copy",
                "csv",
                "excel", 
                "pdf",
                "print",
                "colvis"
                
            ]
        });
        document.getElementById('linea_1').checked = true;
        document.getElementById('linea_2').checked = true;
        document.getElementById('linea_3').checked = true;

        $('.filtroCohortes').on('change', function() {
           
            var checkLinea1 = $('#linea_1').is(":checked");
            var checkLinea2 = $('#linea_2').is(":checked");
            var checkLinea3 = $('#linea_3').is(":checked");


            if (!checkLinea1) {
                    if(checkLinea2 && checkLinea3){
                        //filtro por columna excepto el valor de del id del checbox indicado(linea_1)
                        var filtro = $('input:checkbox[id="linea_1"]').map(function() {
                            return this.value;
                        }).get().join('|');
                        table.column(9).search(filtro ? '^((?!' + filtro + ').*)$' : '', true, false, false).draw(false);
                        //
                    }else if (checkLinea2) {
                        //filtros basicos por columna con un solo valor
                        table.columns(9).search('LINEA 2'); 
                        //       
                    }else if (checkLinea3) {
                        table.columns(9).search('LINEA 3');
                    }
                    table.draw();
                        
                }

                if(!checkLinea2){
                    if(checkLinea1 && checkLinea3){
                        var filtro = $('input:checkbox[id="linea_2"]').map(function() {
                            return this.value;
                        }).get().join('|');
                        table.column(9).search(filtro ? '^((?!' + filtro + ').*)$' : '', true, false, false).draw(false);
                    }else if(checkLinea1){
                        table.columns(9).search('LINEA 1');
                    }else if(checkLinea3){
                        table.columns(9).search('LINEA 3');
                    }
                    table.draw();
                }


                if(!checkLinea3){
                    if(checkLinea1 && checkLinea2){
                        var filtro = $('input:checkbox[id="linea_3"]').map(function() {
                            return this.value;
                        }).get().join('|');
                        table.column(9).search(filtro ? '^((?!' + filtro + ').*)$' : '', true, false, false).draw(false);
                    }else if(checkLinea1){
                        table.columns(9).search('LINEA 1');
                    }else if(checkLinea2){
                        table.columns(9).search('LINEA 2');
                    }
                    table.draw();
                }

                if (checkLinea1 && checkLinea2 && checkLinea3) {
                    //filtro por columna con varios valores segun el name de los checbox y su valor correspondiente
                    var offices = $('input:checkbox[name="check"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    table.column(9).search(offices, true, false, false).draw(false);
                    //
                }
                    
                
                            

        });
        $('.inactivos_student').on('change', function() {
            //alert('checkLinea1');
            var inctvs = $('#inactivos').is(":checked");

            if(inctvs){
                //filtro por columna excepto el valor de del id del checbox indicado(linea_1)
                var filtro = $('input:checkbox[id="inactivos"]').map(function() {
                    return this.value;
                }).get().join('|');
                table.column(21).search(filtro ? '^((?!' + filtro + ').*)$' : '', true, false, false).draw(false);
                //
            }

            if(!inctvs){
                //filtro por columna con varios valores segun el name de los checbox y su valor correspondiente
                var offices = $('input:checkbox[name="filtro"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                table.column(21).search(offices, true, false, false).draw(false);
                //
            }
        });

                
</script>

 
@endpush
@endsection

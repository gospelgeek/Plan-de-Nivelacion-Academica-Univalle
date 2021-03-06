@extends('layouts.dashboard')
@section('title', 'Icfes')
@section('content')
@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">
    <h1 style="text-align:center;">COMPARATIVO ICFES</h1>
    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-md-2">
                    <label for="">ELIJA LA COHORTE: </label>
                    <select class="form-control" name="opcion" id="opcion">
                        <option default value="0">-----</option>
                        <option value="1">LINEA 1</option>
                        <option value="2">LINEA 2</option>
                        <option value="3">LINEA 3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">CAMBIAR A PORCENTAJE</label>
                    <input class="form-control" type="checkbox" name="cambio" id="cambio">
                </div>
                <div class="col-md-3">
                    <a class="btn btn-primary" href="{{ route('sabana_icfes') }}">
                        DESCARGAR SABANA
                    </a>
                </div>
            </div>


        </div>
        <div class="card-body">

            <div class="row" id="linea1" hidden>
                <div class="col-sm table-responsive">
                    <table id="tablaLinea1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Nombres</td>
                                <td>Apellidos</td>
                                <td>Nº documento</td>
                                <td>Linea</td>
                                <td>Grupo</td>
                                <td>Icfes Entrada</td>
                                <td>Simulacro 3</td>
                                <td>Puntos Variacion</td>
                                <td>Icfes De Salida</td>
                                <td>Puntos Variacion</td>
                                <td>Ver Detalle</td>


                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row" id="linea2" hidden>
                <div class="col-sm table-responsive">
                    <table id="tablaLinea2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Nombres</td>
                                <td>Apellidos</td>
                                <td>Nº documento</td>
                                <td>Linea</td>
                                <td>Grupo</td>
                                <td>Icfes Entrada</td>
                                <td>Simulacro 1</td>
                                <td>Puntos Variacion</td>
                                <td>Simulacro 2</td>
                                <td>Puntos Variacion</td>
                                <td>Simulacro 3</td>
                                <td>Puntos Variacion</td>
                                <td>Icfes De Salida</td>
                                <td>Puntos Variacion</td>
                                <td>Ver Detalle</td>


                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row" id="linea3" hidden>
                <div class="col-sm table-responsive">
                    <table id="tablaLinea3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Nombres</td>
                                <td>Apellidos</td>
                                <td>Nº documento</td>
                                <td>Linea</td>
                                <td>Grupo</td>
                                <td>Simulacro 1</td>
                                <td>Simulacro 2</td>
                                <td>Puntos Variacion</td>
                                <td>Simulacro 3</td>
                                <td>Puntos Variacion</td>
                                <td>Icfes De Salida</td>
                                <td>Puntos Variacion</td>
                                <td>Ver Detalle</td>


                            </tr>
                        </thead>
                    </table>
                </div>
            </div>





        </div>
    </div>
</div>

@include('icfes.modal_areas')

@push('scripts')

<script>
    
    var table1 = $("#tablaLinea1").DataTable({
        "ajax": {
            "method": "GET",
            "url": "{{route('datos_icfes_lineas', 1)}}"
        },
        "columns": [{
                data: 'nombre'
            },
            {
                data: 'apellidos'
            },
            {
                data: 'documento'
            },
            {
                data: 'linea'
            },
            {
                data: 'grupo'
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return `
                    <button class="btn" type="button" onclick="abrirModal(${data.id_student}, 1);"><u>${data.ie}</u></button>
                       
                    `
                }

            },
            {
                data: 's3'

            },
            {
                data: null,
                render: function(data, type, row, meta) {

                    let variacion = data.s3 - data.ie;
                    let variacionPor = Math.round((Math.round(variacion) / data.ie) / 100)
                    let resultado

                    if (variacion < 0) {
                        resultado = `
                                <div >

                                <div style="background-color: red;" >
                                    <a data-toggle="modal" data-target="#exampleModal${data.id_student}">${variacion}</a>

                                </div>
                                
                                
                                

                        

                                </div>`
                    }
                    if (variacion > 0) {
                        resultado = `<div style="background-color: green;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion == 0) {
                        resultado = `<div ">
                                    <td>${variacion}</td>
                                </div>`
                    }

                    return resultado
                }
            },
            {
                data: 'if'
            },
            {
                data: null,
                render: function(data, type, row, meta) {

                    let variacion = data.if-data.ie;
                    let resultado;
                    if (variacion < 0) {
                        resultado = `<div style="background-color: red;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion > 0) {
                        resultado = `<div style="background-color: green;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion == 0) {
                        resultado = `<div ">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    return resultado
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return `
                    <div class="row">                                  
                        <div class="col-xs-4 col-sm-4">
                            <a href="/ver_estudiante/${data.id_student}?css=titulo-7#ti7" class="btn btn-block btn-sm  fa fa-eye" ></a>  
                        </div>                                       
                    </div>
                     
                     `
                }
            },

        ],

        "deferRender": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": [
            "copy",
            "csv",
            "excel",
            "pdf",
            "print",
            "colvis"
        ]
    });

    var table2 = $("#tablaLinea2").DataTable({
        "ajax": {
            "method": "GET",
            "url": "{{route('datos_icfes_lineas', 2)}}"
        },
        "columns": [{
                data: 'nombre'
            },
            {
                data: 'apellidos'
            },
            {
                data: 'documento'
            },
            {
                data: 'linea'
            },
            {
                data: 'grupo'
            },
            {
                data: 'ie'
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return `
                    <button class="btn" type="button" onclick="abrirModal(${data.id_student}, 1);"><u>${data.s1}</u></button>
                       
                    `
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    let variacion = data.s1 - data.ie;
                    let resultado;
                    if (variacion < 0) {
                        resultado = `<div style="background-color: red;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion > 0) {
                        resultado = `<div style="background-color: green;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion == 0) {
                        resultado = `<div ">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    return resultado
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return `
                    <button class="btn" type="button" onclick="abrirModal(${data.id_student}, 2);"><u>${data.s2}</u></button>
                       
                    `
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    let variacion = data.s2 - data.ie;
                    let resultado;
                    if (variacion < 0) {
                        resultado = `<div style="background-color: red;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion > 0) {
                        resultado = `<div style="background-color: green;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion == 0) {
                        resultado = `<div ">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    return resultado
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return `
                    <button class="btn" type="button" onclick="abrirModal(${data.id_student}, 3);"><u>${data.s3}</u></button>
                       
                    `
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    let variacion = data.s3 - data.ie;
                    let resultado;
                    if (variacion < 0) {
                        resultado = `<div style="background-color: red;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion > 0) {
                        resultado = `<div style="background-color: green;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion == 0) {
                        resultado = `<div ">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    return resultado
                }
            },
            {
                data: 'if'
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    let variacion = data.if-data.ie;
                    let resultado;
                    if (variacion < 0) {
                        resultado = `<div style="background-color: red;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion > 0) {
                        resultado = `<div style="background-color: green;">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    if (variacion == 0) {
                        resultado = `<div ">
                                    <td>${variacion}</td>
                                </div>`
                    }
                    return resultado
                }
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return `
                    <div class="row">                                  
                        <div class="col-xs-4 col-sm-4">
                            <a href="/ver_estudiante/${data.id_student}?css=titulo-7#ti7" class="btn btn-block btn-sm  fa fa-eye" ></a>  
                        </div>                                       
                    </div>
                     
                     `
                }
            },

        ],

        "deferRender": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": [
            "copy",
            "csv",
            "excel",
            "pdf",
            "print",
            "colvis"
        ]
    });
    
    var table3 = $("#tablaLinea3").DataTable({
            "ajax": {
                "method": "GET",
                "url": "{{route('datos_icfes_lineas', 3)}}"
            },
            "columns": [{
                    data: 'nombre'
                },
                {
                    data: 'apellidos'
                },
                {
                    data: 'documento'
                },
                {
                    data: 'linea'
                },
                {
                    data: 'grupo'
                },
                {
                    data: 's1'
                },
                {
                    data: 's2'
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        let variacion = data.s2 - data.s1;
                        let resultado;
                        if (variacion < 0) {
                            resultado = `<div style="background-color: red;">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        if (variacion > 0) {
                            resultado = `<div style="background-color: green;">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        if(variacion == 0){
                            resultado = `<div ">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        return resultado
                    }
                },
                {
                    data: 's3'
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        let variacion = data.s3 - data.s1;
                        let resultado;
                        if (variacion < 0) {
                            resultado = `<div style="background-color: red;">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        if (variacion > 0) {
                            resultado = `<div style="background-color: green;">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        if(variacion == 0){
                            resultado = `<div ">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        return resultado
                    }
                },
                {
                    data: 'if'
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        let variacion = data.if-data.s1;
                        let resultado;
                        if (variacion < 0) {
                            resultado = `<div style="background-color: red;">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        if (variacion > 0) {
                            resultado = `<div style="background-color: green;">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        if(variacion == 0){
                            resultado = `<div ">
                                        <td>${variacion}</td>
                                    </div>`
                        }
                        return resultado
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return `
                        <div class="row">                                  
                            <div class="col-xs-4 col-sm-4">
                                <a href="/ver_estudiante/${data.id_student}?css=titulo-7#ti7" class="btn btn-block btn-sm  fa fa-eye" ></a>  
                            </div>                                       
                        </div>
                         
                         `
                    }
                },

            ],

            "deferRender": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": [
                "copy",
                "csv",
                "excel",
                "pdf",
                "print",
                "colvis"
            ]
        });

    function abrirModal(id, idP) {
        //$("#recargar").load(" #recargar > *");
        
        $("#pruebaAreas").DataTable({
            "ajax": {
                "method": "GET",
                "url": `/pruebaAreas/${id}/${idP}`
            },
            "columns": [{
                    data: 'nombre'
                },
                {
                    data: 'calificacion'
                }

            ],

            "processing": true,
            "LoadingRecords": true,
            "paging": true,
            "deferRender": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "order": [0, 'desc'],
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "destroy": true,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            "buttons": [
                "copy",
                "csv",
                "excel",
                "pdf",
                "print",
                "colvis"
            ]
        });
        $('#modal-areas').modal('show')
    }
</script>
{!!Html::script('/js/icfes.js')!!}">
@endpush
@endsection

<div class="modal fade" id="modal_actualizar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title pull-center" style="justify-content: center">
                <strong>ACTUALIZAR DATOS SOCIOECONOMICOS</strong> 
              </h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div id="msj-error-edit" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
          <strong id="msj"></strong>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                {!!Form::model($verDatosPerfil,['route'=>['updatedatossocioeconomicos',$verDatosPerfil->socioeconomicdata->id], 'method'=>'PUT'])!!}
                      {{csrf_field()}}
                  <div class="row">
                      <div style="display: none;">
                      {!!Form::label('id','id ')!!}
                      {!!Form::text('id',$verDatosPerfil->socioeconomicdata->id,['id'=>'idSx','class'=>'form-control','placeholder'=>'id para enviar al update'])!!}
                      </div>  
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_ocupation','Ocupacion: ')!!}
                      {!!Form::select('ocupacion',$ocupacion, $verDatosPerfil->socioeconomicdata->occupation->id,['id'=>'ocupacion','class'=>'form-control','required','placeholder'=>'Ocupacion'])!!}  
                      </div>
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_civil_status','Estado civil: ')!!}
                      {!!Form::select('estado_civil',$estado_civil, $verDatosPerfil->socioeconomicdata->civilstatus->id,['id'=>'estadoCivil','class'=>'form-control','required','placeholder'=>'Estado civil'])!!}  
                      </div>
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('children_number','Numero hijos: ')!!}
                      {!!Form::text('children_number',$verDatosPerfil->socioeconomicdata->children_number,['id'=>'hijosNumero', 'class'=>'form-control','placeholder'=>'Fecha nacimiento'])!!}   
                      </div>
                  </div>
                  <div class="row">
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_residence_time','Tiempo en su residencia: ')!!}
                      {!!Form::select('residencia',$residencia, $verDatosPerfil->socioeconomicdata->recidencetime->id,['id'=>'residencia1','class'=>'form-control','required','placeholder'=>'Tiempo residencia'])!!}  
                      </div>
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_housing_type','Tipo vivienda: ')!!}
                      {!!Form::select('id_housing_type',$vivienda, $verDatosPerfil->socioeconomicdata->housingtype->id,['id'=>'vivienda','class'=>'form-control','required','placeholder'=>'Tipo vivienda'])!!}  
                      </div>
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_health_regime','Regimen salud: ')!!}
                      {!!Form::select('regimen',$regimen, $verDatosPerfil->socioeconomicdata->healthregime->id,['id'=>'regimen', 'class'=>'form-control','placeholder'=>'Regimen de salud'])!!}   
                      </div> 
                  </div>
                  <div class="row">
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('sisben_category','Categoria Sisben: ')!!}
                      {!!Form::text('sisben_category', $verDatosPerfil->socioeconomicdata->sisben_category,['id'=>'categoriaSisben','class'=>'form-control','required','placeholder'=>'Categoria sisben'])!!}  
                      </div>
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('household_people','Personas en la familia: ')!!}
                      {!!Form::text('household_people', $verDatosPerfil->socioeconomicdata->household_people,['id'=>'personasFamilia','class'=>'form-control','required','placeholder'=>'Tipo vivienda'])!!}  
                      </div>
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('economic_possition','posicion economica: ')!!}
                      {!!Form::text('economic_possition', $verDatosPerfil->socioeconomicdata->economic_possition,['id'=>'posicionE', 'class'=>'form-control','placeholder'=>'Regimen de salud'])!!}   
                      </div> 
                  </div>
                  <div class="row">
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('dependent_people','Persoans a cargo: ')!!}
                      {!!Form::text('dependent_people', $verDatosPerfil->socioeconomicdata->dependent_people,['id'=>'personasCargo','class'=>'form-control','required','placeholder'=>'Categoria sisben'])!!}  
                      </div>
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('internet_zon','Internet en la zona: ')!!}
                      {!!Form::text('internet_zon', $verDatosPerfil->socioeconomicdata->internet_zone,['id'=>'internetZona','class'=>'form-control','required','placeholder'=>'Internet zona'])!!}  
                      </div>
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('internet_home','Internet en el hogar: ')!!}
                      {!!Form::text('internet_home', $verDatosPerfil->socioeconomicdata->internet_home,['id'=>'internetHogar', 'class'=>'form-control','placeholder'=>'Regimen de salud'])!!}   
                      </div> 
                  </div>
                  <div class="row">
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('sex_document_identidad','Sexo documento: ')!!}
                      {!!Form::text('sex_document_identidad', $verDatosPerfil->socioeconomicdata->sex_document_identidad,['id'=>'sexoD','class'=>'form-control','required','placeholder'=>'Categoria sisben'])!!}  
                      </div>
                       <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_social_conditions','Condicion Social: ')!!}
                      {!!Form::select('condicion', $condicion, $verDatosPerfil->socioeconomicdata->socialconditions ? $verDatosPerfil->socioeconomicdata->socialconditions->id : null,['id'=>'socialC','class'=>'form-control','required','placeholder'=>'Condicion social'])!!}  
                      </div>
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_disability','Discapacidad: ')!!}
                      {!!Form::select('discapacidad',$discapacidad, $verDatosPerfil->socioeconomicdata->disability->id,['id'=>'discapacidadS', 'class'=>'form-control','placeholder'=>'Regimen de salud'])!!}   
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-xs-12 col-sm-4 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
                      {!!Form::label('id_ethnicity','Etnia: ')!!}
                      {!!Form::select('etnia',$etnia, $verDatosPerfil->socioeconomicdata->ethnicity->id,['id'=>'etnia', 'class'=>'form-control','placeholder'=>'Etnia'])!!}   
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-xs-12 col-sm-6 ">
                                {!!Form::submit('Guardar Datos',['class'=>'btn btn-primary btn-block boton_update_datos_socioeconomicos'])!!}                       
                              {!!Form::close()!!} 
                          </div>
                      </div>
                  </div>
              </div>
      </div>

              
    </div>
</div>
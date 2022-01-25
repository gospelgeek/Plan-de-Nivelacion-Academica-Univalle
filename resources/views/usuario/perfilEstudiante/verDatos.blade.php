@extends('layouts.app')
@section('title', 'Ver Datos')

@section('content')

@csrf
<div id="container-main">
	<div class="row">		
		<img  src="{{$verDatosPerfil->foto}}" class="avatar" alt="FOTO ESTUDIANTE">	
	</div>
	<br>	
	<div class="sticky-top">	
		<div class="row">
			<div class="col-sm-12">		             
           		{!!Form::text('nombres',$verDatosPerfil->name.' '.$verDatosPerfil->lastname,['class'=>'form-control','readonly','style' => 'font-size : 30px;font-weight: bolder; text-align: center;','disabled'])!!}
			</div>
		</div>
	</div>				
	<br>
	<div class="row" >
		<div class="col-sm-1">
			{!!Form::select('documento',$documento,$verDatosPerfil->documenttype->id,['class'=>'form-control','required','readonly','disabled','style' =>'text-align: left;'])!!}	
		</div>						
		<div class="col-sm-3">
			{!!Form::text('n_documento',$verDatosPerfil->document_number,['class'=>'form-control','readonly','disabled'])!!}
		</div>
			{!!Form::label('edad','Edad:')!!}
		<div class="col-sm-1">					
			{!!Form::text('edad',$edad,['class'=>'form-control','readonly','disabled'])!!}
		</div>
		<div class="col-sm-4">
			{!!Form::text('e-mail',$verDatosPerfil->email,['class'=>'form-control','readonly','disabled'])!!}
		</div>				
	</div>
	<br>
	<div class="row">
		<div class="col-sm-3">
			{!!Form::text('e-phone',$verDatosPerfil->cellphone,['class'=>'form-control','readonly','disabled'])!!}
		</div>						
		<div class="col-sm-2">
			{!!Form::text('grupo','Grupo',['class'=>'form-control','readonly','disabled'])!!}
		</div>
		<div class="col-sm-2">
			{!!Form::text('cohorte','Cohorte',['class'=>'form-control','readonly','disabled'])!!}
		</div>
	</div>	

	<br>

	<div class="accordion-container">
		<a href="#" id="titulo-1" class="accordion-titulo">Datos Generales<span class="toggle-icon"></span></a>
		<div id="contenido-1" class="accordion-content">
			<div class="form-group">
    			<div class="row">
            		<div class="col-xs-3 col-md-2">
            			<p style="text-align: right;"><label for="nombres">Nombres *</label></p>
            		</div>
					<div class="col-xs-4 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input  readonly class="form-control" type="text" name="nombres" id="nombres" value="{{ old('nombres', $verDatosPerfil->name) }}">
								@error('nombre')
				    				<small class="text-danger">{{ $message }}</small>
				    			@enderror
							</div>
						</div>                	
            		</div>
			
            		<div class="col-xs-4 col-md-2">
            			<p style="text-align: right"><label for="apellidos">Apellidos *</label></p>
            		</div>
					<div class="col-xs-4 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input readonly class="form-control" type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $verDatosPerfil->lastname) }}">
							</div>
						</div>	
            		</div>

            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="fecha_nacimiento">Fecha de nacimiento *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input  readonly class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $verDatosPerfil->birth_date) }}">
							</div>
						</div>  	
            		</div>
            	</div>
			</div>
			
			<div class="form-group">		    
    			<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="tipo_documento">Tipo de documento</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12"> 							
								{!!Form::select('tipo_documento',$tipo_documento, $verDatosPerfil->documenttype->id,['id'=>'tipo_documento','class'=>'form-control','required','placeholder'=>'Seleccionar tipo documento' ,'disabled'])!!}						
							</div>
						</div>
            		</div>   
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="numero_documento">Documento de identificacion *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input readonly class="form-control" type="text" name="numero_documento" id="numero_documento" value="{{ old('numero_documento', $verDatosPerfil->document_number) }}">
							</div>
						</div>               	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="fecha_nacimiento">Fecha de Expedicion del documento</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input  readonly class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $verDatosPerfil->document_expedition_date) }}">
							</div>
						</div>   	
            		</div>
            	</div>           
			</div>

			<div class="form-group">
    			<div class="row">
    				<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="departamento_nacimiento">Departamento nacimiento *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="departamento_nacimiento" id="departamento_nacimiento" value="{{ old('departamento_nacimiento', $verDatosPerfil->birthcity->birthdepartament->name) }}">
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="ciudad_nacimiento">Ciudad nacimiento *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="ciudad_nacimiento" id="ciudad_nacimiento" value="{{ old('ciudad_nacimiento', $verDatosPerfil->birthcity->name) }}">
							</div>
						</div>                	
            		</div>

            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="email">Correo Electronico *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="email" id="email" value="{{ old('email', $verDatosPerfil->email) }}">
							</div>
						</div>	
            		</div>
            	</div>
			</div>

			<div class="form-group">
    			<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="sexo">Sexo</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-3 col-md-12"> 
								{!!Form::select('sexo',$sexo, $verDatosPerfil->sex,['id'=>'sexo','class'=>'form-control','required','placeholder'=>'Seleccionar sexo' ,'disabled'])!!}
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="genero">Genero</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								{!!Form::select('genero', $genero,$verDatosPerfil->gender->id,['placeholder'=>'Genero','class'=>'form-control','required','disabled'])!!}
							</div>	
						</div>
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="telefono1">Numero telefonico *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="telefono1" id="telefono1" value="{{ old('telefono1', $verDatosPerfil->cellphone) }}">
							</div>
						</div>               	
            		</div>		
            	</div>
        	</div>

			<div class="form-group">
    			<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="barrio_residencia">Barrio Residencia *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="barrio_residencia" id="barrio_residencia" value="{{ old('barrio_residencia', $verDatosPerfil->neighborhood->name) }}">
							</div>
						</div>    	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="direccion">Direccion *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly  class="form-control" type="text" name="direccion" id="direccion" value="{{ old('direccion', $verDatosPerfil->direction) }}">
							</div>
						</div>	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="telefono2">Numero telefonico alternativo *</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="telefono2" id="telefono2" value="{{ old('telefono2', $verDatosPerfil->phone) }}">
							</div>
						</div>     	
            		</div>
            	</div>
			</div>			
			<a type="button" href="{{ route('usuario.editar_estudiante', $verDatosPerfil->id) }}" class="btn btn-primary">Actualizar Datos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
		</div>			
	</div>

	<div class="accordion-container">
		<a href="#" id="titulo-2" class="accordion-titulo-2">Datos Academicos Previos<span class="toggle-icon"></span></a>
		<div id="contenido-2" class="accordion-content-2">
			<div class="form-group">
    			<div class="row">
            		<div class="col-xs-3 col-md-2">
            			<p style="text-align: right;"><label for="id_student">Id estudiante </label></p>
            		</div>
					<div class="col-xs-4 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input  readonly class="form-control" type="text" name="id_student" id="id_student" value="{{ old('id_student', $verDatosPerfil->previousacademicdata->id_student) }}">

								@error('id_student')
				    				<small class="text-danger">{{ $message }}</small>
				    			@enderror
							</div>
						</div>                	
            		</div>			
            		<div class="col-xs-4 col-md-2">
            			<p style="text-align: right"><label for="id_institution_type">Institucion</label></p>
            		</div>
					<div class="col-xs-4 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input readonly class="form-control" type="text" name="id_institution_type" id="id_institution_type" value="{{ old('id_institution_type', $verDatosPerfil->previousacademicdata->institutiontype->name) }}">
							</div>
						</div>	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="year_graduation">A&ntilde;o Graduacion</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input  readonly class="form-control" type="text" name="year_graduation" id="year_graduation" value="{{ old('year_graduation', $verDatosPerfil->previousacademicdata->year_graduation) }}">
							</div>
						</div>  	
            		</div>
            	</div>
			</div>
	
			<div class="form-group">
    			<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="bachelor_title">Titulo Bachiller</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12"> 								
								<input  readonly class="form-control" type="text" name="bachelor_title" id="bachelor_title" value="{{ old('bachelor_title',$verDatosPerfil->previousacademicdata->bachelor_title)}}">					
							</div>
						</div>
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="icfes_date">Fecha ICFES</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input readonly class="form-control" type="date" name="icfes_date" id="icfes_date" value="{{ old('icfes_date', $verDatosPerfil->previousacademicdata->icfes_date) }}">
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="snp_register">Registro SNP</label></p>
           			 </div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input  readonly class="form-control" type="text" name="snp_register" id="snp_register" value="{{ old('snp_register', $verDatosPerfil->previousacademicdata->snp_register) }}">
							</div>
						</div>   	
            		</div>
           		</div>            
			</div>

			<div class="form-group">
    			<div class="row">
    				<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="icfes_score">Puntaje ICFES</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="icfes_score" id="icfes_score" value="{{ old('icfes_score', $verDatosPerfil->previousacademicdata->icfes_score) }}">
							</div>
						</div>               	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="graduate_schooling">Graduado escolaridad</label></p>
            		</div>
					<div class="col-xs-2 col-md-6">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="graduate_schooling" id="graduate_schooling" value="{{ old('graduate_schooling', $verDatosPerfil->previousacademicdata->graduate_schooling) }}">
							</div>
						</div>                	
            		</div>
           		</div>
			</div>
			<a type="button" href="{{ route('usuario.editar_datos_academicos', $verDatosPerfil->id) }}" class="btn btn-primary">Actualizar Datos</a>
		</div>
	</div>

	<div class="accordion-container">
		<a href="#" id="titulo-3" class="accordion-titulo-3" onclick="myFunction()">Datos SocioEconomicos<span class="toggle-icon"></span></a>
		<div id="contenido-3" class="accordion-content-3">
			<div class="form-group">
    			<div class="row">			
            		<div class="col-xs-4 col-md-2">
            			<p style="text-align: right"><label for="id_ocupation">Ocupacion</label></p>
            		</div>
					<div class="col-xs-4 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input readonly class="form-control" type="text" name="id_ocupation" id="id_ocupation" value="{{ old('id_ocupation', $verDatosPerfil->socioeconomicdata->occupation->name) }}">
							</div>
						</div>	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_civil_status">Estado civil</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input  readonly class="form-control" type="text" name="id_civil_status" id="id_civil_status" value="{{ old('id_civil_status', $verDatosPerfil->socioeconomicdata->civilstatus->name) }}">
							</div>
						</div>  	
            		</div>
            	</div>
			</div>
	
			<div class="form-group">		    
    			<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="children_number">Numero de hijos</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12"> 								
								<input  readonly class="form-control" type="text" name="children_number" id="children_number" value="{{ old('children_number',$verDatosPerfil->socioeconomicdata->children_number) }}">						
							</div>
						</div>
            		</div>   
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_residence_time">Tiempo en su residencia</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input readonly class="form-control" type="text" name="id_residence_time" id="id_residence_time" value="{{ old('id_residence_time', $verDatosPerfil->socioeconomicdata->recidencetime->name) }}">
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_housing_type">Tipo de vivienda</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-4 col-md-12">
								<input  readonly class="form-control" type="text" name="id_housing_type" id="id_housing_type" value="{{ old('id_housing_type', $verDatosPerfil->socioeconomicdata->recidencetime->name) }}">
							</div>
						</div>   	
           		 	</div>
            	</div>           
			</div>

			<div class="form-group">
    			<div class="row">
    				<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_health_regime">Regimen de Salud</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="id_health_regime" id="id_health_regime" value="{{ old('id_health_regime', $verDatosPerfil->socioeconomicdata->healthregime->name) }}">
							</div>
						</div>             	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="sisben_category">Categoria Sisben</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="sisben_category" id="sisben_category" value="{{ old('sisben_category', $verDatosPerfil->socioeconomicdata->sisben_category) }}">
							</div>
						</div>               	
					</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_benefits">Beneficios</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="id_benefits" id="id_benefits" value="{{ old('id_benefits', $verDatosPerfil->socioeconomicdata->benefits->name) }}">
							</div>
						</div>                	
            		</div>
            	</div>
			</div>
			
			<div class="form-group">
		      	<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="household_people">Personas en la familia</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="household_people" id="household_people" value="{{ old('household_people', $verDatosPerfil->socioeconomicdata->household_people) }}">
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="economic_possition">Posicion economica</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="economic_possition" id="economic_possition" value="{{ old('economic_possition', $verDatosPerfil->socioeconomicdata->economic_possition) }}">
							</div>
						</div>		
					</div>            	
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="dependent_people">Personas a cargo</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="dependent_people" id="dependent_people" value="{{ old('dependent_people', $verDatosPerfil->socioeconomicdata->dependent_people) }}">
							</div>
						</div>             	
            		</div>	
            	</div>	
            </div>

			<div class="form-group">
    			<div class="row">
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="internet_zon">Internet en la zona</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="internet_zon" id="internet_zon" value="{{ old('internet_zon', $internet_zone) }}">
							</div>
						</div>               	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="internet_home">Internet en el hogar</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly  class="form-control" type="text" name="internet_home" id="internet_home" value="{{ old('internet_home', $internet_home) }}">
							</div>
						</div>	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="sex_document_identidad">Sexo documento de identidad</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="sex_document_identidad" id="sex_document_identidad" value="{{ old('sex_document_identidad', $sexo1) }}">
							</div>
						</div>       	
            		</div>
            	</div>
			</div>

			<div class="form-group">
    			<div class="row">
    				<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_social_conditions">Condicion social</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="id_social_conditions" id="id_social_conditions" value="{{ $verDatosPerfil->socioeconomicdata->socialconditions ? $verDatosPerfil->socioeconomicdata->socialconditions->name : null }}">
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_disability">Discapacidad</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="id_disability" id="id_disability" value="{{ old('id_disability', $verDatosPerfil->socioeconomicdata->disability ? $verDatosPerfil->socioeconomicdata->disability->name : null) }}">
							</div>
						</div>                	
            		</div>
            		<div class="col-xs-2 col-md-2">
            			<p style="text-align: right"><label for="id_ethnicity">Etnia</label></p>
            		</div>
					<div class="col-xs-2 col-md-2">
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<input readonly class="form-control" type="text" name="id_ethnicity" id="id_ethnicity" value="{{$verDatosPerfil->socioeconomicdata->ethnicity ? $verDatosPerfil->socioeconomicdata->ethnicity->name : null }}">
							</div>
						</div>                	
            		</div>	
            	</div>
			</div>	
			<a type="button" href="{{ route('usuario.editar_datos_socioeconomicos', $verDatosPerfil->id) }}" class="btn btn-primary">Actualizar Datos</a>		
		</div>
	</div>
	<a class="btn btn-primary" type="button" href="{{ route('usuario.estudiante')}}" >Regresar</a>
</div>

@endsection
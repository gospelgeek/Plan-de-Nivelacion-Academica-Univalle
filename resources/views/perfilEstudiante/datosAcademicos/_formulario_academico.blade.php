@csrf 
<div class="container">
	<div class="form-group">
    		<div class="row">
            	<div class="col-xs-3 col-md-2">
            		<p style="text-align: right;"><label for="id_student">Id estudiante </label></p>
            	</div>
				<div class="col-xs-4 col-md-2">
					<div class="row">
						<div class="col-xs-4 col-md-12">
							<input  readonly class="form-control" type="text" name="id_student" id="id_student" value="{{ old('id_student', $editarAcademicos->previousacademicdata->id_student) }}">

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
							{!!Form::select('id_institution_type', $tipo_institucion,$editarAcademicos->previousacademicdata->id_institution_type,['placeholder'=>'Ocupacion','class'=>'form-control','required'])!!}
						</div>
					</div>	
            	</div>
            	<div class="col-xs-2 col-md-2">
            		<p style="text-align: right"><label for="year_graduation">A?o Graduacion</label></p>
            	</div>
				<div class="col-xs-2 col-md-2">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<input   class="form-control" type="text" name="year_graduation" id="year_graduation" value="{{ old('year_graduation', $editarAcademicos->previousacademicdata->year_graduation) }}">
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
								
							<input   class="form-control" type="text" name="bachelor_title" id="bachelor_title" value="{{ old('bachelor_title',$editarAcademicos->previousacademicdata->bachelor_title) }}">
						
						</div>
					</div>
            	</div>
   
            	<div class="col-xs-2 col-md-2">
            		<p style="text-align: right"><label for="icfes_date">Fecha ICFES</label></p>
            	</div>
				<div class="col-xs-2 col-md-2">
					<div class="row">
						<div class="col-xs-4 col-md-12">
							<input  class="form-control" type="date" name="icfes_date" id="icfes_date" value="{{ old('icfes_date', $editarAcademicos->previousacademicdata->icfes_date) }}">
						</div>
					</div>
                	
            	</div>
            	<div class="col-xs-2 col-md-2">
            		<p style="text-align: right"><label for="snp_register">Registro SNP</label></p>
            </div>
			<div class="col-xs-2 col-md-2">
				<div class="row">
					<div class="col-xs-4 col-md-12">
						<input   class="form-control" type="text" name="snp_register" id="snp_register" value="{{ old('snp_register', $editarAcademicos->previousacademicdata->snp_register) }}">
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
							<input  class="form-control" type="text" name="icfes_score" id="icfes_score" value="{{ old('icfes_score', $editarAcademicos->previousacademicdata->icfes_score) }}">
						</div>
					</div>
                	
            	</div>
            	<div class="col-xs-2 col-md-2">
            		<p style="text-align: right"><label for="graduate">Graduado</label></p>
            	</div>
				<div class="col-xs-2 col-md-2">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<input  class="form-control" type="text" name="graduate" id="graduate" value="{{ old('graduate', $editarAcademicos->previousacademicdata->graduate) }}">
						</div>
					</div>
                	
            	</div>

            	<div class="col-xs-2 col-md-2">
            		<p style="text-align: right"><label for="graduate_schooling">Graduado escolaridad</label></p>
            	</div>
				<div class="col-xs-2 col-md-2">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<input  class="form-control" type="text" name="graduate_schooling" id="graduate_schooling" value="{{ old('graduate_schooling', $editarAcademicos->previousacademicdata->graduate_schooling) }}">
						</div>
					</div>
                	
            	</div>
            </div>
		</div>

			<input class="btn btn-primary" type="button" onclick="history.back()" name="volver atrás" value="Regresar">
			
            <input class="btn btn-primary"  type="submit" value="Guardar Datos"></input>
            				
</div>
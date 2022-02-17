//ACTUALIZAR DATOS ACADEMICOS PREVIOS
//Abrir modal
$('.abrir_modal_actualizar_previos').click(function(e) { 
      e.preventDefault();
        $('#modal_actualizar_datos_academicos_previos').modal('show');
        //alert(cod)
});

//Actualizar datos
$('.boton_update_datos_academicos_previos').click(function(e) { 
  e.preventDefault();   
  var idDatos = $('#idap').val();
  //alert(idDatos);
  $.ajax({
  //ruta manual
    url:'/updatedatosacademicosprevios/'+ idDatos,
    type:'PUT',
    data:{
      '_token': $('input[name=_token]').val(),
      'institution_name': $("#colegio").val(),
      'year_graduation': $("#graduacion").val(),
      'bachelor_title': $("#bachiller").val(),
      'icfes_date': $("#fechaIcfes").val(),
      'snp_register': $("#snpRegistro").val(),
      'icfes_score': $("#icfesPuntaje").val(),
  
    },
    success:function(result) {
      $('#modal_actualizar_datos_academicos_previos').modal('hide');
      //window.location.reload(); 
      toastr.info(result);
      setTimeout("location.reload()", 2000);
    },

    error:function(result) {          
      var mensajeError = "";
      $.each(result.responseJSON.errors,function(i,field){
        mensajeError += "<li>"+field+"</li>"
        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
        console.log(mensajeError)
      });
      $("#msj-error-agendamiento").html("<ul>"+mensajeError+"</ul>").fadeIn();         
    },       
  });
});

//Actualizar datos academicos previos de la otra vista
$('.boton_update_academicos_previos').click(function(e) { 
  e.preventDefault();   
  var idDatos = $('#idPaD').val();
  //alert($("#icfesscore").val());
  $.ajax({
  //ruta manual
    url:'/updatedatosacademicosprevios/'+ idDatos,
    type:'PUT',
    data:{
      '_token': $('input[name=_token]').val(),
      'institution_name': $("#institutionname").val(),
      'year_graduation': $("#yeargraduation").val(),
      'bachelor_title': $("#snpregister").val(),
      'icfes_date': $("#icfesdate").val(),
      'snp_register': $("#bachelortitle").val(),
      'icfes_score': $("#icfesscore").val(),
  
    },
    success:function(result) {
      $('#contenido-2').modal('hide');
      //window.location.reload(); 
      toastr.info(result);
      setTimeout("location.reload()", 2000);
    },

    error:function(result) {          
      var mensajeError = "";
      $.each(result.responseJSON.errors,function(i,field){
        mensajeError += "<li>"+field+"</li>"
        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
        console.log(mensajeError)
      });
      $("#msj-error-agendamiento").html("<ul>"+mensajeError+"</ul>").fadeIn();         
    },       
  });
});


//ACTUALIZAR DATOS GENERALES
//Abrir modal
$('.abrir_modal_actualizar').click(function(e) { 
      e.preventDefault();
        $('#modal_actualizar_datos_generales').modal('show');
        //alert(cod)
});


//Actualiazr datos 
$('.boton_update_datos_generales').click(function(e) { 
  e.preventDefault();   
  var idDatos = $('#idG').val();
  //alert($("#direccion12").val());
  $.ajax({
  //ruta manual
    url:'/updatedatosgenerales/'+ idDatos,
    type:'PUT',
    data:{
      '_token': $('input[name=_token]').val(),
      'name': $("#nombre1").val(),
      'lastname': $("#apellido").val(),
      'id_document_type': $("#tipoDocumento").val(),
      'document_number': $("#numeroDocumento").val(),
      'document_expedition_date': $("#fechaExpedicion").val(),
      'id_birth_city': $("#ciudadNacimiento").val(),
      'email': $("#correo").val(),
      'birth_date': $("#fechaNacimiento").val(),
      'sex': $("#sexo1").val(),
      'id_gender': $("#generoE").val(),
      'cellphone': $("#celular").val(),
      'phone': $("#telefono").val(),
      'id_neighborhood': $("#barrioV").val(),
      'direction': $("#direccion12").val(),
      'student_code': $('#codEstu').val(),  
    },
    success:function(result) {
      $('#modal_actualizar_datos_generales').modal('hide');
      //window.location.reload(); 
      toastr.info(result);
      setTimeout("location.reload()", 2000);
    },

    error:function(result) {          
      var mensajeError = "";
      $.each(result.responseJSON.errors,function(i,field){
        mensajeError += "<li>"+field+"</li>"
        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
        console.log(mensajeError)
      });
      $("#msj-error-agendamiento").html("<ul>"+mensajeError+"</ul>").fadeIn();         
    },       
  });
});

//actualizar datos generales de la otra vista
$('.boton_update_generales').click(function(e) { 
  e.preventDefault();   
  var idDatos = $('#idGeN').val();
  //alert($("#barrioresidencia").val());
  $.ajax({
  //ruta manual
    url:'/actualizardatosgenerales/'+ idDatos,
    type:'PUT',
    data:{
      '_token': $('input[name=_token]').val(),
      'name': $("#nombres123").val(),
      'lastname': $("#apellidosG").val(),
      'id_document_type': $("#tipodocumento").val(),
      'document_number': $("#numerodocumento").val(),
      'document_expedition_date': $("#expedition").val(),
      'id_birth_city': $("#ciudadnacimiento").val(),
      'email': $("#correo").val(),
      'birth_date': $("#fechanacimientoG").val(),
      'sex': $("#sexoGeN").val(),
      'id_gender': $("#gen").val(),
      'cellphone': $("#telefono11").val(),
      'phone': $("#telefono22").val(),
      'id_neighborhood': $("#barrioresidencia").val(),
      'direction': $("#direccionnnnn").val(),
      'student_code': $('#codEstudiante').val(),
    },
    success:function(result) {
      $('#contenido-1').modal('hide');
      //window.location.reload(); 
      toastr.info(result);
      setTimeout("location.reload()", 2000);
    },

    error:function(result) {          
      var mensajeError = "";
      $.each(result.responseJSON.errors,function(i,field){
        mensajeError += "<li>"+field+"</li>"
        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
        console.log(mensajeError)
      });
      $("#msj-error-agendamiento").html("<ul>"+mensajeError+"</ul>").fadeIn();         
    },       
  });
});




//ACTUALIZAR DATOS SOCIOECONOMICOS
//Abrir modal
$('.abrir_modal_socioeconomico').click(function(e) { 
      e.preventDefault();
        $('#modal_actualizar').modal('show');
        //alert(cod)
});


//Actualizar datos
$('.boton_update_datos_socioeconomicos').click(function(e) { 
  e.preventDefault();   
  var idDatos = $('#idSx').val();
  alert(idDatos);
  $.ajax({
  //ruta manual
    url:'/updatedatossocioeconomicos/'+ idDatos,
    type:'PUT',
    data:{
      '_token': $('input[name=_token]').val(),
      'id_ocupation': $("#ocupacion").val(),
      'id_civil_status': $("#estadoCivil").val(),
      'children_number': $("#hijosNumero").val(),
      'id_residence_time': $("#residencia1").val(),
      'id_housing_type': $("#vivienda").val(),
      'id_health_regime': $("#regimen").val(),
      'sisben_category': $("#categoriaSisben").val(),
      'household_people': $("#personasFamilia").val(),
      'economic_possition': $("#posicionE").val(),
      'dependent_people': $("#personasCargo").val(),
      'internet_zon': $("#internetZona").val(),
      'internet_home': $("#internetHogar").val(),
      'sex_document_identidad': $("#sexoD").val(),
      'id_social_conditions': $("#socialC").val(),
      'id_disability': $("#discapacidadS").val(),
      'id_ethnicity': $("#etnia").val(),
    },
    success:function(result) {
      $('#modal_actualizar').modal('hide');
      //window.location.reload(); 
      toastr.info(result);
      setTimeout("location.reload()", 2000);
    },

    error:function(result) {          
      var mensajeError = "";
      $.each(result.responseJSON.errors,function(i,field){
        mensajeError += "<li>"+field+"</li>"
        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
        console.log(mensajeError)
      });
      $("#msj-error-agendamiento").html("<ul>"+mensajeError+"</ul>").fadeIn();         
    },       
  });
});


//Actualizar datos socioeconomicos de la otra vista
$('.boton_update_socioeconomicos').click(function(e) { 
  e.preventDefault();   
  var idDatos = $('#idSd').val();
  //alert($("#idethnicity").val());
  $.ajax({
  //ruta manual
    url:'/updatedatossocioeconomicos/'+ idDatos,
    type:'PUT',
    data:{
      '_token': $('input[name=_token]').val(),
      'id_ocupation': $("#idocupation").val(),
      'id_civil_status': $("#idcivilstatus").val(),
      'children_number': $("#childrennumber").val(),
      'id_residence_time': $("#idresidencetime").val(),
      'id_housing_type': $("#idhousingtype").val(),
      'id_health_regime': $("#idhealthregime").val(),
      'sisben_category': $("#sisbencategory").val(),
      'id_benefits': $("#idbenefits").val(),
      'household_people': $("#householdpeople").val(),
      'economic_possition': $("#economicpossition").val(),
      'dependent_people': $("#dependentpeople").val(),
      'internet_zon': $("#internetzon").val(),
      'internet_home': $("#internethome").val(),
      'sex_document_identidad': $("#sexdocumentidentidad").val(),
      'id_social_conditions': $("#idsocialconditions").val(),
      'id_disability': $("#iddisability").val(),
      'id_ethnicity': $("#idethnicity").val(),
    },
    success:function(result) {
      $('#contenido-3').modal('hide');
      //window.location.reload(); 
      toastr.info(result);
      setTimeout("location.reload()", 2000);
    },

    error:function(result) {          
      var mensajeError = "";
      $.each(result.responseJSON.errors,function(i,field){
        mensajeError += "<li>"+field+"</li>"
        //$("#msj").append("<ul><li>"+field.errors.calendario_nombre+"</li><li>"+field.errors.calendario_semestre+"</li></ul>");   
        console.log(mensajeError)
      });
      $("#msj-error-agendamiento").html("<ul>"+mensajeError+"</ul>").fadeIn();         
    },       
  });
});

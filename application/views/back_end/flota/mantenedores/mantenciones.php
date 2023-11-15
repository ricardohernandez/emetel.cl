<style type="text/css">
  .borrar_mmc,.btn_del_modelo,.btn_del_marca,.btn_del_actividad,.btn_del_mat{
    color: red;
    cursor:pointer;
    font-size: 15px;
    margin-left:10px;
    text-decoration: none;
  }
   .btn_modificar_mmc,.btn_edit_modelo,.btn_edit_marca,.btn_edit_actividad,.btn_edit_mat{
    font-size: 15px;
    cursor:pointer;
    text-decoration: none;
  }

  @media (max-width: 768px){
    .modal_mmc{
      width: 95%!important;
    }
    .modal_nuevo_modelos{
      width: 95%!important;
    }
    .modal_nuevo_marcas{
      width: 95%!important;
    }
    .modal_nuevo_actividad{
      width: 95%!important;
    }
    .modal_mat{
      width: 95%!important;
    }
  }

  @media (min-width: 768px){
    .modal_mmc{
      width: 55%!important;
    }
    .modal_nuevo_modelos{
      width: 55%!important;
    } 
    .modal_nuevo_marcas{
      width: 55%!important;
    }
    .modal_nuevo_actividad{
      width: 75%!important;
    }
    .modal_mat{
      width: 75%!important;
    }
  }


</style>

<script type="text/javascript">
  $.fn.modal.Constructor.prototype.enforceFocus = function() {}; 

  $(function(){

    const perfil="<?php echo $this->session->userdata('id_perfil'); ?>";
    const base = "<?php echo base_url() ?>";

    $.fn.modal.Constructor.prototype.enforceFocus = function() {}; 

  /*********ASIGNACION ACTIVIDADES************/

     var tabla_mat = $('#tabla_mat').DataTable({
      //"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
      "bPaginate": false,
      "aaSorting" : [1,"asc"],
      //"stateSave": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": false,
      "bProcessing": false,
      "pagingType": false , 
      //"responsive":true,
      // "scrollY": 220,
      // "scrollX": true,
        "oLanguage": { 
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar: _MENU_ ",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
          "sInfoEmpty":      "Sin registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "",     
          "sSearchPlaceholder": "Busqueda",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
        "bAutoWidth": true,
        "sAjaxDataProp": "result",        
        "bDeferRender": true,
        "ajax": {
          "url":"<?php echo base_url();?>listaMat",
          "dataSrc": function (json) {
              return json;
          },       
          data: function(param){
          }
        },    
        "columns": [
          {
            "class":"centered","width":"50px","data": function(row,type,val,meta){
              btn='<center><a data-id="'+row.hash_mat+'"  class="btn_edit_mat"><i class="fa fa-edit" ></i> </a>';
              btn+='<a data-id="'+row.hash_mat+'"  class="btn_del_mat"><i class="fa fa-trash" ></i> </a></center>';
              return btn;
            }
          }, 
          { "data": "tipo" ,"width":"40%","class":"margen-td centered"},
          { "data": "fechas" ,"width":"10%","class":"margen-td centered"},
          { "data": "actividad" ,"width":"40%","class":"margen-td centered"},
          { "data": "unidad" ,"width":"10%","class":"margen-td centered"},
          { "data": "rango" ,"width":"10%","class":"margen-td centered"},
          { "data": "estado" ,"width":"10%","class":"margen-td centered"},
        ]
      }); 

      setTimeout( function () {
        var tabla_mat = $.fn.dataTable.fnTables(true);
        if ( tabla_mat.length > 0 ) {
            $(tabla_mat).dataTable().fnAdjustColumnSizing();
      }}, 100 ); 

      setTimeout( function () {
        var tabla_mat = $.fn.dataTable.fnTables(true);
        if ( tabla_mat.length > 0 ) {
            $(tabla_mat).dataTable().fnAdjustColumnSizing();
      }}, 1100 ); 

      async function cargaTipoMat() {
        $.getJSON(base + "listaTiposMmc", function(data) {
          response = data;
          }).done(function() {

          $("#tipo_mat").select2({
            placeholder: 'Seleccione Tipo | Todos',
            data: response,
            width: '100%',    
            allowClear: true
          });
          $('#tipo_mat').val(null).trigger('change.select2');

        });
      }
      
      $(document).off('click', '#mantenedor_mat').on('click', '#mantenedor_mat',function(event) {
        $('#modal_mat').modal('toggle'); 
        $(".btn_ingresa_mat").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_ingresa_mat").attr("disabled", false);
        $('#formMat')[0].reset();
        $("#hash_mat").val("");
        tabla_mat.ajax.reload();
        cargaTipoMat()

      });     
      
      $(document).off('submit', '#formMat').on('submit', '#formMat',function(event) {
        var url="<?php echo base_url()?>";
        var formElement = document.querySelector("#formMat");
        var formData = new FormData(formElement);
          $.ajax({
              url: $('#formMat').attr('action')+"?"+$.now(),  
              type: 'POST',
              data: formData,
              cache: false,
              processData: false,
              dataType: "json",
              contentType : false,
              beforeSend:function(){
                /* $(".btn_ingresa_mat").attr("disabled", true);
               */
              },
              success: function (data) {
                $(".btn_ingresa_mat").attr("disabled", false);
                $(".cierra_mod_modelos").attr("disabled", false);   

                if(data.res == "error"){
              
                    $.notify(data.msg, {
                      className:'error',
                      globalPosition: 'top right',
                      autoHideDelay:10000,
                    });
                }else if(data.res == "ok"){
                    $.notify(data.msg, {
                      className:'success',
                      globalPosition: 'top right',
                      autoHideDelay:2000,
                    });

                    $(".btn_ingresa_mat").html('<i class="fa fa-save"></i> Guardar');
                    $("#hash_mat").val("");
                    $('#tipo_mat').val(null).trigger('change.select2');

                    setTimeout(function(){ 
                      $('#formMat')[0].reset();
                      tabla_mat.ajax.reload();
                    } ,1000);  
                }
              }
          });
          return false; 
      });

      $(document).off('click', '.btn_del_mat').on('click', '.btn_del_mat',function(event) {
        hash=$(this).attr("data-id");
        if(confirm("¿Esta seguro que desea cambiar el estado?")){
          $.post('eliminarMat'+"?"+$.now(), {hash : hash} ,function(data) {
            if(data.res=="ok"){
              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });
            tabla_mat.ajax.reload();
            }else{
              $.notify(data.msg, {
                className:'danger',
                globalPosition: 'top right'
              });
            }
          },"json");
        }
      });


      $(document).off('click', '.btn_edit_mat').on('click', '.btn_edit_mat',function(event) {
         $("#hash_mat").val("");
         hash=$(this).attr("data-id");
         $(".btn_ingresa_mat").html('<i class="fa fa-edit"></i> Modificar');
         $('#formMat')[0].reset();
         $("#hash_mat").val("");
         $("#formMat input,#formMat select,#formMat button,#formMat").prop("disabled", true);

          $.ajax({
            url: "getDataMat"+"?"+$.now(),  
            type: 'POST',
            cache: false,
            tryCount : 0,
            retryLimit : 3,
            data:{hash:hash},
            dataType:"json",
            beforeSend:function(){
            /*  $(".btn_ingresa_mat").prop("disabled",true);  */
            },
            success: function (data) {
              if(data.res=="ok"){
                for(dato in data.datos){
                  $("#hash_mat").val(data.datos[dato].hash_mat);
                  $("#actividad_mat option[value='"+data.datos[dato].id_actividad+"'").prop("selected", true);
                  $('#tipo_mat').val(data.datos[dato].id_tipo_mmc).trigger('change');

                  $("#estado_mat option[value='"+data.datos[dato].estado+"'").prop("selected", true);
                  $("#unidad_mat").val(data.datos[dato].unidad);
                  $("#rango_mat").val(data.datos[dato].rango);
                  $("#desde_mat option[value='"+data.datos[dato].desde+"'").prop("selected", true);
                  $("#hasta_mat option[value='"+data.datos[dato].hasta+"'").prop("selected", true);
                }
                $("#formMat input,#formMat select,#formMat button,#formMat").prop("disabled", false);
                $(".cierra_mod_modelos").prop("disabled", false);
                $(".btn_ingresa_mat").prop("disabled", false);   
                
              }
            },
            error : function(xhr, textStatus, errorThrown ) {
              if (textStatus == 'timeout') {
                  this.tryCount++;
                  if (this.tryCount <= this.retryLimit) {
                      $.notify("Reintentando...", {
                        className:'info',
                        globalPosition: 'top right'
                      });
                      $.ajax(this);
                      return;
                  } else{
                     $.notify("Problemas en el servidor, intente nuevamente.", {
                        className:'warn',
                        globalPosition: 'top right'
                      });     
                      $('#modal_nuevo_mat').modal("toggle");
                  }    
                  return;
              }

              if (xhr.status == 500) {
                  $.notify("Problemas en el servidor, intente más tarde.", {
                    className:'warn',
                    globalPosition: 'top right'
                  });
                  $('#modal_nuevo_mat').modal("toggle");
              }
          },timeout:5000
        }); 
      });
                      
  /*********ACTIVIDADES************/

    var tabla_actividades = $('#tabla_actividades').DataTable({
      //"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
      "bPaginate": false,
      "aaSorting" : [1,"asc"],
      //"stateSave": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": false,
      "bProcessing": false,
      "pagingType": false , 
      //"responsive":true,
      // "scrollY": 220,
      // "scrollX": true,
      "oLanguage": { 
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar: _MENU_ ",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
          "sInfoEmpty":      "Sin registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "",     
          "sSearchPlaceholder": "Busqueda",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
        "bAutoWidth": true,
        "sAjaxDataProp": "result",        
        "bDeferRender": true,
        "ajax": {
          "url":"<?php echo base_url();?>listaActividades",
          "dataSrc": function (json) {
              return json;
          },       
          data: function(param){
          }
        },    
        "columns": [
          {
            "class":"centered","width":"50px","data": function(row,type,val,meta){
              btn='<center><a data-id="'+row.hash_vac+'"  class="btn_edit_actividad"><i class="fa fa-edit" ></i> </a>';
              btn+='<a data-id="'+row.hash_vac+'"  class="btn_del_actividad"><i class="fa fa-trash" ></i> </a></center>';
              return btn;
            }
          }, 
          { "data": "actividad" ,"width":"40%","class":"margen-td centered"},
          { "data": "tipo" ,"width":"40%","class":"margen-td centered"},
          { "data": "unidad" ,"width":"10%","class":"margen-td centered"},
          { "data": "rango" ,"width":"10%","class":"margen-td centered"},
          { "data": "estado" ,"width":"10%","class":"margen-td centered"},
        ]
      }); 


      setTimeout( function () {
        var tabla_actividades = $.fn.dataTable.fnTables(true);
        if ( tabla_actividades.length > 0 ) {
            $(tabla_actividades).dataTable().fnAdjustColumnSizing();
      }}, 100 ); 

      setTimeout( function () {
        var tabla_actividades = $.fn.dataTable.fnTables(true);
        if ( tabla_actividades.length > 0 ) {
            $(tabla_actividades).dataTable().fnAdjustColumnSizing();
      }}, 1100 ); 
            
      $(document).off('click', '#mantenedor_actividades').on('click', '#mantenedor_actividades',function(event) {
        $('#modal_nuevo_actividad').modal('toggle'); 
        $(".btn_ingresa_actividad").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_ingresa_actividad").attr("disabled", false);
        $(".cierra_mod_modelos").attr("disabled", false);
        $('#formActividad')[0].reset();
        $("#hash_actividad").val("");
        tabla_actividades.ajax.reload();
      });     
      
      $(document).off('submit', '#formActividad').on('submit', '#formActividad',function(event) {
        var url="<?php echo base_url()?>";
        var formElement = document.querySelector("#formActividad");
        var formData = new FormData(formElement);
          $.ajax({
              url: $('#formActividad').attr('action')+"?"+$.now(),  
              type: 'POST',
              data: formData,
              cache: false,
              processData: false,
              dataType: "json",
              contentType : false,
              beforeSend:function(){
                /* $(".btn_ingresa_actividad").attr("disabled", true);
                $(".cierra_mod_modelos").attr("disabled", true); */
              },
              success: function (data) {
                $(".btn_ingresa_actividad").attr("disabled", false);
                $(".cierra_mod_modelos").attr("disabled", false);   

                if(data.res == "error"){
              
                    $.notify(data.msg, {
                      className:'error',
                      globalPosition: 'top right',
                      autoHideDelay:10000,
                    });
                }else if(data.res == "ok"){
                    $.notify(data.msg, {
                      className:'success',
                      globalPosition: 'top right',
                      autoHideDelay:2000,
                    });
                    $(".btn_ingresa_actividad").html('<i class="fa fa-save"></i> Guardar');
                    $("#hash_actividad").val("");

                    setTimeout(function(){ 
                      $('#formActividad')[0].reset();
                      tabla_actividades.ajax.reload();
                    } ,2000);  
                }
              }
          });
          return false; 
      });

      $(document).off('click', '.btn_del_actividad').on('click', '.btn_del_actividad',function(event) {
        hash=$(this).attr("data-id");
        if(confirm("¿Esta seguro que desea cambiar el estado?")){
          $.post('eliminarActividad'+"?"+$.now(), {hash : hash} ,function(data) {
            if(data.res=="ok"){
              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });
            tabla_actividades.ajax.reload();
            }else{
              $.notify(data.msg, {
                className:'danger',
                globalPosition: 'top right'
              });
            }
          },"json");
        }
      });


      $(document).off('click', '.btn_edit_actividad').on('click', '.btn_edit_actividad',function(event) {
         $("#hash_actividad").val("");
         hash=$(this).attr("data-id");
         $(".btn_ingresa_actividad").html('<i class="fa fa-edit"></i> Modificar');
         $('#formActividad')[0].reset();
         $("#hash_actividad").val("");
         $("#formActividad input,#formActividad select,#formActividad button,#formActividad").prop("disabled", true);

          $.ajax({
            url: "getDataActividad"+"?"+$.now(),  
            type: 'POST',
            cache: false,
            tryCount : 0,
            retryLimit : 3,
            data:{hash:hash},
            dataType:"json",
            beforeSend:function(){
            /*  $(".btn_ingresa_actividad").prop("disabled",true); 
             $(".cierra_mod_modelos").prop("disabled",true);  */
            },
            success: function (data) {
              if(data.res=="ok"){
                for(dato in data.datos){
                  $("#hash_actividad").val(data.datos[dato].hash_vac);
                  $("#actividad").val(data.datos[dato].actividad);
                  $("#tipo").val(data.datos[dato].tipo);
                  $("#unidad option[value='"+data.datos[dato].unidad+"'").prop("selected", true);
                  $("#rango").val(data.datos[dato].rango);
                }
                $("#formActividad input,#formActividad select,#formActividad button,#formActividad").prop("disabled", false);
                $(".cierra_mod_modelos").prop("disabled", false);
                $(".btn_ingresa_actividad").prop("disabled", false);   
               
              }
            },
            error : function(xhr, textStatus, errorThrown ) {
              if (textStatus == 'timeout') {
                  this.tryCount++;
                  if (this.tryCount <= this.retryLimit) {
                      $.notify("Reintentando...", {
                        className:'info',
                        globalPosition: 'top right'
                      });
                      $.ajax(this);
                      return;
                  } else{
                     $.notify("Problemas en el servidor, intente nuevamente.", {
                        className:'warn',
                        globalPosition: 'top right'
                      });     
                      $('#modal_nuevo_actividad').modal("toggle");
                  }    
                  return;
              }

              if (xhr.status == 500) {
                  $.notify("Problemas en el servidor, intente más tarde.", {
                    className:'warn',
                    globalPosition: 'top right'
                  });
                  $('#modal_nuevo_actividad').modal("toggle");
              }
          },timeout:5000
        }); 
      });
  



  /*********MMC*****/   
    var indexLastColumn = $("#listammc").find('tr')[0].cells.length-1;

    var listammc = $('#listammc').DataTable({
      "order":[[indexLastColumn,'desc']],
      "scrollY": "65vh",
      "scrollX": true,
      "sAjaxDataProp": "result",        
      "bDeferRender": true,
      "select" : true,
      "responsive" : false,
      "columnDefs": [{ orderable: false, targets: 0 }  ],
      "ajax": {
        "url":"<?php echo base_url();?>listaMmc",
        "dataSrc": function (json) {
          $(".btn_filtro_mmc").html('<i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar');
          $(".btn_filtro_mmc").prop("disabled" , false);
          return json;
        },       
        data: function(param){
          /*  param.estado = estado; */
        }
      },    
      "columns": [
        {
          "class":"centered center margen-td","data": function(row,type,val,meta){
            btn='<center><a data-hash_mmc="'+row.hash_mmc+'" title="Modificar" class="fa fa-edit btn_modificar_mmc"></a>';
            
            if(perfil==1){
              btn+='<a href="#" data-placement="top" data-toggle="tooltip" title="Eliminar" class="fa fa-trash borrar_mmc" data-hash_mmc="'+row.hash_mmc+'"></a></center>';
            }
            
            return btn;
          }
        },
        { "data": "tipo", "class": "margen-td centered" },
        { "data": "marca", "class": "margen-td centered" },
        { "data": "modelo", "class": "margen-td centered" },
        { "data": "combustible", "class": "margen-td centered" },
        { "data": "ultima_actualizacion", "class": "margen-td centered" },
      ]
    }); 
  
    $(document).on('keyup paste', '#buscador_mmc', function() {
      listammc.search($(this).val().trim()).draw();
    });

    $(document).off('click', '.btn_filtro_mmc').on('click', '.btn_filtro_mmc',function(event) {
      event.preventDefault();
        $(this).prop("disabled" , true);
        $(".btn_filtro_mmc").html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span class="sr-only"></span> Filtrando');
        listammc.ajax.reload();
    });

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }
 
    function ajustarColumnas() {
      function ajustarTabla(nombreTabla) {
        var tablas = $.fn.dataTable.fnTables(true);
        var tabla = $(tablas).filter(function() {
          return $(this).data('name') === nombreTabla;
        });

        if (tabla.length > 0) {
          tabla.dataTable().fnAdjustColumnSizing();
        }
      }
      const tablasAjustar = ['listammc'];

      tablasAjustar.forEach(nombreTabla => {
        setTimeout(() => {
          ajustarTabla(nombreTabla);
        }, 1000);
      });

      tablasAjustar.forEach(nombreTabla => {
        setTimeout(() => {
          ajustarTabla(nombreTabla);
        }, 3000);
      });
    }

    ajustarColumnas()

    $(document).off('click', '#mantenedor_mmc').on('click', '#mantenedor_mmc',function(event) {
      $('#modal_mmc').modal('toggle'); 
      $(".btn_nuevo_mmc").html('<i class="fa fa-save"></i> Guardar');
      $(".btn_nuevo_mmc").attr("disabled", false);
      $('#formMmc')[0].reset();
      $("#hash_mmc").val("");
      listammc.ajax.reload();
    });     
    
    $(document).off('click', '.btn_nuevo_mmc').on('click', '.btn_nuevo_mmc',function(event) {
        $('#modal_mmc').modal('toggle'); 
        $(".btn_guardar_mmc").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_guardar_mmc").attr("disabled", false);
        $(".cierra_modal_mmc").attr("disabled", false);
        $(".eliminar_modal_mmc").attr("disabled", false);
        $('#formMmc')[0].reset();
        $("#hash_mmc").val("");
        $("#formMmc input,#formMmc select,#formMmc button,#formMmc").prop("disabled", false);
        $(".cont_edit").hide();
    });     

    $(document).off('submit', '#formMmc').on('submit', '#formMmc',function(event) {
      event.preventDefault();
      var $form = $('#formMmc');
      var formData = new FormData($form[0]);
      var $buttons = $(".btn_guardar_mmc, .cierra_modal_mmc, .eliminar_modal_mmc");
      var $inputs = $form.find('input, select, button');
     /*  $buttons.add($inputs).prop("disabled", true); */
      
      $.ajax({
        url: $form.attr('action') + "?" + $.now(),
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        dataType: "json",
        contentType: false,
        success: function(data) {
          $buttons.add($inputs).prop("disabled", false);
          var className = data.res === "error" ? 'error' : 'success';
          showNotify(data.msg, className);
          
          if (data.res === "ok") {
            /* $('#modal_mmc').modal("toggle"); */
            $("#hash_mmc").val("");
            listammc.ajax.reload();
            $('#formMmc')[0].reset();
          }
        },

        error: function(xhr, textStatus, errorThrown) {
          $buttons.add($inputs).prop("disabled", false);
          var message, className;
          if (textStatus === 'timeout') {
            message = "Reintentando...";
            className = 'info';
          } else if (xhr.status === 500) {
            message = "Problemas en el servidor, intente más tarde.";
            className = 'warn';
          }

          showNotify(message, className);

          if (textStatus === 'timeout' || xhr.status === 500) {
            $('#modal_mmc').modal("toggle");
          }
        },
        timeout: 25000
      });
    });

    $(document).off('click', '.btn_modificar_mmc').on('click', '.btn_modificar_mmc',function(event) {
      $('#formMmc')[0].reset();
      $(".cont_edit").show();
      $("#hash_mmc").val("");
      hash_mmc = $(this).attr("data-hash_mmc");
      $("#hash_mmc").val(hash_mmc);
        
      $.ajax({
        url: "getDataMmc"+"?"+$.now(),  
        type: 'POST',
        cache: false,
        tryCount : 0,
        retryLimit : 3,
        data:{hash_mmc : hash_mmc},
        dataType:"json",
        beforeSend:function(){
          $(".btn_guardar_mmc").attr("disabled", true);
          $(".cierra_modal_mmc").attr("disabled", true);
          $(".eliminar_modal_mmc").attr("disabled", true);
          $("#formMmc input,#formMmc select,#formMmc button,#formMmc").prop("disabled", true);
        },
        success: function (data) {
          $(".btn_guardar_mmc").attr("disabled", false);
          $(".cierra_modal_mmc").attr("disabled", false);
          $(".eliminar_modal_mmc").attr("disabled", false);
          $("#formMmc input,#formMmc select,#formMmc button,#formMmc").prop("disabled", false);
        
          if(data.res=="ok"){
            for(dato in data.datos){
            
              $("#tipo  option[value='"+data.datos[dato].id_tipo+"'").prop("selected", true);
              $("#marca  option[value='"+data.datos[dato].id_marca+"'").prop("selected", true);
              $("#modelo  option[value='"+data.datos[dato].id_modelo+"'").prop("selected", true);
              $("#combustible  option[value='"+data.datos[dato].id_combustible+"'").prop("selected", true);
 
            } 
          }
 
        },

        error : function(xhr, textStatus, errorThrown ) {
          if (textStatus == 'timeout') {
              this.tryCount++;
              if (this.tryCount <= this.retryLimit) {
                  $.notify("Reintentando...", {
                    className:'info',
                    globalPosition: 'top right'
                  });
                  $.ajax(this);
                  return;
              } else{
                 $.notify("Problemas en el servidor, intente nuevamente.", {
                    className:'warn',
                    globalPosition: 'top right'
                  });     
                  $('#modal_mmc').modal("toggle");
              }    
              return;
          }

          if (xhr.status == 500) {
              $.notify("Problemas en el servidor, intente más tarde.", {
                className:'warn',
                globalPosition: 'top right'
              });
              $('#modal_mmc').modal("toggle");
          }
        },timeout:25000
      }); 
    });

    $(document).off('click', '.borrar_mmc').on('click', '.borrar_mmc',function(event) {
      var hash_mmc=$(this).attr("data-hash_mmc");
        if(confirm("¿Esta seguro que desea eliminar este registro?")){

          $.post('eliminaMmc'+"?"+$.now(),{"hash_mmc": hash_mmc}, function(data) {

            if(data.res=="ok"){

              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });

              listammc.ajax.reload();

            }else{
              $.notify(data.msg, {
                className:'danger',
                globalPosition: 'top right'
              });
            }

          },"json");
      }
    });
    
  /*********MARCAS************/

    var tabla_marcas = $('#tabla_marcas').DataTable({
      //"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
      "bPaginate": false,
      "aaSorting" : [1,"asc"],
      //"stateSave": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": false,
      "bProcessing": false,
      "pagingType": false , 
      //"responsive":true,
      // "scrollY": 220,
      // "scrollX": true,
      "oLanguage": { 
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar: _MENU_ ",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
        "sInfoEmpty":      "Sin registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "",     
        "sSearchPlaceholder": "Busqueda",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
        "bAutoWidth": true,
        "sAjaxDataProp": "result",        
        "bDeferRender": true,
        "ajax": {
          "url":"<?php echo base_url();?>listaMarcas",
          "dataSrc": function (json) {
              return json;
          },       
          data: function(param){
          }
        },    

        "columns": [
          {
            "class":"centered","width":"50px","data": function(row,type,val,meta){
              btn='<center><a data-id="'+row.hash_vma+'"  class="btn_edit_marca"><i class="fa fa-edit" ></i> </a>';
              btn+='<a data-id="'+row.hash_vma+'"  class="btn_del_marca"><i class="fa fa-trash" ></i> </a></center>';
              return btn;
            }
          }, 
          { "data": "marca" ,"width":"40%","class":"margen-td centered"},
          { "data": "estado" ,"width":"10%","class":"margen-td centered"},
        ]
      }); 

    setTimeout( function () {
      var tabla_marcas = $.fn.dataTable.fnTables(true);
      if ( tabla_marcas.length > 0 ) {
          $(tabla_marcas).dataTable().fnAdjustColumnSizing();
    }}, 100 ); 

    setTimeout( function () {
      var tabla_marcas = $.fn.dataTable.fnTables(true);
      if ( tabla_marcas.length > 0 ) {
          $(tabla_marcas).dataTable().fnAdjustColumnSizing();
    }}, 1100 ); 
          
    $(document).off('click', '#mantenedor_marcas').on('click', '#mantenedor_marcas',function(event) {
      $('#modal_nuevo_marcas').modal('toggle'); 
      $(".btn_ingresa_marcas").html('<i class="fa fa-save"></i> Guardar');
      $(".btn_ingresa_marcas").attr("disabled", false);
      $('#formMarca')[0].reset();
      $("#hash_marca").val("");
      tabla_marcas.ajax.reload();
    });     
    
    $(document).off('submit', '#formMarca').on('submit', '#formMarca',function(event) {
      var url="<?php echo base_url()?>";
      var formElement = document.querySelector("#formMarca");
      var formData = new FormData(formElement);
        $.ajax({
            url: $('#formMarca').attr('action')+"?"+$.now(),  
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            dataType: "json",
            contentType : false,
            beforeSend:function(){
              /* $(".btn_ingresa_marcas").attr("disabled", true); */
            },
            success: function (data) {
              $(".btn_ingresa_marcas").attr("disabled", false);

              if(data.res == "error"){
            
                  $.notify(data.msg, {
                    className:'error',
                    globalPosition: 'top right',
                    autoHideDelay:10000,
                  });
              }else if(data.res == "ok"){
                  $.notify(data.msg, {
                    className:'success',
                    globalPosition: 'top right',
                    autoHideDelay:2000,
                  });
                  $(".btn_ingresa_marcas").html('<i class="fa fa-save"></i> Guardar');
                  $("#hash_marca").val("");
                setTimeout(function(){ 
                  $('#formMarca')[0].reset();
                  tabla_marcas.ajax.reload();
                } ,2000);  
              }
            }
        });
        return false; 
    });

    $(document).off('click', '.btn_del_marca').on('click', '.btn_del_marca',function(event) {
      hash=$(this).attr("data-id");
      if(confirm("¿Esta seguro que desea cambiar el estado?")){
          $.post('eliminarMarca'+"?"+$.now(), {hash : hash} ,function(data) {
            if(data.res=="ok"){
              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });
            tabla_marcas.ajax.reload();
            }else{
              $.notify(data.msg, {
                className:'danger',
                globalPosition: 'top right'
              });
            }
          },"json");
        }
    });


    $(document).off('click', '.btn_edit_marca').on('click', '.btn_edit_marca',function(event) {
      $("#hash").val("");
      hash=$(this).attr("data-id");
      $(".btn_ingresa_marcas").html('<i class="fa fa-edit"></i> Modificar');
      $('#formMarca')[0].reset();
      $("#hash_marca").val("");
      $(".cierra_mod_marca").prop("disabled", false);
      $("#formMarca input,#formMarca select,#formMarca button,#formMarca").prop("disabled", true);

        $.ajax({
          url: "getDataMarca"+"?"+$.now(),  
          type: 'POST',
          cache: false,
          tryCount : 0,
          retryLimit : 3,
          data:{hash:hash},
          dataType:"json",
          beforeSend:function(){
          /*  $(".btn_ingresa_marcas").prop("disabled",true); 
          $(".cierra_mod_marca").prop("disabled",true);  */
          },
          success: function (data) {
            if(data.res=="ok"){
              for(dato in data.datos){
                $("#hash_marca").val(data.datos[dato].hash_vma);
                $("#marca_ma").val(data.datos[dato].marca);
                $("#estado_ma option[value='"+data.datos[dato].estado+"'").prop("selected", true);
              }
              $("#formMarca input,#formMarca select,#formMarca button,#formMarca").prop("disabled", false);
              $(".cierra_mod_marca").prop("disabled", false);
              $(".btn_ingresa_marcas").prop("disabled", false);   
            
            }


          },
          error : function(xhr, textStatus, errorThrown ) {
            if (textStatus == 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.notify("Reintentando...", {
                      className:'info',
                      globalPosition: 'top right'
                    });
                    $.ajax(this);
                    return;
                } else{
                  $.notify("Problemas en el servidor, intente nuevamente.", {
                      className:'warn',
                      globalPosition: 'top right'
                    });     
                    $('#modal_nueva_marca').modal("toggle");
                }    
                return;
            }

            if (xhr.status == 500) {
                $.notify("Problemas en el servidor, intente más tarde.", {
                  className:'warn',
                  globalPosition: 'top right'
                });
                $('#modal_nueva_marca').modal("toggle");
            }
        },timeout:5000
      }); 
    });


  

  /*********MODELOS************/

    var tabla_modelos = $('#tabla_modelos').DataTable({
      //"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
      "bPaginate": false,
      "aaSorting" : [1,"asc"],
      //"stateSave": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": false,
      "bProcessing": false,
      "pagingType": false , 
      //"responsive":true,
      // "scrollY": 220,
      // "scrollX": true,
      "oLanguage": { 
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar: _MENU_ ",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
        "sInfoEmpty":      "Sin registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "",     
        "sSearchPlaceholder": "Busqueda",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
        "bAutoWidth": true,
        "sAjaxDataProp": "result",        
        "bDeferRender": true,
        "ajax": {
          "url":"<?php echo base_url();?>listaModelos",
          "dataSrc": function (json) {
              return json;
          },       
          data: function(param){
          }
        },    

        "columns": [
          {
            "class":"centered","width":"50px","data": function(row,type,val,meta){
              btn='<center><a data-id="'+row.hash_vmo+'"  class="btn_edit_modelo"><i class="fa fa-edit" ></i> </a>';
              btn+='<a data-id="'+row.hash_vmo+'"  class="btn_del_modelo"><i class="fa fa-trash" ></i> </a></center>';
              return btn;
            }
          }, 
          { "data": "marca" ,"width":"40%","class":"margen-td centered"},
          { "data": "modelo" ,"width":"40%","class":"margen-td centered"},
          { "data": "estado" ,"width":"10%","class":"margen-td centered"},
        ]
      }); 

      setTimeout( function () {
        var tabla_modelos = $.fn.dataTable.fnTables(true);
        if ( tabla_modelos.length > 0 ) {
            $(tabla_modelos).dataTable().fnAdjustColumnSizing();
      }}, 100 ); 

      setTimeout( function () {
        var tabla_modelos = $.fn.dataTable.fnTables(true);
        if ( tabla_modelos.length > 0 ) {
            $(tabla_modelos).dataTable().fnAdjustColumnSizing();
      }}, 1100 ); 
            
      $(document).off('click', '#mantenedor_modelos').on('click', '#mantenedor_modelos',function(event) {
        $('#modal_nuevo_modelos').modal('toggle'); 
        $(".btn_ingresa_modelos").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_ingresa_modelos").attr("disabled", false);
        $(".cierra_mod_modelos").attr("disabled", false);
        $('#formModelo')[0].reset();
        $("#hash_modelo").val("");
        tabla_modelos.ajax.reload();
      });     
      
      $(document).off('submit', '#formModelo').on('submit', '#formModelo',function(event) {
        var url="<?php echo base_url()?>";
        var formElement = document.querySelector("#formModelo");
        var formData = new FormData(formElement);
          $.ajax({
              url: $('#formModelo').attr('action')+"?"+$.now(),  
              type: 'POST',
              data: formData,
              cache: false,
              processData: false,
              dataType: "json",
              contentType : false,
              beforeSend:function(){
                /* $(".btn_ingresa_modelos").attr("disabled", true);
                $(".cierra_mod_modelos").attr("disabled", true); */
              },
              success: function (data) {
                $(".btn_ingresa_modelos").attr("disabled", false);
                $(".cierra_mod_modelos").attr("disabled", false);   

                if(data.res == "error"){
              
                    $.notify(data.msg, {
                      className:'error',
                      globalPosition: 'top right',
                      autoHideDelay:10000,
                    });
                }else if(data.res == "ok"){
                    $.notify(data.msg, {
                      className:'success',
                      globalPosition: 'top right',
                      autoHideDelay:2000,
                    });
                    $(".btn_ingresa_modelos").html('<i class="fa fa-save"></i> Guardar');
                    $("#hash_modelo").val("");
                   setTimeout(function(){ 
                    $('#formModelo')[0].reset();
                    tabla_modelos.ajax.reload();
                   } ,2000);  
                }
              }
          });
          return false; 
      });

      $(document).off('click', '.btn_del_modelo').on('click', '.btn_del_modelo',function(event) {
        hash=$(this).attr("data-id");
        if(confirm("¿Esta seguro que desea cambiar el estado?")){
            $.post('eliminarModelo'+"?"+$.now(), {hash : hash} ,function(data) {
              if(data.res=="ok"){
                $.notify(data.msg, {
                  className:'success',
                  globalPosition: 'top right'
                });
              tabla_modelos.ajax.reload();
              }else{
                $.notify(data.msg, {
                  className:'danger',
                  globalPosition: 'top right'
                });
              }
            },"json");
          }
       });


      $(document).off('click', '.btn_edit_modelo').on('click', '.btn_edit_modelo',function(event) {
         $("#hash").val("");
         hash=$(this).attr("data-id");
         $(".btn_ingresa_modelos").html('<i class="fa fa-edit"></i> Modificar');
         $('#formModelo')[0].reset();
         $("#hash_modelo").val("");
         $(".cierra_mod_modelos").prop("disabled", false);
         $("#formModelo input,#formModelo select,#formModelo button,#formModelo").prop("disabled", true);

          $.ajax({
            url: "getDataModelo"+"?"+$.now(),  
            type: 'POST',
            cache: false,
            tryCount : 0,
            retryLimit : 3,
            data:{hash:hash},
            dataType:"json",
            beforeSend:function(){
            /*  $(".btn_ingresa_modelos").prop("disabled",true); 
             $(".cierra_mod_modelos").prop("disabled",true);  */
            },
            success: function (data) {
              if(data.res=="ok"){
                for(dato in data.datos){
                  $("#hash_modelo").val(data.datos[dato].hash_vmo);
                  $("#marca_m option[value='"+data.datos[dato].id_marca+"'").prop("selected", true);
                  $("#modelo_m").val(data.datos[dato].modelo);
                  $("#estado_m option[value='"+data.datos[dato].estado+"'").prop("selected", true);
                }
                $("#formModelo input,#formModelo select,#formModelo button,#formModelo").prop("disabled", false);
                $(".cierra_mod_modelos").prop("disabled", false);
                $(".btn_ingresa_modelos").prop("disabled", false);   
               
              }

  
            },
            error : function(xhr, textStatus, errorThrown ) {
              if (textStatus == 'timeout') {
                  this.tryCount++;
                  if (this.tryCount <= this.retryLimit) {
                      $.notify("Reintentando...", {
                        className:'info',
                        globalPosition: 'top right'
                      });
                      $.ajax(this);
                      return;
                  } else{
                     $.notify("Problemas en el servidor, intente nuevamente.", {
                        className:'warn',
                        globalPosition: 'top right'
                      });     
                      $('#modal_nuevo_modelos').modal("toggle");
                  }    
                  return;
              }

              if (xhr.status == 500) {
                  $.notify("Problemas en el servidor, intente más tarde.", {
                    className:'warn',
                    globalPosition: 'top right'
                  });
                  $('#modal_nuevo_modelos').modal("toggle");
              }
          },timeout:5000
        }); 
      });
  
 
 
  /********OTROS**********/
    

    $(document).off('click', '.excel_vehiculos').on('click', '.excel_vehiculos',function(event) {
      event.preventDefault();
       
      if ($('.check_estado').is(":checked")){
        estado=0;
      }else{
        estado=1;
      }

      window.location="excelUsuarios/"+estado;
    });


    function showNotify(message, className) {
      $.notify(message, {
        className: className,
        globalPosition: 'top right',
        autoHideDelay: 5000,
      });
    }

  })
 
</script>

<!-- FILTROS -->
  
  <div class="form-row">

    <!-- <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1 no-padding">  
       <input type="file" id="userfile" name="userfile" class="file_cs" style="display:none;" />
       <button type="button" class="allwidth btn btn-danger btn-sm btn_file_cs" value="" onclick="document.getElementById('userfile').click();">
       <span class="glyphicon glyphicon-folder-open" style="margin-right:5px!important;"></span> CSV</button>
    </div> -->

    <!-- <div class="col-6 col-lg-1">  
      <div class="form-group">
         <button type="button" class="btn btn-block btn-sm btn-primary btn_nuevo_mmc btn_xr3">
         <i class="fa fa-plus-circle"></i>  Crear 
         </button>
      </div>
    </div> -->

    <div class="col-6 col-lg-3">  
     <div class="form-group">
      <input type="text" placeholder="Busqueda" id="buscador_mmc" class="buscador_mmc form-control form-control-sm">
     </div>
    </div>

    <div class="col-6 col-lg-1">
      <div class="form-group">
       <button type="button" class="btn-block btn btn-sm btn-primary btn_filtro_mmc btn_xr3">
       <i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar
       </button>
     </div>
    </div>

    <div class="col-6 col-lg-2">
      <div class="form-group">
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-table fa-1x"></i><span class="sr-only"></span> Mantenedores
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#" id="mantenedor_mat">Asignacion Actividades a tipos</a>
            <a class="dropdown-item" href="#" id="mantenedor_actividades">Actividades mantenciones</a>
            <a class="dropdown-item" href="#" id="mantenedor_mmc">Tipo/marca/modelo/comb</a>
            <a class="dropdown-item" href="#" id="mantenedor_marcas">Marcas</a>
            <a class="dropdown-item" href="#" id="mantenedor_modelos">Modelos</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>            

<!-- LISTADO -->
ASDAS

<!-- ACTIVIDADES ASIGNACION TIPOS -->

  <div id="modal_mat" class="modal fade"  data-backdrop="static" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal_mat">
      <div class="modal-content">
        <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        
          <fieldset class="form-ing-cont">
            <legend class="form-ing-border">Formulario de asignación de actividades de mantenciones</legend>
            <?php echo form_open_multipart("formMat",array("id"=>"formMat","class"=>"formMat"))?>
            <input type="hidden" name="hash_mat" id="hash_mat">
            <div class="form-row">  

      
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="tipo_mat" class="col-sm-12 col-form-label col-form-label-sm">Tipo</label>
                  <select id="tipo_mat" name="tipo_mat" style="width:100%!important;">
                 <!--  <option>Seleccione tipo</option> -->
                  </select>
                </div>
              </div>

              <div class="col-lg-1">  
                <div class="form-group">
                  <label for="desde_mat" class="col-sm-12 col-form-label col-form-label-sm">Desde</label>
                    <select name="desde_mat" id="desde_mat" class="form-control form-control-sm">
                        <?php
                        $anio_actual = date("Y");

                        // Genera opciones desde el año 2000 hasta el año actual
                        for ($anio = 2000; $anio <= $anio_actual; $anio++) {
                            echo "<option value='$anio'>$anio</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>

              <div class="col-lg-1">  
                <div class="form-group">
                  <label for="desde_mat" class="col-sm-12 col-form-label col-form-label-sm">Desde</label>
                    <select name="hasta_mat" id="hasta_mat" class="form-control form-control-sm">
                        <?php
                        $anio_actual = date("Y");

                        // Genera opciones desde el año 2000 hasta el año actual
                        for ($anio = 2000; $anio <= $anio_actual; $anio++) {
                            echo "<option value='$anio'>$anio</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>

              <div class="col-lg-3">  
                <div class="form-group">
                  <label for="actividad_mat" class="col-sm-12 col-form-label col-form-label-sm">Actividad</label>
                  <select id="actividad_mat" name="actividad_mat" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($actividades as $act) { ?>
                      <option value="<?php echo $act["id"]; ?>"><?php echo $act["actividad"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

             <!--  <div class="col-lg-1">  
                <div class="form-group">
                  <label for="unidad_mat" class="col-sm-12 col-form-label col-form-label-sm">Unidad</label>
                      <select  name="unidad_mat" id="unidad_mat" class="unidad_mat custom-select custom-select-sm">
                      <option  value="km" selected>km</option>
                      <option  value="vencimiento">Venc.</option>
                      <option  value="correctivo">Correctivo</option>
                    </select>
                </div>
              </div>  -->

              <div class="col-lg-2">
                <div class="form-group">
                  <label for="rango_mat" class="col-sm-12 col-form-label col-form-label-sm">Rango</label>
                  <input placeholder="rango" type="text" size="8" maxlength="8" name="rango_mat" id="rango_mat" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>
 
              <div class="col-lg-1">  
                <div class="form-group">
                  <label for="estado_mat" class="col-sm-12 col-form-label col-form-label-sm">Estado</label>
                      <select  name="estado_mat" id="estado_mat" class="custom-select custom-select-sm">
                      <option  value="activo" selected>Activo</option>
                      <option  value="noactivo">No activo</option>
                    </select>
                </div>
              </div> 

            </div>

            <div class="col-lg-4 offset-lg-4 mt-2">
              <div class="form-row">
                <div class="col-12">
                  <div class="form-group">
                    <button type="submit" class="btn-block btn btn-sm btn-primary btn_ingresa_mact">
                      <i class="fa fa-plus-circle"></i> Guardar
                    </button>
                  </div>
                </div>
              </div> 
            </div>  

            <?php echo form_close(); ?>
          </fieldset>

          <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Listado de asignación de actividades de mantenciones</legend>

            <div class="row">
              <div class="col-lg-12">
                <table id="tabla_mat" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th class="centered">Acciones</th>
                      <th class="centered">Tipo</th>  
                      <th class="centered">Desde-hasta</th>
                      <th class="centered">Actividad </th>  
                      <th class="centered">Unidad </th>  
                      <th class="centered">Rango (Cada) </th>  
                      <th class="centered">Estado  </th>  

                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </fieldset>

        </div>
      </div>
    </div>


<!-- ACTIVIDADES -->
  <div id="modal_nuevo_actividad" class="modal fade"  data-backdrop="static" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal_nuevo_actividad">
      <div class="modal-content">
        <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        
          <fieldset class="form-ing-cont">
            <legend class="form-ing-border">Formulario de actividades de mantenciones</legend>
            <?php echo form_open_multipart("formActividad",array("id"=>"formActividad","class"=>"formActividad"))?>
            <input type="hidden" name="hash_actividad" id="hash_actividad">
            <div class="form-row">  

              <div class="col-lg-4">
                <div class="form-group">
                  <label for="actividad" class="col-sm-12 col-form-label col-form-label-sm">Actividad</label>
                  <input placeholder="Actividad" type="text" name="actividad" id="actividad" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-2">  
                <div class="form-group">
                  <label for="tipo_a" class="col-sm-12 col-form-label col-form-label-sm">Tipo</label>
                      <select  name="tipo_a" id="tipo_a" class="tipo_a custom-select custom-select-sm">
                      <option  value="automatico" selected>Automatico</option>
                      <option  value="manual">Manual</option>
                    </select>
                </div>
              </div> 

              <div class="col-lg-2">  
                <div class="form-group">
                  <label for="unidad" class="col-sm-12 col-form-label col-form-label-sm">Unidad</label>
                      <select  name="unidad" id="unidad" class="unidad custom-select custom-select-sm">
                      <option  value="km" selected>km</option>
                      <option  value="vencimiento">Venc.</option>
                      <option  value="correctivo">Correctivo</option>
                    </select>
                </div>
              </div> 

              <div class="col-lg-2">
                <div class="form-group">
                  <label for="rango" class="col-sm-12 col-form-label col-form-label-sm">Rango</label>
                  <input placeholder="rango" type="text" name="rango" id="rango" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-2">  
                <div class="form-group">
                  <label for="estado_a" class="col-sm-12 col-form-label col-form-label-sm">Estado</label>
                      <select  name="estado_a" id="estado_a" class="estado_a custom-select custom-select-sm">
                      <option  value="activo" selected>Activo</option>
                      <option  value="noactivo">No activo</option>
                    </select>
                </div>
              </div> 

            </div>

            <div class="col-lg-4 offset-lg-4 mt-2">
              <div class="form-row">
                <div class="col-12">
                  <div class="form-group">
                    <button type="submit" class="btn-block btn btn-sm btn-primary btn_ingresa_actividad">
                      <i class="fa fa-plus-circle"></i> Guardar
                    </button>
                  </div>
                </div>
              </div> 
            </div>  

            <?php echo form_close(); ?>
          </fieldset>

          <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Listado de actividades de mantenciones</legend>

            <div class="row">
              <div class="col-lg-12">
                <table id="tabla_actividades" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th class="centered">Acciones</th>
                      <th class="centered">Actividad de mantención</th>  
                      <th class="centered">Tipo </th>  
                      <th class="centered">Unidad </th>  
                      <th class="centered">Rango (Cada) </th>  
                      <th class="centered">Estado</th>  
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </fieldset>

        </div>
      </div>
    </div>




<!-- MMC-->

  <div id="modal_mmc" class="modal fade"  data-backdrop="static" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal_mmc">
      <div class="modal-content">
        <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        
        <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Formulario tipo/marca/modelo/combustible</legend>
          <?php echo form_open_multipart("formMmc",array("id"=>"formMmc","class"=>"formMmc"))?>
          <input type="hidden" name="hash_mmc" id="hash_mmc">
          <div class="form-row">  

            <div class="col-lg-3">
              <div class="form-group">
                <label for="tipo" class="col-sm-12 col-form-label col-form-label-sm">Tipo</label>
                <select id="tipo" name="tipo" class="custom-select custom-select-sm">
                  <option value="" selected>Seleccione</option>
                  <?php foreach ($tipos as $t) { ?>
                    <option value="<?php echo $t["id"]; ?>"><?php echo $t["tipo"]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="marca" class="col-sm-12 col-form-label col-form-label-sm">Marca</label>
                <select id="marca" name="marca" class="custom-select custom-select-sm">
                  <option value="" selected>Seleccione</option>
                  <?php foreach ($marcas as $ma) { ?>
                    <option value="<?php echo $ma["id"]; ?>"><?php echo $ma["marca"]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="modelo" class="col-sm-12 col-form-label col-form-label-sm">Modelos</label>
                <select id="modelo" name="modelo" class="custom-select custom-select-sm">
                  <option value="" selected>Seleccione</option>
                  <?php foreach ($modelos as $mo) { ?>
                    <option value="<?php echo $mo["id"]; ?>"><?php echo $mo["modelo"]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="combustible" class="col-sm-12 col-form-label col-form-label-sm">Combustible</label>
                <select id="combustible" name="combustible" class="custom-select custom-select-sm">
                  <option value="" selected>Seleccione</option>
                  <?php foreach ($combustibles as $c) { ?>
                    <option value="<?php echo $c["id"]; ?>"><?php echo $c["combustible"]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-4 offset-lg-4 mt-2">
            <div class="form-row">
              <div class="col-12">
                <div class="form-group">
                  <button type="submit" class="btn-block btn btn-sm btn-primary btn_guardar_mmc">
                    <i class="fa fa-plus-circle"></i> Guardar
                  </button>
                </div>
              </div>
            </div> 
          </div>  

          <?php echo form_close(); ?>
        </fieldset>

        <fieldset class="form-ing-cont">
        <legend class="form-ing-border">Listado de tipo/marca/modelo/combustible</legend>

          <div class="row">
            <div class="col-lg-12">
              <table id="listammc" class="tablaUsuarios table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>    
                    <th class="centered" style="width: 50px;">Acciones</th>    
                    <th class="centered">Tipo</th>
                    <th class="centered">Marca</th>
                    <th class="centered">Modelo</th>
                    <th class="centered">Combustible</th>
                    <th class="centered">&Uacute;ltima actualizaci&#243;n</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

        </fieldset>

      </div>
    </div>
  </div>

  
<!-- MARCAS -->

  <div id="modal_nuevo_marcas" class="modal fade"  data-backdrop="static" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal_nuevo_marcas">
    <div class="modal-content">
      <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>
       
        <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Formulario de marcas</legend>
          <?php echo form_open_multipart("formMarca",array("id"=>"formMarca","class"=>"formMarca"))?>
          <input type="hidden" name="hash_marca" id="hash_marca">
          <div class="form-row">  

            <div class="col-lg-6">
              <div class="form-group">
                <label for="marca_ma" class="col-sm-12 col-form-label col-form-label-sm">Modelo</label>
                <input placeholder="Marca" type="text" name="marca_ma" id="marca_ma" class="form-control form-control-sm" autocomplete="off" />
              </div>
            </div>

            <div class="col-lg-6">  
              <div class="form-group">
                <label for="estado_ma" class="col-sm-12 col-form-label col-form-label-sm">Estado</label>
                    <select  name="estado_ma" id="estado_ma" class="estado_m custom-select custom-select-sm">
                     <option  value="activo" selected>Activo</option>
                    <option  value="noactivo">No activo</option>
                  </select>
              </div>
            </div> 
          </div>

          <div class="col-lg-4 offset-lg-4 mt-2">
            <div class="form-row">
              <div class="col-12">
                <div class="form-group">
                  <button type="submit" class="btn-block btn btn-sm btn-primary btn_ingresa_marcass">
                    <i class="fa fa-plus-circle"></i> Guardar
                  </button>
                </div>
              </div>
            </div> 
          </div>  

          <?php echo form_close(); ?>
        </fieldset>

        <fieldset class="form-ing-cont">
        <legend class="form-ing-border">Listado de marcas</legend>

          <div class="row">
            <div class="col-lg-12">
              <table id="tabla_marcas" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th class="centered">Acciones</th>
                    <th class="centered">Marca</th>  
                    <th class="centered">Estado</th>  
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </fieldset>

      </div>
    </div>
  </div>


<!-- MODELOS -->
 <div id="modal_nuevo_modelos" class="modal fade"  data-backdrop="static" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal_nuevo_modelos">
    <div class="modal-content">
      <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>
       
        <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Formulario de modelos</legend>
          <?php echo form_open_multipart("formModelo",array("id"=>"formModelo","class"=>"formModelo"))?>
          <input type="hidden" name="hash_modelo" id="hash_modelo">
          <div class="form-row">  

            <div class="col-lg-5">
              <div class="form-group">
                <label for="marca_m" class="col-sm-12 col-form-label col-form-label-sm">Marca</label>
                <select id="marca_m" name="marca_m" class="custom-select custom-select-sm">
                  <option value="" selected>Seleccione</option>
                  <?php foreach ($marcas as $m) { ?>
                    <option value="<?php echo $m["id"]; ?>"><?php echo $m["marca"]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="form-group">
                <label for="modelo_m" class="col-sm-12 col-form-label col-form-label-sm">Modelo</label>
                <input placeholder="Modelo" type="text" name="modelo_m" id="modelo_m" class="form-control form-control-sm" autocomplete="off" />
              </div>
            </div>

            <div class="col-lg-2">  
              <div class="form-group">
                <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Estado</label>
                    <select  name="estado_m" id="estado_m" class="estado_m custom-select custom-select-sm">
                     <option  value="activo" selected>Activo</option>
                    <option  value="noactivo">No activo</option>
                  </select>
              </div>
            </div> 
          </div>

          <div class="col-lg-4 offset-lg-4 mt-2">
            <div class="form-row">
              <div class="col-12">
                <div class="form-group">
                  <button type="submit" class="btn-block btn btn-sm btn-primary btn_ingresa_modelos">
                    <i class="fa fa-plus-circle"></i> Guardar
                  </button>
                </div>
              </div>
            </div> 
          </div>  

          <?php echo form_close(); ?>
        </fieldset>

        <fieldset class="form-ing-cont">
        <legend class="form-ing-border">Listado de modelos</legend>

          <div class="row">
            <div class="col-lg-12">
              <table id="tabla_modelos" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th class="centered">Acciones</th>
                    <th class="centered">Marca</th>  
                    <th class="centered">Modelo</th>  
                    <th class="centered">Estado</th>  
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </fieldset>

      </div>
    </div>
  </div>



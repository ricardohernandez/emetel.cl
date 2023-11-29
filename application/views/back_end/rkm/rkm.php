<style type="text/css">
  .borrar_rkm{
    color: red;
    margin-left:10px;
  }

  @media (max-width: 768px){
    .modal_rkm{
      width: 95%!important;
    }
  }

  @media (min-width: 768px){
    .modal_rkm{
      width: 85%!important;
    }
  }

      /* Estilo básico para el switch */
      .form-switch .form-check-input {
    display: none;
  }

  .form-switch .form-check-label {
    cursor: pointer;
    position: relative;
    padding-left: 40px; /* Espacio para el switch */
  }

  .form-switch .form-check-label:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 30px; /* Ancho del switch */
    height: 16px; /* Altura del switch */
    background-color: #ccc; /* Color de fondo cuando está desactivado */
    border-radius: 30px; /* Bordes redondeados */
    transition: background-color 0.3s; /* Animación de la transición de color de fondo */
  }

  .form-switch .form-check-input:checked + .form-check-label:before {
    background-color: #007bff; /* Color de fondo cuando está activado */
  }
  /* Estilo para el switch animado */
  .custom-switch .custom-control-label::before {
    width: 2rem; /* Ancho del switch */
  }

  .custom-switch .custom-control-label::after {
    top: 0.40rem; /* Ajuste vertical del switch */
  }


</style>

<script type="text/javascript">
  $(function(){

    const perfil="<?php echo $this->session->userdata('id_perfil'); ?>";
    const base = "<?php echo base_url() ?>";

    $(document).off('input', '.numbersOnly').on('input', '.numbersOnly', function (e) {
        var inputValue = $(this).val();
        inputValue = inputValue.replace(/\D/g, '');
        inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        $(this).val(inputValue);
    });

  /*****DATATABLE*****/   
    var indexLastColumn = $("#listarkm").find('tr')[0].cells.length-1;

    var listarkm = $('#listarkm').DataTable({
       "order":[[indexLastColumn,'desc']],
       "scrollY": "65vh",
       "scrollX": true,
       "sAjaxDataProp": "result",        
       "bDeferRender": true,
       "select" : true,
       "responsive" : false,
       "columnDefs": [{ orderable: false, targets: 0 }  ],
       "ajax": {
          "url":"<?php echo base_url();?>listarkm",
          "dataSrc": function (json) {
            $(".btn_filtro_rkm").html('<i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar');
            $(".btn_filtro_rkm").prop("disabled" , false);
            return json;
          },       
          data: function(param){
           /*  param.estado = estado; */
          }
        },    
       "columns": [
          {
           "class":"centered center margen-td","data": function(row,type,val,meta){
              btn='<center><a data-toggle="modal" href="#modal_rkm" data-hash="'+row.hash+'" data-placement="top" data-toggle="tooltip" title="Modificar" class="fa fa-edit btn_modificar_rkm"></a>';
              
              if(perfil==1){
                btn+='<a href="#" data-placement="top" data-toggle="tooltip" title="Eliminar" class="fa fa-trash borrar_rkm" data-hash="'+row.hash+'"></a></center>';
              }
              
              return btn;
            }
          },
          { "data": "empresa", "class": "margen-td centered" },
          { "data": "proyecto", "class": "margen-td centered" },
          { "data": "zona", "class": "margen-td centered" },
          { "data": "fecha", "class": "margen-td centered" },
          { "data": "hora", "class": "margen-td centered" },
          { "data": "rut", "class": "margen-td centered" },
          { "data": "tecnico", "class": "margen-td centered" },
          { "data": "patente", "class": "margen-td centered" },
          { "data": "kilometraje", "class": "margen-td centered" },
        ]
      }); 
  

      $(document).on('keyup paste', '#buscador_vehiculo', function() {
        listarkm.search($(this).val().trim()).draw();
      });

      $(document).off('click', '.btn_filtro_rkm').on('click', '.btn_filtro_rkm',function(event) {
        event.preventDefault();
         $(this).prop("disabled" , true);
         $(".btn_filtro_rkm").html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span class="sr-only"></span> Filtrando');
         listarkm.ajax.reload();
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
      const tablasAjustar = ['listarkm'];

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

  /*********INGRESO************/

    $(document).off('click', '.btn_nuevo_rkm').on('click', '.btn_nuevo_rkm',function(event) {
        $('#modal_rkm').modal('toggle'); 
        $(".btn_guardar_rkm").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_guardar_rkm").attr("disabled", false);
        $(".cierra_modal_rkm").attr("disabled", false);
        $(".eliminar_modal_rkm").attr("disabled", false);
        $('#formrkm')[0].reset();
        $("#hash").val("");
        $("#formrkm input,#formrkm select,#formrkm button,#formrkm").prop("disabled", false);
        $(".cont_edit").hide();
    });     

    $(document).off('submit', '#formrkm').on('submit', '#formrkm',function(event) {
      event.preventDefault();
      var $form = $('#formrkm');
      var formData = new FormData($form[0]);
      var $buttons = $(".btn_guardar_rkm, .cierra_modal_rkm, .eliminar_modal_rkm");
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
            $('#modal_rkm').modal("toggle");
            listarkm.ajax.reload();
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

          /* if (textStatus === 'timeout' || xhr.status === 500) {
            $('#modal_rkm').modal("toggle");
          } */
        },
        timeout: 25000
      });
    });

    $(document).off('click', '.btn_modificar_rkm').on('click', '.btn_modificar_rkm',function(event) {
      $(".cont_edit").show();
      $("#hash").val("");
      hash = $(this).attr("data-hash");
      $("#hash-rkm").val(hash);
        
      $.ajax({
        url: "getDatarkm"+"?"+$.now(),  
        type: 'POST',
        cache: false,
        tryCount : 0,
        retryLimit : 3,
        data:{hash : hash},
        dataType:"json",
        beforeSend:function(){
          $(".btn_guardar_rkm").attr("disabled", true);
          $(".cierra_modal_rkm").attr("disabled", true);
          $(".eliminar_modal_rkm").attr("disabled", true);
          $("#formrkm input,#formrkm select,#formrkm button,#formrkm").prop("disabled", true);
        },
        success: function (data) {
          $(".btn_guardar_rkm").attr("disabled", false);
          $(".cierra_modal_rkm").attr("disabled", false);
          $(".eliminar_modal_rkm").attr("disabled", false);
          $("#formrkm input,#formrkm select,#formrkm button,#formrkm").prop("disabled", false);
        
          if(data.res=="ok"){
            for(dato in data.datos){
              $("#id_tecnico  option[value='"+data.datos[dato].id_tecnico+"'").prop("selected", true);
              $("#id_vehiculo  option[value='"+data.datos[dato].id_vehiculo+"'").prop("selected", true);
              $("#kilometraje").val(data.datos[dato].kilometraje);
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
                  $('#modal_rkm').modal("toggle");
              }    
              return;
          }

          if (xhr.status == 500) {
              $.notify("Problemas en el servidor, intente más tarde.", {
                className:'warn',
                globalPosition: 'top right'
              });
              $('#modal_rkm').modal("toggle");
          }
        },timeout:25000
      }); 
    });

    $(document).off('click', '.borrar_rkm').on('click', '.borrar_rkm',function(event) {
      var hash=$(this).attr("data-hash");
        if(confirm("¿Esta seguro que desea eliminar este registro?")){

          $.post('eliminarkm'+"?"+$.now(),{"hash": hash}, function(data) {

            if(data.res=="ok"){

              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });

              listarkm.ajax.reload();

            }else{
              $.notify(data.msg, {
                className:'danger',
                globalPosition: 'top right'
              });
            }

          },"json");
      }
    });
    
  /********OTROS**********/
    

    $(document).off('click', '.excel_rkm').on('click', '.excel_rkm',function(event) {
      event.preventDefault();
       
      if ($('.check_estado').is(":checked")){
        estado=0;
      }else{
        estado=1;
      }

      window.location="excelrkm";
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

    <div class="col-6 col-lg-1">  
      <div class="form-group">
         <button type="button" class="btn btn-block btn-sm btn-primary btn_nuevo_rkm btn_xr3">
         <i class="fa fa-plus-circle"></i>  Crear 
         </button>
      </div>
    </div>

    <div class="col-6 col-lg-3">  
     <div class="form-group">
      <input type="text" placeholder="Busqueda" id="buscador_vehiculo" class="buscador_vehiculo form-control form-control-sm">
     </div>
    </div>

    <div class="col-6 col-lg-1">
      <div class="form-group">
       <button type="button" class="btn-block btn btn-sm btn-primary btn_filtro_rkm btn_xr3">
       <i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar
       </button>
     </div>
    </div>

    <!-- <div class="col-6 col-lg-1">  
      <div class="form-group">
       <button type="button"  class="btn-block btn btn-sm btn-primary excel_rkm btn_xr3">
       <i class="fa fa-save"></i> Excel
       </button>
      </div>
    </div> -->
    
    </div>            

<!-- LISTADO -->

  <div class="row">
    <div class="col-lg-12">
      <table id="listarkm" class="tablaUsuarios table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>    
            <th class="centered" style="width: 50px;">Acciones</th>    
            <th class="centered">Empresa</th>
            <th class="centered">Proyecto</th>
            <th class="centered">Zona</th>
            <th class="centered">Fec.Dig</th>
            <th class="centered">Hr Dig</th>
            <th class="centered">Cod.</th>
            <th class="centered">Nombre tec.</th>
            <th class="centered">Patente</th>
            <th class="centered">Kms.</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<!--  FORMULARIO-->
  <div id="modal_rkm" data-backdrop="static"  data-keyboard="false"   class="modal fade">
    <?php echo form_open_multipart("formrkm",array("id"=>"formrkm","class"=>"formrkm"))?>
    <div class="modal-dialog modal_rkm">
      <div class="modal-content"> 
      <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>

        <div class="modal-body">
          <input type="hidden" name="hash-rkm" id="hash-rkm">
          <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Datos de reporte </legend>
            <div class="form-row">

              <div class="col-lg-4">
                <div class="form-group">
                  <label for="id_tecnico" class="col-sm-12 col-form-label col-form-label-sm">Código técnico</label>
                  <select id="id_tecnico" name="id_tecnico" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($usuarios as $u) { ?>
                      <option value="<?php echo $u["id"]; ?>"><?php echo $u["rut"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label for="id_vehiculo" class="col-sm-12 col-form-label col-form-label-sm">Patente</label>
                  <select id="id_vehiculo" name="id_vehiculo" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($vehiculos as $v) { ?>
                      <option value="<?php echo $v["id"]; ?>"><?php echo $v["patente"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label for="kilometraje" class="col-sm-12 col-form-label col-form-label-sm">Kilometraje</label>
                  <input placeholder="Kilometraje" type="text" name="kilometraje" id="kilometraje" class="form-control form-control-sm numbersOnly" autocomplete="off" />
                </div>
              </div>
                  
            </div>
          </legend>
          </fieldset>

          <div class="col-lg-8 offset-lg-2 mt-3">
            <div class="form-row">
              <div class="col-6 col-lg-6">
                <div class="form-group">
                  <button type="submit" class="btn-block btn btn-sm btn-primary btn_guardar_rkm">
                   <i class="fa fa-save"></i> Guardar
                  </button>
                </div>
              </div>
              <div class="col-6 col-lg-6">
                <button class="btn-block btn btn-sm btn-secondary cierra_modal_rkm" data-dismiss="modal" aria-hidden="true">
                 <i class="fa fa-window-close"></i> Cerrar
                </button>
              </div>
            </div>
          </div>

        </div>
        
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>



 


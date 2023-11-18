<style type="text/css">
  .borrar_ticket{
    color: red;
    margin-left:10px;
  }

  @media (max-width: 768px){
    .modal_ticket{
      width: 95%!important;
    }
  }

  @media (min-width: 768px){
    .modal_ticket{
      width: 35%!important;
    }
  }

</style>

<script type="text/javascript">
  $(function(){

    const perfil="<?php echo $this->session->userdata('id_perfil'); ?>";
    const base = "<?php echo base_url() ?>";

    $(document).off('input', '.numbersOnly').on('input', '.numbersOnly', function (e) {
        var inputValue = $(this).val();
        inputValue = inputValue.replace(/,/g, '.');
        inputValue = inputValue.replace(/[^0-9.]/g, '');
        var parts = inputValue.split('.');
        if (parts.length > 2 || (parts[1] && parts[1].length !== 1)) {
            inputValue = parts[0] + (parts[1] ? '.' + parts[1][0] : '');
        }
        $(this).val(inputValue);
    });


  /*****DATATABLE*****/   
    var indexLastColumn = $("#listaTicket").find('tr')[0].cells.length-1;

    var listaTicket = $('#listaTicket').DataTable({
       "order":[[indexLastColumn,'desc']],
       "scrollY": "65vh",
       "scrollX": true,
       "sAjaxDataProp": "result",        
       "bDeferRender": true,
       "select" : true,
       "responsive" : false,
       "columnDefs": [{ orderable: false, targets: 0 }  ],
       "ajax": {
          "url":"<?php echo base_url();?>listaTicket",
          "dataSrc": function (json) {
            $(".btn_filtro_ticket").html('<i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar');
            $(".btn_filtro_ticket").prop("disabled" , false);
            return json;
          },       
          data: function(param){
           /*  param.estado = estado; */
          }
        },    
       "columns": [
          {
           "class":"centered center margen-td","data": function(row,type,val,meta){
              btn='<center><a data-toggle="modal" href="#modal_ticket" data-hash_ticket="'+row.hash_ticket+'" data-placement="top" data-toggle="tooltip" title="Modificar" class="fa fa-edit btn_modificar_ticket"></a>';
              
              if(perfil==1){
                btn+='<a href="#" data-placement="top" data-toggle="tooltip" title="Eliminar" class="fa fa-trash borrar_ticket" data-hash_ticket="'+row.hash_ticket+'"></a></center>';
              }
              
              return btn;
            }
          },
          { "data": "id", "class": "margen-td centered" },
          { "data": "patente", "class": "margen-td centered" },
          { "data": "kilometraje", "class": "margen-td centered" },
          { "data": "actividad", "class": "margen-td centered" },
          { "data": "estado", "class": "margen-td centered" },
          { "data": "empresa", "class": "margen-td centered" },
          { "data": "sucursal", "class": "margen-td centered" },
          { "data": "conductor_actual", "class": "margen-td centered" },
          { "data": "color", "class": "margen-td centered" },
          { "data": "tipo_mantenimiento", "class": "margen-td centered" },
          { "data": "observacion_mantenimiento", "class": "margen-td centered" },
          { "data": "nueva_fecha_venc", "class": "margen-td centered" },
          { "data": "proximo_km_mant", "class": "margen-td centered" },
          { "data": "ultima_actualizacion", "class": "margen-td centered" },
        ]
      }); 

      $(document).on('keyup paste', '#buscador_ticket', function() {
        listaTicket.search($(this).val().trim()).draw();
      });

      $(document).off('click', '.btn_filtro_ticket').on('click', '.btn_filtro_ticket',function(event) {
        event.preventDefault();
         $(this).prop("disabled" , true);
         $(".btn_filtro_ticket").html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span class="sr-only"></span> Filtrando');
         listaTicket.ajax.reload();
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
      const tablasAjustar = ['listaTicket'];

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

    cargaActividadesMant()
    cargaPatentesMant()

    $(document).off('click', '.btn_nuevo_ticket').on('click', '.btn_nuevo_ticket',function(event) {
        $('#modal_ticket').modal('toggle'); 
        $(".btn_guardar_ticket").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_guardar_ticket").attr("disabled", false);
        $(".cierra_modal_ticket").attr("disabled", false);
        $(".eliminar_modal_ticket").attr("disabled", false);
        $('#formTicket')[0].reset();
        $("#hash_ticket").val("");
        $("#formTicket input,#formTicket select,#formTicket button,#formTicket").prop("disabled", false);
        $(".cont_edit").hide();
        cargaActividadesMant()
        cargaPatentesMant()
    });     

    $(document).off('submit', '#formTicket').on('submit', '#formTicket',function(event) {
      event.preventDefault();
      var $form = $('#formTicket');
      var formData = new FormData($form[0]);
      var $buttons = $(".btn_guardar_ticket, .cierra_modal_ticket, .eliminar_modal_ticket");
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
            $('#modal_ticket').modal("toggle");
            listaTicket.ajax.reload();
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
            $('#modal_ticket').modal("toggle");
          } */
        },
        timeout: 25000
      });
    });

    $(document).off('click', '.btn_modificar_ticket').on('click', '.btn_modificar_ticket',function(event) {
      $(".cont_edit").show();
      $("#hash_ticket").val("");
      hash_ticket = $(this).attr("data-hash_ticket");
      $("#hash_ticket").val(hash_ticket);
      
      $.ajax({
        url: "getDataTicket"+"?"+$.now(),  
        type: 'POST',
        cache: false,
        tryCount : 0,
        retryLimit : 3,
        data:{hash_ticket : hash_ticket},
        dataType:"json",
        beforeSend:function(){
          $(".btn_guardar_ticket").attr("disabled", true);
          $(".cierra_modal_ticket").attr("disabled", true);
          $(".eliminar_modal_ticket").attr("disabled", true);
          $("#formTicket input,#formTicket select,#formTicket button,#formTicket").prop("disabled", true);
        },
        success: function (data) {
          $(".btn_guardar_ticket").attr("disabled", false);
          $(".cierra_modal_ticket").attr("disabled", false);
          $(".eliminar_modal_ticket").attr("disabled", false);
          $("#formTicket input,#formTicket select,#formTicket button,#formTicket").prop("disabled", false);
        
          if(data.res=="ok"){
            for(dato in data.datos){
     
              $("#nuevo_km").val(data.datos[dato].proximo_km_mant);
              $("#nueva_fecha").val(data.datos[dato].nueva_fecha_venc);
              $("#observacion_mant").val(data.datos[dato].observacion_mantenimiento);
              $('#patente_mantencion').val(data.datos[dato].id_vehiculo).trigger('change');
              $('#actividad_mantencion').val(data.datos[dato].id_actividad).trigger('change');
              $("#estado_mant  option[value='"+data.datos[dato].id_estado+"'").prop("selected", true);

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
                  $('#modal_ticket').modal("toggle");
              }    
              return;
          }

          if (xhr.status == 500) {
              $.notify("Problemas en el servidor, intente más tarde.", {
                className:'warn',
                globalPosition: 'top right'
              });
              $('#modal_ticket').modal("toggle");
          }
        },timeout:25000
      }); 
    });

    $(document).off('click', '.borrar_ticket').on('click', '.borrar_ticket',function(event) {
      var hash_ticket=$(this).attr("data-hash_ticket");
        if(confirm("¿Esta seguro que desea eliminar este registro?")){

          $.post('eliminaTicket'+"?"+$.now(),{"hash_ticket": hash_ticket}, function(data) {
            if(data.res=="ok"){

              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });

              listaTicket.ajax.reload();

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
     
    function showNotify(message, className) {
      $.notify(message, {
        className: className,
        globalPosition: 'top right',
        autoHideDelay: 5000,
      });
    }

    async function cargaActividadesMant() {
      $.getJSON(base + "listaActividadesMant", function(data) {
        response = data;
        }).done(function() {

        $("#actividad_mantencion").select2({
          placeholder: 'Seleccione Actividad | Todos',
          data: response,
          width: '100%',    
          allowClear: true
        });
        $('#actividad_mantencion').val(null).trigger('change.select2');

      });
    }
    

    async function cargaPatentesMant() {
      $.getJSON(base + "listaPatentesMant", function(data) {
        response = data;
        }).done(function() {

        $("#patente_mantencion").select2({
          placeholder: 'Seleccione Patente | Todos',
          data: response,
          width: '100%',    
          allowClear: true
        });
        $('#patente_mantencion').val(null).trigger('change.select2');

      });
    }

  })
 
</script>

<!-- FILTROS -->
  
  <div class="form-row">

    <div class="col-6 col-lg-1">  
      <div class="form-group">
         <button type="button" class="btn btn-block btn-sm btn-primary btn_nuevo_ticket btn_xr3">
         <i class="fa fa-plus-circle"></i>  Crear 
         </button>
      </div>
    </div>

    <div class="col-6 col-lg-3">  
     <div class="form-group">
      <input type="text" placeholder="Busqueda" id="buscador_ticket" class="buscador_ticket form-control form-control-sm">
     </div>
    </div>

    <div class="col-6 col-lg-1">
      <div class="form-group">
       <button type="button" class="btn-block btn btn-sm btn-primary btn_filtro_ticket btn_xr3">
       <i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar
       </button>
     </div>
    </div>
    
    </div>            

<!-- LISTADO -->

  <div class="row">
    <div class="col-lg-12">
      <table id="listaTicket" class="tablaUsuarios table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>    
            <th class="centered" style="width: 50px;">Acciones</th>    
            <th class="centered">N°reg.</th>
            <th class="centered">Patente</th>
            <th class="centered">Kilometraje</th>
            <th class="centered">Actividad</th>
            <th class="centered">Estado</th>
            <th class="centered">Empresa</th>
            <th class="centered">Sucursal</th>
            <th class="centered">Conductor actual</th>
            <th class="centered">Color</th>
            <th class="centered">Tipo mantenimiento</th>
            <th class="centered">Observación mantenimiento</th>
            <th class="centered">Nueva fecha venc.</th>
            <th class="centered">Nuevo km</th>
            <th class="centered">Última actualización</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<!-- FORMULARIO-->
  <div id="modal_ticket" data-backdrop="static"  data-keyboard="false"   class="modal fade">
    <?php echo form_open_multipart("formTicket",array("id"=>"formTicket","class"=>"formTicket"))?>
    <div class="modal-dialog modal_ticket">
      <div class="modal-content"> 
      <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>

        <div class="modal-body">
          <input type="hidden" name="hash_ticket" id="hash_ticket">
          <fieldset class="form-ing-cont">

          <legend class="form-ing-border">Datos del ticket de mantención </legend>
            <div class="form-row">

              <div class="col-lg-12">
                <div class="form-group">
                 <label for="patente_mantencion" class="col-sm-12 col-form-label col-form-label-sm">Patente</label>
                  <select id="patente_mantencion" name="patente_mantencion" style="width:100%!important;">
                  </select>
                </div>
              </div>
              
              <div class="col-lg-12">
                <div class="form-group">
                 <label for="actividad_mantencion" class="col-sm-12 col-form-label col-form-label-sm">Actividad de mantención</label>
                  <select id="actividad_mantencion" name="actividad_mantencion" style="width:100%!important;">
                  </select>
                </div>
              </div>
              
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="estado" class="col-sm-12 col-form-label col-form-label-sm">Estado</label>
                  <select id="estado_mant" name="estado_mant" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($estados as $e) { ?>
                      <option value="<?php echo $e["id"]; ?>"><?php echo $e["estado"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for="observacion_mant" class="col-sm-12 col-form-label col-form-label-sm">Observación mantenimiento</label>
                  <input placeholder="Observación mantenimiento" size="200" maxlength="200" type="text" name="observacion_mant" id="observacion_mant" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for="nueva_fecha" class="col-sm-12 col-form-label col-form-label-sm">Nueva fecha venc.</label>
                  <input placeholder="Nueva fecha venc."  type="date" name="nueva_fecha" id="nueva_fecha" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for="nuevo_km" class="col-sm-12 col-form-label col-form-label-sm">Nuevo km</label>
                  <input placeholder="Nuevo km" size="10" maxlength="10" type="text" name="nuevo_km" id="nuevo_km" class="numbersOnly form-control form-control-sm" autocomplete="off" />
                </div>
              </div>
      
            </div>
          </legend>
          </fieldset>

          <div class="col-lg-8 offset-lg-2 mt-3">
            <div class="form-row">
              <div class="col-6 col-lg-6">
                <div class="form-group">
                  <button type="submit" class="btn-block btn btn-sm btn-primary btn_guardar_ticket">
                   <i class="fa fa-save"></i> Guardar
                  </button>
                </div>
              </div>
              <div class="col-6 col-lg-6">
                <button class="btn-block btn btn-sm btn-secondary cierra_modal_ticket" data-dismiss="modal" aria-hidden="true">
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



 


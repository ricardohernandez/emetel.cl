<style type="text/css">
  .borrar_vehiculo{
    color: red;
    margin-left:10px;
  }

  @media (max-width: 768px){
    .modal_vehiculo{
      width: 95%!important;
    }
  }

  @media (min-width: 768px){
    .modal_vehiculo{
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
        inputValue = inputValue.replace(/,/g, '.');
        inputValue = inputValue.replace(/[^0-9.]/g, '');
        var parts = inputValue.split('.');
        if (parts.length > 2 || (parts[1] && parts[1].length !== 1)) {
            inputValue = parts[0] + (parts[1] ? '.' + parts[1][0] : '');
        }
        $(this).val(inputValue);
    });



  /*****DATATABLE*****/   
    var indexLastColumn = $("#listaVehiculos").find('tr')[0].cells.length-1;

    var listaVehiculos = $('#listaVehiculos').DataTable({
       "order":[[indexLastColumn,'desc']],
       "scrollY": "65vh",
       "scrollX": true,
       "sAjaxDataProp": "result",        
       "bDeferRender": true,
       "select" : true,
       "responsive" : false,
       "columnDefs": [{ orderable: false, targets: 0 }  ],
       "ajax": {
          "url":"<?php echo base_url();?>listaVehiculos",
          "dataSrc": function (json) {
            $(".btn_filtro_vehiculos").html('<i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar');
            $(".btn_filtro_vehiculos").prop("disabled" , false);
            return json;
          },       
          data: function(param){
           /*  param.estado = estado; */
          }
        },    
       "columns": [
          {
           "class":"centered center margen-td","data": function(row,type,val,meta){
              btn='<center><a data-toggle="modal" href="#modal_vehiculo" data-hash_vehiculo="'+row.hash_vehiculo+'" data-placement="top" data-toggle="tooltip" title="Modificar" class="fa fa-edit btn_modificar_usuario"></a>';
              
              if(perfil==1){
                btn+='<a href="#" data-placement="top" data-toggle="tooltip" title="Eliminar" class="fa fa-trash borrar_vehiculo" data-hash_vehiculo="'+row.hash_vehiculo+'"></a></center>';
              }
              
              return btn;
            }
          },
          { "data": "id", "class": "margen-td centered" },
          { "data": "estado", "class": "margen-td centered" },
          { "data": "empresa", "class": "margen-td centered" },
          { "data": "sucursal", "class": "margen-td centered" },
          { "data": "conductor_actual", "class": "margen-td centered" },
          { "data": "patente", "class": "margen-td centered" },
          { "data": "kilometraje", "class": "margen-td centered" },
          /* { "data": "tipo", "class": "margen-td centered" }, */
          { "data": "anio", "class": "margen-td centered" },
          { "data": "color", "class": "margen-td centered" },
          { "data": "tipo_mantenimiento", "class": "margen-td centered" },
          { "data": "numero_motor", "class": "margen-td centered" },
          { "data": "numero_chasis", "class": "margen-td centered" },
          { "data": "doc_perm_circ_fecha_venc", "class": "margen-td centered" },
          { "data": "doc_rev_tecnica_fecha_venc", "class": "margen-td centered" },
          { "data": "doc_rev_gases_fecha_venc", "class": "margen-td centered" },
          { "data": "doc_seguro_obli_fecha_venc", "class": "margen-td centered" },
          { "data": "doc_seguro_danos_compania", "class": "margen-td centered" },
          { "data": "doc_seguro_danios_poliza", "class": "margen-td centered" },
          { "data": "doc_seguro_danios_fecha_venc", "class": "margen-td centered" },
          { "data": "equip_tag", "class": "margen-td centered" },
          { "data": "equip_extintor", "class": "margen-td centered" },
          { "data": "equip_extintor_fecha_venc", "class": "margen-td centered" },
          { "data": "equip_neumatico_repuesto", "class": "margen-td centered" },
          { "data": "equip_botiquin", "class": "margen-td centered" },
          { "data": "equip_llave_rueda", "class": "margen-td centered" },
          { "data": "equip_gata", "class": "margen-td centered" },
          { "data": "equip_gps", "class": "margen-td centered" },
          { "data": "equip_tarj_comb_numero", "class": "margen-td centered" },
          { "data": "equip_tarj_clave", "class": "margen-td centered" },
          { "data": "conductor_anterior", "class": "margen-td centered" },
          { "data": "fecha_alta", "class": "margen-td centered" },
          { "data": "conductor_anterior_fecha_ini", "class": "margen-td centered" },
          { "data": "conductor_actual_fecha_ini", "class": "margen-td centered" },
          { "data": "fecha_baja", "class": "margen-td centered" },
          { "data": "motivo_baja", "class": "margen-td centered" },
          { "data": "comprador", "class": "margen-td centered" },
          { "data": "observacion", "class": "margen-td centered" },
        ]
      }); 
  

      $(document).on('keyup paste', '#buscador_vehiculo', function() {
        listaVehiculos.search($(this).val().trim()).draw();
      });

      $(document).off('click', '.btn_filtro_vehiculos').on('click', '.btn_filtro_vehiculos',function(event) {
        event.preventDefault();
         $(this).prop("disabled" , true);
         $(".btn_filtro_vehiculos").html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span class="sr-only"></span> Filtrando');
         listaVehiculos.ajax.reload();
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
      const tablasAjustar = ['listaVehiculos'];

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

    $(document).off('click', '.btn_nuevo_vehiculo').on('click', '.btn_nuevo_vehiculo',function(event) {
        $('#modal_vehiculo').modal('toggle'); 
        $(".btn_guardar_vehiculo").html('<i class="fa fa-save"></i> Guardar');
        $(".btn_guardar_vehiculo").attr("disabled", false);
        $(".cierra_modal_vehiculo").attr("disabled", false);
        $(".eliminar_modal_vehiculo").attr("disabled", false);
        $('#formVehiculos')[0].reset();
        $("#hash_vehiculo").val("");
        $("#formVehiculos input,#formVehiculos select,#formVehiculos button,#formVehiculos").prop("disabled", false);
        $(".cont_edit").hide();
    });     

    $(document).off('submit', '#formVehiculos').on('submit', '#formVehiculos',function(event) {
      event.preventDefault();
      var $form = $('#formVehiculos');
      var formData = new FormData($form[0]);
      var $buttons = $(".btn_guardar_vehiculo, .cierra_modal_vehiculo, .eliminar_modal_vehiculo");
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
            $('#modal_vehiculo').modal("toggle");
            listaVehiculos.ajax.reload();
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
            $('#modal_vehiculo').modal("toggle");
          } */
        },
        timeout: 25000
      });
    });

    $(document).off('click', '.btn_modificar_usuario').on('click', '.btn_modificar_usuario',function(event) {
      $(".cont_edit").show();
      $("#hash_vehiculo").val("");
      hash_vehiculo = $(this).attr("data-hash_vehiculo");
      $("#hash_vehiculo").val(hash_vehiculo);
        
      $.ajax({
        url: "getDataVehiculos"+"?"+$.now(),  
        type: 'POST',
        cache: false,
        tryCount : 0,
        retryLimit : 3,
        data:{hash_vehiculo : hash_vehiculo},
        dataType:"json",
        beforeSend:function(){
          $(".btn_guardar_vehiculo").attr("disabled", true);
          $(".cierra_modal_vehiculo").attr("disabled", true);
          $(".eliminar_modal_vehiculo").attr("disabled", true);
          $("#formVehiculos input,#formVehiculos select,#formVehiculos button,#formVehiculos").prop("disabled", true);
        },
        success: function (data) {
          $(".btn_guardar_vehiculo").attr("disabled", false);
          $(".cierra_modal_vehiculo").attr("disabled", false);
          $(".eliminar_modal_vehiculo").attr("disabled", false);
          $("#formVehiculos input,#formVehiculos select,#formVehiculos button,#formVehiculos").prop("disabled", false);
        
          if(data.res=="ok"){
            for(dato in data.datos){
            
              $("#patente").val(data.datos[dato].patente);
              $("#kilometraje").val(data.datos[dato].kilometraje);
              $("#anio").val(data.datos[dato].anio);
              $("#fecha_alta").val(data.datos[dato].fecha_alta);
              $("#empresa").val(data.datos[dato].empresa);
              $("#numero_motor").val(data.datos[dato].numero_motor);
              $("#numero_chasis").val(data.datos[dato].numero_chasis);
              $("#color").val(data.datos[dato].color);
              $("#fecha_baja").val(data.datos[dato].fecha_baja);
              $("#comprador").val(data.datos[dato].comprador);
              $("#observacion").val(data.datos[dato].observacion);
              $("#tipo_mantenimiento  option[value='"+data.datos[dato].id_tipo_mantenimiento+"'").prop("selected", true);
              $("#estado  option[value='"+data.datos[dato].id_estado+"'").prop("selected", true);
              $("#tipos_mmc  option[value='"+data.datos[dato].id_tipo+"'").prop("selected", true);
              $("#sucursal  option[value='"+data.datos[dato].id_sucursal+"'").prop("selected", true);
              $("#motivo_baja  option[value='"+data.datos[dato].id_motivo_baja+"'").prop("selected", true);
              $("#conductor_actual  option[value='"+data.datos[dato].id_conductor_actual+"'").prop("selected", true);
              $("#conductor_anterior  option[value='"+data.datos[dato].id_conductor_anterior+"'").prop("selected", true);
              $("#conductor_actual_fecha_ini").val(data.datos[dato].conductor_actual_fecha_ini);
              $("#conductor_anterior_fecha_ini").val(data.datos[dato].conductor_anterior_fecha_ini);

              $("#doc_perm_circ_fecha_venc").val(data.datos[dato].doc_perm_circ_fecha_venc);
              $("#doc_rev_tec_fecha_venc").val(data.datos[dato].doc_rev_tec_fecha_venc);
              $("#doc_rev_gases_fecha_venc").val(data.datos[dato].doc_rev_gases_fecha_venc);
              $("#doc_seg_oblig_fecha_venc").val(data.datos[dato].doc_seg_oblig_fecha_venc);
              $("#doc_seg_dan_compania").val(data.datos[dato].doc_seg_dan_compania);
              $("#doc_seg_danios_poliza").val(data.datos[dato].doc_seg_danios_poliza);
              $("#doc_seg_danios_fecha_venc").val(data.datos[dato].doc_seg_danios_fecha_venc);
              $("#equip_extintor_fecha_venc").val(data.datos[dato].equip_extintor_fecha_venc);

              $("#equip_tag").prop("checked", data.datos[dato].equip_tag === "on");
              $("#equip_extintor").prop("checked", data.datos[dato].equip_extintor === "on");
              $("#equip_neumatico_repuesto").prop("checked", data.datos[dato].equip_neumatico_repuesto === "on");
              $("#equip_botiquin").prop("checked", data.datos[dato].equip_botiquin === "on");
              $("#equip_llave_rueda").prop("checked", data.datos[dato].equip_llave_rueda === "on");
              $("#equip_gata").prop("checked", data.datos[dato].equip_gata === "on");
              $("#equip_gps").prop("checked", data.datos[dato].equip_gps === "on");

              $("#equip_tarj_comb_num").val(data.datos[dato].equip_tarj_comb_num);
              $("#equip_tarj_clave").val(data.datos[dato].equip_tarj_clave);
              
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
                  $('#modal_vehiculo').modal("toggle");
              }    
              return;
          }

          if (xhr.status == 500) {
              $.notify("Problemas en el servidor, intente más tarde.", {
                className:'warn',
                globalPosition: 'top right'
              });
              $('#modal_vehiculo').modal("toggle");
          }
        },timeout:25000
      }); 
    });

    $(document).off('click', '.borrar_vehiculo').on('click', '.borrar_vehiculo',function(event) {
      var hash_vehiculo=$(this).attr("data-hash_vehiculo");
        if(confirm("¿Esta seguro que desea eliminar este registro?")){

          $.post('eliminaVehiculos'+"?"+$.now(),{"hash_vehiculo": hash_vehiculo}, function(data) {

            if(data.res=="ok"){

              $.notify(data.msg, {
                className:'success',
                globalPosition: 'top right'
              });

              listaVehiculos.ajax.reload();

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

    <div class="col-6 col-lg-1">  
      <div class="form-group">
         <button type="button" class="btn btn-block btn-sm btn-primary btn_nuevo_vehiculo btn_xr3">
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
       <button type="button" class="btn-block btn btn-sm btn-primary btn_filtro_vehiculos btn_xr3">
       <i class="fa fa-cog fa-1x"></i><span class="sr-only"></span> Filtrar
       </button>
     </div>
    </div>

    <!-- <div class="col-6 col-lg-1">  
      <div class="form-group">
       <button type="button"  class="btn-block btn btn-sm btn-primary excel_vehiculos btn_xr3">
       <i class="fa fa-save"></i> Excel
       </button>
      </div>
    </div> -->
    
    </div>            

<!-- LISTADO -->

  <div class="row">
    <div class="col-lg-12">
      <table id="listaVehiculos" class="tablaUsuarios table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>    
            <th class="centered" style="width: 50px;">Acciones</th>    
            <th class="centered">N°reg.</th>
            <th class="centered">Estado</th>
            <th class="centered">Empresa</th>
            <th class="centered">Sucursal</th>
            <th class="centered">Cond.actual -nombre</th>
            <th class="centered">Patente</th>
            <th class="centered">Kilometraje</th>
            <!-- <th class="centered">Tipo/Marca/modelo/Comb</th> -->
            <th class="centered">Año</th>
            <th class="centered">Color</th>
            <th class="centered">Tipo manten.</th>
            <th class="centered">N°motor</th>
            <th class="centered">N°chasis</th>
            <th class="centered">Doc.-Perm.Circ.-Fecha venc.</th>
            <th class="centered">Doc.-Rev.técnica-Fecha venc.</th>
            <th class="centered">Doc.-Rev.gases-Fecha venc.</th>
            <th class="centered">Doc.-Seguro obli.-Fecha venc.</th>
            <th class="centered">Doc.-Seguro daños-Compañía</th>
            <th class="centered">Doc.-Seguro daños-Poliza</th>
            <th class="centered">Doc.-Seguro daños-Fecha venc.</th>
            <th class="centered">Equip.-Tag</th>
            <th class="centered">Equip.-Extintor</th>
            <th class="centered">Equip.-Extintor Fecha venc.</th>
            <th class="centered">Equip.-Neumatico repuesto</th>
            <th class="centered">Equip.-Botiquin</th>
            <th class="centered">Equip.-Llave de rueda</th>
            <th class="centered">Equip.-Gata</th>
            <th class="centered">Equip.-GPS</th>
            <th class="centered">Equip.-Tarj.comb.n°</th>
            <th class="centered">Equip.-Tarj.comb.clave</th>
            <th class="centered">Conductor anterior -nombre</th>
            <th class="centered">Fecha de alta</th>
            <th class="centered">Conductor anterior -fecha ini.</th>
            <th class="centered">Conductor actual -fecha ini.</th>
            <th class="centered">Fecha de baja</th>
            <th class="centered">Motivo de baja</th>
            <th class="centered">Comprador</th>
            <th class="centered">Observación</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<!--  FORMULARIO-->
  <div id="modal_vehiculo" data-backdrop="static"  data-keyboard="false"   class="modal fade">
    <?php echo form_open_multipart("formVehiculos",array("id"=>"formVehiculos","class"=>"formVehiculos"))?>
    <div class="modal-dialog modal_vehiculo">
      <div class="modal-content"> 
      <button type="button" title="Cerrar Ventana" class="close" data-dismiss="modal" aria-hidden="true">X</button>

        <div class="modal-body">
          <input type="hidden" name="hash_vehiculo" id="hash_vehiculo">
          <fieldset class="form-ing-cont">

          <legend class="form-ing-border">Datos del vehículo </legend>
            <div class="form-row">

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="patente" class="col-sm-12 col-form-label col-form-label-sm">Patente</label>
                  <input placeholder="XXXXYY" size="6" maxlength="6" type="text" name="patente" id="patente" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="kilometraje" class="col-sm-12 col-form-label col-form-label-sm">Kilometraje</label>
                  <input placeholder="Kilometraje" type="text" name="kilometraje" id="kilometraje" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="anio" class="col-sm-12 col-form-label col-form-label-sm">Año</label>
                  <input placeholder="Año" type="text" name="anio" id="anio" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="fecha_alta" class="col-sm-12 col-form-label col-form-label-sm">Fecha de Alta</label>
                  <input placeholder="Fecha de Alta" type="date" name="fecha_alta" id="fecha_alta" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class form-group">
                  <label for="empresa" class="col-sm-12 col-form-label col-form-label-sm">Empresa</label>
                  <input placeholder="Empresa" type="text" name="empresa" id="empresa" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="numero_motor" class="col-sm-12 col-form-label col-form-label-sm">Número de Motor</label>
                  <input placeholder="Número de Motor" type="text" name="numero_motor" id="numero_motor" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="numero_chasis" class="col-sm-12 col-form-label col-form-label-sm">Número de Chasis</label>
                  <input placeholder="Número de Chasis" type="text" name="numero_chasis" id="numero_chasis" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="color" class="col-sm-12 col-form-label col-form-label-sm">Color</label>
                  <input placeholder="Color" type="text" name="color" id="color" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="fecha_baja" class="col-sm-12 col-form-label col-form-label-sm">Fecha de Baja</label>
                  <input placeholder="Fecha de Baja" type="date" name="fecha_baja" id="fecha_baja" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="comprador" class="col-sm-12 col-form-label col-form-label-sm">Comprador</label>
                  <input placeholder="Comprador" type="text" name="comprador" id="comprador" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="observacion" class="col-sm-12 col-form-label col-form-label-sm">Observación</label>
                  <input placeholder="Observación" type="text" name="observacion" id="observacion" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="estado" class="col-sm-12 col-form-label col-form-label-sm">Tipo mantenimiento</label>
                  <select id="tipo_mantenimiento" name="tipo_mantenimiento" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($tipos_mantenimiento as $t) { ?>
                      <option value="<?php echo $t["id"]; ?>"><?php echo $t["tipo_mmc"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="estado" class="col-sm-12 col-form-label col-form-label-sm">Estado</label>
                  <select id="estado" name="estado" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($estados as $e) { ?>
                      <option value="<?php echo $e["id"]; ?>"><?php echo $e["estado"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="tipos_mmc" class="col-sm-12 col-form-label col-form-label-sm">Tipo/Marca/modelo/Comb </label>
                  <select id="tipos_mmc" name="tipos_mmc" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($tipos_mmc as $tm) { ?>
                      <option value="<?php echo $tm["id"]; ?>"><?php echo $tm["tipo_mmc"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="col-lg-3">
                <div class="form-group">
                  <label for="sucursal" class="col-sm-12 col-form-label col-form-label-sm">Sucursal</label>
                  <select id="sucursal" name="sucursal" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($plazas as $p) { ?>
                      <option value="<?php echo $p["id"]; ?>"><?php echo $p["plaza"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="motivo_baja" class="col-sm-12 col-form-label col-form-label-sm">Motivo de Baja</label>
                  <select id="motivo_baja" name="motivo_baja" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($motivos_bajas as $mb) { ?>
                      <option value="<?php echo $mb["id"]; ?>"><?php echo $mb["motivo"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="col-lg-3">
                <div class="form-group">
                  <label for="cond_actual_fecha_ini" class="col-sm-12 col-form-label col-form-label-sm">Conductor Actual Fecha de Inicio</label>
                  <input placeholder="Conductor Actual Fecha de Inicio" type="date" name="conductor_actual_fecha_ini" id="conductor_actual_fecha_ini" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="conductor_actual" class="col-sm-12 col-form-label col-form-label-sm">Conductor Actual</label>
                  <select id="conductor_actual" name="conductor_actual" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($conductores as $c) { ?>
                      <option value="<?php echo $c["id"]; ?>"><?php echo $c["nombre"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="cond_actual_fecha_ini" class="col-sm-12 col-form-label col-form-label-sm">Conductor anterior fecha de inicio</label>
                  <input placeholder="Conductor anterior fecha de Inicio" type="date" name="conductor_anterior_fecha_ini" id="conductor_anterior_fecha_ini" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>
                    
              
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="conductor_anterior" class="col-sm-12 col-form-label col-form-label-sm">Conductor Anterior</label>
                  <select id="conductor_anterior" name="conductor_anterior" class="custom-select custom-select-sm">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($conductores as $c) { ?>
                      <option value="<?php echo $c["id"]; ?>"><?php echo $c["nombre"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </legend>
          </fieldset>

          <fieldset class="form-ing-cont">
          <legend class="form-ing-border">Documentos del vehículo </legend>
            <div class="form-row">

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_perm_circ_fecha_venc" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Perm.Circ.-Fecha venc.</label>
                  <input placeholder="Doc.-Perm.Circ.-Fecha venc." type="date" name="doc_perm_circ_fecha_venc" id="doc_perm_circ_fecha_venc" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_rev_tecnica_fecha_venc" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Rev.técnica-Fecha venc.</label>
                  <input placeholder="Doc.-Rev.técnica.-Fecha venc." type="date" name="doc_rev_tecnica_fecha_venc" id="doc_rev_tecnica_fecha_venc" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_rev_gases_fecha_venc" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Rev.gases-Fecha venc.</label>
                  <input placeholder="Doc.-Rev.gases-Fecha venc." type="date" name="doc_rev_gases_fecha_venc" id="doc_rev_gases_fecha_venc" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_seguro_obli_fecha_venc" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Seguro obli.-Fecha venc.</label>
                  <input placeholder="Doc.-Seguro obli.-Fecha venc." type="date" name="doc_seguro_obli_fecha_venc" id="doc_seguro_obli_fecha_venc" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_seguro_danos_compania" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Seguro daños-Compañía</label>
                  <input placeholder="Doc.-Seguro daños-Compañía" type="text" name="doc_seguro_danos_compania" id="doc_seguro_danos_compania" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_seguro_danios_poliza" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Seguro daños-Poliza </label>
                  <input placeholder="Doc.-Seguro daños-Poliza" type="text" name="doc_seguro_danios_poliza" id="doc_seguro_danios_poliza" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="doc_seg_danios_fecha_venc" class="col-sm-12 col-form-label col-form-label-sm">Doc.-Seguro daños-Fecha venc.</label>
                  <input placeholder="Doc.-Seguro daños-Fecha venc." type="date" name="doc_seg_danios_fecha_venc" id="doc_seg_danios_fecha_venc" class="form-control form-control-sm" autocomplete="off" />
                </div>
              </div>
            </div>
          </legend>
          </fieldset>

          <fieldset class="form-ing-cont">
            <legend class="form-ing-border">Documentos del vehículo </legend>
              <div class="form-row">

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_tag" class="form-check-label">Equip.-Tag</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_tag" name="equip_tag">
                      <label class="custom-control-label" for="equip_tag"></label>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_extintor" class="form-check-label">Equip.-Extintor</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_extintor" name="equip_extintor">
                      <label class="custom-control-label" for="equip_extintor"></label>
                    </div>
                  </div>
                </div>


                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_neumatico_repuesto" class="form-check-label">Equip.-Neumático Repuesto</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_neumatico_repuesto" name="equip_neumatico_repuesto">
                      <label class="custom-control-label" for="equip_neumatico_repuesto"></label>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_botiquin" class="form-check-label">Equip.-Botiquín</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_botiquin" name="equip_botiquin">
                      <label class="custom-control-label" for="equip_botiquin"></label>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_llave_rueda" class="form-check-label">Equip.-Llave de Rueda</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_llave_rueda" name="equip_llave_rueda">
                      <label class="custom-control-label" for="equip_llave_rueda"></label>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_gata" class="form-check-label">Equip.-Gata</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_gata" name="equip_gata">
                      <label class="custom-control-label" for="equip_gata"></label>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="equip_gps" class="form-check-label">Equip.-GPS</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="equip_gps" name="equip_gps">
                      <label class="custom-control-label" for="equip_gps"></label>
                    </div>
                  </div>
                </div>

                
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="equip_extintor_fecha_venc" class="col-sm-12 col-form-label col-form-label-sm">Equip.-Extintor-Fecha venc.</label>
                    <input placeholder="Equip.-Extintor-Fecha venc." type="date" name="equip_extintor_fecha_venc" id="equip_extintor_fecha_venc" class="form-control form-control-sm" autocomplete="off" />
                  </div>
                </div>


                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="equip_tarj_comb_numero" class="col-sm-12 col-form-label col-form-label-sm">Equip.-Tarj.comb.n°</label>
                    <input placeholder="Equip.-Tarj.comb.n°" type="text" name="equip_tarj_comb_numero" id="equip_tarj_comb_numero" class="form-control form-control-sm" autocomplete="off" />
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="equip_tarj_clave" class="col-sm-12 col-form-label col-form-label-sm">Equip.-Tarj.clave</label>
                    <input placeholder="Equip.-Tarj.clave" type="text" name="equip_tarj_clave" id="equip_tarj_clave" class="form-control form-control-sm" autocomplete="off" />
                  </div>
                </div>
            
              </div>
            </legend>
          </fieldset>

          <div class="col-lg-8 offset-lg-2 mt-3">
            <div class="form-row">
              <div class="col-6 col-lg-6">
                <div class="form-group">
                  <button type="submit" class="btn-block btn btn-sm btn-primary btn_guardar_vehiculo">
                   <i class="fa fa-save"></i> Guardar
                  </button>
                </div>
              </div>
              <div class="col-6 col-lg-6">
                <button class="btn-block btn btn-sm btn-secondary cierra_modal_vehiculo" data-dismiss="modal" aria-hidden="true">
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



 


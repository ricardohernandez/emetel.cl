
<script type="text/javascript">
  $(function(){
    $.extend(true,$.fn.dataTable.defaults,{
      dom: "<'row'<'col-12 'f>>" + // Filtro
      "<'row'<'col-12 '<'table-responsive't>>>" + 
      "<'row d-none d-sm-flex '<'col-sm-4'l><'col-sm-4 text-center'i><'col-sm-4'p>>" + 
      "<'row d-sm-none '<'col-12 text-center'p>>", 

      "iDisplayLength":50, 
      "paging":true,
      "lengthChange": true,
      "lengthMenu": [[5, 15, 50, -1], [5, 15, 50, "Todos"]],
      info:true,
      ordering:true,
      searching:true,
      bSort: true,
      bFilter: true,
      bProcessing: true,
      pagingType: "simple" , 
      bAutoWidth: true,
      sAjaxDataProp: "result",        
      bDeferRender: true,
      select : true,
     "oLanguage": { 
      "sProcessing":     "<i id='processingIconTable' class='fa-solid fa-circle-notch fa-spin fa-2x'></i>",
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
    });

    $("#menu_mantenciones").addClass('disabled_sub');
    $(".contenedor_app").html("<center><i id='processingIcon' class='fa-solid fa-circle-notch fa-spin fa-2x'></i></center>");
    $(".menu_lista li").removeClass('menuActivo');       
    $("#menu_mantenciones").addClass('menuActivo');  

    $.get("vistaMantenciones", function( data ) {
      $(".contenedor_app").html(data);    
      $("#menu_mantenciones").removeClass('disabled_sub');
    });

    /* $("#menu_responsables_fallos").addClass('disabled_sub');
    $(".contenedor_app").html("<center><i id='processingIcon' class='fa-solid fa-circle-notch fa-spin fa-2x'></i></center>");
    $(".menu_lista li").removeClass('menuActivo');    
    $("#menu_responsables_fallos").addClass('menuActivo');  
   

    $.get("vistaResponsablesFallosHerramientas", function( data ) {
      $(".contenedor_app").html(data);    
      $("#menu_responsables_fallos").removeClass('disabled_sub');
    });*/

    $(document).off('click', '#menu_vehiculos').on('click', '#menu_vehiculos',function(event) {
      event.preventDefault();
      $("#menu_vehiculos").addClass('disabled_sub');
      $(".contenedor_app").html("<center><i id='processingIcon' class='fa-solid fa-circle-notch fa-spin fa-2x'></i></center>");
      $(".menu_lista li").removeClass('menuActivo');       
      $("#menu_vehiculos").addClass('menuActivo');  

      $.get("vistaVehiculos", function( data ) {
        $(".contenedor_app").html(data);    
        $("#menu_vehiculos").removeClass('disabled_sub');
      });
    });

    $(document).off('click', '#menu_mantenciones').on('click', '#menu_mantenciones',function(event) {
      event.preventDefault();
      $("#menu_mantenciones").addClass('disabled_sub');
      $(".contenedor_app").html("<center><i id='processingIcon' class='fa-solid fa-circle-notch fa-spin fa-2x'></i></center>");
      $(".menu_lista li").removeClass('menuActivo');       
      $("#menu_mantenciones").addClass('menuActivo');  

      $.get("vistaMantenciones", function( data ) {
        $(".contenedor_app").html(data);    
        $("#menu_mantenciones").removeClass('disabled_sub');
      });
    });


  })
</script>

<!-- MENU -->

<div class="contenido" style="display:none;">
<div class="container-fluid">
<section>
<article class="content">

  <div class="row">
    <div class="col-12">
      <div class="scrollable-menu">
        <ul class="nav nav-tabs navbar-left nav-tabs-int menu_lista">
          <li id="menu_vehiculos" class="active"><a> <i class="fa fa-list-alt"></i> Vehiculos </a></li>   
          <li id="menu_mantenciones" class="active"><a> <i class="fa fa-list-alt"></i> Mantenciones  </a></li>   
          <li id="menu_ticket" class="active"><a> <i class="fa fa-list-alt"></i> Ticket  </a></li>   
        </ul>  
      </div> 
      </div> 
  </div>

  <div class="row">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="contenedor_principal">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="contenedor_app"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</article>  
</section>
</div>
</div>

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*******INICIO *******/
	
	$route['default_controller'] = 'inicio';
	$route['404_override'] = "";
	$route['nojs'] = "inicio/nojs";
	$route['validaLogin'] = "inicio/validaLogin";
	$route['login'] = "inicio/login";
	$route['unlogin'] = "inicio/unlogin";
	$route['inicio'] = "inicio/inicio";
	$route['cargaInicio'] = "inicio/cargaInicio";
	$route['cargaInformaciones'] = "inicio/cargaInformaciones";
	$route['cargaVistaNoticias'] = "inicio/cargaVistaNoticias";
	$route['cargaVistaNoticia'] = "inicio/cargaVistaNoticia";
	$route['cargaCategorias'] = "inicio/cargaCategorias";
	$route['cargaIngresos'] = "inicio/cargaIngresos";
	$route['infoUsuario'] = "inicio/infoUsuario";
	$route['cambiarPass'] = "inicio/cambiarPass";
	$route['verComo'] = "inicio/verComo";
	$route['recuperarPass'] = "inicio/recuperarPass";

/*************ADMIN******************/
	
	$route['saludoCumpleanios'] = "inicio/saludoCumpleanios";
	$route['admin_xr3'] = "admin";
	$route['cargaVistaNoticiasAdmin'] = "admin/cargaVistaNoticiasAdmin";
	$route['listaNoticiasAdmin'] = "admin/listaNoticiasAdmin";
	$route['nuevaNoticiaAdmin'] = "admin/nuevaNoticiaAdmin";
	$route['getDataNoticia'] = "admin/getDataNoticia";
	$route['eliminaNoticia'] = "admin/eliminaNoticia";
	$route['eliminaImagen'] = "admin/eliminaImagen";
	$route['cargaVistaInformaciones'] = "admin/cargaVistaInformaciones";
	$route['listaInformaciones'] = "admin/listaInformaciones";
	$route['nuevaInformacion'] = "admin/nuevaInformacion";
	$route['getDataInformacion'] = "admin/getDataInformacion";
	$route['eliminaInformacion'] = "admin/eliminaInformacion";


	
/*******DOCUMENTACION*******/

	$route['documentacion/capacitacion'] = "back_end/documentacion/indexCapacitacion";
	$route['vistaCapacitacion'] = "back_end/documentacion/vistaCapacitacion";
	$route['getCapacitacionList'] = "back_end/documentacion/getCapacitacionList";
	$route['getDataRegistroCapacitacion'] = "back_end/documentacion/getDataRegistroCapacitacion";
	$route['formIngresoCapacitacion'] = "back_end/documentacion/formIngresoCapacitacion";
	$route['eliminaCapacitacion'] = "back_end/documentacion/eliminaCapacitacion";
	$route['documentacion/reportes'] = "back_end/documentacion/indexReportes";
	$route['vistaReportes'] = "back_end/documentacion/vistaReportes";
	$route['getReportesList'] = "back_end/documentacion/getReportesList";
	$route['getDataRegistroReportes'] = "back_end/documentacion/getDataRegistroReportes";
	$route['formIngresoReportes'] = "back_end/documentacion/formIngresoReportes";
	$route['eliminaReportes'] = "back_end/documentacion/eliminaReportes";
	$route['documentacion/prevencion_riesgos'] = "back_end/documentacion/indexPrevencion";
	$route['vistaPrevencion'] = "back_end/documentacion/vistaPrevencion";
	$route['getPrevencionList'] = "back_end/documentacion/getPrevencionList";
	$route['getDataRegistroPrevencion'] = "back_end/documentacion/getDataRegistroPrevencion";
	$route['formIngresoPrevencion'] = "back_end/documentacion/formIngresoPrevencion";
	$route['eliminaPrevencion'] = "back_end/documentacion/eliminaPrevencion";
	$route['documentacion/datas_mandante'] = "back_end/documentacion/indexDatas";



	$route['prevencion_riesgos'] = "back_end/Prevencion_modulos/indexPrevencionModulos"; 
	$route['vistaPrevencionModulos'] = "back_end/Prevencion_modulos/vistaPrevencionModulos";
	
	$route['getListPrevencionModulos'] = "back_end/Prevencion_modulos/getList";
	$route['getDataPrevencionModulos'] = "back_end/Prevencion_modulos/getData";
	$route['formIngresoPrevencionModulos'] = "back_end/Prevencion_modulos/formIngreso";
	$route['eliminarPrevencionModulos'] = "back_end/Prevencion_modulos/eliminar";

	$route['dashboard/dashboard_operaciones'] = "back_end/Dashboard_operaciones/indexDashboardOP";
	$route['dashboard/produccion_calidad_xr3'] = "back_end/Dashboard_operaciones/productividadCalidadXr3";
	$route['dashboard/produccion_calidad_EPS'] = "back_end/Dashboard_operaciones/produccionCalidadEPS";
	$route['dashboard/dotacion'] = "back_end/Dashboard_operaciones/dotacion";
	$route['dashboard/analisis_calidad'] = "back_end/Dashboard_operaciones/analisisCalidad";
	$route['dashboard/prod_cal_claro'] = "back_end/Dashboard_operaciones/prodCalClaro";
	$route['dashboard/prod_x_comuna'] = "back_end/Dashboard_operaciones/prodXComuna";
	
	$route['dashboard/cargaDashboardProductividadXR3'] = "back_end/Dashboard_operaciones/cargaDashboardProductividadXR3";
	$route['graficosProductividadXR3'] = "back_end/Dashboard_operaciones/graficosProductividadXR3";
	$route['graficosProductividadEps'] = "back_end/Dashboard_operaciones/graficosProductividadEps";
	$route['graficoDotacion'] = "back_end/Dashboard_operaciones/graficoDotacion";
	$route['graficoAnalisisCalidad'] = "back_end/Dashboard_operaciones/graficoAnalisisCalidad";
	$route['graficoProdxEps'] = "back_end/Dashboard_operaciones/graficoProdxEps";
	$route['graficoXComuna'] = "back_end/Dashboard_operaciones/graficoXComuna";
 	
	$route['dashboard/capacitacion'] = "back_end/documentacion/indexCapacitacion";
	$route['getDataPrevencionModulos'] = "back_end/Prevencion_modulos/getData";
	$route['formIngresoPrevencionModulos'] = "back_end/Prevencion_modulos/formIngreso";
	$route['eliminarPrevencionModulos'] = "back_end/Prevencion_modulos/eliminar";

	
/******************TICKET*************************/

	$route['ticket'] = "back_end/ticket/index";
	$route['getTicketInicio'] = "back_end/ticket/getTicketInicio";
	$route['getTicketList'] = "back_end/ticket/getTicketList";
	$route['formTicket'] = "back_end/ticket/formTicket";
	$route['eliminaTicket'] = "back_end/ticket/eliminaTicket";
	$route['getDataTicket'] = "back_end/ticket/getDataTicket";

	
/*******MANTENEDORES*******/

	$route['mantenedor_usuarios'] = "back_end/mantenedores/usuarios/index";
	$route['vistaUsuarios'] = "back_end/mantenedores/usuarios/vistaUsuarios";
	$route['listaUsuarios'] = "back_end/mantenedores/usuarios/listaUsuarios";
	$route['getDataUsuarios'] = "back_end/mantenedores/usuarios/getDataUsuarios";
	$route['formUsuario'] = "back_end/mantenedores/usuarios/formUsuario";
	$route['formCargaMasiva'] = "back_end/mantenedores/usuarios/formCargaMasiva";
	$route['formCargaMasivaUsuarios'] = "back_end/mantenedores/usuarios/formCargaMasivaUsuarios";
	$route['excelUsuarios/(:any)'] = "back_end/mantenedores/usuarios/excelUsuarios/$1";
	$route['formCargaMasivaUsuarios'] = "back_end/mantenedores/usuarios/formCargaMasivaUsuarios";
	$route['eliminaUsuario'] = "back_end/mantenedores/usuarios/eliminaUsuario";
	$route['correoDatosFaltantes'] = "back_end/mantenedores/usuarios/correoDatosFaltantes";
	
	$route['vistaCargos'] = "back_end/mantenedores/usuarios/vistaCargos";
	$route['listaCargos'] = "back_end/mantenedores/usuarios/listaCargos";
	$route['getDataCargos'] = "back_end/mantenedores/usuarios/getDataCargos";
	$route['formCargos'] = "back_end/mantenedores/usuarios/formCargos";
	$route['eliminaCargo'] = "back_end/mantenedores/usuarios/eliminaCargo";

	$route['vistaProyectos'] = "back_end/mantenedores/usuarios/vistaProyectos";
	$route['listaProyectos'] = "back_end/mantenedores/usuarios/listaProyectos";
	$route['getDataProyectos'] = "back_end/mantenedores/usuarios/getDataProyectos";
	$route['formProyectos'] = "back_end/mantenedores/usuarios/formProyectos";
	$route['eliminaProyectos'] = "back_end/mantenedores/usuarios/eliminaProyectos";

	$route['vistaAreas'] = "back_end/mantenedores/usuarios/vistaAreas";
	$route['listaAreas'] = "back_end/mantenedores/usuarios/listaAreas";
	$route['getDataAreas'] = "back_end/mantenedores/usuarios/getDataAreas";
	$route['formAreas'] = "back_end/mantenedores/usuarios/formAreas";
	$route['eliminaAreas'] = "back_end/mantenedores/usuarios/eliminaAreas";


	$route['vistaPlazas'] = "back_end/mantenedores/usuarios/vistaPlazas";
	$route['listaPlazas'] = "back_end/mantenedores/usuarios/listaPlazas";
	$route['getDataPlazas'] = "back_end/mantenedores/usuarios/getDataPlazas";
	$route['formPlazas'] = "back_end/mantenedores/usuarios/formPlazas";
	$route['eliminaPlazas'] = "back_end/mantenedores/usuarios/eliminaPlazas";

	$route['vistaJefes'] = "back_end/mantenedores/usuarios/vistaJefes";
	$route['listaJefes'] = "back_end/mantenedores/usuarios/listaJefes";
	$route['getDataJefes'] = "back_end/mantenedores/usuarios/getDataJefes";
	$route['formJefes'] = "back_end/mantenedores/usuarios/formJefes";
	$route['eliminaJefes'] = "back_end/mantenedores/usuarios/eliminaJefes";

	$route['vistaPerfiles'] = "back_end/mantenedores/usuarios/vistaPerfiles";
	$route['listaPerfiles'] = "back_end/mantenedores/usuarios/listaPerfiles";
	$route['getDataPerfiles'] = "back_end/mantenedores/usuarios/getDataPerfiles";
	$route['formPerfiles'] = "back_end/mantenedores/usuarios/formPerfiles";
	$route['eliminaPerfiles'] = "back_end/mantenedores/usuarios/eliminaPerfiles";

/******************VEHICULOS*************************/

	$route['flota'] = "back_end/flota/flota/index";
	$route['vistaVehiculos'] = "back_end/flota/flota/vistaVehiculos";
	$route['listaVehiculos'] = "back_end/flota/flota/listaVehiculos";
	$route['formVehiculos'] = "back_end/flota/flota/formVehiculos";
	$route['getDataVehiculos'] = "back_end/flota/flota/getDataVehiculos";
	$route['eliminaVehiculos'] = "back_end/flota/flota/eliminaVehiculos";

	$route['vistaMantenciones'] = "back_end/flota/Mantenedores/vistaMantenciones";
	$route['listaTiposMmc'] = "back_end/flota/Mantenedores/listaTiposMmc";
	
	


	$route['listaMat'] = "back_end/flota/Mantenedores/listaMat";
	$route['formMat'] = "back_end/flota/Mantenedores/formMat";
	$route['getDataMat'] = "back_end/flota/Mantenedores/getDataMat";
	$route['eliminarMat'] = "back_end/flota/Mantenedores/eliminarMat";
	
	$route['listaActividades'] = "back_end/flota/Mantenedores/listaActividades";
	$route['formActividad'] = "back_end/flota/Mantenedores/formActividad";
	$route['getDataActividad'] = "back_end/flota/Mantenedores/getDataActividad";
	$route['eliminarActividad'] = "back_end/flota/Mantenedores/eliminarActividad";

	$route['listaMmc'] = "back_end/flota/Mantenedores/listaMmc";
	$route['formMmc'] = "back_end/flota/Mantenedores/formMmc";
	$route['getDataMmc'] = "back_end/flota/Mantenedores/getDataMmc";
	$route['eliminaMmc'] = "back_end/flota/Mantenedores/eliminaMmc";

	$route['listaModelos'] = "back_end/flota/Mantenedores/listaModelos";
	$route['formModelo'] = "back_end/flota/Mantenedores/formModelo";
	$route['eliminarModelo'] = "back_end/flota/Mantenedores/eliminarModelo";
	$route['getDataModelo'] = "back_end/flota/Mantenedores/getDataModelo";

	$route['listaMarcas'] = "back_end/flota/Mantenedores/listaMarcas";
	$route['formMarca'] = "back_end/flota/Mantenedores/formMarca";
	$route['eliminarMarca'] = "back_end/flota/Mantenedores/eliminarMarca";
	$route['getDataMarca'] = "back_end/flota/Mantenedores/getDataMarca";
	
	
	


/* End of file routes.php */
/* Location: ./application/config/routes.php */
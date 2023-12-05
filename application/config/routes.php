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

	
 
/*******Mantenedores*******/

	/***** USUARIOS *****/
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

	/*CARGOS*/
	
	$route['vistaCargos'] = "back_end/mantenedores/usuarios/vistaCargos";
	$route['listaCargos'] = "back_end/mantenedores/usuarios/listaCargos";
	$route['getDataCargos'] = "back_end/mantenedores/usuarios/getDataCargos";
	$route['formCargos'] = "back_end/mantenedores/usuarios/formCargos";
	$route['eliminaCargo'] = "back_end/mantenedores/usuarios/eliminaCargo";

	/*PROYECTOS*/

	$route['vistaProyectos'] = "back_end/mantenedores/usuarios/vistaProyectos";
	$route['listaProyectos'] = "back_end/mantenedores/usuarios/listaProyectos";
	$route['getDataProyectos'] = "back_end/mantenedores/usuarios/getDataProyectos";
	$route['formProyectos'] = "back_end/mantenedores/usuarios/formProyectos";
	$route['eliminaProyectos'] = "back_end/mantenedores/usuarios/eliminaProyectos";


	/*AREAS*/

	$route['vistaAreas'] = "back_end/mantenedores/usuarios/vistaAreas";
	$route['listaAreas'] = "back_end/mantenedores/usuarios/listaAreas";
	$route['getDataAreas'] = "back_end/mantenedores/usuarios/getDataAreas";
	$route['formAreas'] = "back_end/mantenedores/usuarios/formAreas";
	$route['eliminaAreas'] = "back_end/mantenedores/usuarios/eliminaAreas";


	/*PLAZAS*/

	$route['vistaPlazas'] = "back_end/mantenedores/usuarios/vistaPlazas";
	$route['listaPlazas'] = "back_end/mantenedores/usuarios/listaPlazas";
	$route['getDataPlazas'] = "back_end/mantenedores/usuarios/getDataPlazas";
	$route['formPlazas'] = "back_end/mantenedores/usuarios/formPlazas";
	$route['eliminaPlazas'] = "back_end/mantenedores/usuarios/eliminaPlazas";

	/*JEFES*/

	$route['vistaJefes'] = "back_end/mantenedores/usuarios/vistaJefes";
	$route['listaJefes'] = "back_end/mantenedores/usuarios/listaJefes";
	$route['getDataJefes'] = "back_end/mantenedores/usuarios/getDataJefes";
	$route['formJefes'] = "back_end/mantenedores/usuarios/formJefes";
	$route['eliminaJefes'] = "back_end/mantenedores/usuarios/eliminaJefes";

	/*PERFILES*/

	$route['vistaPerfiles'] = "back_end/mantenedores/usuarios/vistaPerfiles";
	$route['listaPerfiles'] = "back_end/mantenedores/usuarios/listaPerfiles";
	$route['getDataPerfiles'] = "back_end/mantenedores/usuarios/getDataPerfiles";
	$route['formPerfiles'] = "back_end/mantenedores/usuarios/formPerfiles";
	$route['eliminaPerfiles'] = "back_end/mantenedores/usuarios/eliminaPerfiles";

	/*TICKET*/

	$route['vistaTicket'] = "back_end/flota/ticket/vistaTicket";
	$route['listaTicket'] = "back_end/flota/ticket/listaTicket";
	$route['formTicket'] = "back_end/flota/ticket/formTicket";
	$route['eliminaTicket'] = "back_end/flota/ticket/eliminaTicket";
	$route['getDataTicket'] = "back_end/flota/ticket/getDataTicket";
	$route['listaActividadesMant'] = "back_end/flota/ticket/listaActividadesMant";
	$route['listaPatentesMant'] = "back_end/flota/ticket/listaPatentesMant";
	$route['obtenerTipoActividad'] = "back_end/flota/ticket/obtenerTipoActividad";

	/*HERRAMIENTAS*/

	$route['mantenedor_herramientas'] = "back_end/mantenedores/herramientas/index";
	$route['vistaHerramientas'] = "back_end/mantenedores/herramientas/vistaHerramientas";
	$route['listaHerramientas'] = "back_end/mantenedores/herramientas/listaHerramientas";
	$route['getDataHerramientas'] = "back_end/mantenedores/herramientas/getDataHerramientas";
	$route['formHerramientas'] = "back_end/mantenedores/herramientas/formHerramientas";
	$route['eliminaHerramienta'] = "back_end/mantenedores/herramientas/eliminaHerramienta";
	$route['excelHerramientas/(:any)'] = "back_end/mantenedores/herramientas/excelHerramientas/$1";

	/*FALLOS*/
	
	$route['mantenedor_responsables_fallos'] = "back_end/mantenedores/responsable_fallos/index";
	$route['vistaResponsablesFallosHerramientas'] = "back_end/mantenedores/responsable_fallos/vistaResponsablesFallosHerramientas";
	$route['listaResponsablesFallosHerramientas'] = "back_end/mantenedores/responsable_fallos/listaResponsablesFallosHerramientas";
	$route['formResponsablesFallosHerramientas'] = "back_end/mantenedores/responsable_fallos/formResponsablesFallosHerramientas";
	$route['getDataResponsableFallosHerramientas'] = "back_end/mantenedores/responsable_fallos/getDataResponsableFallosHerramientas";
	$route['eliminaResponsableFallosHerramientas'] = "back_end/mantenedores/responsable_fallos/eliminaResponsableFallosHerramientas";

	/*HFC*/
	
	$route['mantenedor_checklist_hfc'] = "back_end/mantenedores/checklistHFC/index";
	$route['vistaMantChecklistHFC'] = "back_end/mantenedores/checklistHFC/vistaMantChecklistHFC/index";
	$route['listaMantChecklistHFC'] = "back_end/mantenedores/checklistHFC/listaMantChecklistHFC";
	$route['getDataMantChecklistHFC'] = "back_end/mantenedores/checklistHFC/getDataMantChecklistHFC";
	$route['formMantChecklistHFC'] = "back_end/mantenedores/checklistHFC/formMantChecklistHFC";
	$route['eliminaMantChecklistHFC'] = "back_end/mantenedores/checklistHFC/eliminaMantChecklistHFC";
	$route['excelMantChecklistHFC/(:any)'] = "back_end/mantenedores/checklistHFC/excelMantChecklistHFC/$1";

	/*FTTH*/

    $route['mantenedor_checklist_ftth'] = "back_end/mantenedores/checklistFTTH/index";
	$route['vistaMantChecklistFTTH'] = "back_end/mantenedores/checklistFTTH/vistaMantChecklistFTTH/index";
	$route['listaMantChecklistFTTH'] = "back_end/mantenedores/checklistFTTH/listaMantChecklistFTTH";
	$route['getDataMantChecklistFTTH'] = "back_end/mantenedores/checklistFTTH/getDataMantChecklistFTTH";
	$route['formMantChecklistFTTH'] = "back_end/mantenedores/checklistFTTH/formMantChecklistFTTH";
	$route['eliminaMantChecklistFTTH'] = "back_end/mantenedores/checklistFTTH/eliminaMantChecklistFTTH";
	$route['excelMantChecklistFTTH/(:any)'] = "back_end/mantenedores/checklistFTTH/excelMantChecklistFTTH/$1";
	

/******************VEHICULOS*************************/

	$route['flota'] = "back_end/flota/flota/index";
	$route['vistaVehiculos'] = "back_end/flota/flota/vistaVehiculos";
	$route['listaVehiculos'] = "back_end/flota/flota/listaVehiculos";
	$route['formVehiculos'] = "back_end/flota/flota/formVehiculos";
	$route['getDataVehiculos'] = "back_end/flota/flota/getDataVehiculos";
	$route['eliminaVehiculos'] = "back_end/flota/flota/eliminaVehiculos";

	$route['vistaMantenciones'] = "back_end/flota/mantenedores/vistaMantenciones";
	$route['listaTiposMmc'] = "back_end/flota/mantenedores/listaTiposMmc";

	 
	$route['listaMat'] = "back_end/flota/mantenedores/listaMat";
	$route['formMat'] = "back_end/flota/mantenedores/formMat";
	$route['getDataMat'] = "back_end/flota/mantenedores/getDataMat";
	$route['eliminarMat'] = "back_end/flota/mantenedores/eliminarMat";
	
	$route['listaActividades'] = "back_end/flota/mantenedores/listaActividades";
	$route['formActividad'] = "back_end/flota/mantenedores/formActividad";
	$route['getDataActividad'] = "back_end/flota/mantenedores/getDataActividad";
	$route['eliminarActividad'] = "back_end/flota/mantenedores/eliminarActividad";

	$route['listaMmc'] = "back_end/flota/mantenedores/listaMmc";
	$route['formMmc'] = "back_end/flota/mantenedores/formMmc";
	$route['getDataMmc'] = "back_end/flota/mantenedores/getDataMmc";
	$route['eliminaMmc'] = "back_end/flota/mantenedores/eliminaMmc";

	$route['listaModelos'] = "back_end/flota/mantenedores/listaModelos";
	$route['formModelo'] = "back_end/flota/mantenedores/formModelo";
	$route['eliminarModelo'] = "back_end/flota/mantenedores/eliminarModelo";
	$route['getDataModelo'] = "back_end/flota/mantenedores/getDataModelo";

	$route['listaMarcas'] = "back_end/flota/mantenedores/listaMarcas";
	$route['formMarca'] = "back_end/flota/mantenedores/formMarca";
	$route['eliminarMarca'] = "back_end/flota/mantenedores/eliminarMarca";
	$route['getDataMarca'] = "back_end/flota/mantenedores/getDataMarca";

/******* RKM - Reporte de kilometraje *******/

	$route['rkm'] = "back_end/rkm/index";
	$route['vistarkm'] = "back_end/rkm/vistarkm";
	$route['listarkm'] = "back_end/rkm/listarkm";
	$route['formrkm'] = "back_end/rkm/formrkm";
	$route['getDatarkm'] = "back_end/rkm/getDatarkm";
	$route['eliminarkm'] = "back_end/rkm/eliminarkm";
	$route['excelrkm'] = "back_end/rkm/excelrkm";

/*******AST*******/

	$route['ast'] = "back_end/ast/index";
	$route['vistaAst'] = "back_end/ast/vistaAst";
	$route['listaAst'] = "back_end/ast/listaAst";
	$route['getDataAst'] = "back_end/ast/getDataAst";
	$route['formAst'] = "back_end/ast/formAst";
	$route['eliminaAst'] = "back_end/ast/eliminaAst";
	$route['excel_ast/(:any)/(:any)/(:any)'] = "back_end/ast/excel_ast/$1/$2/$3";
	$route['generaPdfAstURL'] = "back_end/ast/generaPdfAstURL";
	$route['formCargaMasivaAst'] = "back_end/ast/formCargaMasivaAst";
	$route['vistaMantActividades'] = "back_end/ast/vistaMantActividades";
	$route['listaMantActividades'] = "back_end/ast/listaMantActividades";
	$route['getDataMantActividades'] = "back_end/ast/getDataMantActividades";
	$route['formMantActividades'] = "back_end/ast/formMantActividades";
	$route['eliminaMantActividades'] = "back_end/ast/eliminaMantActividades";
	$route['getChecklistView'] = "back_end/ast/getChecklistView";
	$route['getUserChecklistView'] = "back_end/ast/getUserChecklistView";
	$route['llenarMant'] = "back_end/ast/llenarMant";

	/*******GRAFICOS*******/
	
		$route['vistaGraficosAst'] = "back_end/ast/vistaGraficosAst";
		$route['graficoAstTecnico'] = "back_end/ast/graficoAstTecnico";
		$route['graficoAstDetalleTecnico'] = "back_end/ast/graficoAstDetalleTecnico";
		$route['graficoTotalTecnicos'] = "back_end/ast/graficoTotalTecnicos";
		$route['graficoTotalItems'] = "back_end/ast/graficoTotalItems";
		$route['excel_items_ast/(:any)/(:any)/(:any)/(:any)'] = "back_end/ast/excel_items_ast/$1/$2/$3/$4";
		$route['excel_ast_totales/(:any)/(:any)/(:any)/(:any)/(:any)'] = "back_end/ast/excel_ast_totales/$1/$2/$3/$4/$5";

/*******CHECKLIST*******/

	$route['checklist_herramientas'] = "back_end/checklist/checklist/index";
	$route['vistaChecklist'] = "back_end/checklist/checklist/vistaChecklist";
	$route['listaOTS'] = "back_end/checklist/checklist/listaOTS";
	$route['getDataChecklistHerramientas'] = "back_end/checklist/checklist/getDataChecklistHerramientas";
	$route['formOTS'] = "back_end/checklist/checklist/formOTS";
	$route['eliminaOTS'] = "back_end/checklist/checklist/eliminaOTS";
	$route['datosAuditor'] = "back_end/checklist/checklist/datosAuditor";
	$route['datosTecnico'] = "back_end/checklist/checklist/datosTecnico";
	$route['formCargaMasiva'] = "back_end/checklist/checklist/formCargaMasiva";
	$route['excel_checklist/(:any)/(:any)'] = "back_end/checklist/checklist/excel_checklist/$1/$2";
	$route['vistaGraficos'] = "back_end/checklist/checklist/vistaGraficos";
	$route['dataEstadosChecklist'] = "back_end/checklist/checklist/dataEstadosChecklist";
	$route['dataTecnicos'] = "back_end/checklist/checklist/dataTecnicos";
	$route['eliminaImagenChecklist'] = "back_end/checklist/checklist/eliminaImagenChecklist";
	$route['vistaGraficosH'] = "back_end/checklist/checklist/vistaGraficosH";
	$route['graficoFallosH'] = "back_end/checklist/checklist/graficoFallosH";
	$route['listaTrabajadoresCH'] = "back_end/checklist/checklist/listaTrabajadoresCH";
	$route['generaPdfChecklistHerramientasURL'] = "back_end/checklist/checklist/generaPdfChecklistHerramientasURL";

	/*******GRAFICOS*******/
		
		$route['graficoAuditoriasDataCH'] = "back_end/checklist/checklist/graficoAuditoriasDataCH";
		$route['graficoAuditoriasDataCHQ'] = "back_end/checklist/checklist/graficoAuditoriasDataCHQ";
		$route['graficoAuditoriasDataCHTecnico'] = "back_end/checklist/checklist/graficoAuditoriasDataCHTecnico";
		$route['graficoAuditoriasDataCHTecnicoQ'] = "back_end/checklist/checklist/graficoAuditoriasDataCHTecnicoQ";
		$route['dataAuditoresChecklistCH'] = "back_end/checklist/checklist/dataAuditoresChecklistCH";
		$route['dataEstadosChecklistCH'] = "back_end/checklist/checklist/dataEstadosChecklistCH";
		$route['dataTecnicosChecklistCH'] = "back_end/checklist/checklist/dataTecnicosChecklistCH";

	/*******FALLOS*******/
	
		$route['vistaFH'] = "back_end/checklist/checklist/vistaFH";
		$route['listaFH'] = "back_end/checklist/checklist/listaFH";
		$route['getDataFH'] = "back_end/checklist/checklist/getDataFH";
		$route['formFH'] = "back_end/checklist/checklist/formFH";


/*******CHECKLIST HFC*******/

	$route['checklistHFC'] = "back_end/checklist/ChecklistHFC/index";
	$route['vistaChecklistHFC'] = "back_end/checklist/ChecklistHFC/vistaChecklistHFC";
	$route['listaChecklistHFC'] = "back_end/checklist/ChecklistHFC/listaChecklistHFC";
	$route['getDataChecklistHFC'] = "back_end/checklist/ChecklistHFC/getDataChecklistHFC";
	$route['formChecklistHFC'] = "back_end/checklist/ChecklistHFC/formChecklistHFC";
	$route['eliminaChecklistHFC'] = "back_end/checklist/ChecklistHFC/eliminaChecklistHFC";
	$route['datosAuditorChecklistHFC'] = "back_end/checklist/ChecklistHFC/datosAuditorChecklistHFC";
	$route['datosTecnicoChecklistHFC'] = "back_end/checklist/ChecklistHFC/datosTecnicoChecklistHFC";
	$route['formCargaMasivaChecklistHFC'] = "back_end/checklist/ChecklistHFC/formCargaMasivaChecklistHFC";
	$route['excel_checklistHFC/(:any)/(:any)'] = "back_end/checklist/ChecklistHFC/excel_checklistHFC/$1/$2";
	$route['vistaGraficosChecklistHFC'] = "back_end/checklist/ChecklistHFC/vistaGraficosChecklistHFC";
	$route['dataEstadosChecklistHFC'] = "back_end/checklist/ChecklistHFC/dataEstadosChecklistHFC";
	$route['dataTecnicosChecklistHFC'] = "back_end/checklist/ChecklistHFC/dataTecnicosChecklistHFC";
	$route['eliminaImagenChecklistHFC'] = "back_end/checklist/ChecklistHFC/eliminaImagenChecklistHFC";
	$route['vistaGraficosFallosHFC'] = "back_end/checklist/ChecklistHFC/vistaGraficosFallosHFC";
	$route['graficoFallosHFC'] = "back_end/checklist/ChecklistHFC/graficoFallosHFC";
	$route['listaTrabajadoresHFC'] = "back_end/checklist/ChecklistHFC/listaTrabajadoresHFC";
	$route['generaPdfChecklistHFCURL'] = "back_end/checklist/ChecklistHFC/generaPdfChecklistHFCURL";


	$route['graficoAuditoriasDataHFC'] = "back_end/checklist/ChecklistHFC/graficoAuditoriasDataHFC";
	$route['graficoAuditoriasDataHFCQ'] = "back_end/checklist/ChecklistHFC/graficoAuditoriasDataHFCQ";
	$route['graficoAuditoriasDataHFCTecnico'] = "back_end/checklist/ChecklistHFC/graficoAuditoriasDataHFCTecnico";
	$route['graficoAuditoriasDataHFCTecnicoQ'] = "back_end/checklist/ChecklistHFC/graficoAuditoriasDataHFCTecnicoQ";
	$route['dataAuditoresChecklistHFC'] = "back_end/checklist/ChecklistHFC/dataAuditoresChecklistHFC";

	
	
	$route['vistaFHFC'] = "back_end/checklist/ChecklistHFC/vistaFHFC";
	$route['listaFHFC'] = "back_end/checklist/ChecklistHFC/listaFHFC";
	$route['getDataFHFC'] = "back_end/checklist/ChecklistHFC/getDataFHFC";
	$route['formFHFC'] = "back_end/checklist/ChecklistHFC/formFHFC";
	
/*******CHECKLIST FTTH*******/

	$route['checklistFTTH'] = "back_end/checklist/ChecklistFTTH/index";
	$route['vistaChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/vistaChecklistFTTH";
	$route['listaChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/listaChecklistFTTH";
	$route['getDataChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/getDataChecklistFTTH";
	$route['formChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/formChecklistFTTH";
	$route['eliminaChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/eliminaChecklistFTTH";
	$route['datosAuditorChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/datosAuditorChecklistFTTH";
	$route['datosTecnicoChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/datosTecnicoChecklistFTTH";
	$route['formCargaMasivaChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/formCargaMasivaChecklistFTTH";
	$route['excel_checklistFTTH/(:any)/(:any)'] = "back_end/checklist/ChecklistFTTH/excel_checklistFTTH/$1/$2";
	$route['vistaGraficosChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/vistaGraficosChecklistFTTH";
	$route['eliminaImagenChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/eliminaImagenChecklistFTTH";
	$route['vistaGraficosFallosFTTH'] = "back_end/checklist/ChecklistFTTH/vistaGraficosFallosFTTH";
	$route['graficoFallosFTTH'] = "back_end/checklist/ChecklistFTTH/graficoFallosFTTH";
	$route['listaTrabajadoresFTTH'] = "back_end/checklist/ChecklistFTTH/listaTrabajadoresFTTH";
	$route['generaPdfChecklistFTTHURL'] = "back_end/checklist/ChecklistFTTH/generaPdfChecklistFTTHURL";

	$route['graficoAuditoriasDataFTTH'] = "back_end/checklist/ChecklistFTTH/graficoAuditoriasDataFTTH";
	$route['graficoAuditoriasDataFTTHQ'] = "back_end/checklist/ChecklistFTTH/graficoAuditoriasDataFTTHQ";
	$route['graficoAuditoriasDataFTTHTecnico'] = "back_end/checklist/ChecklistFTTH/graficoAuditoriasDataFTTHTecnico";
	$route['graficoAuditoriasDataFTTHTecnicoQ'] = "back_end/checklist/ChecklistFTTH/graficoAuditoriasDataFTTHTecnicoQ";
	$route['dataAuditoresChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/dataAuditoresChecklistFTTH";
	$route['dataEstadosChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/dataEstadosChecklistFTTH";
	$route['dataTecnicosChecklistFTTH'] = "back_end/checklist/ChecklistFTTH/dataTecnicosChecklistFTTH";

	$route['vistaFFTTH'] = "back_end/checklist/ChecklistFTTH/vistaFFTTH";
	$route['listaFFTTH'] = "back_end/checklist/ChecklistFTTH/listaFFTTH";
	$route['getDataFFTTH'] = "back_end/checklist/ChecklistFTTH/getDataFFTTH";
	$route['formFFTTH'] = "back_end/checklist/ChecklistFTTH/formFFTTH";

/*******CHECKLIST REPORTES*******/

	$route['checklist_reportes'] = "back_end/checklist/checklist_reportes/index";	
	$route['getChecklistReportesInicio'] = "back_end/checklist/checklist_reportes/getChecklistReportesInicio";
	$route['listaReporteChecklist'] = "back_end/checklist/checklist_reportes/listaReporteChecklist";

	$route['graficoReporteChecklist'] = "back_end/checklist/checklist_reportes/graficoReporteChecklist";
	$route['excel_reporte_checklist/(:any)/(:any)'] = "back_end/checklist/checklist_reportes/excel_reporte_checklist/$1/$2";
	
	
	


/* End of file routes.php */
/* Location: ./application/config/routes.php */
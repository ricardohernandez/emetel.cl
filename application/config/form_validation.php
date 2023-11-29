<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
          
      'formUsuario' => array(
            array(
                  'field'   => 'nombres',
                  'label'   => 'Nombres',
                  'rules'   => 'trim|required'
                  ),
            array(
                  'field'   => 'apellidos',
                  'label'   => 'Apellidos',
                  'rules'   => 'trim|required'
            ),
            array(
                  'field'   => 'perfil',
                  'label'   => 'Perfil',
                  'rules'   => 'trim|required'
            ),
            array(
                  'field'   => 'rut',
                  'label'   => 'Rut',
                  'rules'   => 'trim|required'
            ),
            array(
                  'field'   => 'jefe',
                  'label'   => 'Jefe',
                  'rules'   => 'trim'
                  ),
            array(
                  'field'   => 'nacionalidad',
                  'label'   => 'Nacionalidad',
                  'rules'   => 'trim'
                  ),
            array(
                  'field'   => 'area',
                  'label'   => 'Zona',
                  'rules'   => 'trim'
                  ),
            array(
                  'field'   => 'fecha_ingreso',
                  'label'   => 'Fecha ingreso',
                  'rules'   => 'trim'
                  ),
            array(
                  'field'   => 'cargo',
                  'label'   => 'Cargo',
                  'rules'   => 'trim'
                  ),
            array(
                  'field'   => 'plaza',
                  'label'   => 'Plaza',
                  'rules'   => 'trim'
                  ),
            array(
                  'field'   => 'domicilio',
                  'label'   => 'Domicilio',
                  'rules'   => 'trim'
                  ),
            ),

            'formCargos' => array(
               array(
                     'field'   => 'cargo',
                     'label'   => 'Cargo',
                     'rules'   => 'trim|required'
                    )
            ),

            'formProyectos' => array(
               array(
                     'field'   => 'proyecto',
                     'label'   => 'Proyecto',
                     'rules'   => 'trim|required'
                    )
            ),

            'formAreas' => array(
               array(
                     'field'   => 'area',
                     'label'   => 'Zona',
                     'rules'   => 'trim|required'
                    )
            ),

            'formPlazas' => array(
                  array(
                        'field'   => 'plaza',
                        'label'   => 'Plaza',
                        'rules'   => 'trim|required'
                       )
            ),

            'formPerfiles' => array(
               array(
                     'field'   => 'perfil',
                     'label'   => 'Perfil',
                     'rules'   => 'trim|required'
                    )
            ),

            'formJefes' => array(
               array(
                     'field'   => 'jefe',
                     'label'   => 'Jefe',
                     'rules'   => 'trim|required'
                    )
            ),

         
            'nuevaNoticiaAdmin' => array(
               array(
                     'field'   => 'hash',
                     'label'   => 'Error',
                     'rules'   => 'trim'
                    ),
               array(
                     'field'   => 'titulo',
                     'label'   => 'Título ',
                     'rules'   => 'trim|required'
                    ),
               array(
                     'field'   => 'categoria',
                     'label'   => 'Categoría',
                     'rules'   => 'trim'
                    ),
             
               array(
                     'field'   => 'descripcion',
                     'label'   => 'Descripción',
                     'rules'   => 'trim|required'
                    )
            ),

            'nuevaInformacion' => array(
               array(
                     'field'   => 'hash',
                     'label'   => 'Error',
                     'rules'   => 'trim'
                    ),
               array(
                     'field'   => 'titulo',
                     'label'   => 'Título ',
                     'rules'   => 'trim|required'
                    )
            ),

           
            'formTicket' => array(
               array(
                     'field'   => 'titulo',
                     'label'   => 'Título',
                     'rules'   => 'trim|required'
                    ),
               array(
                     'field'   => 'descripcion',
                     'label'   => 'Descripción',
                     'rules'   => 'trim|required'
                    ),
                array(
                     'field'   => 'tipo',
                     'label'   => 'Tipo',
                     'rules'   => 'trim|required'
                    )
            ),

            'formIngresoCapacitacion' => array(
               array(
                     'field'   => 'nombre_archivo',
                     'label'   => 'Nombre de archivo',
                     'rules'   => 'trim|required'
                    )
            ),

            'formVehiculos' => array(
                  array(
                        'field' => 'patente',
                        'label' => 'Patente',
                        'rules' => 'trim|required|exact_length[6]'
                    ),
                    array(
                        'field' => 'kilometraje',
                        'label' => 'Kilometraje',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'anio',
                        'label' => 'Año',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'fecha_alta',
                        'label' => 'Fecha de Alta',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'empresa',
                        'label' => 'Empresa',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'numero_motor',
                        'label' => 'Número de Motor',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'numero_chasis',
                        'label' => 'Número de Chasis',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'color',
                        'label' => 'Color',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'fecha_baja',
                        'label' => 'Fecha de Baja',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'comprador',
                        'label' => 'Comprador',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'observacion',
                        'label' => 'Observación',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'tipo_mantenimiento',
                        'label' => 'Tipo Mantenimiento',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'estado',
                        'label' => 'Estado',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'tipos_mmc',
                        'label' => 'Tipo/Marca/Modelo/Combustible',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'sucursal',
                        'label' => 'Sucursal',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'motivo_baja',
                        'label' => 'Motivo de Baja',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'conductor_actual_fecha_ini',
                        'label' => 'Conductor Actual Fecha de Inicio',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'conductor_actual',
                        'label' => 'Conductor Actual',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'conductor_anterior_fecha_ini',
                        'label' => 'Conductor Anterior Fecha de Inicio',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'conductor_anterior',
                        'label' => 'Conductor Anterior',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_perm_circ_fecha_venc',
                        'label' => 'Doc.-Perm.Circ.-Fecha venc.',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_rev_tecnica_fecha_venc',
                        'label' => 'Doc.-Rev.Técnica-Fecha venc.',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_rev_gases_fecha_venc',
                        'label' => 'Doc.-Rev.Gases-Fecha venc.',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_seguro_obli_fecha_venc',
                        'label' => 'Doc.-Seguro Oblig.-Fecha venc.',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_seguro_danos_compania',
                        'label' => 'Doc.-Seguro Daños-Compañía',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_seguro_danios_poliza',
                        'label' => 'Doc.-Seguro Daños-Póliza',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'doc_seguro_danios_fecha_venc',
                        'label' => 'Doc.-Seguro Daños-Fecha venc.',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_tag',
                        'label' => 'Equip.-Tag',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_extintor',
                        'label' => 'Equip.-Extintor',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_neumatico_repuesto',
                        'label' => 'Equip.-Neumático Repuesto',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_botiquin',
                        'label' => 'Equip.-Botiquín',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_llave_rueda',
                        'label' => 'Equip.-Llave de Rueda',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_gata',
                        'label' => 'Equip.-Gata',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_gps',
                        'label' => 'Equip.-GPS',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_extintor_fecha_venc',
                        'label' => 'Equip.-Extintor-Fecha venc.',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_tarj_comb_numero',
                        'label' => 'Equip.-Tarj.Comb.N°',
                        'rules' => 'trim'
                    ),
                    array(
                        'field' => 'equip_tarj_clave',
                        'label' => 'Equip.-Tarj.Clave',
                        'rules' => 'trim'
                    )
            ),

            'formMat' => array(
                array(
                    'field'   => 'tipo_mat',
                    'label'   => 'Tipo',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'actividad_mat',
                    'label'   => 'Actividad',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'unidad_mat',
                    'label'   => 'Unidad',
                    'rules'   => 'trim'
                ),
                array(
                    'field'   => 'rango_mat',
                    'label'   => 'Rango',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'estado_mat',
                    'label'   => 'Estado',
                    'rules'   => 'trim|required'
                ),
           
            ),

            'formActividad' => array(
                array(
                    'field'   => 'actividad',
                    'label'   => 'Actividad',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'tipo_a',
                    'label'   => 'Tipo',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'unidad',
                    'label'   => 'Unidad',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'rango',
                    'label'   => 'Rango',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'estado_a',
                    'label'   => 'Estado',
                    'rules'   => 'trim|required'
                )
            ),
  
            'formMarca' => array(
                array(
                    'field'   => 'marca_ma',
                    'label'   => 'Marca',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'estado_ma',
                    'label'   => 'Estado',
                    'rules'   => 'trim|required'
                )
            ),
            

            'formModelo' => array(
                array(
                    'field'   => 'marca_m',
                    'label'   => 'Marca',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'modelo_m',
                    'label'   => 'Modelo',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'estado_m',
                    'label'   => 'Estado',
                    'rules'   => 'trim|required'
                )
            ),
            
            
            
            'formMmc' => array(
                array(
                    'field'   => 'tipo',
                    'label'   => 'Tipo',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'marca',
                    'label'   => 'Marca',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'modelo',
                    'label'   => 'Modelo',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'combustible',
                    'label'   => 'Combustible',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'desde_mmc',
                    'label'   => 'Desde',
                    'rules'   => 'trim|required'
                ),  
                array(
                    'field'   => 'hasta_mmc',
                    'label'   => 'Hasta',
                    'rules'   => 'trim|required'
                )
            ),
			
            'formTicketMant' => array(
              
                array(
                    'field'   => 'patente_mantencion',
                    'label'   => 'Patente',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'actividad_mantencion',
                    'label'   => 'Actividad',
                    'rules'   => 'trim|required'
                ),  
                array(
                    'field'   => 'estado_mant',
                    'label'   => 'Estado',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'nuevo_km',
                    'label'   => 'Nuevo km',
                    'rules'   => 'trim'
                ),
                array(
                    'field'   => 'nueva_fecha',
                    'label'   => 'Nueva fecha vencimiento',
                    'rules'   => 'trim'
                ),
                array(
                    'field'   => 'observacion_mant',
                    'label'   => 'Observación',
                    'rules'   => 'trim'
                ),
            ),

            'formrkm' => array(
                array(
                    'field'   => 'id_tecnico',
                    'label'   => 'código técnico',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'id_vehiculo',
                    'label'   => 'patente',
                    'rules'   => 'trim|required'
                ),  
                array(
                    'field'   => 'kilometraje',
                    'label'   => 'kilometraje',
                    'rules'   => 'trim|required'
                ),
            ),
            
 );

 
 
 
 
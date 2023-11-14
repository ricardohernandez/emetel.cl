<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->uri->segment("1")==""){
			redirect("inicio");
		}
		$this->load->model("back_end/flota/Flotamodel");
		$this->load->model("back_end/Iniciomodel");
		$this->load->library('user_agent');
	}

	public function visitas($modulo){
		$this->load->library('user_agent');
		$data=array("id_usuario"=>$this->session->userdata('id'),
			"id_aplicacion"=>13,
			"modulo"=>$modulo,
	     	"fecha"=>date("Y-m-d G:i:s"),
	    	"navegador"=>"navegador :".$this->agent->browser()."\nversion :".$this->agent->version()."\nos :".$this->agent-> platform()."\nmovil :".$this->agent->mobile(),
	    	"ip"=>$this->input->ip_address(),
    	);
    	$this->Flotamodel->insertarVisita($data);
	}

	public function checkLogin(){
		if(!$this->session->userdata('id')){
			echo json_encode(array('res'=>"sess"));exit;
		}
	}

	
	public function acceso(){
      if($this->session->userdata('id')){
      	if($this->session->userdata('id_perfil')>3){
      		redirect("./login");
      	}
      }else{
      	redirect("./login");
      }
	}

	//USUARIOS

		public function formCargaMasiva(){
			sleep(1);
			if($_FILES['userfile']['name']==""){
			    echo json_encode(array('res'=>'error',  "tipo" => "error" , 'msg'=>"Debe seleccionar un archivo."));exit;
			}
			$fname = $_FILES['userfile']['name'];
			if (strpos($fname, ".") == false) {
	        	 echo json_encode(array('res'=>'error', "tipo" => "error" , 'msg'=>"Debe seleccionar un archivo válido."));exit;
	        }
	        $chk_ext = explode(".",$fname);

	        if($chk_ext[1]!="csv"){
	        	 echo json_encode(array('res'=>'error', "tipo" => "error" , 'msg'=>"Debe seleccionar un archivo CSV."));exit;
	        }

	        $fname = $_FILES['userfile']['name'];
	        $chk_ext = explode(".",$fname);

	        if(strtolower(end($chk_ext)) == "csv")  {
	            $filename = $_FILES['userfile']['tmp_name'];
	            $handle = fopen($filename, "r");
	            $i=0;$z=0;$y=0;     
	         	
	            while (($data = fgetcsv($handle, 9999, ";")) !== FALSE) {
	                $i++;

					$rut = preg_replace('/^00/', '', $data[3]);
					$rut = preg_replace('/[-.,]/', '', $rut); // Eliminar guiones medios, puntos y comas
					$rut = strtolower($rut); // Convertir a minúsculas
					$estado = ($data[31] === "Activo") ? 1 : 0;

	                if(!empty($data[0])){
						$data=array("id_cargo"=>$data[7],
							"id_proyecto"=>$data[11],
							"id_area"=>$data[8],//cambiar a id_zona
							"id_perfil"=>($data[26] > 0) ? $data[26] : 4,
							"id_jefe"=>$data[12],
							"id_tipo_contrato"=>3,//$data[13]
							"id_plaza" => $data[10],
							"nombres"=>$data[0],
							"apellidos"=>$data[1],
							"rut"=>$rut,//eliminar 2 ceros
							"empresa"=>$data[2],
							"comuna"=>0,
							"codigo"=>$data[14],
							"id_nivel_tecnico"=>1,//$data[15] cambiar a id hfc senior
							"sexo"=>$data[4],
							"nacionalidad"=>$data[5],
							"estado_civil"=>$data[6],
							"domicilio"=>$data[16],
							"ciudad"=>$data[18],
							"subzona"=>$data[9],
							"celular_empresa"=>$data[19],
							"celular_personal"=>$data[20],
							"correo_empresa"=>$data[21],
							"correo_personal"=>$data[22],
							"fecha_nacimiento"=>null,//$data[23]
							"fecha_ingreso"=>null,//$data[24]
							"fecha_salida"=>null,//$data[25]
							"talla_zapato"=>$data[27],
							"talla_pantalon"=>$data[28],
							"talla_polera"=>$data[29],
							"talla_cazadora"=>$data[30],
							"estado"=>$estado,
							"contrasena"=>sha1($rut),
							"ultima_actualizacion"=>date("Y-m-d G:i:s")." | ".$this->session->userdata("nombre_completo"),
						);	

						$this->Flotamodel->formUsuario($data);
		            }
	            }

	            fclose($handle); 
	           	echo json_encode(array('res'=>'ok', "tipo" => "success", 'msg' => "Archivo cargado con éxito."));exit;

	        }else{
	        	echo json_encode(array('res'=>'error', "tipo" => "error", 'msg' => "Archivo CSV inválido."));exit;
	        }   
		}

		public function index(){
			$this->visitas("Vehículos");
	    	$this->acceso();
		    $datos = array(
		        'titulo' => "Control flota vehículos",
		        'contenido' => "flota/inicio",
		        'perfiles' => $this->Iniciomodel->listaPerfiles(),
			);  
			$this->load->view('plantillas/plantilla_back_end',$datos);
		}

	    public function vistaVehiculos(){
			if($this->input->is_ajax_request()){
				$desde = date('d-m-Y', strtotime('-365 day', strtotime(date("d-m-Y"))));
		    	$hasta = date('d-m-Y');
				$estados = $this->Flotamodel->listaEstados();
				$combustibles = $this->Flotamodel->listaCombustibles();
				$marcas = $this->Flotamodel->listaMarcas();
				$modelos = $this->Flotamodel->listaModelos();
				$motivos_bajas = $this->Flotamodel->listaMotivos();
				$tipos = $this->Flotamodel->listaTipos();
				$tipos_mmc = $this->Flotamodel->listaTiposMMC();
				$plazas = $this->Flotamodel->listaPlazas();
				$conductores = $this->Flotamodel->listaConductores();
				
				$datos = array(
					'desde' => $desde,
					'hasta' => $hasta,
					'estados' => $estados,
					'tipos' => $tipos,
					'tipos_mmc' => $tipos_mmc,
					'marcas' => $marcas,
					'modelos' => $modelos,
					'combustibles' => $combustibles,
					'motivos_bajas' => $motivos_bajas,
					'plazas' => $plazas,
					'conductores' => $conductores,
			    );

				$this->load->view('back_end/flota/vehiculos',$datos);
			}
		}

		public function listaVehiculos(){
			$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
			echo json_encode($this->Flotamodel->listaVehiculos($estado));
		}

		public function formVehiculos(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash_vehiculo=$this->security->xss_clean(strip_tags($this->input->post("hash_vehiculo")));
				$patente = $this->security->xss_clean(strip_tags($this->input->post("patente")));
				$kilometraje = $this->security->xss_clean(strip_tags($this->input->post("kilometraje")));
				$anio = $this->security->xss_clean(strip_tags($this->input->post("anio")));
				$fecha_alta = $this->security->xss_clean(strip_tags($this->input->post("fecha_alta")));
				$empresa = $this->security->xss_clean(strip_tags($this->input->post("empresa")));
				$numero_motor = $this->security->xss_clean(strip_tags($this->input->post("numero_motor")));
				$numero_chasis = $this->security->xss_clean(strip_tags($this->input->post("numero_chasis")));
				$color = $this->security->xss_clean(strip_tags($this->input->post("color")));
				$fecha_baja = $this->security->xss_clean(strip_tags($this->input->post("fecha_baja")));
				$comprador = $this->security->xss_clean(strip_tags($this->input->post("comprador")));
				$observacion = $this->security->xss_clean(strip_tags($this->input->post("observacion")));
				$tipo_mantenimiento = $this->security->xss_clean(strip_tags($this->input->post("tipo_mantenimiento")));
				$estado = $this->security->xss_clean(strip_tags($this->input->post("estado")));
 				$sucursal = $this->security->xss_clean(strip_tags($this->input->post("sucursal")));
				$motivo_baja = $this->security->xss_clean(strip_tags($this->input->post("motivo_baja")));
				$conductor_actual_fecha_ini = $this->security->xss_clean(strip_tags($this->input->post("conductor_actual_fecha_ini")));
				$conductor_actual = $this->security->xss_clean(strip_tags($this->input->post("conductor_actual")));
				$conductor_anterior_fecha_ini = $this->security->xss_clean(strip_tags($this->input->post("conductor_anterior_fecha_ini")));
				$conductor_anterior = $this->security->xss_clean(strip_tags($this->input->post("conductor_anterior")));
				$doc_perm_circ_fecha_venc = $this->security->xss_clean(strip_tags($this->input->post("doc_perm_circ_fecha_venc")));
				$doc_rev_tecnica_fecha_venc = $this->security->xss_clean(strip_tags($this->input->post("doc_rev_tecnica_fecha_venc")));
				$doc_rev_gases_fecha_venc = $this->security->xss_clean(strip_tags($this->input->post("doc_rev_gases_fecha_venc")));
				$doc_seguro_obli_fecha_venc = $this->security->xss_clean(strip_tags($this->input->post("doc_seguro_obli_fecha_venc")));
				$doc_seguro_danos_compania = $this->security->xss_clean(strip_tags($this->input->post("doc_seguro_danos_compania")));
				$doc_seguro_danios_poliza = $this->security->xss_clean(strip_tags($this->input->post("doc_seguro_danios_poliza")));
				$doc_seguro_danios_fecha_venc = $this->security->xss_clean(strip_tags($this->input->post("doc_seguro_danios_fecha_venc")));
				$equip_tag = $this->security->xss_clean(strip_tags($this->input->post("equip_tag")));
				$equip_extintor = $this->security->xss_clean(strip_tags($this->input->post("equip_extintor")));
				$equip_neumatico_repuesto = $this->security->xss_clean(strip_tags($this->input->post("equip_neumatico_repuesto")));
				$equip_botiquin = $this->security->xss_clean(strip_tags($this->input->post("equip_botiquin")));
				$equip_llave_rueda = $this->security->xss_clean(strip_tags($this->input->post("equip_llave_rueda")));
				$equip_gata = $this->security->xss_clean(strip_tags($this->input->post("equip_gata")));
				$equip_gps = $this->security->xss_clean(strip_tags($this->input->post("equip_gps")));
				$equip_extintor_fecha_venc = $this->security->xss_clean(strip_tags($this->input->post("equip_extintor_fecha_venc")));
				$equip_tarj_comb_numero = $this->security->xss_clean(strip_tags($this->input->post("equip_tarj_comb_numero")));
				$equip_tarj_clave = $this->security->xss_clean(strip_tags($this->input->post("equip_tarj_clave")));

				$ultima_actualizacion=date("Y-m-d G:i:s")." | ".$this->session->userdata("nombres")." ".$this->session->userdata("apellidos");

				if ($this->form_validation->run("formVehiculos") == FALSE){
					echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
				}else{	

					$data = array(
						"patente" => $patente,
						"id_tipo_mantenimiento" => $tipo_mantenimiento,
						"id_estado" => $estado,
 						"id_sucursal" => $sucursal,
						"id_motivo_baja" => $motivo_baja,
						"id_conductor_actual" => $conductor_actual,
						"id_conductor_anterior" => $conductor_anterior,
						"id_digitador" => $this->session->userdata("id"),
						"kilometraje" => $kilometraje,
						"anio" => $anio,
						"fecha_alta" => $fecha_alta,
						"empresa" => $empresa,
						"numero_motor" => $numero_motor,
						"numero_chasis" => $numero_chasis,
						"color" => $color,
						"fecha_baja" => $fecha_baja,
						"comprador" => $comprador,
						"observacion" => $observacion, 
						"conductor_actual_fecha_ini" => $conductor_actual_fecha_ini,
						"conductor_anterior_fecha_ini" => $conductor_anterior_fecha_ini,
						"doc_perm_circ_fecha_venc" => $doc_perm_circ_fecha_venc,
						"doc_rev_tecnica_fecha_venc" => $doc_rev_tecnica_fecha_venc,
						"doc_rev_gases_fecha_venc" => $doc_rev_gases_fecha_venc,
						"doc_seguro_obli_fecha_venc" => $doc_seguro_obli_fecha_venc,
						"doc_seguro_danos_compania" => $doc_seguro_danos_compania,
						"doc_seguro_danios_poliza" => $doc_seguro_danios_poliza,
						"doc_seguro_danios_fecha_venc" => $doc_seguro_danios_fecha_venc,
						"equip_tag" => $equip_tag,
						"equip_extintor" => $equip_extintor,
						"equip_neumatico_repuesto" => $equip_neumatico_repuesto,
						"equip_botiquin" => $equip_botiquin,
						"equip_llave_rueda" => $equip_llave_rueda,
						"equip_gata" => $equip_gata,
						"equip_gps" => $equip_gps,
						"equip_extintor_fecha_venc" => $equip_extintor_fecha_venc,
						"equip_tarj_comb_numero" => $equip_tarj_comb_numero,
						"equip_tarj_clave" => $equip_tarj_clave,
						"ultima_actualizacion" => $ultima_actualizacion,
					);
					
					if($hash_vehiculo==""){

						$existe = $this->Flotamodel->existeVehiculo($patente);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "La patente ya se encuentra registrada."));exit;
						}

						$id=$this->Flotamodel->formVehiculos($data);
						if($id!=FALSE){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}
						
					}else{

						/* if($estado=="0"){
							$data["fecha_salida"]=$fecha_salida;
						}

						$foto=@$_FILES["foto"]["name"];
						if($foto!=""){
							$foto=$this->procesaArchivo($_FILES["foto"],$rutf);
							$data["foto"]=$foto;
						} */

						if($this->Flotamodel->actualizarVehiculos($hash_vehiculo,$data)){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
						}
					}
	    		}	
			}
		}

		public function getDataVehiculos(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash_vehiculo=$this->security->xss_clean(strip_tags($this->input->post("hash_vehiculo")));
				$data=$this->Flotamodel->getDataVehiculos($hash_vehiculo);
			
				if($data){
					echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
				}else{
					echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
				}	
			}else{
				exit('No direct script access allowed');
			}
		}

		public function eliminaVehiculos(){
			$hash_vehiculo=$this->security->xss_clean(strip_tags($this->input->post("hash_vehiculo")));
		    if($this->Flotamodel->eliminaVehiculos($hash_vehiculo)){
		      echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
		    }else{
		      echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
		    }
		}

		public function excelUsuarios(){
			$estado=$this->uri->segment(2);
			$data=$this->Flotamodel->listaUsuarios($estado);

			if(!$data){
				return FALSE;
			}else{

				$nombre="reporte-usuarios.xls";
				header("Content-type: application/vnd.ms-excel;  charset=utf-8");
				header("Content-Disposition: attachment; filename=$nombre");
				?>
				<style type="text/css">
				.head{font-size:13px;height: 30px; background-color:#32477C;color:#fff; font-weight:bold;padding:10px;margin:10px;vertical-align:middle;}
				td{font-size:12px;text-align:center;   vertical-align:middle;}
				</style>
				<h3>Reporte Usuarios </h3>
					<table align='center' border="1"> 
				        <tr style="background-color:#F9F9F9">
						    <th class="head">Nombre</th> 
						    <th class="head">Apellidos</th> 
						    <th class="head">Empresa</th> 
						    <th class="head">Rut</th> 
						    <th class="head">Sexo</th> 
						    <th class="head">Nacionalidad</th> 
						    <th class="head">Estado civil</th> 
						    <th class="head">Cargo</th> 
						    <th class="head">Zona</th> 
						    <th class="head">Subzona</th> 
						    <th class="head">Plaza</th> 
						    <th class="head">Proyecto</th> 
						    <th class="head">Jefe</th> 
						    <th class="head">Tipo contrato</th> 
						    <th class="head">C&oacute;digo</th> 
						    <th class="head">Nivel t&eacute;cnico</th> 
						    <th class="head">Domicilio</th> 
						    <th class="head">Comuna</th> 
						    <th class="head">Ciudad</th> 
						    <th class="head">Celular empresa</th> 
						    <th class="head">Celular personal</th> 
						    <th class="head">Correo empresa</th> 
						    <th class="head">Correo personal</th> 
						    <th class="head">Fecha nacimiento</th> 
						    <th class="head">Fecha ingreso</th> 
						    <th class="head">Fecha salida</th> 
						    <th class="head">Perfil</th> 
						    <th class="head">Talla zapato</th> 
						    <th class="head">Talla pantalon</th> 
						    <th class="head">Talla polera</th>   
						    <th class="head">Talla cazadora</th>   
						    <th class="head">Estado</th>   
						    <th class="head">&Uacute;ltima actualizaci&oacute;n</th>   
				        </tr>
				        </thead>	
						<tbody>
				        <?php 
				        	if($data !=FALSE){
					      		foreach($data as $d){
				      			?>
				      			 <tr>
									 <td><?php echo utf8_decode($d["nombres"]); ?></td>
									 <td><?php echo utf8_decode($d["apellidos"]); ?></td>
									 <td><?php echo utf8_decode($d["empresa"]); ?></td>
									 <td><?php echo utf8_decode($d["rut"]); ?></td>
									 <td><?php echo utf8_decode($d["sexo"]); ?></td>
									 <td><?php echo utf8_decode($d["nacionalidad"]); ?></td>
									 <td><?php echo utf8_decode($d["estado_civil"]); ?></td>
									 <td><?php echo utf8_decode($d["cargo"]); ?></td>
									 <td><?php echo utf8_decode($d["area"]); ?></td>
									 <td><?php echo utf8_decode($d["subzona"]); ?></td>
									 <td><?php echo utf8_decode($d["plaza"]); ?></td>
									 <td><?php echo utf8_decode($d["proyecto"]); ?></td>
									 <td><?php echo utf8_decode($d["jefe"]); ?></td>
									 <td><?php echo utf8_decode($d["tipo_contrato"]); ?></td>
									 <td><?php echo utf8_decode($d["codigo"]); ?></td>
									 <td><?php echo utf8_decode($d["nivel_tecnico"]); ?></td>
									 <td><?php echo utf8_decode($d["domicilio"]); ?></td>
									 <td><?php echo utf8_decode($d["comuna"]); ?></td>
									 <td><?php echo utf8_decode($d["ciudad"]); ?></td>
									 <td><?php echo utf8_decode($d["celular_empresa"]); ?></td>
									 <td><?php echo utf8_decode($d["celular_personal"]); ?></td>
									 <td><?php echo utf8_decode($d["correo_empresa"]); ?></td>
									 <td><?php echo utf8_decode($d["correo_personal"]); ?></td>
									 <td><?php echo utf8_decode($d["fecha_nacimiento"]); ?></td>
									 <td><?php echo utf8_decode($d["fecha_ingreso"]); ?></td>
									 <td><?php echo utf8_decode($d["fecha_salida"]); ?></td>
									 <td><?php echo utf8_decode($d["perfil"]); ?></td>
									 <td><?php echo utf8_decode($d["talla_zapato"]); ?></td>
									 <td><?php echo utf8_decode($d["talla_pantalon"]); ?></td>
									 <td><?php echo utf8_decode($d["talla_polera"]); ?></td>
									 <td><?php echo utf8_decode($d["talla_cazadora"]); ?></td>
									 <td><?php echo utf8_decode($d["estado_str"]); ?></td>
									 <td><?php echo utf8_decode($d["ultima_actualizacion"]); ?></td>
								 </tr>
				      			<?php
				      			}
				      		}
				          ?>
				        </tbody>
			        </table>
			    <?php
			}
		}

		public function procesaArchivo($file,$titulo){
			$path = $file['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$archivo=strtolower(url_title(convert_accented_characters($titulo.rand(10, 1000)))).".".$ext;
			$config['upload_path'] = './fotos_usuarios';
		
			$config['allowed_types'] = 'jpg|jpeg|bmp|png|PNG|JPG|JPEG|BMP|PNG';
		    $config['file_name'] = $archivo;
			$config['max_size']	= '5300';
			$config['overwrite']	= FALSE;
			$this->load->library('upload', $config);
			$_FILES['userfile']['name'] = $archivo;
		    $_FILES['userfile']['type'] = $file['type'];
		    $_FILES['userfile']['tmp_name'] = $file['tmp_name'];
		    $_FILES['userfile']['error'] = $file['error'];
			$_FILES['userfile']['size'] = $file['size'];
			$this->upload->initialize($config);

			if (!$this->upload->do_upload()){ 
			    echo json_encode(array('res'=>"error", 'msg' =>strip_tags($this->upload->display_errors())));exit;
		    }else{
		    	unset($config);
		    	return $archivo;
		    }
    	}


	
}
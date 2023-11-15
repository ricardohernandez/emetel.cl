<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mantenedores extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->uri->segment("1")==""){
			redirect("inicio");
		}
		$this->load->model("back_end/flota/Mantenedoresmodel");
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
    	$this->Mantenedoresmodel->insertarVisita($data);
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

	
	public function vistaMantenciones(){
		if($this->input->is_ajax_request()){
			$desde = date('d-m-Y', strtotime('-365 day', strtotime(date("d-m-Y"))));
			$hasta = date('d-m-Y');
			$combustibles = $this->Flotamodel->listaCombustibles();
			$marcas = $this->Flotamodel->listaMarcas();
			$modelos = $this->Flotamodel->listaModelos();
			$tipos = $this->Flotamodel->listaTipos();
			$tipos_mmc = $this->Mantenedoresmodel->listaTiposMMC();
			$actividades = $this->Mantenedoresmodel->listaActividadesOpt();
			
			$datos = array(
				'desde' => $desde,
				'hasta' => $hasta,
				'tipos' => $tipos,
				'tipos_mmc' => $tipos_mmc,
				'marcas' => $marcas,
				'modelos' => $modelos,
				'combustibles' => $combustibles,
				'actividades' => $actividades,
			);

			$this->load->view('back_end/flota/mantenedores/mantenciones',$datos);
		}
	}


		//ASIGNACION ACTIVIDADES
			public function listaMat(){
				$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
				echo json_encode($this->Mantenedoresmodel->listaMat($estado));
			}

			public function listaTiposMmc(){
 				echo $this->Mantenedoresmodel->listaTiposMmcS2();
			}

			public function formMat(){
				if($this->input->is_ajax_request()){
					$this->checkLogin();
					$hash_mat=$this->security->xss_clean(strip_tags($this->input->post("hash_mat")));
					$actividad = $this->security->xss_clean(strip_tags($this->input->post("actividad_mat")));
					$tipo = $this->security->xss_clean(strip_tags($this->input->post("tipo_mat")));
					$unidad = $this->security->xss_clean(strip_tags($this->input->post("unidad_mat")));
					$rango = $this->security->xss_clean(strip_tags($this->input->post("rango_mat")));
					$estado = $this->security->xss_clean(strip_tags($this->input->post("estado_mat")));
					$desde = $this->security->xss_clean(strip_tags($this->input->post("desde_mat")));
					$hasta = $this->security->xss_clean(strip_tags($this->input->post("hasta_mat")));
					$ultima_actualizacion=date("Y-m-d G:i:s")." | ".$this->session->userdata("nombres")." ".$this->session->userdata("apellidos");

					if ($this->form_validation->run("formMat") == FALSE){
						echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
					}else{	

						$data = array(
							"id_tipo_mmc" => $tipo,
							"id_actividad" => $actividad,
							"unidad" => $unidad,
							"rango" => $rango,
							"estado" => $estado,
							"desde" => $desde,
							"hasta" => $hasta,
							"ultima_actualizacion" => $ultima_actualizacion,
						);
						
						if($hash_mat==""){

							$existe = $this->Mantenedoresmodel->existeMat($data);

							if($existe){
								echo json_encode(array("res" => "error" , "msg" => "Ya existe una configuracion de mantención con estos parametros."));exit;
							}

							$id=$this->Mantenedoresmodel->formMat($data);
							if($id!=FALSE){
								echo json_encode(array('res'=>"ok", 'msg' => OK_MSG));exit;
							}else{
								echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
							}
							
						}else{

							$existe = $this->Mantenedoresmodel->existeMatMod($hash_mat,$data);

							if($existe){
								echo json_encode(array("res" => "error" , "msg" => "Ya existe una actividad de mantención con estos parametros."));exit;
							}

							if($this->Mantenedoresmodel->actualizarMat($hash_mat,$data)){
								echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
							}else{
								echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
							}
						}
					}	
				}
			}

			public function getDataMat(){
				if($this->input->is_ajax_request()){
					$this->checkLogin();
					$hash_mat=$this->security->xss_clean(strip_tags($this->input->post("hash")));
					$data=$this->Mantenedoresmodel->getDataMat($hash_mat);
				
					if($data){
						echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
					}else{
						echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
					}	
				}else{
					exit('No direct script access allowed');
				}
			}

			public function eliminarMat(){
				$hash_mat=$this->security->xss_clean(strip_tags($this->input->post("hash")));
				if($this->Mantenedoresmodel->eliminarMat($hash_mat)){
					echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
				}else{
					echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
				}
			}
			
	
		//ACTIVIDADES
			public function listaActividades(){
				$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
				echo json_encode($this->Mantenedoresmodel->listaActividades($estado));
			}

			public function formActividad(){
				if($this->input->is_ajax_request()){
					$this->checkLogin();
					$hash_vac=$this->security->xss_clean(strip_tags($this->input->post("hash_actividad")));
					$actividad = $this->security->xss_clean(strip_tags($this->input->post("actividad")));
					$tipo = $this->security->xss_clean(strip_tags($this->input->post("tipo_a")));
					$unidad = $this->security->xss_clean(strip_tags($this->input->post("unidad")));
					$rango = $this->security->xss_clean(strip_tags($this->input->post("rango")));
					$estado = $this->security->xss_clean(strip_tags($this->input->post("estado_a")));
					
					if ($this->form_validation->run("formActividad") == FALSE){
						echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
					}else{	

						$data = array(
							"actividad" => $actividad,
							"tipo" => $tipo,
							"unidad" => $unidad,
							"rango" => $rango,
							"estado" => $estado
						);
						
						if($hash_vac==""){

							$existe = $this->Mantenedoresmodel->existeActividad($data);

							if($existe){
								echo json_encode(array("res" => "error" , "msg" => "Ya existe una configuracion de mantención con estos parametros."));exit;
							}

							$id=$this->Mantenedoresmodel->formActividad($data);
							if($id!=FALSE){
								echo json_encode(array('res'=>"ok", 'msg' => OK_MSG));exit;
							}else{
								echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
							}
							
						}else{

							$existe = $this->Mantenedoresmodel->existeActividadMod($hash_vac,$data);

							if($existe){
								echo json_encode(array("res" => "error" , "msg" => "Ya existe una actividad de mantención con estos parametros."));exit;
							}

							if($this->Mantenedoresmodel->actualizarActividad($hash_vac,$data)){
								echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
							}else{
								echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
							}
						}
					}	
				}
			}

			public function getDataActividad(){
				if($this->input->is_ajax_request()){
					$this->checkLogin();
					$hash_vac=$this->security->xss_clean(strip_tags($this->input->post("hash")));
					$data=$this->Mantenedoresmodel->getDataActividad($hash_vac);
				
					if($data){
						echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
					}else{
						echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
					}	
				}else{
					exit('No direct script access allowed');
				}
			}

			public function eliminarActividad(){
				$hash_vac=$this->security->xss_clean(strip_tags($this->input->post("hash")));
				if($this->Mantenedoresmodel->eliminarActividad($hash_vac)){
					echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
				}else{
					echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
				}
			}

	//MMC

		public function listaMmc(){
			$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
			echo json_encode($this->Mantenedoresmodel->listaMmc($estado));
		}

		public function formMmc(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash_mmc=$this->security->xss_clean(strip_tags($this->input->post("hash_mmc")));
				$tipo = $this->security->xss_clean(strip_tags($this->input->post("tipo")));
				$marca = $this->security->xss_clean(strip_tags($this->input->post("marca")));
				$modelo = $this->security->xss_clean(strip_tags($this->input->post("modelo")));
				$combustible = $this->security->xss_clean(strip_tags($this->input->post("combustible")));
				$ultima_actualizacion=date("Y-m-d G:i:s")." | ".$this->session->userdata("nombres")." ".$this->session->userdata("apellidos");

				if ($this->form_validation->run("formMmc") == FALSE){
					echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
				}else{	

					$data = array(
						"id_tipo" => $tipo,
						"id_marca" => $marca,
						"id_modelo" => $modelo,
						"id_combustible" => $combustible,
						"ultima_actualizacion" => $ultima_actualizacion,
					);
					
					if($hash_mmc==""){

						$existe = $this->Mantenedoresmodel->existeMmc($data);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "Ya existe una configuracion de mantencion con estos parametros."));exit;
						}

						$id=$this->Mantenedoresmodel->formMmc($data);
						if($id!=FALSE){
							echo json_encode(array('res'=>"ok", 'msg' => OK_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}
						
					}else{
	
						$existe = $this->Mantenedoresmodel->existeMmcMod($hash_mmc,$data);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "Ya existe una configuracion de mantencion con estos parametros."));exit;
						}

						if($this->Mantenedoresmodel->actualizarMmc($hash_mmc,$data)){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
						}
					}
				}	
			}
		}

		public function getDataMmc(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash_mmc=$this->security->xss_clean(strip_tags($this->input->post("hash_mmc")));
				$data=$this->Mantenedoresmodel->getDataMmc($hash_mmc);
			
				if($data){
					echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
				}else{
					echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
				}	
			}else{
				exit('No direct script access allowed');
			}
		}

		public function eliminaMmc(){
			$hash_mmc=$this->security->xss_clean(strip_tags($this->input->post("hash_mmc")));
			if($this->Mantenedoresmodel->eliminaMmc($hash_mmc)){
				echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
			}else{
				echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
			}
		}

	//MARCAS

		public function listaMarcas(){
			$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
			echo json_encode($this->Mantenedoresmodel->listaMarcas($estado));
		}

		public function formMarca(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash_marca=$this->security->xss_clean(strip_tags($this->input->post("hash_marca")));
				$marca = $this->security->xss_clean(strip_tags($this->input->post("marca_ma")));
 				$estado = $this->security->xss_clean(strip_tags($this->input->post("estado_ma")));

				if ($this->form_validation->run("formMarca") == FALSE){
					echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
				}else{	

					$data = array(
						"marca" => $marca,
						"estado" => $estado,
					);
					
					if($hash_marca==""){

						$existe = $this->Mantenedoresmodel->existeMarca($data);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "Ya existe este modelo."));exit;
						}

						$id=$this->Mantenedoresmodel->formMarca($data);
						if($id!=FALSE){
							echo json_encode(array('res'=>"ok", 'msg' => OK_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}
						
					}else{

						$existe = $this->Mantenedoresmodel->existeMarcaMod($hash_marca,$data);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "Ya existe este modelo."));exit;
						}

						if($this->Mantenedoresmodel->actualizarMarca($hash_marca,$data)){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
						}
					}
				}	
			}
		}

		public function getDataMarca(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash=$this->security->xss_clean(strip_tags($this->input->post("hash")));
				$data=$this->Mantenedoresmodel->getDataMarca($hash);
			
				if($data){
					echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
				}else{
					echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
				}	
			}else{
				exit('No direct script access allowed');
			}
		}

		public function eliminarMarca(){
			$hash=$this->security->xss_clean(strip_tags($this->input->post("hash")));
			if($this->Mantenedoresmodel->eliminarMarca($hash)){
				echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
			}else{
				echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
			}
		}

 
	//MODELOS	

		public function listaModelos(){
			$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
			echo json_encode($this->Mantenedoresmodel->listaModelos($estado));
		}

		public function formModelo(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash_modelo=$this->security->xss_clean(strip_tags($this->input->post("hash_modelo")));
				$marca = $this->security->xss_clean(strip_tags($this->input->post("marca_m")));
				$modelo = $this->security->xss_clean(strip_tags($this->input->post("modelo_m")));
				$estado = $this->security->xss_clean(strip_tags($this->input->post("estado_m")));
				$ultima_actualizacion=date("Y-m-d G:i:s")." | ".$this->session->userdata("nombres")." ".$this->session->userdata("apellidos");

				if ($this->form_validation->run("formModelo") == FALSE){
					echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
				}else{	

					$data = array(
						"id_marca" => $marca,
						"modelo" => $modelo,
						"estado" => $estado,
					);
					
					if($hash_modelo==""){

						$existe = $this->Mantenedoresmodel->existeModelo($data);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "Ya existe este modelo."));exit;
						}

						$id=$this->Mantenedoresmodel->formModelo($data);
						if($id!=FALSE){
							echo json_encode(array('res'=>"ok", 'msg' => OK_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}
						
					}else{
	
						$existe = $this->Mantenedoresmodel->existeModeloMod($hash_modelo,$data);

						if($existe){
							echo json_encode(array("res" => "error" , "msg" => "Ya existe este modelo."));exit;
						}

						if($this->Mantenedoresmodel->actualizarModelo($hash_modelo,$data)){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
						}
					}
				}	
			}
		}

		public function getDataModelo(){
			if($this->input->is_ajax_request()){
				$this->checkLogin();
				$hash=$this->security->xss_clean(strip_tags($this->input->post("hash")));
				$data=$this->Mantenedoresmodel->getDataModelo($hash);
			
				if($data){
					echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
				}else{
					echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
				}	
			}else{
				exit('No direct script access allowed');
			}
		}

		public function eliminarModelo(){
			$hash=$this->security->xss_clean(strip_tags($this->input->post("hash")));
			if($this->Mantenedoresmodel->eliminarModelo($hash)){
				echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
			}else{
				echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
			}
		}

	
}
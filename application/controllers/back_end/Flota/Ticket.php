<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->uri->segment("1")==""){
			redirect("inicio");
		}
		$this->load->model("back_end/flota/Ticketmodel");
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
    	$this->Ticketmodel->insertarVisita($data);
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

	
	public function vistaTicket(){
		if($this->input->is_ajax_request()){
			$desde = date('d-m-Y', strtotime('-365 day', strtotime(date("d-m-Y"))));
			$hasta = date('d-m-Y');
			$estados = $this->Ticketmodel->listaEstadosMant();
			
			$datos = array(
				'desde' => $desde,
				'hasta' => $hasta,
				'estados' => $estados,
			);

			$this->load->view('back_end/flota/ticket',$datos);
		}
	}


	public function listaTicket(){
		$estado=$this->security->xss_clean(strip_tags($this->input->get_post("estado")));
		echo json_encode($this->Ticketmodel->listaTicket($estado));
	}
	
	public function listaActividadesMant(){
		$vehiculo=$this->security->xss_clean(strip_tags($this->input->get_post("vehiculo")));
		echo $this->Ticketmodel->listaActividadesMant($vehiculo);
	}

	public function listaPatentesMant(){
		echo $this->Ticketmodel->listaPatentesMant();
	}

	public function formTicket(){
		if($this->input->is_ajax_request()){
			$this->checkLogin();
			$hash_ticket=$this->security->xss_clean(strip_tags($this->input->post("hash_ticket")));
			$actividad_mantencion = $this->security->xss_clean(strip_tags($this->input->post("actividad_mantencion")));
			$vehiculo = $this->security->xss_clean(strip_tags($this->input->post("patente_mantencion")));
			$observacion = $this->security->xss_clean(strip_tags($this->input->post("observacion_mant")));
			$nueva_fecha = $this->security->xss_clean(strip_tags($this->input->post("nueva_fecha")));
			$estado_mant = $this->security->xss_clean(strip_tags($this->input->post("estado_mant")));
			$nuevo_km = $this->security->xss_clean(strip_tags($this->input->post("nuevo_km")));
	
			$ultima_actualizacion=date("Y-m-d G:i:s")." | ".$this->session->userdata("nombres")." ".$this->session->userdata("apellidos");

			if ($this->form_validation->run("formTicketMant") == FALSE){
				echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
			}else{	

				$data = array(
					"id_actividad" => $actividad_mantencion,
					"id_estado" => $estado_mant,
					"id_digitador" => $this->session->userdata("id"),
					"id_vehiculo" => $vehiculo,
					"fecha_creacion" => date("Y-m-d"),
					"kilometraje_actual" => 400,
					"observacion_mantenimiento" => $observacion,
					"nueva_fecha_venc" => $nueva_fecha,
					"proximo_km_mant" => $nuevo_km,
					"ultima_actualizacion" => $ultima_actualizacion,
				);
				
				if($hash_ticket==""){

					/* $existe = $this->Ticketmodel->existeTicket($data);

					if($existe){
						echo json_encode(array("res" => "error" , "msg" => "Ya existe una configuracion de mantención con estos parametros."));exit;
					} */

					$id=$this->Ticketmodel->formTicket($data);
					if($id!=FALSE){
						echo json_encode(array('res'=>"ok", 'msg' => OK_MSG));exit;
					}else{
						echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
					}
					
				}else{

					/* $existe = $this->Ticketmodel->existeTicketMod($hash_ticket,$data);

					if($existe){
						echo json_encode(array("res" => "error" , "msg" => "Ya existe una actividad de mantención con estos parametros."));exit;
					} */

					if($this->Ticketmodel->actualizarTicket($hash_ticket,$data)){
						echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
					}else{
						echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
					}
				}
			}	
		}
	}

	public function getDataTicket(){
		if($this->input->is_ajax_request()){
			$this->checkLogin();
			$hash_mat=$this->security->xss_clean(strip_tags($this->input->post("hash_ticket")));
			$data=$this->Ticketmodel->getDataTicket($hash_mat);
		
			if($data){
				echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
			}else{
				echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
			}	
		}else{
			exit('No direct script access allowed');
		}
	}

	public function obtenerTipoActividad(){
		if($this->input->is_ajax_request()){
			$this->checkLogin();
			$actividad=$this->security->xss_clean(strip_tags($this->input->post("actividad")));
			$data = $this->Ticketmodel->obtenerTipoActividad($actividad);
		
			if($data){
				echo json_encode(array('res'=>"ok", 'tipo' => $data));exit;
			}else{
				echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
			}	
		}else{
			exit('No direct script access allowed');
		}
	}

	public function eliminaTicket(){
		$hash_ticket=$this->security->xss_clean(strip_tags($this->input->post("hash_ticket")));
		if($this->Ticketmodel->eliminaTicket($hash_ticket)){
			echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
		}else{
			echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
		}
	}
		
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rkm extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->uri->segment("1")==""){
			redirect("inicio");
		}
		$this->load->model("back_end/Rkmmodel");
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
    	$this->Rkmmodel->insertarVisita($data);
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
	        'titulo' => "Reporte de kilometraje",
	        'contenido' => "rkm/inicio",
	        'perfiles' => $this->Iniciomodel->listaPerfiles(),
		);  
		$this->load->view('plantillas/plantilla_back_end',$datos);
	}
	   public function vistarkm(){
		if($this->input->is_ajax_request()){
			$desde = date('d-m-Y', strtotime('-365 day', strtotime(date("d-m-Y"))));
	    	$hasta = date('d-m-Y');
			
			$datos = array(
				'desde' => $desde,
				'hasta' => $hasta,
				'usuarios' => $this->Rkmmodel->listaUsuarios(),
				'vehiculos' => $this->Rkmmodel->listaVehiculos(),
		    );
			$this->load->view('back_end/rkm/rkm',$datos);
		}
	}
	public function listarkm(){
		echo json_encode($this->Rkmmodel->listarkm());
	}

	public function formrkm(){
		if($this->input->is_ajax_request()){
				$this->checkLogin();

				$hash=$this->security->xss_clean(strip_tags($this->input->post("hash-rkm")));
				$id_tecnico = $this->security->xss_clean(strip_tags($this->input->post("id_tecnico")));
				$id_vehiculo = $this->security->xss_clean(strip_tags($this->input->post("id_vehiculo")));
				$kilometraje = str_replace('.', '', $this->security->xss_clean(strip_tags($this->input->post("kilometraje"))));
				$fecha=date("Y-m-d");
				$hora=date("G:i:s");
				$ultima_actualizacion=date("Y-m-d G:i:s")." | ".$this->session->userdata("nombres")." ".$this->session->userdata("apellidos");

				if ($this->form_validation->run("formrkm") == FALSE){
					echo json_encode(array('res'=>"error", 'msg' => strip_tags(validation_errors())));exit;
				}else{	

					$data = array(
						"id_tecnico" => $id_tecnico,
						"id_vehiculo" => $id_vehiculo,
						"fecha" => $fecha,
						"hora" => $hora,
 						"kilometraje" => $kilometraje,
 						"ultima_actualizacion" => $ultima_actualizacion,
					);
					
					if($hash==""){

						$id=$this->Rkmmodel->formrkm($data);
						if($id!=FALSE){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}
						
					}else{

						if($this->Rkmmodel->actualizarrkm($hash,$data)){
							echo json_encode(array('res'=>"ok", 'msg' => MOD_MSG));exit;
						}else{
							echo json_encode(array('res'=>"ok",  'msg' => MOD_MSG));exit;
						}
					}
	    		}	
		}
	}
	public function getDatarkm(){
		if($this->input->is_ajax_request()){
			$this->checkLogin();
			$hash=$this->security->xss_clean(strip_tags($this->input->post("hash")));
			$data=$this->Rkmmodel->getDatarkm($hash);
		
			if($data){
			echo json_encode(array('res'=>"ok", 'datos' => $data));exit;
			}else{
				echo json_encode(array('res'=>"error", 'msg' => ERROR_MSG));exit;
			}	
			}else{
			exit('No direct script access allowed');
		}
	}
	public function eliminarkm(){
		$hash=$this->security->xss_clean(strip_tags($this->input->post("hash")));
	    if($this->Rkmmodel->eliminarkm($hash)){
	      echo json_encode(array("res" => "ok" , "msg" => "Registro eliminado correctamente."));
	    }else{
	      echo json_encode(array("res" => "error" , "msg" => "Problemas eliminando el registro, intente nuevamente."));
    	}
	}

	public function excelrkm(){
		$data=$this->Rkmmodel->listarkm();
		if(!$data){
			return FALSE;
		}else{
			$nombre="reporte-kilometraje.xls";
			header("Content-type: application/vnd.ms-excel;  charset=utf-8");
			header("Content-Disposition: attachment; filename=$nombre");
			?>
			<style type="text/css">
			.head{font-size:13px;height: 30px; background-color:#32477C;color:#fff; font-weight:bold;padding:10px;margin:10px;vertical-align:middle;}
			td{font-size:12px;text-align:center;   vertical-align:middle;}
			</style>
			<h3>Reporte Kilometraje </h3>
				<table align='center' border="1"> 
			        <tr style="background-color:#F9F9F9">
					    <th class="head">Nombre</th> 
					    <th class="head">Apellidos</th> 
					    <th class="head">Empresa</th> 
					    <th class="head">Rut</th> 
					    <th class="head">Sexo</th> 
					    <th class="head">Nacionalidad</th> 
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
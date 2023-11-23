<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticketmodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function insertarVisita($data){
		if($this->db->insert('aplicaciones_visitas', $data)){
			return TRUE;
		}
		return FALSE;
	}

	public function listaTicket($estado){
		$this->db->select("sha1(mat.id) as hash_ticket, 

			mat.*,
			v.*,
			mat.id as id,
			vme.estado as estado,
			vma.marca as marca,
			vmo.modelo as modelo,
			up.plaza as sucursal,

			vc.combustible as combustible,
			vact.actividad as actividad,
			CONCAT(vt.tipo,' - ',vma.marca,' - ',vmo.modelo,' - ',vc.combustible,' - ', tmmc.desde,' - ',tmmc.hasta) as  'tipo_mantenimiento',
			
			CONCAT(SUBSTRING_INDEX(us.nombres, ' ', 1), ' ', SUBSTRING_INDEX(us.apellidos, ' ', 1)) AS conductor_actual, 
			IF(mat.nueva_fecha_venc != '1970-01-01' AND mat.nueva_fecha_venc != '0000-00-00', DATE_FORMAT(mat.nueva_fecha_venc, '%Y-%m-%d'), '') AS nueva_fecha_venc,

		");

		$this->db->join('vehiculos v', 'v.id = mat.id_vehiculo', 'left');
		$this->db->join('vehiculos_tipos_mmc as tmmc', 'tmmc.id = v.id_tipo_mantenimiento', 'left');
		$this->db->join('vehiculos_tipo as vt', 'vt.id = tmmc.id_tipo', 'left');
		$this->db->join('vehiculos_marca as vma', 'vma.id = tmmc.id_marca', 'left');
		$this->db->join('vehiculos_modelo as vmo', 'vmo.id = tmmc.id_modelo', 'left');
		$this->db->join('vehiculos_combustible as vc', 'vc.id = tmmc.id_combustible', 'left');
		$this->db->join('vehiculos_mantenciones_actividades as vact', 'vact.id = mat.id_actividad', 'left');
		$this->db->join('vehiculos_mantenciones_estados as vme', 'vme.id = mat.id_estado', 'left');
		$this->db->join('usuarios_plazas as up', 'up.id = v.id_sucursal', 'left');
		$this->db->join('usuarios as us', 'us.id = v.id_conductor_actual', 'left');

		$res=$this->db->get('vehiculos_mantenciones_ticket mat');
		
		if($res->num_rows()>0){
			return $res->result_array();
		}
	}


	public function getDataTicket($hash){ 
		$this->db->select("sha1(mat.id) as hash_ticket, 
			mat.*,
		");

		$this->db->where('sha1(mat.id)', $hash);
		$res=$this->db->get('vehiculos_mantenciones_ticket mat');
		
		if($res->num_rows()>0){
			return $res->result_array();
		}
	}

	public function obtenerTipoActividad($actividad){ 
		$this->db->select("unidad");
		$this->db->where('id', $actividad);
		$res=$this->db->get('vehiculos_mantenciones_actividades');
		
		if($res->num_rows()>0){
			$row = $res->row_array();
			return $row["unidad"];
		}
		return FALSE;
	}

	
	public function formTicket($data){
		if($this->db->insert('vehiculos_mantenciones_ticket', $data)){
			return $this->db->insert_id();
		}
		return FALSE;
	}

	public function actualizarTicket($hash,$data){
		$this->db->where('sha1(id)', $hash);
		if($this->db->update('vehiculos_mantenciones_ticket', $data)){
			return TRUE;
		}
		return FALSE;
	}

	public function existeTicket($data){
		$this->db->where($data);
		$res = $this->db->get('vehiculos_mantenciones_ticket');
		return $res->num_rows() > 0;
	}

	public function existeTicketMod($hash,$data){
		$this->db->where('sha1(id)<>', $hash);
		$this->db->where($data);
		$res = $this->db->get('vehiculos_mantenciones_ticket');
		return $res->num_rows() > 0;
	}


	public function eliminaTicket($hash){
		$this->db->where('sha1(id)', $hash);
		if($this ->db->delete('vehiculos_mantenciones_ticket')){
			return TRUE;
		}
		return FALSE;
	}

	public function listaPatentesMant(){
		$this->db->select("v.id as id,CONCAT(vt.tipo,' - ',vma.marca,' - ',vmo.modelo,' - ',vc.combustible,' - ', tmmc.desde,' - ',tmmc.hasta ,' - ',v.patente) as patente");

		$this->db->join('vehiculos_tipos_mmc as tmmc', 'tmmc.id = v.id_tipo_mantenimiento', 'left');
		$this->db->join('vehiculos_tipo as vt', 'vt.id = tmmc.id_tipo', 'left');
		$this->db->join('vehiculos_marca as vma', 'vma.id = tmmc.id_marca', 'left');
		$this->db->join('vehiculos_modelo as vmo', 'vmo.id = tmmc.id_modelo', 'left');
		$this->db->join('vehiculos_combustible as vc', 'vc.id = tmmc.id_combustible', 'left');
		
		$res=$this->db->get('vehiculos v');
		if($res->num_rows()>0){
			$array=array();
			foreach($res->result_array() as $key){
				$temp=array();
				$temp["id"]=$key["id"];
				$temp["text"]=$key["patente"];
				$array[]=$temp;
			}
			return json_encode($array);
		}
		return FALSE;
	}
	
	public function listaActividadesMant($vehiculo){
		$this->db->select('vma.id as id,
		vma.actividad as actividad');
		
		$this->db->join('vehiculos_mantenciones_actividades vma', 'vma.id = vmt.id_actividad', 'left');
		$this->db->join('vehiculos_tipos_mmc vtm', 'vtm.id = vmt.id_tipo_mmc', 'left');
		$this->db->join('vehiculos v', 'v.id_tipo_mantenimiento = vtm.id', 'left');
		
		$this->db->where('v.id', $vehiculo);
		
		$this->db->order_by('vma.actividad', 'asc');
		$this->db->where('vma.estado', "activo");
		$res=$this->db->get('vehiculos_mantenciones_tipos vmt');

		if($res->num_rows()>0){
			$array=array();
			foreach($res->result_array() as $key){
				$temp=array();
				$temp["id"]=$key["id"];
				$temp["text"]=$key["actividad"];
				$array[]=$temp;
			}
			return json_encode($array);
		}
		return FALSE;
	}
	
	public function listaEstadosMant(){
		$this->db->order_by('id', 'asc');
		$res=$this->db->get('vehiculos_mantenciones_estados');
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}


	



}


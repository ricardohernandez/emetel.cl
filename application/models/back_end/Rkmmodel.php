<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rkmmodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function insertarVisita($data){
		if($this->db->insert('aplicaciones_visitas', $data)){
			return TRUE;
		}
		return FALSE;
	}

	public function listarkm(){
		$this->db->select("sha1(r.id) as hash,

			CONCAT(SUBSTRING_INDEX(u.nombres, ' ', 1), ' ', SUBSTRING_INDEX(u.apellidos, ' ', 1)) AS tecnico, 
			v.patente as patente,
			if(r.kilometraje!='0', FORMAT(r.kilometraje,'n'),'') as 'kilometraje',
			concat(substr(replace(u.rut,'-',''),1,char_length(replace(u.rut,'-',''))-1),'-',substr(replace(u.rut,'-',''),char_length(replace(u.rut,'-','')))) as 'rut',
			u.empresa,
			p.proyecto,
			u.zona,
			fecha,
			hora,
		");
		$this->db->join('usuarios as u', 'u.id = r.id_tecnico', 'left');
		$this->db->join('usuarios_proyectos as p', 'u.id_proyecto = p.id', 'left');
		$this->db->join('usuarios_areas as a', 'u.id_area = a.id', 'left');

		$this->db->join('vehiculos as v', 'v.id = r.id_vehiculo', 'left');

		$res=$this->db->get('rkm r');
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function getDatarkm($hash){
		$this->db->select("sha1(r.id) as hash,
			CONCAT(SUBSTRING_INDEX(u.nombres, ' ', 1), ' ', SUBSTRING_INDEX(u.apellidos, ' ', 1)) AS tecnico, 
			v.patente as patente,
			r.kilometraje,
			u.id as id_tecnico,
			v.id as id_vehiculo,
		");
		$this->db->join('usuarios as u', 'u.id = r.id_tecnico', 'left');
		$this->db->join('vehiculos as v', 'v.id = r.id_vehiculo', 'left');
		$this->db->where('sha1(r.id)', $hash);
		$res=$this->db->get('rkm r');
		if($res->num_rows()>0){
			return $res->result_array();
		}
	}

	public function formrkm($data){
		if($this->db->insert('rkm', $data)){
			return $this->db->insert_id();
		}
		return FALSE;
	}

	public function actualizarrkm($hash,$data){
		$this->db->where('sha1(id)', $hash);
		if($this->db->update('rkm', $data)){
			/*echo $this->db->last_query();
			echo "<br>";*/
			return TRUE;
		}
		return FALSE;
	}
	
	public function eliminarkm($hash){
		$this->db->where('sha1(id)', $hash);
	    if($this ->db->delete('rkm')){
	    	return TRUE;
	    }
	    return FALSE;
	}

	public function listaUsuarios(){
		$this->db->select("
		id,
		CONCAT(SUBSTRING_INDEX(nombres, ' ', 1), ' ', SUBSTRING_INDEX(apellidos, ' ', 1)) AS nombre,
		concat(substr(replace(rut,'-',''),1,char_length(replace(rut,'-',''))-1),'-',substr(replace(rut,'-',''),char_length(replace(rut,'-','')))) as 'rut',");
		$this->db->order_by('nombres', 'asc');
		$this->db->where('estado', "1");
		$res=$this->db->get('usuarios');
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}

	public function listaVehiculos(){
		$this->db->select("id,patente");
		$res=$this->db->get('vehiculos');
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return FALSE;
	}
	
}
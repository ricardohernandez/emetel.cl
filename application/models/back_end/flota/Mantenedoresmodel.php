<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mantenedoresmodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function insertarVisita($data){
		if($this->db->insert('aplicaciones_visitas', $data)){
			return TRUE;
		}
		return FALSE;
	}

	//MMC
 	
		public function listaMmc($estado){
			$this->db->select("sha1(mmc.id) as hash_mmc,
				mmc.*,
				vt.tipo as tipo,
				vma.marca as marca,
				vmo.modelo as modelo,
				vc.combustible as combustible,
			");
			$this->db->join('vehiculos_tipos_mmc as tmmc', 'tmmc.id = mmc.id_tipo', 'left');
			$this->db->join('vehiculos_tipo as vt', 'vt.id = mmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = mmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = mmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = mmc.id_combustible', 'left');


			/* if($estado==1){
				$this->db->where('u.estado', "1");
			} */

			$res=$this->db->get('vehiculos_tipos_mmc mmc');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function getDataMmc($hash){

			$this->db->select("sha1(mmc.id) as hash_mmc,
				mmc.*,
				vt.tipo as tipo,
				vma.marca as marca,
				vmo.modelo as modelo,
				vc.combustible as combustible,
			");
			$this->db->join('vehiculos_tipos_mmc as tmmc', 'tmmc.id = mmc.id_tipo', 'left');
			$this->db->join('vehiculos_tipo as vt', 'vt.id = mmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = mmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = mmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = mmc.id_combustible', 'left');
			$this->db->where('sha1(mmc.id)', $hash);
			$res=$this->db->get('vehiculos_tipos_mmc mmc');
			if($res->num_rows()>0){
				return $res->result_array();
			}
		}

		public function formMmc($data){
			if($this->db->insert('vehiculos_tipos_mmc', $data)){
				return $this->db->insert_id();
			}
			return FALSE;
		}

		public function actualizarMmc($hash,$data){
			$this->db->where('sha1(id)', $hash);
			if($this->db->update('vehiculos_tipos_mmc', $data)){
				return TRUE;
			}
			return FALSE;
		}
		
		public function existeMmc($data){
			unset($data['ultima_actualizacion']);
			$this->db->where($data);
			$res = $this->db->get('vehiculos_tipos_mmc');
			return $res->num_rows() > 0;
		}
		
		public function existeMmcMod($hash,$data){
			unset($data['ultima_actualizacion']);
			$this->db->where('sha1(id)<>', $hash);
			
			$this->db->where($data);
			$res = $this->db->get('vehiculos_tipos_mmc');
			return $res->num_rows() > 0;
		}
		

		public function eliminaMmc($hash){
			$this->db->where('sha1(id)', $hash);
			if($this ->db->delete('vehiculos_tipos_mmc')){
				return TRUE;
			}
			return FALSE;
		}

	//MARCAS

		public function listaMarcas($estado){
			$this->db->select("sha1(vma.id) as hash_vma,
				vma.*,
				vma.marca as marca, 
  			");
	
			$res=$this->db->get('vehiculos_marca vma');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function getDataMarca($hash){ 
			$this->db->select("sha1(vma.id) as hash_vma,
				vma.*,
				vma.marca as marca, 
			");

			$this->db->where('sha1(vma.id)', $hash);
			$res=$this->db->get('vehiculos_marca vma');
			
			if($res->num_rows()>0){
				return $res->result_array();
			}
		}

		public function formMarca($data){
			if($this->db->insert('vehiculos_marca', $data)){
				return $this->db->insert_id();
			}
			return FALSE;
		}

		public function actualizarMarca($hash,$data){
			$this->db->where('sha1(id)', $hash);
			if($this->db->update('vehiculos_marca', $data)){
				return TRUE;
			}
			return FALSE;
		}
		
		public function existeMarca($data){
			$this->db->where($data);
			$res = $this->db->get('vehiculos_marca');
			return $res->num_rows() > 0;
		}
		
		public function existeMarcaMod($hash,$data){
			$this->db->where('sha1(id)<>', $hash);
			$this->db->where($data);
			$res = $this->db->get('vehiculos_marca');
			return $res->num_rows() > 0;
		}
		

		public function eliminarMarca($hash){
			$this->db->where('sha1(id)', $hash);
			if($this ->db->delete('vehiculos_marca')){
				return TRUE;
			}
			return FALSE;
		}

		

	//MODELOS

		public function listaModelos($estado){
			$this->db->select("sha1(vmo.id) as hash_vmo,
				vmo.*,
				vma.marca as marca, 
				vmo.modelo as modelo,
 			");

			$this->db->join('vehiculos_marca as vma', 'vma.id = vmo.id_marca', 'left');
	
			/* if($estado==1){
				$this->db->where('u.estado', "1");
			} */

			$res=$this->db->get('vehiculos_modelo vmo');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function getDataModelo($hash){ 
			$this->db->select("sha1(vmo.id) as hash_vmo,
				vmo.*,
				vma.marca as marca, 
				vmo.modelo as modelo,
 			");

			$this->db->join('vehiculos_marca as vma', 'vma.id = vmo.id_marca', 'left');
			$this->db->where('sha1(vmo.id)', $hash);
			$res=$this->db->get('vehiculos_modelo vmo');
			
			if($res->num_rows()>0){
				return $res->result_array();
			}
		}

		public function formModelo($data){
			if($this->db->insert('vehiculos_modelo', $data)){
				return $this->db->insert_id();
			}
			return FALSE;
		}

		public function actualizarModelo($hash,$data){
			$this->db->where('sha1(id)', $hash);
			if($this->db->update('vehiculos_modelo', $data)){
				return TRUE;
			}
			return FALSE;
		}
		
		public function existeModelo($data){
			$this->db->where($data);
			$res = $this->db->get('vehiculos_modelo');
			return $res->num_rows() > 0;
		}
		
		public function existeModeloMod($hash,$data){
			$this->db->where('sha1(id)<>', $hash);
			$this->db->where($data);
			$res = $this->db->get('vehiculos_modelo');
			return $res->num_rows() > 0;
		}
		

		public function eliminarModelo($hash){
			$this->db->where('sha1(id)', $hash);
			if($this ->db->delete('vehiculos_modelo')){
				return TRUE;
			}
			return FALSE;
		}

		

}


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

	//ASIGNACION ACTIVIDADES
		public function listaMat($tipo_mat){
			$this->db->select("sha1(mat.id) as hash_mat, 
				mat.*,
				vma.marca as marca,
				vmo.modelo as modelo,
				vc.combustible as combustible,
				vact.actividad as actividad,
				vact.tipo as tipo,
				vact.unidad as unidad,
				CONCAT(vt.tipo,' - ',vma.marca,' - ',vmo.modelo,' - ',vc.combustible,' - ', tmmc.desde,' - ',tmmc.hasta) as  'tipo'

			");

			$this->db->join('vehiculos_tipos_mmc as tmmc', 'tmmc.id = mat.id_tipo_mmc', 'left');
			$this->db->join('vehiculos_tipo as vt', 'vt.id = tmmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = tmmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = tmmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = tmmc.id_combustible', 'left');
			$this->db->join('vehiculos_mantenciones_actividades as vact', 'vact.id = mat.id_actividad', 'left');
			
			if($tipo_mat!=""){
				$this->db->where('mat.id_tipo_mmc', $tipo_mat);
			}

			$res=$this->db->get('vehiculos_mantenciones_tipos mat');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}
 

		public function getDataMat($hash){ 
			$this->db->select("sha1(mat.id) as hash_mat, 
				mat.*,
				vma.marca as marca,
				vmo.modelo as modelo,
				vc.combustible as combustible,
				vact.actividad as actividad,
 				CONCAT(vt.tipo,' - ',vma.marca,' - ',vmo.modelo,' - ',vc.combustible) as  'tipo'

			");

			$this->db->join('vehiculos_tipos_mmc as tmmc', 'tmmc.id = mat.id_tipo_mmc', 'left');
			$this->db->join('vehiculos_tipo as vt', 'vt.id = tmmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = tmmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = tmmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = tmmc.id_combustible', 'left');
			$this->db->join('vehiculos_mantenciones_actividades as vact', 'vact.id = mat.id_actividad', 'left');
			$this->db->where('sha1(mat.id)', $hash);
			$res=$this->db->get(' vehiculos_mantenciones_tipos mat');
			
			if($res->num_rows()>0){
				return $res->result_array();
			}
		}

		public function formMat($data){
			if($this->db->insert(' vehiculos_mantenciones_tipos', $data)){
				return $this->db->insert_id();
			}
			return FALSE;
		}

		public function actualizarMat($hash,$data){
			$this->db->where('sha1(id)', $hash);
			if($this->db->update('vehiculos_mantenciones_tipos', $data)){
				return TRUE;
			}
			return FALSE;
		}

		public function existeMat($data){
			unset($data['ultima_actualizacion']);
			$this->db->where($data);
			$res = $this->db->get(' vehiculos_mantenciones_tipos');
			return $res->num_rows() > 0;
		}

		public function existeMatMod($hash,$data){
			unset($data['ultima_actualizacion']);
			$this->db->where('sha1(id)<>', $hash);
			$this->db->where($data);
			$res = $this->db->get(' vehiculos_mantenciones_tipos');
			return $res->num_rows() > 0;
		}


		public function eliminarMat($hash){
			
			$this->db->where('sha1(id)', $hash);
			if($this ->db->delete(' vehiculos_mantenciones_tipos')){
				return TRUE;
			}
			return FALSE;
		}




	//ACTIVIDADES
		public function listaActividades($estado){
			$this->db->select("sha1(vac.id) as hash_vac,
				vac.*,
			");

			$res=$this->db->get('vehiculos_mantenciones_actividades vac');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function getDataActividad($hash){ 
			$this->db->select("sha1(vac.id) as hash_vac,
				vac.*,
			");

			$this->db->where('sha1(vac.id)', $hash);
			$res=$this->db->get('vehiculos_mantenciones_actividades vac');
			
			if($res->num_rows()>0){
				return $res->result_array();
			}
		}

		public function formActividad($data){
			if($this->db->insert('vehiculos_mantenciones_actividades', $data)){
				return $this->db->insert_id();
			}
			return FALSE;
		}

		public function actualizarActividad($hash,$data){
			$this->db->where('sha1(id)', $hash);
			if($this->db->update('vehiculos_mantenciones_actividades', $data)){
				return TRUE;
			}
			return FALSE;
		}

		public function existeActividad($data){
			$this->db->where($data);
			$res = $this->db->get('vehiculos_mantenciones_actividades');
			return $res->num_rows() > 0;
		}

		public function existeActividadMod($hash,$data){
			$this->db->where('sha1(id)<>', $hash);
			$this->db->where($data);
			$res = $this->db->get('vehiculos_mantenciones_actividades');
			return $res->num_rows() > 0;
		}


		public function eliminarActividad($hash){
			$this->db->where('sha1(id)', $hash);
			if($this ->db->delete('vehiculos_mantenciones_actividades')){
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
				CONCAT(mmc.desde,' - ',mmc.hasta) as  'fechas',

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
				CONCAT(mmc.desde,' - ',mmc.hasta) as  'fechas',

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

		

		public function listaActividadesOpt(){
			$this->db->order_by('actividad', 'asc');
			$this->db->where('estado', "activo");
			$res=$this->db->get('vehiculos_mantenciones_actividades');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function listaTiposMMC(){
			$this->db->select("
				vtm.id as id,
				CONCAT(vt.tipo,' - ',vma.marca,' - ',vmo.modelo,' - ',vc.combustible,' - ', vtm.desde,' - ',vtm.hasta) as  'tipo'
			");

 			$this->db->join('vehiculos_tipo as vt', 'vt.id = vtm.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = vtm.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = vtm.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = vtm.id_combustible', 'left');
			$res=$this->db->get('vehiculos_tipos_mmc vtm');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function listaTiposMmcS2(){
			$this->db->select("vtm.id as id,
				CONCAT(vt.tipo,' - ',vma.marca,' - ',vmo.modelo,' - ',vc.combustible,' - ', vtm.desde,' - ',vtm.hasta) as  'tipo'
			");
	
			$this->db->join('vehiculos_tipo as vt', 'vt.id = vtm.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = vtm.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = vtm.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = vtm.id_combustible', 'left');
			$res=$this->db->get('vehiculos_tipos_mmc vtm');

			if($res->num_rows()>0){
				$array=array();
				foreach($res->result_array() as $key){
					$temp=array();
					$temp["id"]=$key["id"];
					$temp["text"]=$key["tipo"];
					$array[]=$temp;
				}
				return json_encode($array);
			}
			return FALSE;
		}


}


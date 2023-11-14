<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flotamodel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function insertarVisita($data){
		if($this->db->insert('aplicaciones_visitas', $data)){
			return TRUE;
		}
		return FALSE;
	}

	//VEHICULOS
	
		public function listaVehiculos($estado){
			$this->db->select("sha1(v.id) as hash_vehiculo,
				v.*,
				vt.tipo as tipo,
				vma.marca as marca,
				vmo.modelo as modelo,
				vc.combustible as combustible,
				ve.estado as estado,
				vmb.motivo as motivo_baja,
				up.plaza as sucursal,
				'tipo_mantenimiento' as tipo_mantenimiento,
				CONCAT(SUBSTRING_INDEX(u.nombres, ' ', 1), ' ', SUBSTRING_INDEX(u.apellidos, ' ', 1)) AS conductor_anterior, 
				CONCAT(SUBSTRING_INDEX(us.nombres, ' ', 1), ' ', SUBSTRING_INDEX(us.apellidos, ' ', 1)) AS conductor_actual, 
				CONCAT(SUBSTRING_INDEX(us2.nombres, ' ', 1), ' ', SUBSTRING_INDEX(us2.apellidos, ' ', 1)) AS digitador, 
				IF(v.fecha_alta != '1970-01-01' AND v.fecha_alta != '0000-00-00', DATE_FORMAT(v.fecha_alta, '%Y-%m-%d'), '') AS fecha_alta,
				IF(v.fecha_baja != '1970-01-01' AND v.fecha_baja != '0000-00-00', DATE_FORMAT(v.fecha_baja, '%Y-%m-%d'), '') AS fecha_baja,
				IF(v.conductor_actual_fecha_ini != '1970-01-01' AND v.conductor_actual_fecha_ini != '0000-00-00', DATE_FORMAT(v.conductor_actual_fecha_ini, '%Y-%m-%d'), '') AS conductor_actual_fecha_ini,
				IF(v.conductor_anterior_fecha_ini != '1970-01-01' AND v.conductor_anterior_fecha_ini != '0000-00-00', DATE_FORMAT(v.conductor_anterior_fecha_ini, '%Y-%m-%d'), '') AS conductor_anterior_fecha_ini,
				IF(v.doc_perm_circ_fecha_venc != '1970-01-01' AND v.doc_perm_circ_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_perm_circ_fecha_venc, '%Y-%m-%d'), '') AS doc_perm_circ_fecha_venc,
				IF(v.doc_rev_tecnica_fecha_venc != '1970-01-01' AND v.doc_rev_tecnica_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_rev_tecnica_fecha_venc, '%Y-%m-%d'), '') AS doc_rev_tecnica_fecha_venc,
				IF(v.doc_rev_gases_fecha_venc != '1970-01-01' AND v.doc_rev_gases_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_rev_gases_fecha_venc, '%Y-%m-%d'), '') AS doc_rev_gases_fecha_venc,
				IF(v.doc_seguro_obli_fecha_venc != '1970-01-01' AND v.doc_seguro_obli_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_seguro_obli_fecha_venc, '%Y-%m-%d'), '') AS doc_seguro_obli_fecha_venc,
				IF(v.doc_seguro_danios_fecha_venc != '1970-01-01' AND v.doc_seguro_danios_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_seguro_danios_fecha_venc, '%Y-%m-%d'), '') AS doc_seguro_danios_fecha_venc,
				IF(v.equip_extintor_fecha_venc != '1970-01-01' AND v.equip_extintor_fecha_venc != '0000-00-00', DATE_FORMAT(v.equip_extintor_fecha_venc, '%Y-%m-%d'), '') AS equip_extintor_fecha_venc,
				IF(v.equip_extintor = 'on', 'si', 'no') AS equip_extintor,
				IF(v.equip_neumatico_repuesto = 'on', 'si', 'no') AS equip_neumatico_repuesto,
				IF(v.equip_botiquin = 'on', 'si', 'no') AS equip_botiquin,
				IF(v.equip_llave_rueda = 'on', 'si', 'no') AS equip_llave_rueda,
				IF(v.equip_gata = 'on', 'si', 'no') AS equip_gata,
				IF(v.equip_gps = 'on', 'si', 'no') AS equip_gps,
				IF(v.equip_tag = 'on', 'si', 'no') AS equip_tag
					
			");
			$this->db->join('vehiculos_tipos_mmc as vmmc', 'vmmc.id = v.id_tipo', 'left');
			$this->db->join('vehiculos_tipo as vt', 'vt.id = vmmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = vmmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = vmmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = vmmc.id_combustible', 'left');
			$this->db->join('vehiculos_estados as ve', 've.id = v.id_estado', 'left');
			$this->db->join('vehiculos_motivos_bajas as vmb', 'vmb.id = v.id_motivo_baja', 'left');
			$this->db->join('usuarios_plazas as up', 'up.id = v.id_sucursal', 'left');

			$this->db->join('usuarios as u', 'u.id = v.id_conductor_anterior', 'left');
			$this->db->join('usuarios as us', 'us.id = v.id_conductor_actual', 'left');
			$this->db->join('usuarios as us2', 'us2.id = v.id_digitador', 'left');


			/* if($estado==1){
				$this->db->where('u.estado', "1");
			} */

			$res=$this->db->get('vehiculos v');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function getDataVehiculos($hash){

			$this->db->select("sha1(v.id) as hash_vehiculo,
				v.*,
				vt.tipo as tipo,
				vma.marca as marca,
				vmo.modelo as modelo,
				vc.combustible as combustible,
				ve.estado as estado,
				vmb.motivo as motivo_baja,
				up.plaza as sucursal,
				'tipo_mantenimiento' as tipo_mantenimiento,
				CONCAT(SUBSTRING_INDEX(u.nombres, ' ', 1), ' ', SUBSTRING_INDEX(u.apellidos, ' ', 1)) AS conductor_anterior, 
				CONCAT(SUBSTRING_INDEX(us.nombres, ' ', 1), ' ', SUBSTRING_INDEX(us.apellidos, ' ', 1)) AS conductor_actual, 
				CONCAT(SUBSTRING_INDEX(us2.nombres, ' ', 1), ' ', SUBSTRING_INDEX(us2.apellidos, ' ', 1)) AS digitador, 
				IF(v.fecha_alta != '1970-01-01' AND v.fecha_alta != '0000-00-00', DATE_FORMAT(v.fecha_alta, '%Y-%m-%d'), '') AS fecha_alta,
				IF(v.fecha_baja != '1970-01-01' AND v.fecha_baja != '0000-00-00', DATE_FORMAT(v.fecha_baja, '%Y-%m-%d'), '') AS fecha_baja,
				IF(v.conductor_actual_fecha_ini != '1970-01-01' AND v.conductor_actual_fecha_ini != '0000-00-00', DATE_FORMAT(v.conductor_actual_fecha_ini, '%Y-%m-%d'), '') AS conductor_actual_fecha_ini,
				IF(v.conductor_anterior_fecha_ini != '1970-01-01' AND v.conductor_anterior_fecha_ini != '0000-00-00', DATE_FORMAT(v.conductor_anterior_fecha_ini, '%Y-%m-%d'), '') AS conductor_anterior_fecha_ini,
				IF(v.doc_perm_circ_fecha_venc != '1970-01-01' AND v.doc_perm_circ_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_perm_circ_fecha_venc, '%Y-%m-%d'), '') AS doc_perm_circ_fecha_venc,
				IF(v.doc_rev_tecnica_fecha_venc != '1970-01-01' AND v.doc_rev_tecnica_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_rev_tecnica_fecha_venc, '%Y-%m-%d'), '') AS doc_rev_tecnica_fecha_venc,
				IF(v.doc_rev_gases_fecha_venc != '1970-01-01' AND v.doc_rev_gases_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_rev_gases_fecha_venc, '%Y-%m-%d'), '') AS doc_rev_gases_fecha_venc,
				IF(v.doc_seguro_obli_fecha_venc != '1970-01-01' AND v.doc_seguro_obli_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_seguro_obli_fecha_venc, '%Y-%m-%d'), '') AS doc_seguro_obli_fecha_venc,
				IF(v.doc_seguro_danios_fecha_venc != '1970-01-01' AND v.doc_seguro_danios_fecha_venc != '0000-00-00', DATE_FORMAT(v.doc_seguro_danios_fecha_venc, '%Y-%m-%d'), '') AS doc_seguro_danios_fecha_venc,
				IF(v.equip_extintor_fecha_venc != '1970-01-01' AND v.equip_extintor_fecha_venc != '0000-00-00', DATE_FORMAT(v.equip_extintor_fecha_venc, '%Y-%m-%d'), '') AS equip_extintor_fecha_venc
				
			");
			$this->db->join('vehiculos_tipos_mmc as vmmc', 'vmmc.id = v.id_tipo', 'left');
			$this->db->join('vehiculos_tipo as vt', 'vt.id = vmmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = vmmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = vmmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = vmmc.id_combustible', 'left');
			$this->db->join('vehiculos_estados as ve', 've.id = v.id_estado', 'left');
			$this->db->join('vehiculos_motivos_bajas as vmb', 'vmb.id = v.id_motivo_baja', 'left');
			$this->db->join('usuarios_plazas as up', 'up.id = v.id_sucursal', 'left');

			$this->db->join('usuarios as u', 'u.id = v.id_conductor_anterior', 'left');
			$this->db->join('usuarios as us', 'us.id = v.id_conductor_actual', 'left');
			$this->db->join('usuarios as us2', 'us2.id = v.id_digitador', 'left');
			$this->db->where('sha1(v.id)', $hash);

			$res=$this->db->get('vehiculos v');
			if($res->num_rows()>0){
				return $res->result_array();
			}
		}

		public function formVehiculos($data){
			if($this->db->insert('vehiculos', $data)){
				return $this->db->insert_id();
			}
			return FALSE;
		}

		public function actualizarVehiculos($hash,$data){
			$this->db->where('sha1(id)', $hash);
			if($this->db->update('vehiculos', $data)){
				/*echo $this->db->last_query();
				echo "<br>";*/

				return TRUE;
			}
			return FALSE;
		}
		
		public function existeVehiculo($patente){
			$this->db->where('patente', $patente);
			$res=$this->db->get('vehiculos');
		    if($res->num_rows()==0){
		    	return FALSE;
		    }
		    return TRUE;
		}

		public function eliminaVehiculos($hash){
			$this->db->where('sha1(id)', $hash);
		    if($this ->db->delete('vehiculos')){
		    	return TRUE;
		    }
		    return FALSE;
		}

		 
		public function listaMarcas(){
			$this->db->order_by('marca', 'asc');
			$res=$this->db->get('vehiculos_marca');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function listaModelos(){
			$this->db->order_by('modelo', 'asc');
			$res=$this->db->get('vehiculos_modelo');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		
		public function listaCombustibles(){
			$this->db->order_by('combustible', 'asc');
			$res=$this->db->get('vehiculos_combustible');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}
		
		public function listaTipos(){
			$this->db->order_by('tipo', 'asc');
			$res=$this->db->get('vehiculos_tipo');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function listaTiposMMC(){
			$this->db->select("mmc.id as id,CONCAT_WS('-', vt.tipo, vma.marca, vmo.modelo, vc.combustible) as tipo_mmc");
			$this->db->join('vehiculos_tipo as vt', 'vt.id = mmc.id_tipo', 'left');
			$this->db->join('vehiculos_marca as vma', 'vma.id = mmc.id_marca', 'left');
			$this->db->join('vehiculos_modelo as vmo', 'vmo.id = mmc.id_modelo', 'left');
			$this->db->join('vehiculos_combustible as vc', 'vc.id = mmc.id_combustible', 'left');
			$this->db->order_by('id', 'asc');

			$res=$this->db->get('vehiculos_tipos_mmc mmc');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}
		
		public function listaMotivos(){
			$this->db->order_by('id', 'asc');
			$res=$this->db->get('vehiculos_motivos_bajas');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

	
		public function listaEstados(){
			$this->db->order_by('id', 'asc');
			$res=$this->db->get('vehiculos_estados');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}


		public function listaPlazas(){
			$this->db->order_by('plaza', 'asc');
			$res=$this->db->get('usuarios_plazas');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}

		public function listaConductores(){
			$this->db->select("id,CONCAT(SUBSTRING_INDEX(nombres, ' ', 1), ' ', SUBSTRING_INDEX(apellidos, ' ', 1)) AS nombre");
			$this->db->order_by('nombres', 'asc');
			$this->db->where('estado', "1");
			$res=$this->db->get('usuarios');
			if($res->num_rows()>0){
				return $res->result_array();
			}
			return FALSE;
		}





	

	

}


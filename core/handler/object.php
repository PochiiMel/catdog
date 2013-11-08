<?php

/**
 * This abstract class provides basic operations for new models
 *
 */
	
	abstract class object{
 
		protected $not_null;
		protected $id; 
		protected $tblname;
		protected $fields;
		protected $is_auto;

		public function __construct(){
			$this->not_null = array();
			list($this->tblname,$this->fields,$this->id,$this->is_auto) =  ORMHelper::analize($this);
		}

		# establece campos no nulos
		public function not_null(array $attrs = NULL){	
			$this->not_null = $attrs;
		}

		public function get_fields(){
			return $this->fields;
		}

		public function getId(){
			return $this->id;
		}

		# actualiza el estado del objeto
		public function get($search_id){
			list($tblname,$fields,$id,$is_auto) =  ORMHelper::analize($this);
			if(!$id):
				return false;
			else:
				if($search_id!=0):
					$search_id = set_type($search_id); 
					$select = "SELECT * FROM $tblname WHERE $id = $search_id";
					data_model()->executeQuery($select);
					$data = data_model()->getResult()->fetch_assoc();
					foreach ($data as $key => $value):
						$this->set_attr($key,$value);
					endforeach;
				else:
					foreach($fields as $field):
						$this->set_attr($field,'');
					endforeach;
				endif;
			endif;
		}
		
		# cambia el estado del objeto 
		# no se guarda automaticamente para que sea posible serializarlo
		public function change_status($data){
			list($tblname,$fields,$id,$is_auto) =  ORMHelper::analize($this);
			foreach ($fields as $field):
				if(isset($data[$field])):
					$this->set_attr($field,$data[$field]);
				endif;
			endforeach;
		}

		# guarda el estado actual del objeto
		public function save(){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);
			$data = array();
			foreach ($fields as $field):
				$data[$field] = $this->get_attr($field);
			endforeach;
			if($this->validateData($data)):
				if($id):
					if($this->exists($data[$id])):
						$value = set_type($data[$id]);
						$condition = "$id = $value";
						$query = MysqliHandler::get_update_query($tblname,$data,$condition);
					else:
						if($is_auto) unset($data[$id]);
						$query = MysqliHandler::get_insert_query($tblname,$data);	
					endif;
				else:
					$query = MysqliHandler::get_insert_query($tblname,$data);
				endif;
				//echo $query;
				data_model()->executeQuery($query);
				return true;
			else:
				return false;
			endif;
		}

		public function force_save(){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);
			$data = array();
			foreach ($fields as $field):
				$data[$field] = $this->get_attr($field);
			endforeach;
			$query = MysqliHandler::get_insert_query($tblname,$data);
			data_model()->executeQuery($query);
		}

		
		# establece el valor de un atributo
		protected function set_attr($attr_name,$val=''){	
			$this->$attr_name = $val;
		}

		# devuelve el valor de un atributo
		public function get_attr($attr_name){	
			return $this->$attr_name;
		}

		# valida aquellos campos establecidos como no nulos
		public function validateData($data){	
			foreach ($this->not_null as $key):
				if(!isset($data[$key]) || empty($data) ):
					return false;
				else:
					$data[$key] = trim($data[$key]);
					if((empty($data[$key]) && $data[$key] != 0) || $data[$key]=="" ):
						return false;
					endif;
				endif; 
			endforeach; 
			return true;
		}

		# verifica si el objeto ya existe en la base de datos
		public function exists($data){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);
			if ($id):
				$data = set_type($data);
				$query = "SELECT $id from $tblname WHERE $id = $data"; 
				data_model()->executeQuery($query); 
				$return = (data_model()->getNumRows() > 0)? true:false;
			else: 
				$return = false; 
			endif; 
			return $return;
		}

		# obtiene modelos bajo el directorio mdl/model
		public function get_sibling($sibling_name){
			import("mdl.model.{$sibling_name}");
			$cls = "{$sibling_name}Model";
			$sibling_obj = new $cls();
			return $sibling_obj; 
		}

		# obtiene modelos bajo el directorio objects/
		public function get_child($child_name){
			import("objects.{$child_name}");
			$cls = "{$child_name}Model";
			$child_obj = new $cls();
			return $child_obj;
		}
		
		# obtiene numero de registros coincidentes
		public function quantify($field='',$term=''){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);
			if ($field=='' || $term==''):
				$query = "SELECT * FROM $tblname";
			else:
				$term_s = set_type($term);
				$query = "SELECT * FROM $tblname WHERE ($field = $term_s) 
					  			OR ($field LIKE '%{$term}') OR ($field LIKE '{$term}%') 
					  			OR ($field LIKE '%{$term}%') ";
			endif;
			data_model()->executeQuery($query);
			return data_model()->getNumRows();
		}

		# elimina los registros coincidentes
		public function delete($term,$field=''){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);	
			$term = set_type($term);
			data_model()->start_transaction();
			if ($field == ''):
				$query = "DELETE FROM $tblname WHERE $id = $term"; 
			else:
				$query = "DELETE FROM $tblname WHERE $field = $term"; 
			endif;
			data_model()->executeQuery($query);
			data_model()->commit();
		}

		# filtrado de registros
		public function filter($field,$term,$limitInf='',$limitSup=''){	
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);
			$limit_str = "";
			if($limitInf!=='') $limit_str = "LIMIT $limitInf";
			if($limitSup!=='') $limit_str .= ", $limitSup";
			$term_s = set_type($term);
			$query = "SELECT * FROM $tblname WHERE ($field = $term_s) 
					  OR ($field LIKE '%{$term}') OR ($field LIKE '{$term}%') 
					  OR ($field LIKE '%{$term}%') ".$limit_str; 
			return data_model()->cacheQuery($query);
		}

		# obtiene una lista de registros
		public function get_list($limitInf='',$limitSup=''){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);			
			$limit_str = "";
			if($limitInf!=='') $limit_str .= "LIMIT $limitInf";
			if($limitSup!=='') $limit_str .= ", $limitSup";
			$query = "SELECT * FROM $tblname ".$limit_str;
			return data_model()->cacheQuery($query);
		}
		
		# envia un listado de registros hacia $output
		public function send_data_to_file($output,$limitInf='',$limitSup=''){	
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);
			$limit_str = "";
			if($limitInf!=='') $limit_str .= "LIMIT $limitInf";
			if($limitSup!=='') $limit_str .= ", $limitSup";
			$query = "SELECT * FROM $tblname ".$limit_str;
			$result = "";
			$archivo = fopen(APP_PATH.'scripts/'.$output,'w');
			data_model()->executeQuery($query);
			while($data = data_model()->getResult()->fetch_assoc()):
				$result = implode(";",$data);
				if( ! (fwrite($archivo,$result.PHP_EOL)) ):
					echo "can't write ".$output;
					exit;
				endif;
			endwhile; 
			fclose($archivo);
		}

		# revuelve el resultado de una busqueda puntual
		public function search($field,$term){
			list($tblname,$fields,$id,$is_auto) = ORMHelper::analize($this);			
			$term = set_type($term);
			$query = "SELECT * FROM $tblname WHERE $field = $term";
			return data_model()->cacheQuery($query);
		}

	}

?>
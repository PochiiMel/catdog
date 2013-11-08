<?php
	
	import("mdl.model.fichaPaciente");
	import("mdl.view.fichaPaciente");

	class fichaPacienteController extends controller
	{
		public function nuevoPeludo()
		{
			$cache = array();
			$cache[0] = $this->model->get_child("especie")->get_list();
			$cache[1] = $this->model->get_child("razas")->get_list();
			$cache[2] = $this->model->get_sibling("padrinos")->get_list();
			$this->view->ver($cache);
		}
		public function listadoPeludo(){
			import('scripts.paginacion');
      		$cache = array();
      		if(isset($_GET['filtro']) && !empty($_GET['filtro'])):
        		$filtro = data_model()->sanitizeData($_GET['filtro']);
       			$tipo_filtro = (isset($_GET['tipo_filtro']) && !empty($_GET['tipo_filtro']))?data_model()->sanitizeData($_GET['tipo_filtro']):'nombrePeludo';
        		$numeroRegistros = $this->model->quantify($tipo_filtro,$filtro);
        		$url_filtro = "/catdog/fichaPaciente/listadoPeludo?filtro=".$filtro."&";
        		list($paginacion_str,$limitInf,$tamPag) = paginar($numeroRegistros,$url_filtro);
        		$cache[0] = $this->model->filter($tipo_filtro,$filtro,$limitInf,$tamPag); 
     		 else:
       			$numeroRegistros = $this->model->quantify();
        		$url_filtro = "/catdog/fichaPaciente/listadoPeludo?";
        		list($paginacion_str,$limitInf,$tamPag) = paginar($numeroRegistros,$url_filtro);
        		$cache[0] = $this->model->get_list($limitInf,$tamPag);
      		endif;
     		$fil = (isset($_GET['tipo_filtro']))?$_GET['tipo_filtro']:'nombrePeludo';
			$medidas = $this->model->consultarMedidas();
			$razas   = $this->model->consultarRazas();
			$cache[1] = $numeroRegistros;
			$this->view->listado($cache,$medidas,$razas,$paginacion_str,$fil);
		}
		public function guardarPeludo()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$this->model->get(0); //para crear nuevo registro
				$data = $_POST;
				$data['fechaIngreso'] = date("y-m-d");
				$this->model->change_status($data);
				if($this->model->save()){
					HttpHandler::redirect("/catdog/fichaPaciente/nuevoPeludo?conf=Ok");
				}
				else
					return false;
			}
		}

		public function editar()
		{
			if(isset($_GET['id']) && !empty($_GET['id'])):
				$cache 	  = array();
				$cache[0] = $this->model->get_child("especie")->get_list();
				$cache[1] = $this->model->get_child("razas")->get_list();
				$cache[2] = $this->model->get_sibling("padrinos")->get_list();
				$cache[3] = $this->model->editar($_GET['id']);
				$this->view->editar($cache);
			endif;
		}//fin editar

		public function guardarCambios()
		{
			if (isset($_POST) && !empty($_POST)):
				$data = $_POST;
				$id = empty($data['idfichaPaciente'])?0:$data['idfichaPaciente'];
				$this->model->get($id);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/fichaPaciente/listadoPeludo?confe=Ok');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
		}
	}//fin clase
?>
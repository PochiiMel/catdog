<?php
	
	import("mdl.model.historiaMedica");
	import("mdl.view.historiaMedica");

	class historiaMedicaController extends controller
	{
		public function agregarDiagnostico()
		{
			if((isset($_GET['id']) && !empty($_GET['id'])))
			{
				$id =  $_GET['id'];
				if($this->model->get_sibling('fichaPaciente')->exists($id)){
					$cache 	  = array();
					$cache[0] = $this->model->verDatos($id);
					$cache[1] = $this->model->datosDetalle($id);
					$this->view->ver($cache,$id);
				}else{
					HttpHandler::redirect('/catdog/sistema/inicio');
				}
			}
		}

		public function guardar()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$id = $_POST['idPaciente'];
				$this->model->get(0); //para crear nuevo registro
				$this->model->change_status($_POST);
				echo var_dump(get_object_vars($this->model));
				if($this->model->save()){
					HttpHandler::redirect("/catdog/historiaMedica/agregarDiagnostico?id=$id");
				}
				else
					return false;
			}
		}

		public function eliminar()
		{
			if(isset($_GET['id']) && !empty($_GET['id']))
			{
				$this->model->delete($_GET['id']);
				$pa = $_GET['pa'];
				HttpHandler::redirect("/catdog/historiaMedica/agregarDiagnostico?del=Ok&id=".$pa);
			}
		}

		public function editar()
		{
			if(isset($_GET['id']) && !empty($_GET))
			{
				$cache 	  = array();
				$cache[0] = $this->model->editarDiagnostico($_GET['id']);
				$this->view->editar($cache);
			}
		}

		public function guardarCambios()
		{
			if (isset($_POST) && !empty($_POST)):
				$data = $_POST;
				$id   = empty($data['idHistoriaMedica'])?0:$data['idHistoriaMedica'];
				$idP  = empty($data['idPaciente'])?0:$data['idPaciente'];
				$this->model->get($id);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect("/catdog/historiaMedica/agregarDiagnostico?id=$idP&confe=Ok");
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
		}
	}//fin medicinas
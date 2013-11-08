<?php
	
	import("mdl.model.medicinas");
	import("mdl.view.medicinas");

	class medicinasController extends controller
	{
		public function nuevaMedicina()
		{
			$cache 	  = array();
			$cache[0] = $this->model->medidasMedicinas();
			$this->view->ver($cache);
		}

		public function guardar()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$this->model->get(0); //para crear nuevo registro
				$this->model->change_status($_POST);
				if($this->model->save())
					HttpHandler::redirect("/catdog/medicinas/nuevaMedicina?conf=Ok");
				else
					return false;
			}
		}

		public function eliminar()
		{
			if(isset($_GET['id']) && !empty($_GET))
			{
				$this->model->delete($_GET['id']);
				HttpHandler::redirect("/catdog/medicinas/nuevaMedicina?del=Ok");
			}
		}

		public function editar()
		{
			if(isset($_GET['id']) && !empty($_GET))
			{
				$cache 	  = array();
				$cache[0] = $this->model->editarMedicinas($_GET['id']);
				$this->view->editar($cache);
			}
		}

		public function guardarCambios()
		{
			if (isset($_POST) && !empty($_POST)):
				$data = $_POST;
				$id = empty($data['id'])?0:$data['id'];
				unset($data['id']);
				
				$this->model->get(0);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/medicinas/nuevaMedicina?confe=Ok');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
		}
	}//fin medicinas
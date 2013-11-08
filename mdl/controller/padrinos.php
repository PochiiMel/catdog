<?php
	import("mdl.model.padrinos");
	import("mdl.view.padrinos");

	class padrinosController extends controller
	{
		public function nuevoPadrino()
		{
			$cache = array();
			$cache[0] = $this->model->verDetallePadrinos();
			$this->view->ver($cache);
		} //fin nuevoPadrino

		public function guardar()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$this->model->get(0); //para crear nuevo registro
				$this->model->change_status($_POST);
				if($this->model->save())
					HttpHandler::redirect("/catdog/padrinos/nuevoPadrino?conf=Ok");
				else
					return false;
			}
		}

		public function editar()
		{
			if(isset($_GET['id']) && !empty($_GET['id']))
			{
				$idpadrinos = $_GET['id'];
				$cache = array();
				$cache[0] = $this->model->editar($idpadrinos);
				$this->view->editar($cache);
			}
		}

		public function guardarCambios()
		{
			if(isset($_POST) && !empty($_POST)):
				$data = $_POST;
				$idpadrinos  = empty($data['idpadrinos']) ?0 : $data['idpadrinos'];
				unset($data['idpadrinos']);
				
				$this->model->get($idpadrinos);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect("/catdog/padrinos/nuevoPadrino");
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
		}
		public function eliminar()
		{
			if(isset($_GET['id']) && !empty($_GET['id']))
			{
				$this->model->delete($_GET['id']);
				$this->model->eliminarPadrinosPacientes($_GET['id']);
				HttpHandler::redirect("/catdog/padrinos/nuevoPadrino?del=Ok");
			}
		}
	} //fin padrinos controller
?>
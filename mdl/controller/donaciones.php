<?php
	
	import('mdl.model.donaciones');
	import('mdl.view.donaciones');

	class donacionesController extends controller
	{

		public function panel(){
			$this->view->panel();
		}

		public function guardarDonaciones()
		{
			if (isset($_POST) && !empty($_POST)):			
				$this->model->get(0);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/donaciones/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
			
		}

		public function ListarDonacion()
		{
			$idTipo = isset($_GET['id'])?$_GET['id']:'0';
			$this->model->delete($idTipo);
			HttpHandler::redirect('/catdog/donaciones/formularioIngreso');

		}

		public function GuardarModificarDonaciones()
		{
			if (isset($_POST) && !empty($_POST)):
			
				$data = $_POST;
				$id = empty($data['id'])?0:$data['id'];
				unset($data['id']);
				$this->model->get($id);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/donaciones/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;

		}



		public function modificarDonaciones()
		{
			
			$id = isset($_GET['id'])?$_GET['id']:'0';
			$cache = array();

			if ($this->model->exists($id))
			{

				$cache[0] = $this->model->listar_insumos();
				$cache[1] = $this->model->get_child("tipoDonacion")->get_list();
				$cache[2] = $this->model->editar($id);
				$cache[3] = $this->model->insumo_actual($id);
				$cache[4] = $this->model->donacion_actual($id);
				$this->view->generarFmodificar($cache);
			}
			else 
			{
				HttpHandler::redirect('/catdog/donaciones/formularioIngreso');
			}

						
		}

		public function formularioIngreso()
		{
			$cache = array();
			$cache[0] = $this->model->listar_insumos();
			$cache[1] = $this->model->get_child("tipoDonacion")->get_list();
			//$this->view->generarCombo($cache);
			
			$this->view->generarFingreso($cache);
			//$this->view->generarFingreso();
		}

		public function formularioListar()
		{
			$cache = array();
			$cache[0] = $this->model->listar();
			//$cache[0] = $this->model->get_child("medidas")->get_list();
			$this->view->generarFlistar($cache);
			
			
		}
		
			
	}

?>
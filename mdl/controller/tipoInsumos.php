<?php
	
	import('mdl.model.tipoInsumos');
	import('mdl.view.tipoInsumos');

	class tipoInsumosController extends controller
	{

		/*public function llenarCombo()
		{
			
		}*/

		public function panel(){
			$this->view->panel();
		}


		public function guardarTipoInsumos()
		{
			if (isset($_POST) && !empty($_POST)):
			
				
				
				$this->model->get(0);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/tipoInsumos/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
			
		}

		public function ListarTipoInsumos()
		{
			$idTipo = isset($_GET['id'])?$_GET['id']:'0';
			$this->model->delete($idTipo);
			HttpHandler::redirect('/catdog/tipoInsumos/formularioIngreso');

		}

		public function GuardarModificarTipoInsumos()
		{
			if (isset($_POST) && !empty($_POST)):
			
				$data = $_POST;
				$this->model->get($data['idtipoInsumos']);
				unset($data['idtipoInsumos']);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/tipoInsumos/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;

		}



		public function modificarTipoInsumos()
		{
			
			$id = isset($_GET['id'])?$_GET['id']:'0';
			$cache = array();

			if ($this->model->exists($id))
			{

				$cache[0] = $this->model->get_child("medidas")->get_list();
				$cache[1] = $this->model->ObtenerRegistroExacto($id);
				$this->view->generarFmodificar($cache);


			}
			else 
			{
				HttpHandler::redirect('/catdog/tipoInsumos/formularioIngreso');
			}

						
		}

		public function formularioIngreso()
		{
			$cache = array();
			$cache[0] = $this->model->get_child("medidas")->get_list();
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
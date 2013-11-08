<?php
	
	import('mdl.model.insumos');
	import('mdl.view.insumos');

	class insumosController extends controller
	{


		public function panel(){
			$this->view->panel();
		}

		public function guardarInsumos()
		{
			if (isset($_POST) && !empty($_POST)):
			
				
				
				$this->model->get(0);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/insumos/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
			
		}

		public function ListarInsumos()
		{
			$idTipo = isset($_GET['id'])?$_GET['id']:'0';
			$this->model->delete($idTipo);
			HttpHandler::redirect('/catdog/insumos/formularioIngreso');

		}

		public function GuardarModificarInsumos()
		{
			if (isset($_POST) && !empty($_POST)):
			
				$data = $_POST;
				$id = empty($data['idtipoInsumos'])?0:$data['idtipoInsumos'];
				unset($data['idtipoInsumos']);
				$this->model->get($id);
				$this->model->change_status($data);
				$this->model->save();
				HttpHandler::redirect('/catdog/insumos/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;

		}
		public function modificarInsumos()
		{
			
			$id = isset($_GET['id'])?$_GET['id']:'0';
			$cache = array();

			if ($this->model->exists($id))
			{
				$cache[0] = $this->model->get_child("tipoinsumos")->get_list();
				$cache[1] = $this->model->ObtenerRegistroExacto($id);
				$cache[2] = $this->model->tipo_actual($id);
 			    $this->view->generarFmodificar($cache);
			}
			else 
			{
				HttpHandler::redirect('/catdog/insumos/formularioIngreso');
			}

						
		}

		public function formularioIngreso()
		{
			$cache = array();
			$cache[0] = $this->model->get_child("tipoInsumos")->get_list();
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

		public function verMedidas()
		{
			$tipo = $_POST['tipo'];
			$medida = $this->model->medidaPorTipo($tipo);
			echo json_encode($medida);
		}
	}

?>
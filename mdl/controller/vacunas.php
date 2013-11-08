<?php
	
	import('mdl.model.vacunas');
	import('mdl.view.vacunas');

	class vacunasController extends controller
	{


		public function panel(){
			$this->view->panel();
		}

		public function guardarVacunas()
		{
			if (isset($_POST) && !empty($_POST)):
			
				$this->model->get(0);
				
				//$this->model->find($_POST['idtipoInsumos']);
				
				
				
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/vacunas/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
			
		}

		public function ListarVacunas()
		{
			$idTipo = isset($_GET['id'])?$_GET['id']:'0';
			$this->model->delete($idTipo);
			HttpHandler::redirect('/catdog/vacunas/formularioIngreso');

		}

		public function GuardarModificarVacunas()
		{
			if (isset($_POST) && !empty($_POST)):
			
				$data = $_POST;
				$id = empty($data['idvacunas'])?0:$data['idvacunas'];
				unset($data['idtvacunas']);
				$this->model->get($id);
				$this->model->change_status($data);
				$this->model->save();
				HttpHandler::redirect('/catdog/vacunas/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;

		}



		public function modificarVacunas()
		{
			
			$id = isset($_GET['id'])?$_GET['id']:'0';
			$cache = array();

			if ($this->model->exists($id))
			{

				//$cache[0] = $this->model->get_child("medidas")->get_list();
				$cache[0] = $this->model->ObtenerRegistroExacto($id);
				$this->view->generarFmodificar($cache);


			}
			else 
			{
				HttpHandler::redirect('/catdog/vacunas/formularioIngreso');
			}

						
		}

		public function formularioIngreso()
		{
			$cache = array();
			//$cache[0] = $this->model->get_child("tipoInsumos")->get_list();
			$this->view->generarFingreso($cache);
			
		}

		public function formularioListar()
		{
			$cache = array();
			$cache[0] = $this->model->get_list();
			//$cache[0] = $this->model->get_child("medidas")->get_list();
			$this->view->generarFlistar($cache);
		}
	}

?>
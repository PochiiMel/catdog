<?php
	
	import('mdl.model.tipoDonacion');
	import('mdl.view.tipoDonacion');

	class tipoDonacionController extends controller
	{

		public function panel(){
			$this->view->panel();
		}

		public function guardarTipoDonacion()
		{
			if (isset($_POST) && !empty($_POST)):
			
				
				$this->model->get(0);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/tipoDonacion/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
			
		}

		public function ListarTipoDonacion()
		{
			$idTipo = isset($_GET['id'])?$_GET['id']:'0';
			$this->model->delete($idTipo);
			HttpHandler::redirect('/catdog/tipoDonacion/formularioIngreso');

		}

		public function GuardarModificarTipoDonacion()
		{
			if (isset($_POST) && !empty($_POST)):
			
				$data = $_POST;
				$id = empty($data['idtipoDonacion'])?0:$data['idtipoDonacion'];
				unset($data['idtipoDonacion']);
				$this->model->get($id);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect('/catdog/tipoDonacion/formularioIngreso');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;

		}



		public function modificarTipoDonacion()
		{
			
			$id = isset($_GET['id'])?$_GET['id']:'0';
			$cache = array();

			if ($this->model->exists($id))
			{
				$cache[0] = $this->model->ObtenerRegistroExacto($id);
				$this->view->generarFmodificar($cache);


			}
			else 
			{
				HttpHandler::redirect('/catdog/tipoDonacion/formularioIngreso');
			}

						
		}

		public function formularioIngreso()
		{
			$this->view->generarFingreso();
		}

		public function formularioListar()
		{
			$cache = array();
			$cache[0] = $this->model->get_list();
			$this->view->generarFlistar($cache);
		}
	}

?>
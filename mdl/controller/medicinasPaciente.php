<?php
	
	import('mdl.model.medicinasPaciente');
	import('mdl.view.medicinasPaciente');

	class medicinasPacienteController extends controller{

		public function agregar(){
			if(isset($_GET['idPaciente'])){
				if($this->model->get_sibling('fichaPaciente')->exists($_GET['idPaciente'])){
					$cache = array();
					$cache[0] = $this->model->get_child('medicinas')->get_list();
					$cache[1] = $this->model->obtenerMedicinas($_GET['idPaciente']);
					$this->view->agregar($cache,$_GET['idPaciente']);
				}else{
					HttpHandler::redirect('/catdog/sistema/inicio');
				}
			}else{
				HttpHandler::redirect('/catdog/sistema/inicio');
			}
		}

		public function guardar(){
			if(isset($_POST) && !empty($_POST)){
				$datos = $_POST;
				$datos["fecha"] = date("y-m-d h:m:s");
				$this->model->get(0);
				$this->model->change_status($datos);
				$this->model->save();
				HttpHandler::redirect('/catdog/medicinasPaciente/agregar?idPaciente='.$_POST['idPaciente']);
			}else{
				echo "Se llamo al recurso incorrectamente";
			}
		}

	}
?>
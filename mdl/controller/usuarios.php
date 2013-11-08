<?php
	
	import("mdl.model.usuarios");
	import("mdl.view.usuarios");

	class usuariosController extends controller
	{
		public function nuevoUsuario()
		{
			$cache 	  = array();
			$cache[0] = $this->model->UsuariosTipos();
			$cache[1] = $this->model->tipoUsuarios();
			$this->view->ver($cache);
		}

		public function guardar()
		{
			if(isset($_POST) && !empty($_POST))
			{
				//echo var_dump($_POST);
				$this->model->get(0); //para crear nuevo registro
				$this->model->change_status($_POST);
				if($this->model->save())
					HttpHandler::redirect("/catdog/usuarios/nuevoUsuario?conf=Ok");
				else
					return false;
			}
		}

		public function eliminar()
		{
			if(isset($_GET['id']) && !empty($_GET))
			{
				$this->model->delete($_GET['id']);
				HttpHandler::redirect("/catdog/usuarios/nuevoUsuario?del=Ok");
			}
		}

		public function editar()
		{
			if(isset($_GET['id']) && !empty($_GET))
			{
				$cache 	  = array();
				$cache[0] = $this->model->editarUsuarios($_GET['id']);
				$cache[1] = $this->model->tipoUsuarios();
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
				HttpHandler::redirect('/catdog/usuarios/nuevoUsuario?confe=Ok');
				else:
					echo "La funcion no fue llamada desde formulario";
				endif;
		}
	}//fin usuarios
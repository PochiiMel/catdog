<?php

	import("mdl.model.especie");
	import("mdl.view.especie");

	class especieController extends controller
	{
		public function registrar()
		{
			$cache = array();
			$cache[0] = $this->model->get_list();
			$this->view->ver($cache);
		}//fin registrar
		
		public function guardar()
		{
			if(isset($_POST) && !empty($_POST))
			{
				$this->model->get(0);
				$this->model->change_status($_POST);
				$this->model->save();
				HttpHandler::redirect("/catdog/especie/registrar?id=ok");
			}//fin if
		}//fin guardar
	}
?>
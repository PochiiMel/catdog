<?php

	import('mdl.view.sistema');

	class sistemaController extends controller{

		/* sobre escribimos el constructor para librar el controlador del model asociado */
		public function __construct($resource='',$argv=''){
			
			$this->view = Helper::get_view($this); // solo se carga la vista

		}

		/* funcion que provee acceso a los modulos */
		public function inicio(){

			$this->view->index(); // cargar el index.html [ver: ../mdl/view/sistema.php]

		}

	}

?>
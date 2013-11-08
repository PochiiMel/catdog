<?php

	class sistemaView{

		/* esta es la pagina principal */
		public function index(){
			template()->buildFromTemplates('index.html');
			//template()->addTemplateBit('contenido','index.html');
			page()->setTitle('Inicio');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseExtras();
			template()->parseOutput(); 
			print page()->getContent();
		}

	}

?>
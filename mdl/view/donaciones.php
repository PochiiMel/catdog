<?php

	class donacionesView 
	{
		public function panel(){
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','donaciones/panel.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();	
		}


		public function generarFingreso($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','donaciones/ingresoDonaciones.html');
			page()->addEstigma("combo", array("SQL", $cache[0]));
			page()->addEstigma("comboDonacion", array("SQL", $cache[1]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}

		public function generarFlistar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','donaciones/listarDonaciones.html');
			page()->addEstigma('lista_Donaciones',array('SQL',$cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}


		public function generarFmodificar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','donaciones/modificarDonaciones.html');
			page()->addEstigma("combo", array("SQL", $cache[0]));
			page()->addEstigma("comboDonacion", array("SQL", $cache[1]));
		    page()->addEstigma("lista_modificar", array("SQL", $cache[2]));
		    page()->addEstigma("insumo_actual", array("SQL", $cache[3]));
		    page()->addEstigma("donacion_actual", array("SQL", $cache[4]));
		    page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();

		}

	}



?>
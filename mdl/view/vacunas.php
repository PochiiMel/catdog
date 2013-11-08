<?php

	class vacunasView 
	{


		public function panel(){
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','vacunas/panel.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();	
		}

		public function generarFingreso($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','vacunas/ingresoVacunas.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			//page()->addEstigma("combo", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}

		public function generarFlistar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','vacunas/listarVacunas.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma('lista_tipoInsumos',array('SQL',$cache[0]));
			template()->parseOutput();
			print page()->getContent();
		}


		public function generarFmodificar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','vacunas/modificarVacunas.html');
			page()->addEstigma('lista_modificar',array('SQL',$cache[0]));
			//page()->addEstigma("combo", array("SQL", $cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			print page()->getContent();

		}

	}



?>
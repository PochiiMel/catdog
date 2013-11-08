<?php

	class tipoDonacionView 
	{
		public function panel(){
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoDonacion/panel.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();	
		}

		public function generarFingreso()
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoDonacion/ingresoTipoDonacion.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}

		public function generarFlistar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoDonacion/listarTipoDonacion.html');
			page()->addEstigma('lista_tipoDonacion',array('SQL',$cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}


		public function generarFmodificar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoDonacion/modificarTipoDonacion.html');
			page()->addEstigma('lista_modificar',array('SQL',$cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();

		}

	}



?>
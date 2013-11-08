<?php

	class tipoInsumosView 
	{


	/*	public function generarCombo($cache)
		{
			template()->buildFromTemplates("tipoInsumos/ingresoTipoInsumos.html");
			page()->addEstigma("combo", array("SQL", $cache[0]));
			
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}*/

		public function panel(){
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoInsumos/panel.html');
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();	
		}


		public function generarFingreso($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoInsumos/ingresoTipoInsumos.html');
			page()->addEstigma("combo", array("SQL", $cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}

		public function generarFlistar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoInsumos/listarTipoInsumos.html');
			page()->addEstigma('lista_tipoInsumos',array('SQL',$cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			print page()->getContent();
		}


		public function generarFmodificar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido','tipoInsumos/modificarTipoInsumos.html');
			page()->addEstigma('lista_modificar',array('SQL',$cache[1]));
			page()->addEstigma("combo", array("SQL", $cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			print page()->getContent();

		}

	}



?>
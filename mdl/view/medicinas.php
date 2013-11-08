<?php
	
	class medicinasView
	{
		public function ver($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/nuevaMedicina.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma("listaMedicinas", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}

		public function editar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/editarMedicina.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma("listaEdicion", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}
	}//fin clase
?>
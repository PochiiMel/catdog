<?php
	
	class historiaMedicaView
	{
		public function ver($cache,$id)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/nuevoDiagnostico.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma("listaEdicion", array("SQL", $cache[1]));
			page()->addEstigma("listaDatos", array("SQL", $cache[0]));
			page()->addEstigma('paciente',$id);
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}

		public function editar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplatebit('contenido',"historialClinico/editarDiagnostico.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma("listaDatos", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}
	}//fin clase
?>
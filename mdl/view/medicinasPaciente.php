<?php
	class medicinasPacienteView{

		public function agregar($cache,$id){
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/medicinasPaciente.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma('idPaciente',$id);
			page()->addEstigma("listaMedicinas", array("SQL", $cache[0]));
			page()->addEstigma("medicamentosPaciente", array("SQL", $cache[1]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}

	}
?>
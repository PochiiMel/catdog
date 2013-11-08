<?php
	
	class fichaPacienteView
	{
		public function ver($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/fichaPaciente.html");
			page()->setTitle('Ficha del paciente');
			page()->addEstigma("especiePeludos", array("SQL", $cache[0]));
			page()->addEstigma("razaPeludos", array("SQL", $cache[1]));
			page()->addEstigma("padrinosPeludos", array("SQL", $cache[2]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}

		public function listado($cache,$medidas,$razas,$paginacion,$fil){
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/listadoPaciente.html");
			page()->setTitle('Listado de pacientes');
			page()->addEstigma('paginacion',$paginacion);
			page()->addEstigma('cant',$cache[1]);
			page()->addEstigma("listadoPeludos", array("SQL", $cache[0]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			foreach ($medidas as $reg) {
				page()->addEstigma("_".$reg['idmedidas'],$reg['nombreMedida']);
			}
			foreach ($razas as $reg1) {
				page()->addEstigma($reg1['idrazas'],$reg1['nombreRaza']);
			}
			template()->parseOutput();
			template()->parseExtras();
			print page()->getContent();
		}

		public function editar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"historialClinico/editarFichaPaciente.html");
			page()->setTitle('Ficha del paciente');
			page()->addEstigma("especiePeludos", array("SQL", $cache[0]));
			page()->addEstigma("razaPeludos", array("SQL", $cache[1]));
			page()->addEstigma("padrinosPeludos", array("SQL", $cache[2]));
			page()->addEstigma("ficha", array("SQL",$cache[3]));
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}
	}//fin clase
?>
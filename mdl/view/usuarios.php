<?php
	
	class usuariosView
	{
		public function ver($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"Usuarios/nuevoUsuario.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma("ListaUsuarios", array("SQL", $cache[0]));
			page()->addEstigma("combo", array("SQL", $cache[1]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}

		public function editar($cache)
		{
			template()->buildFromTemplates('template.html');
			template()->addTemplateBit('contenido',"Usuarios/editarUsuario.html");
			page()->addEstigma('resource','http://'.$_SERVER['HTTP_HOST'].'/'.WEB_DIR);
			page()->addEstigma("listaEdicionUser", array("SQL", $cache[0]));
			page()->addEstigma("comboU", array("SQL", $cache[1]));

			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}
	}//fin clase
?>
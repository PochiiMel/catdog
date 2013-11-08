<?php
	class padrinosView
	{
		public function ver($cache)
		{
			template()->buildFromTemplates("historialClinico/nuevoPadrino.html");
			page()->addEstigma("listaPadrinos", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}

		public function editar($cache)
		{
			template()->buildFromTemplates("historialClinico/editarPadrino.html");
			page()->addEstigma("listaPadrinos", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		}
	}
?>
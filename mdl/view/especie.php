<?php
	
	class especieView
	{
		public function ver($cache)
		{
			template()->buildFromTemplates("ingresoEspecie.html");
			page()->addEstigma("lista", array("SQL", $cache[0]));
			template()->parseOutput();
			template()->parseExtras();
			echo page()->getContent();
		} //fin function
	}

?>
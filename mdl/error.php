<?php

	class ErrorController{

		public function not_found(){
			proveedor_activo();
			BM::singleton()->getObject('temp')->buildFromTemplates('error.html');
			BM::singleton()->getObject('temp')->parseExtras();
			print BM::singleton()->getObject('temp')->getPage()->getContent();
		}

	}
?>
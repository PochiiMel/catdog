<?php

	class tipoDonacionModel  extends object
	{
		
		public function ObtenerRegistroExacto($id)
		{

			$qr = "select * from tipoDonacion where idTipoDonacion=" . $id . ";";
			return data_model()->cacheQuery($qr);
			
		}

	}

?>

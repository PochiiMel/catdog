<?php

	class vacunasModel  extends object
	{
		
		public function ObtenerRegistroExacto($id)
		{

			$qr = "select * from vacunas where idvacunas=" . $id . ";";
			return data_model()->cacheQuery($qr);
			
		}

		

	}

?>

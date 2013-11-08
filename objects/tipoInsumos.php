<?php

	class tipoInsumosModel extends object
	{

		public function cargarMedidas()
		{
		$qr = "select * from tipoInsumos";
		data_model()->executeQuery($qr);

		if (data_model()->getNumRows() > 0):

			return true;

		else:
			return false;
			
		endif;
		}

	}

?>
<?php
	class medidasModel extends object
	{

		public function cargarMedidas()
		{
			$query = "SELECT * FROM medidas";
			data_model()->executeQuery($query);
			if(data_model()->getNumRows()>0):
				return true;
			else:
				return false;
			endif;
		}//fin cargarFicha

	} //fin fichaPaciente
?>
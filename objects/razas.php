<?php
	class razasModel extends object
	{

		public function cargarRaza()
		{
			$query = "select * from razas";
			data_model()->executeQuery($query);
			if(data_model()->getNumRows()>0):
				return true;
			else:
				return false;
			endif;
		}//fin cargarFicha
	} //fin fichaPaciente
?>
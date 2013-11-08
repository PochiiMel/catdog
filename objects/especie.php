<?php
	class especieModel extends object
	{

		public function cargarEspecie()
		{
			$query = "SELECT * FROM especie";
			data_model()->executeQuery($query);
			if(data_model()->getNumRows()>0):
				return true;
			else:
				return false;
			endif;
		}//fin cargarFicha
	} //fin fichaPaciente
?>
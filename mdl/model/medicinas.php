<?php
	class medicinasModel extends object
	{

		public function medidasMedicinas()
		{
			$query = "SELECT m.idMedicinas, m.nombreMedicina, m.cantidad, me.nombreMedida FROM 
					 medicinas as m
					 INNER JOIN medidas as me
					 ON me.idmedidas = m.idMedida";
			return data_model()->cacheQuery($query);
		}//fin cargarFicha

		public function editarMedicinas($id)
		{
			if(isset($id))
			{
				$query = "SELECT * from medicinas where idmedicinas=$id";
				return data_model()->cacheQuery($query);
			}
		}
	} //fin fichaPaciente
?>
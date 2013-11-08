<?php
	class fichaPacienteModel extends object
	{

		public function cargar()
		{
			
		}//fin cargarFicha

		public function consultarMedidas()
		{
			$query = "SELECT idmedidas,nombreMedida FROM medidas WHERE idmedidas IN 
						(SELECT medidaEdad FROM fichaPaciente GROUP BY medidaEdad);";
			data_model()->executeQuery($query);		
			$ret = array();
			while ($data = data_model()->getResult()->fetch_assoc() ) {
					$ret[] = $data;
				}	
			return $ret;
		}

		public function consultarRazas()
		{
			$query = "SELECT idrazas, nombreRaza from razas";
			data_model()->executeQuery($query);
			$ret = array();
			while ($data = data_model()->getResult()->fetch_assoc() ) {
					$ret[] = $data;
				}	
			return $ret;
		}

		public function editar($id)
		{
			$query = "SELECT idfichaPaciente, nombrePeludo, edadEstimada,
					  fechaIngreso, Peso, motivoEntrada, motivoSalida FROM 
					  fichaPaciente WHERE idfichaPaciente=$id";
			return data_model()->cacheQuery($query);
		}
	} //fin fichaPaciente
?>
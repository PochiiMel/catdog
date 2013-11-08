<?php

	class historiaMedicaModel extends object
	{

		public function verDatos($id)
		{
			$query = "SELECT * from fichaPaciente  where idFichaPaciente=" . $id;
			return data_model()->cacheQuery($query);
		}//fin cargarFicha

		public function datosDetalle($id)
		{
			if(isset($id))
			{
				    $query = "SELECT hm.idhistoriaMedica, fp.nombrePeludo, fp.idFichaPaciente, 
                    hm.diagnosticoClinico, hm.fechaDiagnostico, fp.Genero
					FROM historiaMedica as hm
					INNER JOIN fichaPaciente as  fp
					ON  fp.idfichaPaciente = hm.idPaciente
					where fp.idfichaPaciente = " . $id;

					return data_model()->cacheQuery($query);
			}
		}

		public function editarDiagnostico($id)
		{
			if(isset($id))
			{
				$query = "SELECT hm.idhistoriaMedica,hm.idPaciente, hm.diagnosticoClinico,hm.fechaDiagnostico, fp.nombrePeludo, fp.Genero, fp.edadEstimada
						 from historiaMedica as hm
						 INNER JOIN fichaPaciente as fp
						 ON fp.idFichaPaciente = hm.idPaciente
						 where hm.idHistoriaMedica=$id";
				return data_model()->cacheQuery($query);
			}
		}
	} //fin fichaPaciente
?>
<?php
	class medicinasPacienteModel extends object{
		
		public function obtenerMedicinas($id){
			$query ="SELECT mp.idmedicinasPaciente, mp.idPaciente, mp.estado,
					 m.nombreMedicina, mp.fecha					 
					 FROM medicinasPaciente as mp
					 INNER JOIN medicinas as m
					 ON m.idMedicinas = mp.idMedicinas
					 WHERE mp.idPaciente=$id";
			return data_model()->cacheQuery($query);
		}

	}
?>
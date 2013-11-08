<?php

	class insumosModel  extends object
	{
		
		public function ObtenerRegistroExacto($id)
		{

			$qr = "select * from insumos where idinsumos=" . $id . ";";
			return data_model()->cacheQuery($qr);
			
		}

		public function obtenerMedida()
		{
			$qr = "select * from medidas;";
			return data_model()->cacheQuery($qr);
		}

		public function medidaPorTipo($tipo)
		{
			$query  = "SELECT m.nombreMedida from 
					   tipoInsumos as ti 
					   INNER JOIN medidas as m
					   ON  ti.idMedida = m.idmedidas
					   where ti.idtipoDonacion = $tipo";
			data_model()->executeQuery($query);
			$medida = data_model()->getResults()->fetch_assoc();
			return $medida;
		}

		public function listar()
		{
			$query = "SELECT i.idinsumos, i.nombre_insumo, i.cantidadTotal, m.nombreMedida 
					FROM insumos as i
					inner join tipoinsumos as tin 
					on tin.idtipoInsumos =  i.tipoInsumo
					inner join medidas as m
					on tin.idMedida = m.idmedidas;";
			return data_model()->cacheQuery($query);
		}

		public function tipo_actual($id)
		{
			$query = "SELECT ti.tipoInsumo FROM insumos as i 
			 		 INNER JOIN tipoinsumos as ti ON 
			 		 ti.idtipoInsumos = i.tipoInsumo 
			 		 WHERE i.idinsumos = $id";
			return data_model()->cacheQuery($query);
		}
	}

?>

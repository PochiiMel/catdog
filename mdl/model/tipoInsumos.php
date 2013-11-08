<?php

	class tipoInsumosModel  extends object
	{
		
		public function ObtenerRegistroExacto($id)
		{

			$qr = "select * from tipoInsumos where idTipoInsumos=" . $id . ";";
			return data_model()->cacheQuery($qr);
			
		}

		public function obtenerMedida()
		{
			$qr = "select * from medidas;";
			return data_model()->cacheQuery($qr);
		}

		public function listar()
		{
			$qr  = "SELECT ti.idtipoInsumos, ti.tipoInsumo, m.nombreMedida 
					FROM tipoinsumos as ti INNER JOIN 
					medidas as m
					ON m.idmedidas = ti.idMedida";
			return data_model()->cacheQuery($qr);
		}

	}

?>

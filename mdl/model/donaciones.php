<?php

	class donacionesModel  extends object
	{
		
		public function ObtenerRegistroExacto($id)
		{

			$qr = "select * from donaciones where idDonacion=" . $id . ";";
			return data_model()->cacheQuery($qr);
			
		}

		public function obtenerMedida()
		{
			$qr = "select * from medidas;";
			return data_model()->cacheQuery($qr);
		}
		
		public function listar()
		{
			$qr  = "SELECT d.idDonacion,ti.nombre_insumo, td.tipoDonacion, d.cantidadDonacion,  m.nombreMedida,
					d.fechaDonacion, d.donador from donaciones as d 
            		inner join insumos as ti on ti.idinsumos = d.idinsumos
                      inner join  tipoDonacion as td 
                      on td.idtipoDonacion = d.tipoDonacion
                      inner join tipoinsumos as tin 
                      on tin.idtipoInsumos =  ti.tipoInsumo
                      inner join medidas as m
                      on tin.idMedida = m.idmedidas;";
			return data_model()->cacheQuery($qr);
		}
		
		public function listar_insumos()
		{
			$qr = "select idinsumos, nombre_insumo from insumos";
			return data_model()->cacheQuery($qr);
		}
		public function editar($id)
		{
			$qr = "select idDonacion, cantidadDonacion, fechaDonacion, donador from donaciones where idDonacion = $id";
			return data_model()->cacheQuery($qr);
		}

		public function insumo_actual($id)
		{
			$qr = "SELECT i.nombre_insumo from donaciones 
				   as d INNER JOIN insumos as i ON i.idinsumos = d.idinsumos
				   WHERE d.idDonacion = $id";
			return data_model()->cacheQuery($qr);
		}

		public function donacion_actual($id)
		{
			$qr = "SELECT ti.tipoDonacion from donaciones as d
				   INNER JOIN tipoDonacion as ti ON ti.idtipoDonacion = d.tipoDonacion 
				   WHERE idDonacion = $id";
			return data_model()->cacheQuery($qr);
		}
	}

?>

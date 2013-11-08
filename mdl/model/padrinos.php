<?php
	class padrinosModel extends object
	{
		function verPadrinos()
		{
			$query = "SELECT idpadrinos, nombrePadrino FROM padrinos";
			data_model()->executeQuery($Query);
			if(data_model()->getNumRows()>0):
				return true;
			else:
				return false;
			endif;
		}
		
		function verDetallePadrinos()
		{
			$query  = "SELECT * FROM padrinos";
			return data_model()->cacheQuery($query);
		}


		function eliminarPadrinosPacientes($idpadrinos)
		{
			$query = "delete from padrinospeludos where idpadrinos = $idpadrinos";
			data_model()->executeQuery($query);
			if(data_model()->getNumRows()>0):
				return true;
			else:
				return false;
			endif;
		}

		function editar($idpadrinos)
		{
			$query  = "SELECT * FROM padrinos WHERE idpadrinos = $idpadrinos";
			return data_model()->cacheQuery($query);
		}
	}//fin padrinos
?>
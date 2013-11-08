<?php
	class usuariosModel extends object
	{

		public function UsuariosTipos()
		{
			$query = "SELECT u.idusuarios, u.nickname, u.password, u.nombre, u.apellidos, us.tipoUsuario FROM 
					 usuarios as u
					 INNER JOIN tipousuario as us
					 ON us.idtipoUsuario = u.tipoUsuario";
			return data_model()->cacheQuery($query);
		}//fin cargarUsuarios

		public function editarUsuarios($id)
		{
			if(isset($id))
			{
				$query = "SELECT * from usuarios where idusuarios=$id";
				return data_model()->cacheQuery($query);
			}
		}

		public function tipoUsuarios ()
		{
			$qr= "select tipoUsuario, idtipoUsuario from tipousuario";
			return data_model()->cacheQuery($qr);
		}


	} //fin cargarUsuarios
?>
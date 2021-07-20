<?php

class Paginas
{

	static public function enlacesPaginasModel($enlaces)
	{

		switch ($enlaces) {
			case "ingresar":
			case "usuarios":
			case "Fotos":
			case "editar":
				
			case "salir":
				$module =  "views/modules/" . $enlaces . ".php";
				break;
				//////////////////////////////////////
			case "index":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "registro_ok":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "registro_error":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "eliminado_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "eliminado_error":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "actualizado_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "actualizado_error":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "ingresarNuevo_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "ingresarNuevo_error":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingresarNuevo_error_invalido":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingresarNuevo_error_vacio":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "registro_error_invalido":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "registro_error_vacio":
				$module =  "views/modules/registro.php";
				break;
				//////////////////////////////////////
			case "editar&idEditar":
				$module =  "views/modules/editar.php";
				break;
				//////////////////////////////////////
			case "actualizado_error_vacio":
				$module =  "views/modules/editar.php";
				break;
				//////////////////////////////////////
			case "obtenerIdUpdate_error_invalido":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "obtenerIdUpdate_error_vacio":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "eliminarIdUsuario_error_invalido":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "eliminarIdUsuario_error_vacio":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			case "error_salir":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingresar_error":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingreso":
				$module =  "views/modules/ingresar.php";
				break;
				//////////////////////////////////////
			case "ingresar_ok":
				$module =  "views/modules/usuarios.php";
				break;
				//////////////////////////////////////
			default:
				$module =  "views/modules/registro.php";
				break;
		}
		return $module;
	}
}

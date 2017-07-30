<?php 
	session_start();
	require_once "conexion.php";
	//Funcion de conexion se agrego la variable de insert para verificar el utlimo id ingresado en la tabla
	function call($conn, $sql, $insert="0")
	{
		$result = mysqli_query($conn, $sql);
			$data = array();
			if($result)
			{
				//Si se inserto algo en la tabla
				if($insert == 1)
				{	
					$last_id = mysqli_insert_id($conn);
					return $last_id;
				}
				else //Cuando se realiza una consulta
				{			
					$data = array();
					if (mysqli_num_rows($result) > 0) {
				    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {			
							$data[] = $row;
					    }	    
					}
					return $data;
				}
			}
			return false;
	}
	//Genera la solicitud en la base de datos
	function crear_solicitud($conn, $res)
	{
		$idusuario = $_SESSION["usuario"];
		$idcontacto = $res[0]["id"];
		$sql = "SELECT * FROM solicitudes WHERE idusuario = '$idusuario' AND idcontacto = '$idcontacto'";//Verifica si ya existe la invitacion
		$res = call($conn, $sql);
		if(count($res) == 0)//Si no hay invitacion, la envia 
		{
			$sql = "INSERT INTO solicitudes(idusuario, idcontacto) VALUES ('$idusuario', '$idcontacto', '".date("Y-m-d"). "')";
			$idsolicitud = call($conn, $sql, 1);
			return $idsolicitud;//Regresar valor cuando es la primera solicitud
		}
		return $res[0]["idsolicitud"];
	}
	//Verifica si el email al que se envio la invitación esta dado de alta, si no existe llama a funcion crear_solicitud
	function invitar_usuario($conn, $data)
	{
		$email = $data["email"];
		$idusuario = $_SESSION["usuario"];
		//Verifica que la invitacion no sea al mismo usuario
		$sql = "SELECT * FROM usuarios WHERE username = '$email' AND id != '$idusuario'";
		$res = call($conn, $sql);
		if(count($res) > 0)
		{
			$idsolicitud = crear_solicitud($conn, $res);
			if($idsolicitud)
			{
				return array("success" => true, "id" => $idsolicitud);
			}
			return array("success" => false);
		}
		else
		{
			return array("success" => false, "error" => "El usuario no existe");
		}
	}
	//
	function obtener_datos_solicitud($conn, $idsolicitud)
	{
		$sql = "SELECT * FROM solicitudes WHERE idsolicitud = '$idsolicitud'";
		$res = call($conn, $sql);
		
		if(count($res) > 0)
		{
			return array("success" => true, "data" => $res);
		}
		else
		{
			return array("success" => false);
		}
	}
	//Aceptar la solicitud
	function aceptar_solicitud($conn, $idsolicitud)
	{
		$sql = "UPDATE solicitudes SET estatus='1' WHERE idsolicitud='$idsolicitud'";
		call($conn, $sql);
		$solicitud = obtener_datos_solicitud($conn, $idsolicitud);
		if($solicitud["success"])
		{
			$solicitud = $solicitud["data"][0];
			$idusuario = $solicitud["idusuario"];
			$idcontacto = $solicitud["idcontacto"];
			$sql = "INSERT INTO contactos (idusuario, idcontacto, fecha) VALUES ('$idusuario', '$idcontacto', '".date("Y-m-d")."')";
			$new_contacto = call($conn, $sql, 1);
			if($new_contacto)
			{
				return array("success" => true, "id" => $new_contacto);
			}

		}
		return array("success" => true);
	}
	//Obtener datos de un usuario
	function obtener_datos_usuario($conn, $idusuario)
	{
		$sql = "SELECT id, nombre, apellido, username FROM usuarios WHERE id = '$idusuario'";
		$res = call($conn, $sql);
		if(count($res) > 0)
		{
			return array("success" => true, "data" => $res);
		}
		else
		{
			return array("success" => false, "error" => "No se pudieron obtener datos del usuario.");
		}
	}
	//Funcion para obtener solicitudes pendientes 
	function obtener_solicitudes($conn)
	{
		$idusuario = $_SESSION["usuario"];
		//El estatus debe ser 0 = Pendiente
		$sql = "SELECT * FROM solicitudes WHERE idcontacto = '$idusuario' AND estatus = 0";
		$res = call($conn, $sql);
		//var_dump($res);
		if(count($res) > 0)
		{
			foreach ($res as $key => $row) {
				$row_idusuario = $row["idusuario"];
				$info_usuario = obtener_datos_usuario($conn, $row_idusuario);
				if($info_usuario["success"])
				{
					//Codifica el nombre y apellido para caracteres epeciales
					$info_usuario["data"][0]["nombre"] = utf8_encode($info_usuario["data"][0]["nombre"]);
					$info_usuario["data"][0]["apellido"] = utf8_encode($info_usuario["data"][0]["apellido"]);
					//
					$res[$key]["idusuario"] = $info_usuario["data"];
				}			
			}
			return array("success" => true, "data" => $res);
		}
		else
		{
			return array("success" => false, "error" => "No se encontraron solicitudes pendientes");
		}
	}
	//Funcion obtener contactos del usuario actualizada
	function obtener_contactos($conn)
	{
		$idusuario = $_SESSION["usuario"];
		$sql = "SELECT * FROM contactos WHERE idusuario = '$idusuario' OR idcontacto = '$idusuario'";
		$res = call($conn, $sql);
		if(count($res) > 0)
		{
			foreach ($res as $key => $contacto) {
				
				if($contacto["idcontacto"] != $idusuario)
				{
					$idres = $contacto["idcontacto"];				
				}
				else
				{
					$idres = $contacto["idusuario"];
				}
				$info = obtener_datos_usuario($conn, $idres);	
				if($info["success"])
				{
					$res[$key]["contacto"] = $info["data"][0];
				}
			}
			return array("success" => true, "data" => $res);
		}
		else
		{
			return array("success" => false, "error" => "No hay contactos registrados.");
		}
	}
	//Envia el mensaje al contacto
	function enviar_mensaje($conn, $data)
	{
		$idusuario = $_SESSION["usuario"];//Lo toma de la sesion
		$idcontacto = $data["idcontacto"];//Viene en los parametros
		$msj = $data["mensaje"];
		$fecha = date("Y-m-d");
		$sql = "INSERT INTO notificaciones (idusuario, idcontacto, mensaje, fecha) VALUES ('$idusuario', '$idcontacto', '$msj', '$fecha')";
		$idnewnotificacion = call($conn, $sql, 1);
		if($idnewnotificacion)
		{
			return array("success" => true, "id" => $idnewnotificacion);
		}
		return array("success" => false);
	}

	$res = array();

	//Si llega la información, se dirige a obtener contactos/solicitudes/Aceptar
	//Esta información se manda a la base de datos
	if(isset($_GET["obtener"]))
	{
		$res = obtener_contactos($conn);
	}
	else if(isset($_GET["invitar"]) && isset($_GET["email"]))//Cuando invitas a un contacto como amigo 
	{
		$res = invitar_usuario($conn, $_GET);
	}
	else if(isset($_GET["solicitudes"]))
	{
		$res = obtener_solicitudes($conn);
	}
	else if(isset($_GET["aceptar"]) && isset($_GET["id"]))//Aceptar la solictud de contacto
	{
		$res = aceptar_solicitud($conn, $_GET["id"]);
	}
	else if(isset($_GET["mensaje"]) && isset($_POST["mensaje"]) && isset($_POST["idcontacto"]))//Enviar mensaje a un contacto
	{
		$res = enviar_mensaje($conn, $_POST);
	}
	echo json_encode($res);
?>

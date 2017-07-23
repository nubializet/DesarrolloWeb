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
			$sql = "INSERT INTO solicitudes(idusuario, idcontacto) VALUES ('$idusuario', '$idcontacto')";
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

	//Funcion obtener contactos del usuario
	function obtener_contactos($conn)
	{
		$idusuario = $_SESSION["usuario"];
		$sql = "SELECT * FROM contactos WHERE idusuario = '$idusuario'";
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
	$res = array();

	//Si llega la información, se dirige a obtener contactos
	if(isset($_GET["obtener"]))
	{
		$res = ontener_contactos($conn);
	}
	else if(isset($_GET["invitar"]) && isset($_GET["email"]))
	{
		$res = invitar_usuario($conn, $_GET);
	}
	echo json_encode($res);
?>

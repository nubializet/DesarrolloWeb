<?php 
//this: Hace referencia la clase
session_start();
require_once "conexion.php";
//Herencia de Clase (Conexion.php)
class Mensaje extends Basica
{	//Constructor
	function __construct($conn)
	{
		// parent llama a la clase padre
		parent::__construct($conn);
		// $this->conn = $conn;
		// $this->usuario = 4; //$_SESSION["usuario"];
	}	

	function obtener_mensajes()
	{
		$idsesion = $this->usuario;//$idusuario = $_SESSION["usuario"];
		$sql = "SELECT * FROM notificaciones WHERE idcontacto = '$idsesion'";
		$res = $this->call($sql);//Funcion call en conexion.php
		//
		if($res && count($res) > 0)
		{
			return array("success" => true, "data" => $res);
		}
		return array("success" => false);
	}
}
//Instancia
$obj = new Mensaje($conn);
$res = array();
if(isset($_GET["mensajes"]))
{
	$res = $obj->obtener_mensajes();
}
echo json_encode($res);
?>
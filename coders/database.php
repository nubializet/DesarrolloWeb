<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "coders";
$email = "mcgalv@gmail.com";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
echo "Connected successfully";


//Seleccinar
// $sql = "select * from usuarios where username = '$email'";
// $r = mysqli_query($conn, $sql);
// 	if($r)
// 	{
// 		print_r($r);
// 	}
// 	else
// 	{
// 		echo mysqli_error($conn);
// 	}

//Insertar
//$sql = "INSERT INTO usuarios (username, password, fecha) VALUES ('mcgalv@gmail.com', '123456', '". date('Y-m-d')."')";
//$res = mysqli_query($conn, $sql);
//if ($res) {
  //   echo "New record created successfully" . $res;
//} else {
  //  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 //}

//UPDATE
// $sql = "update usuarios set username = 'nubia@gmail.com' where id = 1";
// $r = mysqli_query($conn, $sql);
// 	if($r)
// 	{
// 		echo "Se modifico el username";
// 	}
// 	else
// 	{
// 		echo mysqli_error($conn);
// 	}

$sql = "delete from usuarios where id = 1";
$r = mysqli_query($conn, $sql);
	if($r)
	{
		echo "Se elimino el usuario";
	}
	else
	{
		echo mysqli_error($conn);
	}


mysqli_close($conn);
?>
<?php 

// Inicia la sesión de cada usuario
session_start();
$_SESSION["conn"] = mysqli_connect('localhost','root','1234', 'Musify');


// LOGIN
if (isset($_POST['btnLogin'])){
	$alias=$_POST['alias'];
	$pass=$_POST['pass'];

	// Login del administrador
	if ($alias == "root123" && $pass == "1234") header ("Location: ../musify/admin.php");
	
	// Login del usuario
	else{
		// comprueba que los datos son correctos
		$result = mysqli_query($_SESSION["conn"], "SELECT Alias FROM Users WHERE Alias = '$alias' AND Pass = '$pass'");
		
		if (mysqli_num_rows($result) == 1)	{
			$_SESSION["alias"] = $alias;
			header ("Location: ../musify/muro.php");		
		}
		else header ("Location: ../musify/login.php");
	}	
}
// REGISTRO
else if (isset($_POST['btnRegistro'])){
	$alias=$_POST['alias'];
	$pass=$_POST['pass'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$age=$_POST['age'];
	$music=$_POST['music'];
	$mail=$_POST['mail'];
	
	// Comprueba que el usuario no existe y no es el administrador (root123) y lo inserta en la base de datos
	$result = mysqli_query($_SESSION["conn"], "SELECT Alias FROM Users WHERE Alias = '$alias'");
	if (mysqli_num_rows($result) == 0 && $alias != "root123"){	
		mysqli_query($_SESSION["conn"],"INSERT INTO Users (Alias, Name, Surname, Age, Mail, Pass) 
					VALUES('$alias', '$name', '$surname', '$age', '$mail', '$pass')");
					
		$_SESSION["alias"] = $alias;
		
		// Asigna musica y grupos correspondientes
		asignaMusica ($alias);
		asignaGrupos ($alias, $age);
    	header ("Location: ../musify/muro.php");
	}
	else header ("Location: ../musify/login.php");	
}
// CERAR SESIÓN
else if (isset($_POST['btnOut'])){
	mysqli_close($_SESSION["conn"]);
	header ("Location: ../musify/login.php");
}


// Asigna a cada usuario un grupo
function asignaGrupos ($alias, $age){
	$result1 = mysqli_query($_SESSION["conn"], "SELECT * FROM Grupos");
	
	while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
		// declaro result2 (tipos de musica que le gustan al usuario) aqui para que ejecute varias veces fetch_array
		$result2 = mysqli_query($_SESSION["conn"], "SELECT IdMusic FROM userMusic WHERE IdUser = '$alias'");
		while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
			
			if ($age >= $row1["minAge"] && $age <= $row1["maxAge"] && $row2["IdMusic"] == $row1["Music"]){
				$name = $row1["Name"]; 	
				
				mysqli_query ($_SESSION["conn"] ,"INSERT INTO userGroup (IdUser, IdGroup) VALUES('$alias', '$name')");
			}
		}
	}
} 

// Asigna a cada usuario un tipo de musica
function asignaMusica ($alias){
	$result = mysqli_query($_SESSION["conn"], "SELECT * FROM Music");
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		foreach ($_POST['music'] as $selectedMusic){
			
			if ($selectedMusic == $row["Name"]){
				$name = $row["Name"]; 	
				mysqli_query ($_SESSION["conn"] ,"INSERT INTO userMusic (IdUser, IdMusic) VALUES('$alias', '$name')");
			}
		}
	}
} 

// Devuelve los tipos de musica
function getMusica (){
	
	$result = mysqli_query($_SESSION["conn"], "SELECT * FROM Music");
	return $result;
} 

// Devuelve la afinidad musical entre dos usuarios
function getAfinidad ($user1){
	$user2 = $_SESSION["alias"];
	
	$result1 = mysqli_query($_SESSION["conn"], "SELECT IdMusic FROM UserMusic WHERE IdUser = '$user1' AND IdMusic IN (SELECT IdMusic FROM UserMusic WHERE IdUser = '$user2')");
	$result2 = mysqli_query($_SESSION["conn"], "SELECT IdMusic FROM UserMusic WHERE IdUser = '$user2'");

	// Convierte el resultado a porcentaje
	return round((mysqli_num_rows($result1)/mysqli_num_rows($result2))*100);
} 

?> 
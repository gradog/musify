<?php
require_once("exeLogin.php");

// CREA GRUPO
if (isset($_POST['btnCreate'])){	
	$group = $_POST['group'];
	$minAge = $_POST['minAge'];
	$maxAge = $_POST['maxAge'];
	$music = $_POST['music'];

	mysqli_query ($_SESSION["conn"] ,"INSERT INTO Grupos (Name, minAge, maxAge, Music) 
					VALUES('$group', '$minAge', '$maxAge', '$music')");
	
	// Asigna un grupo a uno o varios usuarios
	asignaGrupo ($group, $minAge, $maxAge, $music);
	
	header ("Location: ../musify/admin.php");	
}
// ELIMINA GRUPO
else if (isset($_POST['btnDelete'])){
	$group = $_POST['group'];
	
	mysqli_query($_SESSION["conn"], "DELETE FROM Grupos WHERE Name = '$group'");
	
	header ("Location: ../musify/admin.php");	
}

// Asigna un grupo a uno o varios usuarios
function asignaGrupo ($group, $minAge, $maxAge, $music){

	// SELECT de los usuarios que les gusta la misma musica que el grupo creado
	$result = mysqli_query($_SESSION["conn"], "SELECT IdUser FROM userMusic WHERE IdMusic = '$music'");
	
	// Recorre las filas obtenidas
	while ($row1 = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$alias =  $row1["IdUser"];
	
		// Comprueba que la edad del usuario esta dentro del rango
		$row2 = mysqli_fetch_array (mysqli_query($_SESSION["conn"], "SELECT Age FROM Users WHERE Alias = '$alias'"), MYSQLI_ASSOC);
		if ($row2["Age"] >= $minAge && $row2["Age"] <= $maxAge)
			mysqli_query ($_SESSION["conn"] ,"INSERT INTO userGroup (IdUser, IdGroup) VALUES('$alias', '$group')");			
	}
}

// Devuelve los grupos existentes
function getGrupos (){

	return mysqli_query($_SESSION["conn"], "SELECT * FROM Grupos");
}

// Devuelve los grupos del usuario de la sesion
function inGrupo (){
	$alias = $_SESSION["alias"];
	
	return mysqli_query($_SESSION["conn"], "SELECT * FROM Grupos WHERE Name IN (SELECT IdGroup FROM userGroup WHERE IdUser = '$alias')");
}

// Devuelve el numero de participantes de un grupo
function participantes ($group){
	$result = mysqli_query($_SESSION["conn"], "SELECT * FROM userGroup WHERE IdGroup = '$group'");
	
	return mysqli_num_rows($result);
}


// Devuelve el numero de grupos en común entre dos usuarios
function gruposComun ($user1){
	$user2 = $_SESSION["alias"];
	
	$result1 = mysqli_query($_SESSION["conn"], "SELECT IdGroup FROM UserGroup WHERE IdUser = '$user1' AND IdGroup IN (SELECT IdGroup FROM UserGroup WHERE IdUser = '$user2')");

	return mysqli_num_rows($result1);
}

?> 
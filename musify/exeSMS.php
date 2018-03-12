<?php
require_once("exeLogin.php");

// Inserta un mensaje
function insertaMensaje($for, $grupo){
	$sms = $_POST['sms'];
	$from = $_SESSION["alias"];
	
	// Inserta público
	if (is_null($for) && is_null($grupo)){
		mysqli_query ($_SESSION["conn"], "INSERT INTO Messages (Sender, Message) 
					VALUES('$from', '$sms')");
	}
	// Inserta grupal
	else if (!is_null($grupo)) {
		mysqli_query ($_SESSION["conn"], "INSERT INTO Messages (Sender, IdGrupo, Message) 
					VALUES('$from', '$grupo', '$sms')");
	}
	// Inserta privado
	else {
		mysqli_query ($_SESSION["conn"], "INSERT INTO Messages (Sender, Receiver, Message) 
					VALUES('$from', '$for', '$sms')");
	}
}

// Crea y muestra una tarjeta para cada mensaje intercambiado en un grupo
function muestraMensajes($sms){
			
	while ($row = mysqli_fetch_array($sms, MYSQLI_ASSOC)):?>		
   	 	<!-- mis sms privados -->
    	<?php if ($row["Sender"] == $_SESSION["alias"]):?>
 			<div class="myCard">
  				<h5><b><?php echo "Mi mensaje:"; ?> </b></h5> 
  				<h6><?php echo $row["Message"] ?></h6> 
  				<h7><?php echo $row["Date"] ?></h7>   		
			</div>		
			 	
		<!-- otros sms privados -->
		<?php else:?>
			<div class="friendCard">
  				<h5><b><?php echo "Mensaje de " . $row["Sender"] . ":"?></b></h5> 
  				<h6><?php echo $row["Message"] ?></h6> 
  				<h7><?php echo $row["Date"] ?></b></h7> 		
			</div>	
		<?php endif ?>
	<?php endwhile; 
}

// Devuelve los mensajes públicos
function getPublicos(){ 
	  
	return mysqli_query($_SESSION["conn"] , "SELECT * FROM Messages WHERE Receiver IS NULL AND IdGrupo IS NULL");
}

// Devuelve los mensajes grupales de los grupos a los que pertenece el usuario
function getGrupales($group){ 
	$alias = $_SESSION["alias"];
	 
	return mysqli_query ($_SESSION["conn"] , "SELECT * FROM Messages WHERE IdGrupo IN (SELECT IdGroup FROM userGroup WHERE IdGroup = '$group' AND IdUser = '$alias')");
}

// Devuelve los mensajes privados entre el usuario loggeado ("alias") y el usuario seleccionado ("user") 
function getPrivados($user){ 
	$alias = $_SESSION["alias"];
	
	return mysqli_query($_SESSION["conn"], "SELECT * FROM Messages WHERE (Receiver = '$alias' OR Receiver = '$user') AND (Sender = '$alias' OR Sender = '$user') AND IdGrupo IS NULL");
}
	
// Devuelve los alias de los usuarioss
function getUsuarios (){
	
	return mysqli_query($_SESSION["conn"], "SELECT * FROM Users");
} 

?> 
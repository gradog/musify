<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Musify - Mi Muro</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="estilo.css">
  <link rel="icon" type="image/png" href="icon.png">	<!-- FavIcon -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <?php require_once('exeSMS.php'); ?>
</head>

<body>
	<!-- SIDEBAR USUARIO -->
  	<div class="userBar">
		<h1><b>Musify</b></h1>
		<h2> Muro </h2>
		<div class="txtSaludo"> Hola <?php echo " " . $_SESSION['alias'] . " !" ?> </div>
		
		<!-- Botones de navegación -->
	 	<form method="post" action="grupos.php">
    		<button type="submit" name="btnGroups" class="btn btn-primary btn-block btn-large btn-gruposMuro">Mis Grupos</button> </form>
    	<form method="post" action="privado.php">
    		<button type="submit" name="btnPrivate" class="btn btn-primary btn-block btn-large btn-privadosMuro">Mensajes Privados</button> </form>
   		<form method="post" action="exeLogin.php">
    		<button type="submit" name="btnOut" class="btn btn-primary btn-block btn-large btn-salir">Cerrar sesión</button> </form>
	</div>
	  
	<!-- ZONA DE MENSAJES PUBLICOS -->  
  	<div class="smsPanel">
    	<form method="post" action="">
        	<input  class="boxSMS" type="text" name="sms" placeholder="Escribe aquí tu mensaje público..." required="required"/>
        	<button type="submit" name="btnSend" required="required" class="btn btn btn-primary btn-large btn-send"> <b> > <b> </button>
    	</form>
    
    	<!-- SCROLL -->  
    	<div class="scrollSMS">	
    		<?php if (isset($_POST['btnSend'])) insertaMensaje(NULL, NULL);	
			$sms = getPublicos();	
					
    		while ($row = mysqli_fetch_array($sms, MYSQLI_ASSOC)):?>	
    		<!-- mis sms publicos -->
    		<?php if ($row["Sender"] == $_SESSION["alias"]):?>
 				<div class="myCard">
  					<h5><b><?php echo "Mi mensaje:";?></b></h5> 
  					<h6><?php echo $row["Message"] ?></h6>
  					<h7><?php echo $row["Date"] ?></h7>    		
			 	</div>
			 		
			 <!-- otros sms publicos -->
			 <?php else: ?>
			 	<div class="friendCard">
  					<h5><b><?php echo $row["Sender"] . " dijo:"?></b></h5> 
  					<h6><?php echo $row["Message"] ?></h6> 
  					<h7><?php echo $row["Date"] ?></h7>    		
			 	</div>	
			 <?php endif ?>
			<?php endwhile; ?> 
    	</div>
	</div>

    <script src="js/index.js"></script>

</body>
</html>

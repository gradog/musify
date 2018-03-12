<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Musify - Grupos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="estilo.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <?php require_once('exeSMS.php'); ?>
  <?php require_once('exeGrupos.php'); ?>
</head>

<body>
	<!-- SIDEBAR USUARIO -->
  	<div class="userBar">
		<h1><b>Musify</b></h1>
		<h2> Mis Grupos </h2>
		<div class ="txtSaludo"> Hola <?php echo " " . $_SESSION['alias'] . " !" ?> </div>
		
		<div class="panelInfo">		
			<!-- SCROLL GRUPOS USUARIO -->
			<?php $grupos = inGrupo();			
			
			// Crea y muestra una tarjeta para cada grupo al que pertenece el usuario
			while ($row = mysqli_fetch_array($grupos, MYSQLI_ASSOC)):?>		
 			 	<div class="infoCard">
 			 		<?php $nombreGrupo = $row["Name"];
 			 		echo "<a href='grupos.php?smsGrupo=$nombreGrupo' style='text-decoration:none'>"; ?>
 			 		<h5><b> <?php echo $row["Name"] ?> </b></h5></a>		
  					<h6> <?php echo "Estilo: " . $row["Music"] ?> 
  					<br><br> <?php echo "Participantes: " . participantes($row["Name"]);?> 
  					<br><br> <?php echo "De " . $row["minAge"] . " a " . $row["maxAge"] . " años"?> </h6>			
			 		</div>	
			<?php endwhile;?>		 
		</div>
		
		<!-- Botones de navegación -->
	 	<form method="post" action="muro.php">
    		<button type="submit" name="btnMuro" class="btn btn-primary btn-block btn-large btn-gruposMuro">Ir al Muro</button> </form>
    	<form method="post" action="privado.php">
    		<button type="submit" name="btnPrivate" class="btn btn-primary btn-block btn-large btn-privadosMuro">Mensajes Privados</button> </form>  
   		<form method="post" action="exeLogin.php">
    		<button type="submit" name="btnOut" class="btn btn-primary btn-block btn-large btn-salir">Cerrar sesión</button> </form>
	</div>
	  
	<!-- AREA DE MENSAJES GRUPALES -->  
  	<div class="smsPanel">
    	<form method="post" action="">
        	<input class="boxSMS" type="text" name="sms" placeholder="Escribe aquí tu mensaje grupal..." required="required" />
        	<button class="btn btn btn-primary btn-large btn-send" type="submit" name="btnSend" required="required" /> <b> > <b> </button>
    	</form>
    			
    	<!-- Muestra con qué grupo se esta comunicando -->
 		<?php if (!empty($_GET['smsGrupo'])):?>
 			<div class="txtMensajes">
 				<?php echo "Mensajes de '" . $_GET['smsGrupo'] . "'";?>
 			</div>
 		<?php endif ?>
 		
 		<!-- SCROLL -->
    	<div class="scrollSMS">
			<?php if (isset($_POST['btnSend']) && !empty($_GET['smsGrupo'])) insertaMensaje(NULL, $_GET['smsGrupo']);

				
			// Mensaje informativo
			if (empty($_GET['smsGrupo'])):?>
				<div class="txtInfo">
				<?php echo "Haz click en un grupo para ver los mensajes";?>
				</div>
			<?php else:	
				// Coge mensajes del grupo seleccionado y los muestra en tarjetas
				$sms = getGrupales($_GET['smsGrupo']);
    			muestraMensajes($sms);
			
				// Mensaje informativo		
				if (mysqli_num_rows($sms) == 0): ?>
					<div class="txtInfo">
					<?php echo "Todavía no has enviado mensajes en '" . $_GET['smsGrupo'] . "'";?>
					</div>
				<?php endif ?>		
			<?php endif ?>
    		</div>
		</div>

    <script src="js/index.js"></script>
</body>
</html>

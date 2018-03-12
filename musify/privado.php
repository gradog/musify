<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Musify - Privado</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="estilo.css">
  <link rel="icon" type="image/png" href="icon.png">	<!-- FavIcon -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <?php require_once('exeSMS.php');
  		require_once('exeLogin.php');
  		require_once('exeGrupos.php'); ?>
</head>

<body>
	<!-- SIDEBAR USUARIO -->
  	<div class="userBar">
	<h1><b>Musify</b></h1>
	<h2> Mensajes Privados</h2>
	<div class="txtSaludo"> Hola <?php echo " " . $_SESSION['alias'] . " !" ?> </div>
		
	<div class="panelInfo">			
		<!-- Scroll -->
		<?php $usuarios = getUsuarios();			
			
		while ($row = mysqli_fetch_array($usuarios, MYSQLI_ASSOC)):?>		
			<!-- Crea y muestra una tarjeta para cada usuario -->
 		 	<?php if ($row["Alias"] != $_SESSION["alias"]): ?>
 		 	<div class="infoCard">
 		 		<?php 	$nombreUsuario = $row["Alias"];
 		 		echo "<a href='privado.php?smsUser=$nombreUsuario' style='text-decoration:none'>"; ?>
 		 		<h5><b> <?php echo $row["Alias"] ?> </b></h5></a>
 		 		<h6> <?php echo "Nombre real: " . $row["Name"] ?>
 		 		<br><br> <?php echo "Afinidad musical: " . getAfinidad ($row["Alias"]) . "%" ?>
 		 		<br><br> <?php echo "Grupos en común: " . gruposComun($row["Alias"]) ?> </h6>					
		 	</div>	
		 	<?php endif ?>
		<?php endwhile;?>	
	</div>	
	
	<!-- Botones de navegación -->
	<form method="post" action="grupos.php">
    	<button type="submit" name="btnGroups" class="btn btn-primary btn-block btn-large btn-gruposMuro">Mis Grupos</button> </form>   
    <form method="post" action="muro.php">
    	<button type="submit" name="btnMuro" class="btn btn-primary btn-block btn-large btn-privadosMuro">Ir al muro</button> </form>  
    <form method="post" action="exeLogin.php">
        <button type="submit" name="btnOut" class="btn btn-primary btn-block btn-large btn-salir">Cerrar sesión</button> </form>
	</div>
	
	<!-- ZONA DE MENSAJES PRIVADOS -->
  	<div class="smsPanel">
    	<form method="post" action="">
        	<input class="boxSMS" type="text" name="sms" placeholder="Escribe aquí tu mensaje privado..." required="required"/>
        	<button type="submit" name="btnSend" required="required" class="btn btn btn-primary btn-large btn-send"/> <b> > <b> </button>
    	</form>
 		
 		<!-- Muestra con qué usuario se esta comunicando -->
 		<?php if (!empty($_GET['smsUser'])):?>
 			<div class="txtMensajes">
 				<?php echo "Mensajes de '" . $_GET['smsUser'] . "'";?>
 			</div>
 		<?php endif ?>
 		
 		<!-- SCROLL -->
    	<div class="scrollSMS">
    	<?php if (isset($_POST['btnSend']) && !empty($_GET['smsUser'])) insertaMensaje($_GET['smsUser'], NULL);	
			
		// Mensaje informativo
		if (empty($_GET['smsUser'])):?>
			<div class="txtInfo">
			<?php echo "Haz click en un usuario para ver vuestros mensajes";?>
			</div>	
		<?php else: 
			// Coge mensajes del grupo seleccionado y los muestra en tarjetas
			$sms = getPrivados($_GET['smsUser']);	
			muestraMensajes($sms);
			
			// Mensaje informativo		
			if (mysqli_num_rows($sms) == 0): ?>
				<div class="txtInfo">
				<?php echo "Todavía no has enviado mensajes a '" . $_GET['smsUser'] . "'";?>
				</div>
			<?php endif ?>			
		<?php endif ?>
	</div>

    <script src="js/index.js"></script>
</body>
</html>

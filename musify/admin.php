<!DOCTYPE html>
<html >
<head>
  	<meta charset="UTF-8">
  	<title>Musify - Admin</title>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  	<link rel="stylesheet" href="estilo.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  	<?php require_once('exeGrupos.php'); 
  		require_once('exeLogin.php'); ?>
</head>

<body>
	<!-- SIDEBAR DEL ADMINISTRADOR -->
  	<div class="userBar">
	<h1><b>Musify - Admin</b></h1>
	<h2>Gestión de Grupos</h2>
		
	<!-- SCROLL -->
	<div class="panelInfo">	
		<?php $grupos = getGrupos();	
			
		// Crea y muestra una tarjeta para cada grupo existente 	
		while ($row = mysqli_fetch_array($grupos, MYSQLI_ASSOC)):?>		
 		 	<div class="infoCard">
  				<h5><b> <?php echo $row["Name"] ?> </b></h5>
  				<h6> <?php echo "Estilo: " . $row["Music"] ?> 
  				<br><br> <?php echo "Participantes: " . participantes($row["Name"]);?> 
  				<br><br> <?php echo "De " . $row["minAge"] . " a " . $row["maxAge"] . " años"?> </h6>				 		
		 	</div>	
		<?php endwhile;?>	
	</div>
	
    <form method="post" action="exeLogin.php">
    	<button type="submit" name="btnOut" class="btn btn-primary btn-block btn-large btn-salir">Cerrar sesión</button> </form>    
	</div>
	 
	<!-- AREA DE TRABAJO - CREA GRUPO -->  
  	<div class="crearGrupo">
  	<h2>Crear Grupo</h2>
    <form method="post" action="exeGrupos.php">
    	<input type="text" name="group" placeholder="Nombre del grupo" required="required" />
        
        <!-- Dropdown para asignar un rango de edades -->
        <p>Desde:</p>
		<select id="minAge" name="minAge" size = "1" required="required">	
		<?php 	
			for ($i=15; $i<100; $i++):?>
    		<option><?php echo $i; ?> <p> años</p> </option>
    	<?php endfor;?>  			
		</select>
		
		<p>Hasta:</p>
		<select id="maxAge" name="maxAge" size = "1" required="required">		
		<?php 	
			for ($i=15; $i<100; $i++):?>
    		<option><?php echo $i; ?> <p> años</p> </option>
    	<?php endfor;?>  			
		</select>

		<p>Tipo de música</p>
		<!--Dropdown para asignar un género musical -->
		<select  id="music" name="music" size = "1" required="required">
			<?php $musica = getMusica();		
    			while ($row = mysqli_fetch_array($musica, MYSQLI_ASSOC)):?>
    				<option> <?php echo $row["Name"]; ?> </option>
				<?php endwhile;?>			
			</select>
		 
    	<button type="submit" name="btnCreate" class="btn btn-primary btn-block btn-large btn-margin btn-crear">Crear Grupo</button>
    	</form>
	</div>
	
	<!-- AREA DE TRABAJO - ELIMINA GRUPO-->  
  	<div class="eliminarGrupo">
  	<h2>Eliminar Grupo</h2>
    <form method="post" action="exeGrupos.php">
        
        <!-- Dropdown para eliminar un grupo existente -->
       	<p>¿Qué grupo quieres eliminar? </p>
		<select id="group" name="group" size = "1" required="required">
		<?php
			$grupos = getGrupos();		
    		while ($row = mysqli_fetch_array($grupos, MYSQLI_ASSOC)):?>
    			<option> <?php echo $row["Name"]; ?> </option>
    	<?php endwhile;?>
    	</select>
		 
    	<button  type="submit" name="btnDelete" class="btn btn-primary btn-block btn-large btn-margin btn-eliminar">Eliminar Grupo</button>
    </form>
	</div>
	
    <script src="js/index.js"></script>
</body>
</html>

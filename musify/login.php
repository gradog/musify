<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Musify - Entra o regístrate</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="estilo.css">
  <link rel="icon" type="image/png" href="icon.png">	<!-- FavIcon -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <?php require_once('exeLogin.php'); ?>

</head>

<body>
	<div class="txtLogo"> Musify </div>
	
	<!-- LOGIN FORM -->
  	<div class="panelLogin">
		<h1>Login</h1>
		
    	<form method="post" action="exeLogin.php">
    		<input type="text" name="alias" placeholder="Usuario" required="required" />
        	<input type="password" name="pass" placeholder="Contraseña" required="required" />
        	<button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-large">Iniciar sesión</button>
    	</form>
    </div>

	<!-- REGISTRO FORM -->
 	<div class="panelRegistro">
		<h1>Regístrate</h1>
    	<form method="post" action="exeLogin.php">
    		<input type="text" name="name" placeholder="Nombre" required="required" />
    		<input type="text" name="surname" placeholder="Apellido" />
    		<input type="text" name="alias" placeholder="Usuario" required="required" />
    		<input type="text" name="mail" placeholder="Correo electrónico" required="required"/>
        	<input type="password" name="pass" placeholder="Contraseña" required="required" />
        
        	<p>Por favor, indica tu edad:</p>
        	<!-- Dropdown para elegir la edad -->
			<select id="age" name="age" size = "1" required="required">	
			<?php 	
				for ($i=15; $i<100; $i++):?>
    			<option><?php echo $i; ?></option>
    		<?php endfor;?>  			
			</select>
		
			<p>¿Qué estilos de música te gustan?</p>
			<!-- Dropdown para elegir uno o varios gustos musicales -->
			<select multiple="multiple" size = "4" id="music[]" name="music[]" size = "1" required="required">
			<?php
				$musica = getMusica();		
    			while ($row = mysqli_fetch_array($musica, MYSQLI_ASSOC)):?>
    				<option> <?php echo $row["Name"]; ?> </option>
				<?php endwhile;?>			
			</select>
		
        	<button type="submit" name="btnRegistro" class="btn btn-primary btn-block btn-large btn-margin">Registrame</button>
   	 	</form> 
	</div>
  
    <script src="js/index.js"></script>

</body>
</html>
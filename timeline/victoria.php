<?php
	session_start();	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		body{
			background-image: url("fondo.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
		table#tablero{
			margin-right: auto;
			margin-left: auto;
			margin-top: 5%;
			background-color: rgba(0, 0, 0, 0.7);
		}
		form{
			margin-right: auto;
			margin-left: auto;
			margin-top: 12%;
		}
		label{
			width: 500px;
			color: white;
			font-family: "Copperplate", "Copperplate Gothic Light", fantasy;
			font-size: 50px;
			background-color: rgba(0, 0, 0, 0.7);
		}
		.boton{
			background-color:rgba(0, 0, 0, 0.7); 
			margin-top: 5%;
			color: white; 
			width: 120px;
			height: 40px ;
		}

		.boton:hover{
			transform: scale(1.2);
			background-color:rgba(150, 127, 77, 0.6); 
			color: white; 
			width: 120px;
			height: 40spx ;
		}
		
	</style>
</head>
<body>
	<center>
		<form action="inicio.php">
			<label>ENHORABUENA DE LA BUENA</label>
			<br><br>
			<table id="tablero" cellpadding="10">
				<tr>
				<?php
					foreach ($_SESSION['tablero'] as $value) {
						foreach ($_SESSION['titulos'] as $key => $value2){
							if($value==$key){
								echo "<td><img src='dated_cards/".$key."' class='zoom' width='100' height='140'/></td>";
							}
						}
					}
				?>
				</tr>
			</table>
			<?php
				unset($_SESSION);
				session_destroy();
			?>
			<button class="boton">Volver</button>
			<br><br>
		<form>
	</center>
</body>
</html>
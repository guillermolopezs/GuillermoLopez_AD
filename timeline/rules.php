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
		form{
			margin-right: auto;
			margin-left: auto;
			margin-top: 10%;
			background-color: rgba(0, 0, 0, 0.7);
		}
		.label{
			color: white;
			font-family: "Copperplate", "Copperplate Gothic Light", fantasy;
			font-size: 50px;
		}
		.normas{
			color: white;
			font-family: "Copperplate", "Copperplate Gothic Light", fantasy;
			font-size: 20px;
			padding: 50px;
		}
		.lista{
			color: white;
			font-family: "Copperplate", "Copperplate Gothic Light", fantasy;
			font-size: 20px;
			margin-left: 7%;
		}
		.boton{
			background-color:rgba(150, 127, 77, 0.6); 
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
	<form action="inicio.php">
		<br>
		<center><label class="label">REGLAS</label>
		<br><br>
		<label class="normas">	El juego consiste en colocar las cartas que el jugador tiene en la mano en orden cronológico en el tablero. </label>
		</center>
		<br><br>
		<label class="normas">- El jugador gana si consigue colocar todas las cartas antes de que se le agoten las vidas.</label><br>
		<label class="normas">- Las cartas de la mano no tienen fecha, mientras que las cartas del tablero sí que la tienen.</label><br>
		<label class="normas">- Para jugar: </label><br>
		<label class="lista">- Escoger una carta de la mano.</label><br>
		<label class="lista">- Escoger una carta del tablero.</label><br>
		<label class="lista">- Escoger si colocar carta de la mano antes o después que la carta del tablero escogida.</label><br>
		<label class="lista">- Colocar.</label><br>
		<label class="normas">- Si el jugador falla, se colocará la carta de la mano escogida, el jugador perderá una vida y el jugador tendrá que robar una </label>
		<label class="normas">carta</label><br>
		<label class="normas">- Si se acierta, se coloca la carta en el tablero y se mantendrá el número de vidas.</label> 
		<center><button class="boton">Volver</button></center>
		<br><br>
	<form>
</body>
</html>
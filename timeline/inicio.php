<?php 
	session_start();
	$_SESSION['firstTurn']=true;
	$_SESSION['vidas']=5;
	$_SESSION['cards'] = array("0.png","1.png","2.png","3.png","4.png","5.png","6.png","7.png","8.png","9.png","10.png","11.png","12.png","13.png","14.png",
		"15.png","16.png","17.png","18.png","19.png","20.png","21.png","22.png","23.png","24.png","25.png","26.png","27.png","28.png","29.png");
	$_SESSION['hand'] = array();
	$_SESSION['tablero'] = array();
	$_SESSION['titulos'] = array(
	    "0.png"  => "Invención del tabaco",
	    "1.png" => "Invención de la mesa",
	    "2.png" => "Invención de la rueda",
	    "3.png" => "Invención del barco",
	    "4.png" => "Invención de la cerveza",
	    "5.png" => "Construcción del coliseo romano",
	    "6.png" => "La Capilla sixtina",
	    "7.png" => "Revolución industrial",
	    "8.png" => "Revolución francesa",
	    "9.png" => "Invención de la pila",
	    "10.png" => "Invención del ferrocarril",
	    "11.png" => "Construccion del arco del triunfo",
	    "12.png" => "Invención del horno",
	    "13.png" => "Invención de la lavadora",
	    "14.png" => "Invención del telefono",
	    "15.png" => "Invención del futbol",
	    "16.png" => "Invención de la raqueta de tenis",
	    "17.png" => "Invención del coche",
	    "18.png" => "Invención del lavavajillas",
	    "19.png" => "Invención de los dibujos",
	    "20.png" => "Creacion del anime",
	    "21.png" => "Fin primera guerra mundial",
	    "22.png" => "Invención del portaviones",
	    "23.png" => "Fin segunda guerra mundial",
	    "24.png" => "Invención de la marca adidas",
	    "25.png" => "Invención de la marca nike",
	    "26.png" => "Invención de la fregona",
	    "27.png" => "Invención de la pala de padel",
	    "28.png" => "Invención del internet",
	    "29.png" => "Caida del muro de Berlin"
	);

	
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
		form{
			margin-top: 15%;
		}
		.boton{
			background-color:rgba(0, 0, 0, 0.7); 
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
		<br><br><br><br>
		<form method="post" id="mainform">
			<button class="boton" onclick="jugar()">NUEVO JUEGO</button>
			<br><br>
			<button class="boton" onclick="reglas()">REGLAS</button>
		</form>
	</center>	
	<script type="text/javascript">
	function jugar(){
		document.getElementById("mainform").action="juego.php";
		document.getElementById("mainform").submit();
	}
	function reglas(){
		document.getElementById("mainform").action="rules.php";
		document.getElementById("mainform").submit();
	}
</script>
</body>
</html>
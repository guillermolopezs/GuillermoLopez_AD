<?php
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
	<?php 		

		$contador_mano=0;
		
		$num_cartas=count($_SESSION['cards']);
		
		if($_SESSION['firstTurn']==true){
			$inicial=rand(0,$num_cartas-1);
			$_SESSION['tablero'][]=$_SESSION['cards'][$inicial];
			unset($_SESSION['cards'][$inicial]);
			$_SESSION['cards']=array_values($_SESSION['cards']);
			
			while(count($_SESSION['hand'])<3){
				$num_cartas=count($_SESSION['cards']);
				$carta=rand(0,$num_cartas-1);
				$_SESSION['hand'][]=$_SESSION['cards'][$carta];
				unset($_SESSION['cards'][$carta]);
				$_SESSION['cards']=array_values($_SESSION['cards']);
				
			}
			$_SESSION['firstTurn']=false;
		}
		elseif($_POST['cartaTablero']!="null" && $_POST['cartaMano']!="null" && $_POST['antdesp']!="null"){
			$clave1=array_search($_POST['cartaMano'], $_SESSION['titulos']);
			$clave1=array_search($clave1, array_keys($_SESSION['titulos']));
			$cartamano=array_search($_POST['cartaMano'], $_SESSION['titulos']);
			$clave2=array_search($_POST['cartaTablero'], $_SESSION['titulos']);
			$clave2=array_search($clave2, array_keys($_SESSION['titulos']));
			$cartatablero=array_search($_POST['cartaTablero'], $_SESSION['titulos']);
			
			$num_cartas_tablero=count($_SESSION['tablero']);			
			if($clave1>$clave2){
				$acierto=true;
				$auxiliar=0;

				if($_POST['antdesp']!=1){
					$acierto=false;
				}
				
				foreach ($_SESSION['tablero'] as $value){
					$position=$_SESSION['titulos'][$value];
					$position=array_search($position, $_SESSION['titulos']);
					$position=array_search($position, array_keys($_SESSION['titulos']));
					$auxiliar++;
					if($position>$clave2 && $position<$clave1){
						$acierto=false;
					}
					if($clave1<$position){
						array_splice($_SESSION['tablero'],array_search($value, $_SESSION['tablero']),0,$cartamano);
						break;
					}
					elseif($auxiliar==count($_SESSION['tablero'])){
						$_SESSION['tablero'][]=$cartamano;
						break;
					}
				}	

				if($acierto==false){
					$_SESSION['vidas']--;
					$num_cartas=count($_SESSION['cards']);
					$carta=rand(0,$num_cartas-1);
					$_SESSION['hand'][]=$_SESSION['cards'][$carta];
					unset($_SESSION['cards'][$carta]);
					$_SESSION['cards']=array_values($_SESSION['cards']);
				}
			}
			elseif($clave1<$clave2){
				$acierto=true;
				$auxiliar=0;
				if($_POST['antdesp']==1){
					$acierto=false;
				}
				foreach ($_SESSION['tablero'] as $value){
					$position=$_SESSION['titulos'][$value];
					$position=array_search($position, $_SESSION['titulos']);
					$position=array_search($position, array_keys($_SESSION['titulos']));
					var_export($position);
					echo "       ";
					if($position<$clave2 && $position>$clave1){
						$acierto=false;
					}
					if($clave1<$position){
						array_splice($_SESSION['tablero'],$auxiliar,0,$cartamano);
						break;
					}
					$auxiliar++;
				}
				if($acierto==false){
					$_SESSION['vidas']--;
					$num_cartas=count($_SESSION['cards']);
					$carta=rand(0,$num_cartas-1);
					$_SESSION['hand'][]=$_SESSION['cards'][$carta];
					unset($_SESSION['cards'][$carta]);
					$_SESSION['cards']=array_values($_SESSION['cards']);
				}
			}
			unset($_SESSION['hand'][array_search($cartamano, $_SESSION['hand'])]);
			$_SESSION['hand']=array_values($_SESSION['hand']);
		}
		$cont_mano=count($_SESSION['hand']);
		if(count($_SESSION['hand'])==0 && $_SESSION['firstTurn']==false){
			echo header("Location:victoria.php");
		}	
		
		if($_SESSION['vidas']==0){
			echo header("Location:derrota.php");
		}

	?>
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
		td#hand{
			margin-right: auto;
			margin-left: auto;
			margin-top: 8%;
			background-color: rgba(0, 0, 0, 0.7);
		}
		table#vidas{
			margin-right: auto;
			margin-left: auto;
			margin-top: 9%;
		}
		table#tablero{
			margin-right: auto;
			margin-left: auto;
			margin-top: 2%;
			background-color: rgba(0, 0, 0, 0.7);
		}

		.zoom:hover {
  			transform: scale(1.8); 
		}

		form#jugar{
			margin-right: auto;
			margin-left: 4.5%;
			margin-top: 4.5%;
			
		}

		.boton{
			background-color:rgba(0, 0, 0, 0.7); 
			color: white; 
			width: 63px;
			height: 26px ;
		}

		.boton:hover{
			transform: scale(1.2);
			background-color:rgba(150, 127, 77, 0.6); 
			color: white; 
			width: 63px;
			height: 26px ;
		}

		.select{
			background-color:rgba(0, 0, 0, 0.7); 
			color: white; 
			width: 190px;
			height: 26px ;
		}

		.radioLabel{
			background-color:rgba(0, 0, 0, 0.7); 
			color: white; 
		}
	</style>
</head>
<body>
	<table id="vidas">
		<tr>
		<?php
			for ($i=0; $i <$_SESSION['vidas'] ; $i++) { 
				echo "<td><img src='vida.png' width='70' height='70'/></td>";
			}			
		?>
		</tr>
	</table>
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
	<br><br>
	<table id="hand" cellpadding="20" align="center">
		<tr>
		<?php
		//imprimir mano
			for($i=0;$i<count($_SESSION['hand']);$i++){
				echo "<td id='hand'><img src='undated_cards/".$_SESSION['hand'][$i]."' class='zoom' align='bottom-center' width='110' height='150'/></td>";
				echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
			}
		?>
		<td></td>
		<td width="250px">
			<form id="jugar" method="POST" action="juego.php">
				<center>
					<select class="select" name="cartaMano">
					<option hidden selected value="null">Elige una carta de tu mano</option>
					<?php
						foreach ($_SESSION['hand'] as $card ) {
							$contador_mano++;
							foreach ($_SESSION['titulos'] as $key => $value) {
								if($card == $key){
									echo "<option value='".$value."'>".$contador_mano.".  ".$value."</option>";
								}
							}
						}
					?>
					</select>	
					<br><br>
					<select class="select" name="cartaTablero" default="null">
						<option hidden selected value="null">Elige una carta del tablero</option>
						<?php
							foreach ($_SESSION['tablero'] as $card ) {
								$contador_mano++;
								foreach ($_SESSION['titulos'] as $key => $value) {
									if($card == $key){
										echo "<option value='".$value."'>".$value."</option>";
									}
								}
							}
						?>
					</select>
					<br><br>

					<input type="radio" id="default" name="antdesp" value="null" hidden checked>
					<input type="radio" id="antes" name="antdesp" value=0>
					<label for="antes" class="radioLabel">ANTES</label>
					&nbsp&nbsp&nbsp&nbsp&nbsp
					<input type="radio" id="despues" name="antdesp" value=1>
					<label for="despues" class="radioLabel">DESPUES</label><br>

					<br>
					<button class="boton">
						Colocar
					</button>
				</center>
			</form>
		</td>
		</tr>
	</table>
</body>
</html>
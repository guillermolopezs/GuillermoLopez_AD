<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		img{margin: 20px}
	</style>
	<title></title>
</head>
<body>
	<h1>SALA 2</h1>
	<form method="POST" id="formS2">
	<?php 
		$puertas=rand(2,4);
		$a = rand(0,$puertas-1);
		do{
			$b = rand(0,$puertas-1);
		}while ($a==$b);

		for($i=0;$i<$puertas;$i++){
			if($puertas==2){
				if($a==$i){
				echo "<img onclick='go()' src='puerta.jpg' width='150' height='300'>";
				}
				else{
				echo "<img onclick='goDead()' src='puerta.jpg' width='150' height='300'>";
				}
			}
			else{
				if($a==$i){
					echo "<img onclick='go()' src='puerta.jpg' width='150' height='300'>";
				}
				else if($b==$i){
					echo "<img onclick='volver()' src='puerta.jpg' width='150' height='300'>";
				}
				else{
					echo "<img onclick='goDead()' src='puerta.jpg' width='150' height='300'>";
				}
			}
		}
	?>
</form>
<script type="text/javascript">
	function go(){
		document.getElementById("formS2").action="sala3.php";
		document.getElementById("formS2").submit();
	}
	function goDead(){
		document.getElementById("formS2").action="dead.php";
		document.getElementById("formS2").submit();
	}
	function volver(){
		document.getElementById("formS2").action="sala1.php";
		document.getElementById("formS2").submit();
	}
</script>
</body>
</html>
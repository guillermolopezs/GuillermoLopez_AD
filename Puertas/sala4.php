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
	<h1>SALA 4</h1>
	<form method="POST" id="formS4">
	<?php 
		$puertas=rand(6,12);
		$a = rand(0,$puertas-1);
		do{
			$b = rand(0,$puertas-1);
		}while ($a==$b);

		for($i=0;$i<$puertas;$i++){
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
	
	?>
</form>
<script type="text/javascript">
	function go(){
		document.getElementById("formS4").action="victory.php";
		document.getElementById("formS4").submit();
	}
	function goDead(){
		document.getElementById("formS4").action="dead.php";
		document.getElementById("formS4").submit();
	}
	function volver(){
		document.getElementById("formS4").action="sala3.php";
		document.getElementById("formS4").submit();
	}
</script>
</body>
</html>
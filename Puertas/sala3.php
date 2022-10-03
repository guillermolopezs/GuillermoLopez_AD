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
	<h1>SALA 3</h1>
	<form method="POST" id="formS3">
	<?php 
		$puertas=rand(3,6);
		$a = rand(0,$puertas-1);
		do{
			$b = rand(0,$puertas);
		}while ($a==$b);

		for($i=0;$i<$puertas;$i++){
			if($a==$i){
				echo "<img onclick='go()' src='puerta.jpg' width='150' height='300'> v";
			}
			else if($b==$i){
				echo "<img onclick='volver()' src='puerta.jpg' width='150' height='300'>a";
			}
			else{
				echo "<img onclick='goDead()' src='puerta.jpg' width='150' height='300'>m";
			}
		}
	
	?>
</form>
<script type="text/javascript">
	function go(){
		document.getElementById("formS3").action="sala4.php";
		document.getElementById("formS3").submit();
	}
	function goDead(){
		document.getElementById("formS3").action="dead.php";
		document.getElementById("formS3").submit();
	}
	function volver(){
		document.getElementById("formS3").action="sala2.php";
		document.getElementById("formS3").submit();
	}
</script>
</body>
</html>
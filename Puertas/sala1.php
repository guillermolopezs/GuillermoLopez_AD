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
	<h1>SALA 1</h1>
	<form method="POST" id="formS1">
	<?php 
		$a = rand(0,1);
		for($i=0;$i<2;$i++){
			if($a==$i){
				echo "<img onclick='go()' src='puerta.jpg' width='150' height='300'>v";
			}
			else{
				echo "<img onclick='goDead()' src='puerta.jpg' width='150' height='300'>m";
			}
		}
	?>
</form>
<script type="text/javascript">
	function go(){
		document.getElementById("formS1").action="sala2.php";
		document.getElementById("formS1").submit();
	}
	function goDead(){
		document.getElementById("formS1").action="dead.php";
		document.getElementById("formS1").submit();
	}
</script>
</body>
</html>
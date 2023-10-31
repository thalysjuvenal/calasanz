<?php
@session_start();
if(@$_SESSION['nivel_usuario'] != 'administrador'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

 ?>
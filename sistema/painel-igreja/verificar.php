<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] != 'administrador' and @$_SESSION['nivel_usuario'] != 'coordenador'  and @$_SESSION['nivel_usuario'] != 'tesoureiro' and @$_SESSION['nivel_usuario'] != 'secretario'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

 ?>
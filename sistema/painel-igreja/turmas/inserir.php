<?php
require_once("../../conexao.php");
$pagina = 'turmas';
$nome = $_POST['nome'];
$dias = $_POST['dias'];
$local = $_POST['local'];
$hora = $_POST['hora'];
$pastor = $_POST['pastor'];
$coordenador = $_POST['coordenador'];
$lider1 = $_POST['lider1'];
$lider2 = $_POST['lider2'];
$igreja = $_POST['igreja'];
$id = @$_POST['id'];
$data_inicio = @$_POST['data_inicio'];
$data_termino = @$_POST['data_termino'];
$status = @$_POST['status'];

$query = $pdo->query("SELECT * FROM $pagina where nome = '$nome' and igreja = '$igreja'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id_reg != $id){
	echo 'O nome já está indisponível!';
	exit();
}


if($id == "" || $id == 0){
	$query = $pdo->prepare("INSERT INTO $pagina SET nome = :nome, dias = :dias, hora = :hora, local = :local, igreja = '$igreja', pastor = '$pastor', coordenador = '$coordenador', lider1 = '$lider1', lider2 = '$lider2', data_inicio = '$data_inicio', data_termino = '$data_termino', status = '$status'");

}else{
	$query = $pdo->prepare("UPDATE $pagina SET nome = :nome, dias = :dias, hora = :hora, local = :local,  pastor = '$pastor', coordenador = '$coordenador', lider1 = '$lider1', lider2 = '$lider2', data_inicio = '$data_inicio', data_termino = '$data_termino', status = '$status' where id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":dias", "$dias");
$query->bindValue(":hora", "$hora");
$query->bindValue(":local", "$local");
$query->execute();
echo 'Salvo com Sucesso';


?>
<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$pagina = 'missoes_recebidas';

$valor = $_POST['valor'];
$membro = $_POST['membro'];
$data = $_POST['data'];
$igreja = $_POST['igreja'];
$id = @$_POST['id'];


if($id == "" || $id == 0){
	$query = $pdo->prepare("INSERT INTO $pagina SET membro = '$membro', valor = :valor, data = '$data', usuario = '$id_usuario', igreja = '$igreja'");

	$query->bindValue(":valor", "$valor");
	$query->execute();
	$ult_id = $pdo->lastInsertId();

	//INSIRO NAS MOVIMENTACOES
$pdo->query("INSERT INTO movimentacoes SET tipo = 'Entrada', movimento = 'Missões Recebidas', descricao = '$membro', valor = '$valor', data = '$data', usuario = '$id_usuario', id_mov = '$ult_id', igreja = '$igreja'");

}else{
	require_once("../verificar-tesoureiro.php");
	$query = $pdo->prepare("UPDATE $pagina SET membro = '$membro', valor = :valor, data = '$data', usuario = '$id_usuario', igreja = '$igreja' where id = '$id'");

	//INSIRO NAS MOVIMENTACOES
$pdo->query("UPDATE movimentacoes SET descricao = '$membro', valor = '$valor', data = '$data', usuario = '$id_usuario' where id_mov = '$id' and movimento = 'Missões Recebidas'");


$query->bindValue(":valor", "$valor");
$query->execute();

}







echo 'Salvo com Sucesso';


?>
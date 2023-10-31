<?php
require_once("../../conexao.php");
$pagina = 'tarefas';
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$igreja = $_POST['igreja'];
$id = @$_POST['id'];


$query = $pdo->query("SELECT * FROM $pagina where data = '$data' and hora = '$hora' and igreja = '$igreja'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id_reg != $id){
	echo 'O horário está indisponível!';
	exit();
}


if($id == "" || $id == 0){
	$query = $pdo->prepare("INSERT INTO $pagina SET titulo = :titulo, descricao = :descricao, data = '$data', hora = '$hora', igreja = '$igreja', status = 'Agendada'");

	 $dataF = implode('/', array_reverse(explode('-', $data)));

	$query_not = $pdo->query("SELECT * FROM token where igreja = '$igreja'");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}
	$token = $res_not[$i_not]['token'];
	$titulo_not = 'Tarefa '.$titulo;
	$conteudo_not = $dataF . ' - ' .$hora;
	require("../../notificacao.php");

	}

}else{
	$query = $pdo->prepare("UPDATE $pagina SET titulo = :titulo, descricao = :descricao, data = '$data', hora = '$hora' where id = '$id'");
}

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":titulo", "$titulo");
$query->execute();
echo 'Salvo com Sucesso';


?>
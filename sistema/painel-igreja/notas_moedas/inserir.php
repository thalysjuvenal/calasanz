<?php
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$pagina = 'notas_moedas';

$valor_unitario = $_POST['valor_unitario'];
$quantidade = $_POST['quantidade'];
$dizimo_oferta = $_POST['dizimo_oferta'];
$membro = $_POST['membro'];
$data = $_POST['data'];
$igreja = $_POST['igreja'];
$id = @$_POST['id'];
$valor = $valor_unitario * $quantidade;

$query_con = $pdo->query("SELECT * FROM tesoureiros where id = '$membro' and igreja = '$igreja'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if (count($res_con) > 0) {
	$nome_membro = $res_con[0]['nome'];
} else {
	$nome_membro = 'Membro Não Informado';
}


if ($id == "" || $id == 0) {
	$query = $pdo->prepare("INSERT INTO $pagina SET tesoureiro = '$membro', quantidade = '$quantidade', valorunitario = '$valor_unitario', valortotal = '$valor', usuario = '$id_usuario', igreja = '$igreja', data = '$data', tipoinfo = '$dizimo_oferta'");

	$query->bindValue(":valor", "$valor");
	$query->execute();
	$ult_id = $pdo->lastInsertId();

	//INSIRO NAS MOVIMENTACOES
	$pdo->query("INSERT INTO movimentacoes SET tipo = 'Entrada', movimento = 'Contagem', descricao = '$nome_membro', valor = :valor, data = '$data', usuario = '$id_usuario', id_mov = '$ult_id', igreja = '$igreja'");

} else {
	require_once("../verificar-tesoureiro.php");
	$query = $pdo->prepare("UPDATE $pagina SET membro = '$membro', valor = :valor, data = '$data', usuario = '$id_usuario', igreja = '$igreja' where id = '$id'");

	//INSIRO NAS MOVIMENTACOES
	$pdo->query("UPDATE movimentacoes SET descricao = '$nome_membro', valor = '$valor', data = '$data', usuario = '$id_usuario' where id_mov = '$id' and movimento = 'Oferta'");


	$query->bindValue(":valor", "$valor");
	$query->execute();

}







echo 'Salvo com Sucesso';


?>
<?php
require_once("../../conexao.php");
$pagina = 'ministerios';
$id = @$_POST['id-excluir'];

$query = $pdo->query("DELETE FROM ministerios_membros where ministerio = '$id'");
$query = $pdo->query("DELETE FROM $pagina where id = '$id'");


echo 'Excluído com Sucesso';
?>
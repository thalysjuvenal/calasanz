<?php
require_once("../../conexao.php");
$pagina = 'celulas';
$id = @$_POST['id-excluir'];

$query = $pdo->query("DELETE FROM celulas_membros where celula = '$id'");
$query = $pdo->query("DELETE FROM $pagina where id = '$id'");


echo 'Excluído com Sucesso';
?>
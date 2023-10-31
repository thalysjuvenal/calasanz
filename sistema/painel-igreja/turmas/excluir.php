<?php
require_once("../../conexao.php");
$pagina = 'turmas';
$id = @$_POST['id-excluir'];

$query = $pdo->query("DELETE FROM turmas_membros where celula = '$id'");
$query = $pdo->query("DELETE FROM $pagina where id = '$id'");


echo 'Excluído com Sucesso';
?>
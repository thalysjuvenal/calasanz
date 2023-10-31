<?php 
require_once("conexao.php");

$email = $_POST['email_rec'];

$query = $pdo->query("SELECT * FROM usuarios where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);

if($total_reg > 0){

	$senha = $res[0]['senha'];
	//ENVIAR O EMAIL COM A SENHA
	$destinatario = $email;
	$assunto = $nome_igreja_sistema . ' - Recuperação de Senha';
	$mensagem = 'Sua senha é ' .$senha;
	$cabecalhos = "From: ".$email_super_adm;

	@mail($destinatario, $assunto, $mensagem, $cabecalhos);
	echo "<script>window.alert('Senha enviada para o email!')</script>";
	echo "<script>window.location='index.php'</script>";
	exit();

}else{
	echo "<script>window.alert('Email não Cadastrado!')</script>";
	echo "<script>window.location='index.php'</script>";
	exit();
}

 ?>
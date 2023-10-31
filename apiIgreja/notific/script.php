<!DOCTYPE html>
<html>
<head>
	<title>Script</title>
</head>
<body>

<?php 
require_once("../conexao.php");


$query = $pdo->query("SELECT * FROM config where notificacao = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_not = @count($res);

if($total_not == 0){

	$query_ig = $pdo->query("SELECT * FROM igrejas");
	$res_ig = $query_ig->fetchAll(PDO::FETCH_ASSOC);	
	for($i_ig=0; $i_ig < @count($res_ig); $i_ig++){
		foreach ($res_ig[$i_ig] as $key => $value){} 
		$id_igreja = $res_ig[$i_ig]['id'];

	$query = $pdo->query("SELECT * FROM pagar where igreja = '$id_igreja' and vencimento = curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$pagarHoje = @count($res);


$query = $pdo->query("SELECT * FROM receber where igreja = '$id_igreja' and vencimento = curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$receberHoje = @count($res);


$query = $pdo->query("SELECT * from tarefas where igreja = '$id_igreja' and data = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefas = @count($res);



//total de aniversariantes
$dataMes = Date('m');
$dataDia = Date('d');
$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and month(data_nasc) = '$dataMes' and day(data_nasc) = '$dataDia' order by data_nasc asc, id desc");
	$query_pastores = $pdo->query("SELECT * FROM pastores where igreja = '$id_igreja' and month(data_nasc) = '$dataMes' and day(data_nasc) = '$dataDia' order by data_nasc asc, id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
$res_pastores = $query_pastores->fetchAll(PDO::FETCH_ASSOC);
	$total_reg_pastores = count($res_pastores);
$totalAniversariantes = $total_reg + $total_reg_pastores;

	//NOTIFICAR CONTAS A PAGAR
	if(@$_GET['pagina'] == '1'){
		$query_not = $pdo->query("SELECT * FROM token where igreja = '$id_igreja' and (nivel = 'pastor' or nivel = 'tesoureiro')");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}

	$token = $res_not[$i_not]['token'];
	$titulo_not = 'Contas à Pagar';
	$conteudo_not = '('.$pagarHoje. ') Contas Hoje';
	require("../../sistema/notificacao.php");

	}
	
	}
	

	if(@$_GET['pagina'] == '2'){
	//NOTIFICAR CONTAS A RECEBER
	$query_not = $pdo->query("SELECT * FROM token where igreja = '$id_igreja' and (nivel = 'pastor' or nivel = 'tesoureiro')");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}

	$token = $res_not[$i_not]['token'];
	$titulo_not = 'Contas à Receber';
	$conteudo_not = '('.$receberHoje. ') Contas Hoje';
	require("../../sistema/notificacao.php");

	}
	
	}


	if(@$_GET['pagina'] == '3'){
	//NOTIFICAR ANIVERSARIANTES
	$query_not = $pdo->query("SELECT * FROM token where igreja = '$id_igreja' and (nivel = 'pastor' or nivel = 'secretario')");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}

	$token = $res_not[$i_not]['token'];
	$titulo_not = 'Aniversariantes';
	$conteudo_not = '('.$totalAniversariantes. ') Hoje';
	require("../../sistema/notificacao.php");

	}
	
	}


	if(@$_GET['pagina'] == '4'){
	//NOTIFICAR TAREFAS
	$query_not = $pdo->query("SELECT * FROM token where igreja = '$id_igreja'");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}

	$token = $res_not[$i_not]['token'];
	$titulo_not = 'Tarefas';
	$conteudo_not = '('.$totalTarefas. ') Hoje';
	require("../../sistema/notificacao.php");

	}

	$query = $pdo->query("UPDATE config SET notificacao = curDate()");
	
	}


}



}else{
	$_GET['pagina'] = 0;
}






//ENVIO BASEADO EM HORÁRIO
$hora_30 = date("H:i",strtotime(date("H:i")." +30 minutes"));

$query_ig = $pdo->query("SELECT * FROM igrejas");
	$res_ig = $query_ig->fetchAll(PDO::FETCH_ASSOC);	
	for($i_ig=0; $i_ig < @count($res_ig); $i_ig++){
		foreach ($res_ig[$i_ig] as $key => $value){} 
		$id_igreja = $res_ig[$i_ig]['id'];

$query_tar = $pdo->query("SELECT * FROM tarefas where igreja = '$id_igreja' and hora = '$hora_30' and data = curDate() and status = 'Agendada'");
$res_tar = $query_tar->fetchAll(PDO::FETCH_ASSOC);
$tar = @count($res_tar);

if($tar > 0){
	$horaF = (new DateTime($res_tar[0]['hora']))->format('H:i');

	$titulo_tar = 'Tarefa '.$res_tar[0]['titulo'];
	$desc_tar = 'Hoje as '. $horaF;


	//NOTIFICAR TAREFAS
	$query_not = $pdo->query("SELECT * FROM token where igreja = '$id_igreja'");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}

	$token = $res_not[$i_not]['token'];
	$titulo_not = $titulo_tar;
	$conteudo_not = $desc_tar;
	require("../../sistema/notificacao.php");

	}

}


}



if(!isset($_GET['pagina']) || $_GET['pagina'] >= 4){
	echo "<meta HTTP-EQUIV='refresh' CONTENT='60;URL=script.php?pagina=1'>"; 
}else{
	$valor = @$_GET['pagina'] + 1;
	echo "<meta HTTP-EQUIV='refresh' CONTENT='60;URL=script.php?pagina=$valor'>"; 
}


echo 'Mantenha este script aberto para ele buscar notificações a cada minuto!';

?>

</body>
</html>
<?php
require_once("../../conexao.php");
$pagina = 'informativos';

$preletor = $_POST['preletor'];
$data = $_POST['data'];
$texto_base = $_POST['texto_base'];
$tema = $_POST['tema'];
$evento = $_POST['evento'];
$horario = $_POST['horario'];


$pastor_responsavel = $_POST['pastor_responsavel'];
$pastores = $_POST['pastores'];
$lider_louvor = $_POST['lider_louvor'];
$obreiros = $_POST['obreiros'];
$apoio = $_POST['apoio'];
$abertura = $_POST['abertura'];
$recado = $_POST['recado'];


$oferta = $_POST['oferta'];
$recepcao = $_POST['recepcao'];
$bercario = $_POST['bercario'];
$escolinha = $_POST['escolinha'];
$membros = $_POST['membros'];
$visitantes = $_POST['visitantes'];
$conversoes = $_POST['conversoes'];
$total_ofertas = $_POST['total_ofertas'];
$total_dizimos = $_POST['total_dizimos'];
$obs = $_POST['obs'];

$id = @$_POST['id'];
$id_igreja = @$_POST['id_igreja'];
			
			

if($id_igreja == ""){
	$id_igreja = 1;
}



if($id == "" || $id == 0){
	$query = $pdo->prepare("INSERT INTO $pagina SET igreja = '$id_igreja', preletor = :preletor, data = '$data', texto_base = :texto_base, tema = :tema, evento = :evento, horario = :horario, obs = :obs, pastor_responsavel = '$pastor_responsavel', pastores = :pastores, lider_louvor = :lider_louvor, obreiros = :obreiros, apoio = :apoio, abertura = :abertura, recado = :recado, oferta = :oferta, recepcao = :recepcao, bercario = :bercario, escolinha = :escolinha, membros = :membros, visitantes = :visitantes, conversoes = :conversoes, total_ofertas = :total_ofertas, total_dizimos = :total_dizimos");

}else{
	$query = $pdo->prepare("UPDATE $pagina SET igreja = '$id_igreja', preletor = :preletor, data = '$data', texto_base = :texto_base, tema = :tema, evento = :evento, horario = :horario, obs = :obs, pastor_responsavel = '$pastor_responsavel', pastores = :pastores, lider_louvor = :lider_louvor, obreiros = :obreiros, apoio = :apoio, abertura = :abertura, recado = :recado, oferta = :oferta, recepcao = :recepcao, bercario = :bercario, escolinha = :escolinha, membros = :membros, visitantes = :visitantes, conversoes = :conversoes, total_ofertas = :total_ofertas, total_dizimos = :total_dizimos WHERE id = '$id'");
}

	$query->bindValue(":preletor", "$preletor");
	$query->bindValue(":texto_base", "$texto_base");
	$query->bindValue(":tema", "$tema");
	$query->bindValue(":evento", "$evento");
	$query->bindValue(":horario", "$horario");

	$query->bindValue(":obs", "$obs");
	$query->bindValue(":pastores", "$pastores");
	$query->bindValue(":lider_louvor", "$lider_louvor");
	$query->bindValue(":obreiros", "$obreiros");
	$query->bindValue(":apoio", "$apoio");
	$query->bindValue(":abertura", "$abertura");

	$query->bindValue(":recado", "$recado");
	$query->bindValue(":oferta", "$oferta");
	$query->bindValue(":recepcao", "$recepcao");
	$query->bindValue(":bercario", "$bercario");
	$query->bindValue(":escolinha", "$escolinha");

	$query->bindValue(":membros", "$membros");
	$query->bindValue(":visitantes", "$visitantes");
	$query->bindValue(":conversoes", "$conversoes");
	$query->bindValue(":total_ofertas", "$total_ofertas");
	$query->bindValue(":total_dizimos", "$total_dizimos");
	

	$query->execute();


echo 'Salvo com Sucesso';


?>
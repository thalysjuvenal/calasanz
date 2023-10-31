<?php
require_once("../../conexao.php");
$pagina = 'membros';
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$data_nasc = $_POST['data_nasc'];
$igreja = $_POST['igreja'];
$data_bat = $_POST['data_bat'];
$cargo = $_POST['cargo'];
$estado = $_POST['estado'];
$id = @$_POST['id'];

$rg = @$_POST['rg'];
$nome_pai = @$_POST['nome_pai'];
$nome_mae = @$_POST['nome_mae'];
$membresia = @$_POST['membresia'];
$naturalidade = @$_POST['naturalidade'];
$nacionalidade = @$_POST['nacionalidade'];

$query = $pdo->query("SELECT * FROM $pagina where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id_reg != $id){
	echo 'O CPF já está cadastrado nessa ou em outra filial!';
	exit();
}

$query = $pdo->query("SELECT * FROM $pagina where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id_reg != $id){
	echo 'O Email já está cadastrado nessa ou em outra filial!';
	exit();
}


//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/membros/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
	$imagem = "sem-foto.jpg";
}else{
	$imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'jpg' or $ext == 'jpeg'){ 
	move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida, somente JPG ou JPEG!';
	exit();
}



if($id == "" || $id == 0){
	$query = $pdo->prepare("INSERT INTO $pagina SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, foto = '$imagem', data_nasc = '$data_nasc', data_cad = curDate(), igreja = '$igreja', data_batismo = '$data_bat', cargo = '$cargo', ativo = 'Sim', estado_civil = '$estado', rg = :rg, membresia = :membresia, nome_pai = :nome_pai, nome_mae = :nome_mae, naturalidade = :naturalidade, nacionalidade = :nacionalidade");

	$query->bindValue(":nome", "$nome");
	$query->bindValue(":email", "$email");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":endereco", "$endereco");

	$query->bindValue(":rg", "$rg");
	$query->bindValue(":membresia", "$membresia");
	$query->bindValue(":nome_pai", "$nome_pai");
	$query->bindValue(":nome_mae", "$nome_mae");
	$query->bindValue(":naturalidade", "$naturalidade");
	$query->bindValue(":nacionalidade", "$nacionalidade");
	$query->execute();


	$query_c = $pdo->query("SELECT * FROM cargos where id = '$cargo'");	
	$res_c = $query_c->fetchAll(PDO::FETCH_ASSOC);
	$nome_cargo = $res_c[0]['nome'];

	$query_not = $pdo->query("SELECT * FROM token where igreja = '$igreja'");	
	$res_not = $query_not->fetchAll(PDO::FETCH_ASSOC);
	for ($i_not=  0; $i_not < count($res_not); $i_not++) { 
		foreach ($res_not[$i_not] as $key => $value) {
	}
	$token = $res_not[$i_not]['token'];
	$titulo_not = 'Novo '.$nome_cargo;
	$conteudo_not = $nome;
	require("../../notificacao.php");

	}
	

}else{
	if($imagem == "sem-foto.jpg"){
		$query = $pdo->prepare("UPDATE $pagina SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, data_nasc = '$data_nasc', igreja = '$igreja', data_batismo = '$data_bat', cargo = '$cargo', estado_civil = '$estado', rg = :rg, membresia = :membresia, nome_pai = :nome_pai, nome_mae = :nome_mae, naturalidade = :naturalidade, nacionalidade = :nacionalidade where id = '$id'");
	}else{

		$query = $pdo->query("SELECT * FROM $pagina where id = '$id'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$foto = $res[0]['foto'];
		if($foto != "sem-foto.jpg"){
			@unlink('../../img/membros/'.$foto);	
		}

		$query = $pdo->prepare("UPDATE $pagina SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, foto = '$imagem', data_nasc = '$data_nasc', igreja = '$igreja', data_batismo = '$data_bat', cargo = '$cargo', estado_civil = '$estado', rg = :rg, membresia = :membresia, nome_pai = :nome_pai, nome_mae = :nome_mae, naturalidade = :naturalidade, nacionalidade = :nacionalidade where id = '$id'");
	}
	


	$query->bindValue(":nome", "$nome");
	$query->bindValue(":email", "$email");
	$query->bindValue(":cpf", "$cpf");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":endereco", "$endereco");

	$query->bindValue(":rg", "$rg");
	$query->bindValue(":membresia", "$membresia");
	$query->bindValue(":nome_pai", "$nome_pai");
	$query->bindValue(":nome_mae", "$nome_mae");
	$query->bindValue(":naturalidade", "$naturalidade");
	$query->bindValue(":nacionalidade", "$nacionalidade");
	$query->execute();

	
}



echo 'Salvo com Sucesso';


?>
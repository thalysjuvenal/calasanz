<?php 
require_once("conexao.php");

//CRIAR O USUÁRIO ADMINISTRADOR CASO ELE NÃO EXISTA
$query = $pdo->query("SELECT * from usuarios where nivel = 'administrador' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);


if($total_reg == 0){
  $pdo->query("INSERT INTO usuarios SET nome = 'Pastor Presidente', email = 'sistemasparaigrejas@gmail.com', senha = '123', cpf = '000.000.000-00', nivel = 'bispo', id_pessoa = '1', foto = '22-06-2021-18-30-33-user.jpg', igreja = '0' ");  
}
 ?>
<!DOCTYPE html>
<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link href="img/logo-icone.ico" rel="shortcut icon" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title><?php echo $nome_igreja_sistema ?></title>
</head>
<body>

	<div class="login">
	<img src="img/logo.png" width="100%" class="mb-4">
    <form method="post" action="autenticar.php">
    	<input type="text" name="usuario" placeholder="Email ou CPF" required="required" value=""/>
        <input type="password" name="senha" placeholder="Insira sua Senha" required="required" value="" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Logar</button>
        <div align="center" style="margin-top: 10px"><a title="Recuperar Senha" href="#" data-bs-toggle="modal" data-bs-target="#modalRecuperar"><small>Recuperar Senha</small></a></div>
    </form>
</div>

</body>
</html>







<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Recuperar Senha </h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="recuperar.php">
				<div class="modal-body">
					<input class="" type="email" name="email_rec" placeholder="Seu Email" required >					
				</div>
			
			<small><div align="center" id="msg-config"></div></small>
			<div class="modal-footer">
				
				<button type="submit" class="btn btn-primary">Recuperar</button>
			</div>
		</form>
	</div>
</div>
</div>


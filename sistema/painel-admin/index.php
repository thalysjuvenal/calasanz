<?php
@session_start();
require_once("../conexao.php");
require_once("verificar.php");
$id_usuario = @$_SESSION['id_usuario'];

//TRAZER DADOS DO USUÁRIO LOGADO
$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $res[0]['nome'];
$email_usu = $res[0]['email'];
$senha_usu = $res[0]['senha'];
$cpf_usu = $res[0]['cpf'];
$nivel_usu = $res[0]['nivel'];
$foto_usu = $res[0]['foto'];

//TRAZER DADOS DO CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_igr = $res[0]['email'];
$nome_igr = $res[0]['nome'];
$end_igr = $res[0]['endereco'];
$tel_igr = $res[0]['telefone'];

$pag = @$_GET['pag'];
if($pag == ""){
	$pag = 'home';
}


$data_atual = date('Y-m-d');
$hora_atual = date('H:i:s');

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";





?>
<!DOCTYPE html>
<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link href="../img/logo-icone.ico" rel="shortcut icon" type="image/x-icon">
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
	<script type="text/javascript" src="../DataTables/datatables.min.js"></script>

	<link href="../css/toastr.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/toastr.js"></script>


	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		<script>
			$(document).ready(function() {
				$('.selfin').select2({
				//placeholder: 'Selecione um Cliente',
				dropdownParent: $('#modalRelFinanceiro')
				});

				$('.selpat').select2({
				//placeholder: 'Selecione um Cliente',
				dropdownParent: $('#modalRelPatrimonios')
				});

				$('.selmem').select2({
				//placeholder: 'Selecione um Cliente',
				dropdownParent: $('#modalRelMembros')
				});
			});


		</script>

		<style type="text/css">
			.select2-selection__rendered {
				line-height: 30px !important;
				font-size:14px !important;
				color:#292929 !important;

			}

			.select2-selection {
				height: 30px !important;
				font-size:14px !important;
				color:#292929 !important;

			}
		</style>  

	
	<title>Painel Administrativo</title>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php"><img src="../img/logo-icone.png" width="50px"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Pessoas
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="index.php?pag=administradores">Administradores</a></li>
							<li><a class="dropdown-item" href="index.php?pag=coordenadores">Coordenadores</a></li>
							<li><a class="dropdown-item" href="index.php?pag=tesoureiros">Tesoureiros</a></li>
							<li><a class="dropdown-item" href="index.php?pag=secretarios">Secretários</a>
							</li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="index.php?pag=usuarios">Usuários</a></li>
							
							
						</ul>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Cadastros
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

							<li><a class="dropdown-item" href="index.php?pag=igrejas">Igrejas</a></li>
							
							<li><a class="dropdown-item" href="index.php?pag=cargos">Funções</a></li>

							<li><a class="dropdown-item" href="index.php?pag=frequencias">Frequências (Contas)</a></li>
							
						</ul>
					</li>

						<!--<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Consultas
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="index.php?pag=anexos">Anexos / Arquivos</a></li>
							<li><a class="dropdown-item" href="index.php?pag=patrimonios">Patrimônios</a></li>
							
							
							
						</ul>
					</li>-->



					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Relatórios
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

							<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalRelMembros">Membros</a></li>
														
							<!--<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalRelPatrimonios">Patrimônio</a></li>-->

							<li><a class="dropdown-item " href="#" data-bs-toggle="modal" data-bs-target="#modalRelFinanceiro">Financeiros</a></li>

							<li><a class="dropdown-item " href="#" data-bs-toggle="modal" data-bs-target="#modalRelLogs">Auditoria de Logs</a></li>

							<li><a class="dropdown-item " href="#" data-bs-toggle="modal" data-bs-target="#modalRelTransfMembros">Transferência de Membros</a></li>

							<li><a class="dropdown-item " href="#" data-bs-toggle="modal" data-bs-target="#modalRelFechamentos">Fechamentos Mensais</a></li>


																											
						</ul>
					</li>


					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="../../apiIgreja/notific/script.php" target="_blank">Notificações</a>
					</li>

				
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#modalConfig">Configurações</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="backup/backup.php" target="_blank">Backup Banco</a>
					</li>

				</ul>
				<div class="d-flex mx-4">
					<img class="img-profile rounded-circle" src="../img/membros/<?php echo $foto_usu ?>" width="40px" height="40px">

					<ul class="navbar-nav ">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo @$nome_usu ?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalPerfil">Editar Dados</a></li>

								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="../logout.php">Sair</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</div>
		</div>
	</nav>

	<div class="container-fluid mb-4 mx-4">
		<?php 
		require_once($pag.'.php');
		?>
	</div>

</body>
</html>




<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Dados</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-usu" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome</label>
								<input type="text" class="form-control" id="nome_usu" name="nome_usu" placeholder="Insira o Nome" value="<?php echo $nome_usu ?>" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">CPF</label>
								<input type="text" class="form-control" id="cpf_usu" name="cpf_usu" placeholder="Insira o CPF" value="<?php echo $cpf_usu ?>" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Email</label>
								<input type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Insira o Email" value="<?php echo $email_usu ?>" required>
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Senha</label>
								<input type="text" class="form-control" id="senha_usu" name="senha_usu" placeholder="Insira a Senha" value="<?php echo $senha_usu ?>" required>
							</div>
						</div>


						<div class="row">
							<div class="col-md-8">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Foto</label>
									<input type="file" class="form-control-file" id="imagem-usu" name="imagem" onChange="carregarImg2();">
								</div>
							</div>
							<div class="col-md-4">
								<div id="divImg" class="mt-4">
									<img src="../img/membros/<?php echo $foto_usu ?>"  width="100px" id="target-usu">									
								</div>
							</div>
						</div>


						<input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">

					</div>
				</div>
				<small><div align="center" id="msg-usu"></div></small>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-usu">Fechar</button>
					<button type="submit" class="btn btn-primary">Editar</button>
				</div>
			</form>
		</div>
	</div>
</div>






<div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Configurações do Sistema</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-config" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome Igreja</label>
								<input type="text" class="form-control form-control-sm" id="nome_igr" name="nome_igr" placeholder="Nome da Igreja" value="<?php echo $nome_igr ?>" required>
							</div>
						</div>
						

						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Email Igreja</label>
								<input type="email" class="form-control form-control-sm" id="email_igr" name="email_igr" placeholder="Insira o Email Igreja" value="<?php echo $email_igr ?>" required>
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Telefone Igreja</label>
								<input type="text" class="form-control form-control-sm" id="tel_igr" name="tel_igr" placeholder="Telefone da Igreja" value="<?php echo $tel_igr ?>" required>
							</div>
						</div>
					</div>


					<div class="row">

							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Endereço Igreja</label>
								<input type="text" class="form-control form-control-sm" id="end_igr" name="end_igr" placeholder="Endereço da Igreja" value="<?php echo $end_igr ?>" required>
							</div>
						
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Qtd Tarefas</label>
								<input type="number" class="form-control form-control-sm" id="qtd_tar_igr" name="qtd_tar_igr" value="<?php echo $quantidade_tarefas ?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Limitar Tesoureiro</label>
								<select class="form-select form-select-sm" name="limitar_tesoureiro">
									<option <?php if($limitar_tesoureiro == 'Sim'){ ?>selected <?php } ?> value="Sim">Sim</option>
									<option <?php if($limitar_tesoureiro == 'Não'){ ?>selected <?php } ?> value="Não">Não</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Relatório PDF</label>
								<select class="form-select form-select-sm" name="relatorio_pdf">
									<option <?php if($relatorio_pdf == 'Sim'){ ?>selected <?php } ?> value="Sim">Sim</option>
									<option <?php if($relatorio_pdf == 'Não'){ ?>selected <?php } ?> value="Não">Não</option>
								</select>
							</div>
						</div>


						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Cabeçalho Rel Imagem</label>
								<select class="form-select form-select-sm" name="cabecalho_rel_img">
									<option <?php if($cabecalho_rel_img == 'Sim'){ ?>selected <?php } ?> value="Sim">Sim</option>
									<option <?php if($cabecalho_rel_img == 'Não'){ ?>selected <?php } ?> value="Não">Não</option>
								</select>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-3">
								<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Itens Por Página (Site)</label>
								<input type="number" class="form-control form-control-sm" id="itens_por_pagina" name="itens_por_pagina" value="<?php echo $itens_por_pagina ?>">
							</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Auditoria (logs)</label>
								<select class="form-select form-select-sm" name="logs">
									<option <?php if($logs == 'Sim'){ ?>selected <?php } ?> value="Sim">Sim</option>
									<option <?php if($logs == 'Não'){ ?>selected <?php } ?> value="Não">Não</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Dias Excluir Logs</label>
								<input type="number" class="form-control form-control-sm" id="dias_excluir_logs" name="dias_excluir_logs" value="<?php echo $dias_excluir_logs ?>">
							</div>
						</div>

					</div>

					
				</div>
			
			<small><div align="center" id="msg-config"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-config">Fechar</button>
				<button type="submit" class="btn btn-primary">Editar</button>
			</div>
		</form>
	</div>
</div>
</div>








<div class="modal fade" id="modalRelMembros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Relatório de Membros</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="../rel/relMembros.php" target="_blank">
				<div class="modal-body">
					<div class="row">

							<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Igreja</label>
									<select class="selmem" aria-label="Default select example" name="igreja" style="width:100%">  
										
										<?php 
									$query = $pdo->query("SELECT * FROM igrejas order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = count($res);
									if($total_reg > 0){

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){} 

												$nome_reg = $res[$i]['nome'];
											$id_reg = $res[$i]['id'];
											?>
											<option value="<?php echo $id_reg ?>"><?php echo $nome_reg ?></option>

										<?php }} ?>

									</select>
								</div>
						</div>



						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Cargo / Membros</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="cargo">  
										<option value="">Todos</option>

										<?php 
									$query = $pdo->query("SELECT * FROM cargos order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = count($res);
									if($total_reg > 0){

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){} 

												$nome_reg = $res[$i]['nome'];
											$id_reg = $res[$i]['id'];
											?>
											<option value="<?php echo $id_reg ?>"><?php echo $nome_reg ?></option>

										<?php }} ?>

									</select>
								</div>
						</div>
						

						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Status</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="status">  
										<option value="">Todos</option>
										<option value="Sim">Ativo</option>
										<option value="Não">Inativo</option>
									</select>
								</div>
						</div>

						<div class="col-md-4">
							
						</div>

						
					</div>

					
				</div>
			
			<small><div align="center" id="msg-config"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-config">Fechar</button>
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
		</form>
	</div>
</div>
</div>






<div class="modal fade" id="modalRelPatrimonios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Relatório de Patrimônios</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="../rel/relPatrimonio.php" target="_blank">
				<div class="modal-body">
					<div class="row">

							<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Igreja</label>
									<select class="selpat" aria-label="Default select example" name="igreja" style="width:100%">  
										
										<?php 
									$query = $pdo->query("SELECT * FROM igrejas order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = count($res);
									if($total_reg > 0){

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){} 

												$nome_reg = $res[$i]['nome'];
											$id_reg = $res[$i]['id'];
											?>
											<option value="<?php echo $id_reg ?>"><?php echo $nome_reg ?></option>

										<?php }} ?>

									</select>
								</div>
						</div>



						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Itens</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="itens">  
										<option value="">Todos</option>
										<option value="1">Pertencentes a Igreja</option>
										<option value="2">Emprestados a Outros</option>
										<option value="3">Itens de Outras Igrejas</option>
									</select>
								</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Status</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="status">  
										<option value="">Todos</option>
										<option value="Sim">Ativo</option>
										<option value="Não">Inativo</option>
									</select>
								</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Compra / Doação</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="entrada">  
										<option value="">Todos</option>
										<option value="Compra">Compra</option>
										<option value="Doação">Doação</option>
									</select>
								</div>
						</div>

						
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Inicial <small><small>(
										<a href="#" class="text-primary" onclick="datas('1980-01-01', 'tudo-pat', 'pat')">
											<span id="tudo-pat">Tudo</span>
										</a> / 
									<a href="#" class="text-dark" onclick="datas('<?php echo $data_atual ?>', 'hoje-pat', 'pat')">
											<span id="hoje-pat">Hoje</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_mes ?>', 'mes-pat', 'pat')">
											<span id="mes-pat">Mês</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_ano ?>', 'ano-pat', 'pat')">
											<span id="ano-pat">Ano</span>
										</a> 
									)</small></small></label>
									<input type="date" class="form-control form-control-sm" name="dataInicial" id="dtInicial-pat" value="1980-01-01">
								</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Final</label>
									<input type="date" class="form-control form-control-sm"  name="dataFinal" id="dtFinal-pat" value="<?php echo $data_atual ?>">
								</div>
						</div>


					</div>

					
				</div>
			
			<small><div align="center" id="msg-config"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-config">Fechar</button>
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
		</form>
	</div>
</div>
</div>







<div class="modal fade" id="modalRelFinanceiro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Relatório Financeiro <small><small>(
										<a href="#" class="text-primary" onclick="datas('1980-01-01', 'tudo-fin', 'fin')">
											<span id="tudo-fin">Tudo</span>
										</a> / 
									<a href="#" class="text-dark" onclick="datas('<?php echo $data_atual ?>', 'hoje-fin', 'fin')">
											<span id="hoje-fin">Hoje</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_mes ?>', 'mes-fin', 'fin')">
											<span id="mes-fin">Mês</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_ano ?>', 'ano-fin', 'fin')">
											<span id="ano-fin">Ano</span>
										</a> 
									)</small></small></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="../rel/relFinanceiro.php" target="_blank">
				<div class="modal-body">
					<div class="row">


							<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Igreja</label>
									<select class="selfin" aria-label="Default select example" name="igreja" style="width:100%">  
										
										<?php 
									$query = $pdo->query("SELECT * FROM igrejas order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = count($res);
									if($total_reg > 0){

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){} 

												$nome_reg = $res[$i]['nome'];
											$id_reg = $res[$i]['id'];
											?>
											<option value="<?php echo $id_reg ?>"><?php echo $nome_reg ?></option>

										<?php }} ?>

									</select>
								</div>
						</div>

						
						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Movimento</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="movimento" id="movim">  
										<option value="">Todos</option>
										<option value="Conta">Contas à Pagar</option>
										<option value="Dízimo">Dízimos</option>
										<option value="Oferta">Ofertas</option>
										<option value="Doação">Doações</option>
										<option value="Venda">Vendas</option>
									</select>
								</div>
						</div>


						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Entradas / Saídas</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="tipo" id="tip">  
										<option value="">Todas</option>
										<option value="Entrada">Entradas</option>
										<option value="Saída">Saídas</option>
										
									</select>
								</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Inicial </label>
									<input type="date" class="form-control form-control-sm" name="dataInicial" id="dtInicial-fin" value="1980-01-01">
								</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Final</label>
									<input type="date" class="form-control form-control-sm"  name="dataFinal" id="dtFinal-fin" value="<?php echo $data_atual ?>">
								</div>
						</div>

						
					</div>

										
				</div>
			
			<small><div align="center" id="msg-config"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-config">Fechar</button>
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
		</form>
	</div>
</div>
</div>







<div class="modal fade" id="modalRelLogs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Relatório de Logs <small><small>(
										<a href="#" class="text-primary" onclick="datas('1980-01-01', 'tudo-log', 'log')">
											<span id="tudo-log">Tudo</span>
										</a> / 
									<a href="#" class="text-dark" onclick="datas('<?php echo $data_atual ?>', 'hoje-log', 'log')">
											<span id="hoje-log">Hoje</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_mes ?>', 'mes-log', 'log')">
											<span id="mes-log">Mês</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_ano ?>', 'ano-log', 'log')">
											<span id="ano-log">Ano</span>
										</a> 
									)</small></small></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="../rel/relLogs.php" target="_blank">
				<div class="modal-body">
					<div class="row">

						
						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Ações</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="acao" id="acao">  
										<option value="">Todas</option>
										<option value="Exclusão">Exclusão</option>
										<option value="Inserção">Inserção</option>
										<option value="Edição">Edição</option>
										<option value="Login">Login</option>
										<option value="Logout">Logout</option>
									</select>
								</div>
						</div>


						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Tabelas</label>
									<select class="form-select form-select-sm" aria-label="Default select example" name="tabelas" id="tabelas">  
										<option value="">Todas</option>
										<option value="usuarios">Usuários</option>
										<option value="patrimonios">Patrimônios</option>
										<option value="tesoureiros">Tesoureiros</option>
										<option value="secretarios">Secretários</option>
										<option value="pastores">Pastores</option>
										<option value="igrejas">Igrejas</option>
										<option value="frequencias">Frequencias</option>
										<option value="cargos">Cargos</option>
										<option value="bispos">Bispos</option>
										<option value="anexos">Anexos</option>
									</select>
								</div>
						</div>


					
						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Inicial </label>
									<input type="date" class="form-control form-control-sm" name="dataInicial" id="dtInicial-log" value="1980-01-01">
								</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Final</label>
									<input type="date" class="form-control form-control-sm"  name="dataFinal" id="dtFinal-log" value="<?php echo $data_atual ?>">
								</div>
						</div>

						
					</div>

										
				</div>
			
			<small><div align="center" id="msg-config"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-config">Fechar</button>
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
		</form>
	</div>
</div>
</div>








<div class="modal fade" id="modalRelTransfMembros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><small>Relatório de Transferência <small><small>(
										<a href="#" class="text-primary" onclick="datas('1980-01-01', 'tudo-tra', 'tra')">
											<span id="tudo-tra">Tudo</span>
										</a> / 
									<a href="#" class="text-dark" onclick="datas('<?php echo $data_atual ?>', 'hoje-tra', 'tra')">
											<span id="hoje-tra">Hoje</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_mes ?>', 'mes-tra', 'tra')">
											<span id="mes-tra">Mês</span>
										</a> /
										<a href="#" class="text-dark" onclick="datas('<?php echo $data_ano ?>', 'ano-tra', 'tra')">
											<span id="ano-tra">Ano</span>
										</a> 
									)</small></small></small></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="../rel/relTransferencia.php" target="_blank">
				<div class="modal-body">
					<div class="row">

					

					
						<div class="col-md-6">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Inicial </label>
									<input type="date" class="form-control form-control-sm" name="dataInicial" id="dtInicial-tra" value="1980-01-01">
								</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data Final</label>
									<input type="date" class="form-control form-control-sm"  name="dataFinal" id="dtFinal-tra" value="<?php echo $data_atual ?>">
								</div>
						</div>

						
					</div>

										
				</div>
			
			<small><div align="center" id="msg-transf"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-transf">Fechar</button>
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
		</form>
	</div>
</div>
</div>






<div class="modal fade" id="modalRelFechamentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><small>Relatório de Fechamentos</small></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="../rel/relFechamentos.php" target="_blank">
				<div class="modal-body">
					<div class="row">					

					
						<div class="col-md-12">
							<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data do Mês Fechamento </label>
									<input type="date" class="form-control form-control-sm" name="dataInicial" value="<?php echo date('Y-m-d') ?>">
								</div>
						</div>

					

						
					</div>

										
				</div>
			
			<small><div align="center" id="msg-transf"></div></small>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-transf">Fechar</button>
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
		</form>
	</div>
</div>
</div>




<!-- Mascaras JS -->
<script type="text/javascript" src="../js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 


<script type="text/javascript">
	$("#form-usu").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-dados.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-usu').text('');
				$('#msg-usu').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					$('#btn-fechar-usu').click();
					window.location="index.php";

				} else {

					$('#msg-usu').addClass('text-danger')
					$('#msg-usu').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>


<script type="text/javascript">
	$("#form-config").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-config.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-config').text('');
				$('#msg-config').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {

					$('#btn-fechar-config').click();
					window.location="index.php";

				} else {

					$('#msg-config').addClass('text-danger')
					$('#msg-config').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>




<script type="text/javascript">
	function datas(data, id, campo){
		var data_atual = "<?=$data_atual?>";
		$('#dtInicial-'+campo).val(data);
		$('#dtFinal-pat'+campo).val(data_atual);

		document.getElementById('hoje-'+campo).style.color = "#000";
		document.getElementById('mes-'+campo).style.color = "#000";
		document.getElementById(id).style.color = "blue";	
		document.getElementById('tudo-'+campo).style.color = "#000";
		document.getElementById('ano-'+campo).style.color = "#000";
		document.getElementById(id).style.color = "blue";		
	}
</script>


<script type="text/javascript">
	$(function(){
		$("#movim").change(function(){
			if($("#movim").val() != ""){
				document.getElementById("tip").options.selectedIndex = 0;
				$('#tip').val($('#tip').val()).change();
				document.getElementById('tip').disabled = true;
			}else{
				document.getElementById('tip').disabled = false;
			}
		})
	})
</script>





		
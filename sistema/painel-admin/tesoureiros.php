<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'tesoureiros';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Tesoureiro</a>
</div>

<div class="tabela bg-light">
	<?php 

	$query = $pdo->query("SELECT * FROM $pagina order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){

		?>

		<table id="example" class="table table-striped table-light table-hover my-4 my-4" style="width:100%">
			<thead>			
				<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th class="esc">Email</th>
					<th class="esc">Telefone</th>
					<th class="esc">Igreja</th>
					<th class="esc">Foto</th>
					
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 

						$nome = $res[$i]['nome'];
					$cpf = $res[$i]['cpf'];
					$email = $res[$i]['email'];
					$telefone = $res[$i]['telefone'];
					$endereco = $res[$i]['endereco'];
					$foto = $res[$i]['foto'];
					$igreja = $res[$i]['igreja'];
					$id = $res[$i]['id'];


					$query_con = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_ig = $res_con[0]['nome'];
					}else{
						$nome_ig = $nome_igreja_sistema;
					}

					?>			
					<tr>
						<td><?php echo $nome ?></td>
						<td><?php echo $cpf ?></td>
						<td class="esc"><?php echo $email ?></td>
						<td class="esc"><?php echo $telefone ?></td>
						<td class="esc"><?php echo $nome_ig ?></td>
						<td class="esc"><img src="../img/membros/<?php echo $foto ?>" width="30px"></td>
						
						<td>
							<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $nome ?>', '<?php echo $cpf ?>', '<?php echo $email ?>', '<?php echo $telefone ?>', '<?php echo $endereco ?>', '<?php echo $foto ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
							<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $nome ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
							<a href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $cpf ?>', '<?php echo $email ?>', '<?php echo $telefone ?>', '<?php echo $endereco ?>', '<?php echo $foto ?>')" title="Ver Dados">	<i class="bi bi-info-square-fill text-primary"></i> </a>
						</td>
					</tr>	
				<?php } ?>	
			</tbody>
		</table>
	<?php }else{
		echo 'Não Existem Dados Cadastrados';
	} ?>
</div>


<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tituloModal"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o Nome" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="Insira o CPF"  required>
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Insira o Email" required>
							</div>
						</div>

					</div>
					<div class="row">
						

						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Insira o Telefone" required>
							</div>
						</div>

						<div class="col-md-9">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Insira o Endereço">
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Foto</label>
								<input type="file" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
							</div>
						</div>
						<div class="col-md-6">
						<div id="divImg" class="mt-4">
								<img src="../img/membros/sem-foto.jpg"  width="130px" id="target">									
							</div>
						</div>
					</div>

					<input type="hidden" id="id" name="id">

				</div>
				<small><div align="center" id="mensagem"></div></small>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-excluir" method="post">
				<div class="modal-body">

					Deseja Realmente excluir este Registro: <span id="nome-excluido"></span>?

					<small><div id="mensagem-excluir" align="center"></div></small>

					<input type="hidden" class="form-control" name="id-excluir"  id="id-excluir">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
					<button type="submit" class="btn btn-danger">Excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>



<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nome : <span id="nome-dados"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<div class="modal-body">

				<span class=""><b>CPF:</b> <span id="cpf-dados"></span></span>
				<hr style="margin:4px">

				<span class=""><b>Email:</b> <span id="email-dados"></span></span>
				<hr style="margin:4px">

				<span class=""><b>Telefone:</b> <span id="telefone-dados"></span></span>
				<hr style="margin:4px">

				<span class=""><b>Endereço:</b> <span id="endereco-dados"></span></span>
				<hr style="margin:4px">

				<span class=""><img src="" id="foto-dados" width="200px"></span>
				<hr style="margin:4px">


			</div>

		</form>
	</div>
</div>
</div>



<script type="text/javascript">var pag = "<?=$pagina?>"</script>
<script src="../js/ajax.js"></script>


<script type="text/javascript">

	function editar(id, nome, cpf, email, telefone, endereco, foto){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#cpf').val(cpf);
		$('#telefone').val(telefone);
		$('#endereco').val(endereco);
		$('#target').attr('src', '../img/membros/' + foto);
		
		$('#tituloModal').text('Editar Registro');
		var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
		myModal.show();
		$('#mensagem').text('');
	}



	function dados(nome, cpf, email, telefone, endereco, foto){

		$('#nome-dados').text(nome);
		$('#cpf-dados').text(cpf);
		$('#email-dados').text(email);
		$('#telefone-dados').text(telefone);
		$('#endereco-dados').text(endereco);
		$('#foto-dados').attr('src', '../img/membros/' + foto);
		
		var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {		});
		myModal.show();
		$('#mensagem').text('');
	}

	function limpar(){
		$('#id').val('');
		$('#nome').val('');		
		$('#email').val('');
		$('#cpf').val('');
		$('#telefone').val('');
		$('#endereco').val('');
		
		$('#target').attr('src', '../img/membros/sem-foto.jpg');
	}

</script>
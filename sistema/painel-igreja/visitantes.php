<?php 
require_once("../conexao.php");
require_once("verificar.php");
require_once("deslogar-tesoureiro.php");

$pagina = 'visitantes';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Visitante</a>
</div>

<div class="tabela bg-light">
	<?php 

	$query = $pdo->query("SELECT * FROM $pagina where igreja = '$id_igreja' order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){

		?>

		<table id="example" class="table table-striped table-light table-hover my-4 my-4" style="width:100%">
			<thead>			
				<tr>
					<th>Nome</th>
					<th class="">Telefone</th>
					<th class="esc">Email</th>	
					<th class="esc">Desejo</th>	
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 

					$nome = $res[$i]['nome'];	
					$telefone = $res[$i]['telefone'];
					$email = $res[$i]['email'];
					$endereco = $res[$i]['endereco'];
					$desejo = $res[$i]['desejo'];
					$igreja = $res[$i]['igreja'];
					$id = $res[$i]['id'];

				
				
					?>			
					<tr>
						<td class=""><?php echo $nome ?></td>
						<td class=""><?php echo $telefone ?></td>
						<td class="esc"><?php echo $email ?></td>
						<td class="esc"><?php echo $desejo ?></td>
						<td>

							<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $nome ?>', '<?php echo $telefone ?>', '<?php echo $email ?>', '<?php echo $endereco ?>', '<?php echo $desejo ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>

							<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $nome ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>


							<a href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $telefone ?>', '<?php echo $email ?>', '<?php echo $endereco ?>', '<?php echo $desejo ?>')" title="Ver Dados">	<i class="bi bi-info-square-fill text-primary"></i> </a>

							

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
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tituloModal"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form" method="post">
					<div class="modal-body">

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Nome</label>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Visitante" required>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Telefone</label>
							<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
						</div>

						<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Email</label>
									<input type="email" class="form-control" id="email" name="email" >
								</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Endereço</label>
							<input type="text" maxlength="100" class="form-control" id="endereco" name="endereco" placeholder="Rua X Numero 20 Bairro XX" >
						</div>


						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Desejo</label>
							<input type="text" maxlength="255" class="form-control" id="desejo" name="desejo" placeholder="Receber Visita, Receber Oração, etc" >
						</div>

					

						<input type="hidden" id="id" name="id">
						<input type="hidden" id="igreja" name="igreja" value="<?php echo $id_igreja ?>">

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

				

					<span class=""><b>Email:</b> <span id="email-dados"></span></span>
					<hr style="margin:4px">

					<span class=""><b>Telefone:</b> <span id="telefone-dados"></span></span>
					<hr style="margin:4px">

					<span class=""><b>Endereço:</b> <span id="endereco-dados"></span></span>
					<hr style="margin:4px">				

					<span class=""><b>Desejo:</b> <span id="desejo-dados"></span></span>
					<hr style="margin:4px">

					

				</div>

			</form>
		</div>
	</div>
</div>




	<script type="text/javascript">var pag = "<?=$pagina?>"</script>
	<script src="../js/ajax.js"></script>


	<script type="text/javascript">

		function editar(id, nome, telefone, email, endereco, desejo){
			$('#id').val(id);
			$('#nome').val(nome);
			$('#telefone').val(telefone);
			$('#email').val(email);
			$('#endereco').val(endereco);
			$('#desejo').val(desejo);

			$('#tituloModal').text('Editar Registro');
			var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
			myModal.show();
			$('#mensagem').text('');
		}





		function limpar(){
			
			$('#id').val('');
			$('#nome').val('');
			$('#telefone').val('');
			$('#endereco').val('');
			$('#email').val('');	
			$('#desejo').val('');		

		}


		function dados(nome, telefone, email, endereco, desejo){

		$('#nome-dados').text(nome);		
		$('#email-dados').text(email);
		$('#telefone-dados').text(telefone);
		$('#endereco-dados').text(endereco);
		$('#desejo-dados').text(desejo);
		
		
		var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {		});
		myModal.show();
		$('#mensagem').text('');
	}
	</script>
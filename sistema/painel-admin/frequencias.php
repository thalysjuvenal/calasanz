<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'frequencias';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Nova Frequência</a>
</div>

<div class="tabela bg-light">
	<?php 

	$query = $pdo->query("SELECT * FROM $pagina order by id asc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){

		?>

		<table id="example" class="table table-striped table-light table-hover my-4 my-4" style="width:100%">
			<thead>			
				<tr>
					<th>Frequência</th>
					<th>Dias</th>			
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 

						$frequencia = $res[$i]['frequencia'];
					$dias = $res[$i]['dias'];
					
					$id = $res[$i]['id'];
					?>			
					<tr>
						<td><?php echo $frequencia ?></td>
						<td><?php echo $dias ?></td>

						<td>
							<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $frequencia ?>', '<?php echo $dias ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>
							<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $frequencia ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>

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

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Frequência</label>
								<input type="text" class="form-control" id="frequencia" name="frequencia" placeholder="Insira a Frequência" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Dias</label>
								<input type="number" class="form-control" id="dias" name="dias" placeholder="Dias" required>
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



<script type="text/javascript">var pag = "<?=$pagina?>"</script>
<script src="../js/ajax.js"></script>


<script type="text/javascript">

	function editar(id, frequencia, dias){
		$('#id').val(id);
		$('#frequencia').val(frequencia);
		$('#dias').val(dias);

		$('#tituloModal').text('Editar Registro');
		var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
		myModal.show();
		$('#mensagem').text('');
	}



	

	function limpar(){
		$('#id').val('');
		$('#frequencia').val('');	
		$('#dias').val('');		
		
	}

</script>
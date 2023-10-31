<?php 
require_once("../conexao.php");
require_once("verificar.php");
require_once("deslogar-tesoureiro.php");

$pagina = 'versiculos';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Versículo</a>
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
					<th>Versículo</th>
					<th class="">Capítulo</th>
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 

					$versiculo = $res[$i]['versiculo'];	
					$capitulo = $res[$i]['capitulo'];
					
					$igreja = $res[$i]['igreja'];
					$id = $res[$i]['id'];


									
					?>			
					<tr>
						<td class=""><?php echo $versiculo ?></td>
						<td class=""><?php echo $capitulo ?></td>
						
						<td>

							<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $versiculo ?>', '<?php echo $capitulo ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>

							<a href="#" onclick="excluir('<?php echo $id ?>' , '')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>

				
							

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
							<label for="exampleFormControlInput1" class="form-label">Versículo</label>
							<textarea class="form-control" id="versiculo" name="versiculo" maxlength="1000" style="height:200px" required></textarea>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Capítulo</label>
							<input type="text" class="form-control" id="capitulo" name="capitulo" placeholder="Josue 1:9" required>
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





	<script type="text/javascript">var pag = "<?=$pagina?>"</script>
	<script src="../js/ajax.js"></script>


	<script type="text/javascript">

		function editar(id, versiculo, capitulo){
			$('#id').val(id);
			$('#versiculo').val(versiculo);
			$('#capitulo').val(capitulo);
			
			$('#tituloModal').text('Editar Registro');
			var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
			myModal.show();
			$('#mensagem').text('');
		}





		function limpar(){
			
			$('#id').val('');
			$('#versiculo').val('');
			$('#capitulo').val('');
		

		}


	</script>
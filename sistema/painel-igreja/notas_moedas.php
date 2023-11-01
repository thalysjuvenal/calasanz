<?php
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'notas_moedas';
require_once("deslogar-secretario.php");
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Inserir quantidades</a>
</div>

<div class="tabela bg-light">
	<?php

	$query = $pdo->query("SELECT * FROM $pagina where igreja = '$id_igreja' order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if ($total_reg > 0) {

		?>

		<table id="example" class="table table-striped table-light table-hover my-4 my-4" style="width:100%">
			<thead>
				<tr>
					<th>Valor</th>
					<th>Quantidade</th>
					<th>Cédula / Moeda</th>
					<th>Dízimo / Oferta</th>
					<th class="esc">Data</th>
					<th class="esc">Tesoureiro</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < $total_reg; $i++) {
					foreach ($res[$i] as $key => $value) {
					}

					$valor = $res[$i]['valortotal'];
					$quantidade = $res[$i]['quantidade'];
					$cedula_moeda = $res[$i]['valorunitario'];
					$dizimo_oferta = $res[$i]['tipoinfo'];
					$Data = $res[$i]['Data'];
					$usuario = $res[$i]['usuario'];

					$id = $res[$i]['id'];

					$dataF = implode('/', array_reverse(explode('-', $Data)));
					$valorF = number_format($valor, 2, ',', '.');

					$query_con = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if (count($res_con) > 0) {
						$usuario_cad = $res_con[0]['nome'];
						$nivel_usuario = $res_con[0]['nivel'];
					} else {
						$usuario_cad = '';
						$nivel_usuario = '';
					}


					?>
					<tr>
						<td>R$
							<?php echo $valorF ?>
						</td>
						<td class="esc">
							<?php echo $quantidade ?>
						</td>
						<td class="">
							<?php echo $cedula_moeda ?>
						</td>
						<td class="">
							<?php echo $dizimo_oferta ?>
						</td>
						<td class="">
							<?php echo $dataF ?>
						</td>
						<td class="esc">
							<?php echo $usuario_cad . ' <small>(' . $nivel_usuario . ')</small>' ?>
						</td>

						<td>

							<a href="#"
								onclick="editar('<?php echo $id ?>', '<?php echo $quantidade ?>', '<?php echo $cedula_moeda ?>', '<?php echo $dizimo_oferta ?>', '<?php echo $usuario ?>')"
								title="Editar Registro"> <i class="bi bi-pencil-square text-primary"></i> </a>

							<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $valor ?>')"
								title="Excluir Registro"> <i class="bi bi-trash text-danger"></i> </a>


						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else {
		echo 'Não Existem Dados Cadastrados';
	} ?>
</div>


<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tituloModal"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form" method="post">
				<div class="modal-body">

					<div class="row">
						<!--<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor </label>
								<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor da Oferta" required>
							</div>
						</div>-->
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Data </label>
								<input type="date" class="form-control" id="data" name="data" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Quantidade </label>
								<input type="number" class="form-control" id="quantidade" name="quantidade"
									placeholder="Quantidade" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Cédula/Moeda</label>
								<select name="valor_unitario" class="form-select" required>
									<option value="0.05">R$ 0.05</option>
									<option value="0.10">R$ 0.10</option>
									<option value="0.25">R$ 0.25</option>
									<option value="0.50">R$ 0.50</option>
									<option value="1.00">R$ 1.00</option>
									<option value="2.00">R$ 2.00</option>
									<option value="5.00">R$ 5.00</option>
									<option value="10.00">R$ 10.00</option>
									<option value="20.00">R$ 20.00</option>
									<option value="50.00">R$ 50.00</option>
									<option value="100.00">R$ 100.00</option>
									<option value="200.00">R$ 200.00</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Dízimo/Oferta</label>
								<select name="dizimo_oferta" class="form-select" required>
									<option value="Dízimo">Dízimo</option>
									<option value="Oferta">Oferta</option>
								</select>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Membro</label>
						<select class="form-control sel2" id="membro" name="membro" style="width:100%;">
							<option value="0">Selecionar Membro</option>
							<?php
							$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' order by id asc");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$total_reg = count($res);
							if ($total_reg > 0) {
								for ($i = 0; $i < $total_reg; $i++) {
									foreach ($res[$i] as $key => $value) {
									}
									$nome_reg = $res[$i]['nome'];
									$cargo = $res[$i]['cargo'];
									$id_reg = $res[$i]['id'];
									$query_con = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
									$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
									$nome_cargo = $res_con[0]['nome'];
									?>
									<option value="<?php echo $id_reg ?>">
										<?php echo $nome_reg . ' - ' . $nome_cargo ?>
									</option>
								<?php }
							} ?>
						</select>
					</div>

					<input type="hidden" id="id" name="id">
					<input type="hidden" id="igreja" name="igreja" value="<?php echo $id_igreja ?>">

				</div>
				<small>
					<div align="center" id="mensagem"></div>
				</small>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
						id="btn-fechar">Fechar</button>
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

					<small>
						<div id="mensagem-excluir" align="center"></div>
					</small>

					<input type="hidden" class="form-control" name="id-excluir" id="id-excluir">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
						id="btn-fechar-excluir">Fechar</button>
					<button type="submit" class="btn btn-danger">Excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?= $pagina ?>"</script>
<script src="../js/ajax.js"></script>


<script type="text/javascript">

	function editar(id, membro, valor, data) {
		$('#id').val(id);
		$('#membro').val(membro).change();;
		$('#valor').val(valor);
		$('#data').val(data);

		$('#tituloModal').text('Editar Registro');
		var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {});
		myModal.show();
		$('#mensagem').text('');
	}





	function limpar() {
		var data = "<?= $data_atual ?>"

		$('#id').val('');
		$('#data').val(data);
		$('#valor').val('');

		document.getElementById("membro").options.selectedIndex = 0;
		$('#membro').val($('#membro').val()).change();



	}

</script>




<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	$(document).ready(function () {
		$('.sel2').select2({
			//placeholder: 'Selecione um Cliente',
			dropdownParent: $('#modalForm')
		});
	});
</script>

<style type="text/css">
	.select2-selection__rendered {
		line-height: 36px !important;
		font-size: 16px !important;
		color: #666666 !important;

	}

	.select2-selection {
		height: 36px !important;
		font-size: 16px !important;
		color: #666666 !important;

	}
</style>
<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'informativos';

?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Culto</a>
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
					<th>Data</th>
					<th>Preletor</th>
					<th class="esc">Evento</th>
					<th class="esc">Horário</th>
					<th class="esc">Pastor Responsável</th>					
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 
						$id = $res[$i]['id'];
						$preletor = $res[$i]['preletor'];
					$data = $res[$i]['data'];
					$texto_base = $res[$i]['texto_base'];
					$tema = $res[$i]['tema'];
					$evento = $res[$i]['evento'];
					$horario = $res[$i]['horario'];
					
					$pastor_responsavel = $res[$i]['pastor_responsavel'];
					$pastores = $res[$i]['pastores'];
					$lider_louvor = $res[$i]['lider_louvor'];
					$obreiros = $res[$i]['obreiros'];
					$apoio = $res[$i]['apoio'];
					$abertura = $res[$i]['abertura'];
					$recado = $res[$i]['recado'];

					$oferta = $res[$i]['oferta'];
					$recepcao = $res[$i]['recepcao'];
					$bercario = $res[$i]['bercario'];
					$escolinha = $res[$i]['escolinha'];
					$membros = $res[$i]['membros'];
					$visitantes = $res[$i]['visitantes'];
					$conversoes = $res[$i]['conversoes'];
					$total_ofertas = $res[$i]['total_ofertas'];
					$total_dizimos = $res[$i]['total_dizimos'];

					$obs = $res[$i]['obs'];

					$dataF = implode('/', array_reverse(explode('-', $data)));

					$query_con = $pdo->query("SELECT * FROM pastores where id = '$pastor_responsavel'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_pastor_resp = $res_con[0]['nome'];
					}else{
						$nome_pastor_resp = '';
					}
					?>			
					<tr>
						<td><?php echo $dataF ?></td>
						<td><?php echo $preletor ?></td>
						<td class="esc"><?php echo $evento ?></td>
						<td class="esc"><?php echo $horario ?></td>
						<td class="esc"><?php echo $nome_pastor_resp ?></td>
						
						<td>
							<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $preletor ?>', '<?php echo $data ?>', '<?php echo $texto_base ?>', '<?php echo $tema ?>', '<?php echo $evento ?>', '<?php echo $horario ?>', '<?php echo $obs ?>', '<?php echo $pastor_responsavel ?>', '<?php echo $pastores ?>', '<?php echo $lider_louvor ?>', '<?php echo $obreiros ?>', '<?php echo $apoio ?>', '<?php echo $abertura ?>', '<?php echo $recado ?>', '<?php echo $oferta ?>', '<?php echo $recepcao ?>', '<?php echo $bercario ?>', '<?php echo $escolinha ?>', '<?php echo $membros ?>', '<?php echo $visitantes ?>', '<?php echo $conversoes ?>', '<?php echo $total_ofertas ?>', '<?php echo $total_dizimos ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>

							<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $tema ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>

							<a href="../rel/relFichaCulto.php?id=<?php echo $id ?>" target="_blank" title="Gerar PDF">	<i class="bi bi-file-pdf"></i> </a>
							
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
								<label for="exampleFormControlInput1" class="form-label">Preletor</label>
								<input type="text" class="form-control" id="preletor" name="preletor" placeholder="Nome do Preletor / Pregador" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Data</label>
								<input type="date" class="form-control" id="data" name="data"  required>
							</div>
						</div>

						<div class="col-md-5">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Texto Base</label>
								<input maxlength="255" type="text" class="form-control" id="texto_base" name="texto_base" placeholder="Insira o Texto Base" required>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Tema</label>
								<input maxlength="255" type="text" class="form-control" id="tema" name="tema" placeholder="Tema do Culto" required>
							</div>
						</div>
					</div>

					<div class="row">
						

						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Evento</label>
								<input type="text" class="form-control" id="evento" name="evento" placeholder="Culto de Domingo" required>
							</div>
						</div>

						<div class="col-md-2">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Horário</label>
								<input type="time" class="form-control" id="horario" name="horario">
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Pastor Responsável</label>
								<select class="form-control sel2" id="pastor_responsavel" name="pastor_responsavel" style="width:100%;" required>										
										<?php 
										$query = $pdo->query("SELECT * FROM pastores where igreja = '$id_igreja' order by id asc");
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


					</div>



					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Demais Pastores</label>
								<input type="text" class="form-control" id="pastores" name="pastores" placeholder="Pastor Marcos / Pastor Paulo...">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Líder Louvor</label>
								<input type="text" class="form-control" id="lider_louvor" name="lider_louvor">
							</div>
						</div>


					</div>



					<div class="row">
						<div class="col-md-7">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Obreiros</label>
								<input type="text" class="form-control" id="obreiros" name="obreiros" placeholder="Marcos / Paulo...">
							</div>
						</div>
						<div class="col-md-5">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Apoios</label>
								<input type="text" class="form-control" id="apoio" name="apoio" placeholder="Sandro / Márcia">
							</div>
						</div>


					</div>




					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Abertura</label>
								<input type="text" class="form-control" id="abertura" name="abertura" placeholder="Responsável pela Abertura">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Recados</label>
								<input type="text" class="form-control" id="recado" name="recado" placeholder="Responsável pelos Recados">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Ofertas</label>
								<input type="text" class="form-control" id="oferta" name="oferta" placeholder="Responsável pelas Ofertas">
							</div>
						</div>


					</div>




					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Recepção</label>
								<input type="text" class="form-control" id="recepcao" name="recepcao" placeholder="Responsável pela Recepção">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Berçário</label>
								<input type="text" class="form-control" id="bercario" name="bercario" placeholder="Responsável pelo Berçário">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Escolinha</label>
								<input type="text" class="form-control" id="escolinha" name="escolinha" placeholder="Responsável pela Escolinha">
							</div>
						</div>


					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Observações</label>
								<input maxlength="1000" type="text" class="form-control" id="obs" name="obs" placeholder="">
							</div>
						</div>
					</div>

					<hr>


					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Total Membros</label>
								<input type="number" class="form-control" id="membros" name="membros" placeholder="Membros Presentes">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Total Visitantes</label>
								<input type="number" class="form-control" id="visitantes" name="visitantes" placeholder="Visitantes Presentes">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Total de Conversões</label>
								<input type="number" class="form-control" id="conversoes" name="conversoes" placeholder="Total de Conversões">
							</div>
						</div>


					</div>




						<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Total Ofertas</label>
								<input type="text" class="form-control" id="total_ofertas" name="total_ofertas" placeholder="Total de Ofertas">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Total Dízimos</label>
								<input type="text" class="form-control" id="total_dizimos" name="total_dizimos" placeholder="Total de Dízimos">
							</div>
						</div>
						

					</div>
					

					<input type="hidden" id="id" name="id">
					<input type="hidden" id="id_igreja" name="id_igreja" value="<?php echo $id_igreja ?>">

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

	function editar(id, preletor, data, texto_base, tema, evento, horario, obs, pastor_responsavel, pastores, lider_louvor, obreiros, apoio, abertura, recado, oferta, recepcao, bercario, escolinha, membros, visitantes, conversoes, total_ofertas, total_dizimos){
		$('#id').val(id);
		$('#preletor').val(preletor);
		$('#data').val(data);
		$('#texto_base').val(texto_base);
		$('#tema').val(tema);
		$('#evento').val(evento);

		$('#horario').val(horario);
		$('#obs').val(obs);
		$('#pastor_responsavel').val(pastor_responsavel).change();
		$('#pastores').val(pastores);
		$('#lider_louvor').val(lider_louvor);

			$('#obreiros').val(obreiros);
		$('#apoio').val(apoio);
		$('#abertura').val(abertura);
		$('#recado').val(recado);
		$('#oferta').val(oferta);

		$('#recepcao').val(recepcao);
		$('#bercario').val(bercario);
		$('#escolinha').val(escolinha);
		$('#membros').val(membros);
		$('#visitantes').val(visitantes);

		$('#conversoes').val(conversoes);
		$('#total_ofertas').val(total_ofertas);
		$('#total_dizimos').val(total_dizimos);
		
				
		$('#tituloModal').text('Editar Registro');
		var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
		myModal.show();
		$('#mensagem').text('');
	}




	function limpar(){
		$('#id').val('');
		
		$('#preletor').val('');
		$('#data').val('');
		$('#texto_base').val('');
		$('#tema').val('');
		$('#evento').val('');

		$('#horario').val('');
		$('#obs').val('');
		$('#pastor_responsavel').val('');
		$('#pastores').val('');
		$('#lider_louvor').val('');

			$('#obreiros').val('');
		$('#apoio').val('');
		$('#abertura').val('');
		$('#recado').val('');
		$('#oferta').val('');

		$('#recepcao').val('');
		$('#bercario').val('');
		$('#escolinha').val('');
		$('#membros').val('');
		$('#visitantes').val('');

		$('#conversoes').val('');
		$('#total_ofertas').val('');
		$('#total_dizimos').val('');
	}

</script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		<script>
			$(document).ready(function() {
				$('.sel2').select2({
			//placeholder: 'Selecione um Cliente',
			dropdownParent: $('#modalForm')
		});
			});
		</script>

		<style type="text/css">
			.select2-selection__rendered {
				line-height: 36px !important;
				font-size:16px !important;
				color:#666666 !important;

			}

			.select2-selection {
				height: 36px !important;
				font-size:16px !important;
				color:#666666 !important;

			}
		</style>  
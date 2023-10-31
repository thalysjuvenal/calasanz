<?php 
require_once("../conexao.php");
require_once("verificar.php");
require_once("deslogar-secretario.php");
$pagina = 'fechamentos';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Fechamento</a>
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
					<th>Mês</th>
					<th class="">Data</th>
					<th class="esc">Usuário</th>	
					<th class="esc">Saídas</th>
					<th class="esc">Entradas</th>
					<th class="esc">Saldo</th>	
					<th class="esc">Prebenda</th>	
					<th class="esc">Saldo Final</th>	
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 

					$data_fec = $res[$i]['data_fec'];	
					$data = $res[$i]['data'];
					$saidas = $res[$i]['saidas'];
					$usuario = $res[$i]['usuario'];
					$entradas = $res[$i]['entradas'];
					$saldo = $res[$i]['saldo'];
					$prebenda = $res[$i]['prebenda'];
					$saldo_final = $res[$i]['saldo_final'];
									
					$id = $res[$i]['id'];

					$dataF = implode('/', array_reverse(explode('-', $data)));
					$entradasF = number_format($entradas, 2, ',', '.');
					$saidasF = number_format($saidas, 2, ',', '.');
					$saldoF = number_format($saldo, 2, ',', '.');
					$prebendaF = number_format($prebenda, 2, ',', '.');
					$saldo_finalF = number_format($saldo_final, 2, ',', '.');

					$separar = explode("-", $data_fec);
					$mes = $separar[1];
					$ano = $separar[0];
				
					$query_con = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$usuario_cad = $res_con[0]['nome'];
						
					}else{
						$usuario_cad = '';
						
					}

					$mesF = '';
					if($mes == '01'){
						$mesF = "Janeiro";
					}

					if($mes == '02'){
						$mesF = "Fevereiro";
					}

					if($mes == '03'){
						$mesF = "Março";
					}

					if($mes == '04'){
						$mesF = "Abril";
					}

					if($mes == '05'){
						$mesF = "Maio";
					}

					if($mes == '06'){
						$mesF = "Junho";
					}

					if($mes == '07'){
						$mesF = "Julho";
					}

					if($mes == '08'){
						$mesF = "Agosto";
					}

					if($mes == '09'){
						$mesF = "Setembro";
					}

					if($mes == '10'){
						$mesF = "Outubro";
					}

					if($mes == '11'){
						$mesF = "Novembro";
					}

					if($mes == '12'){
						$mesF = "Dezembro";
					}

					
					?>			
					<tr>
						<td><?php echo $mesF ?> / <?php echo $ano ?></td>
						<td class="esc"><?php echo $dataF ?></td>
						<td class="esc"><?php echo $usuario_cad ?></td>						
						<td class="esc">R$ <?php echo $saidasF ?></td>
						<td class="esc">R$ <?php echo $entradasF ?></td>
						<td class="esc">R$ <?php echo $saldoF ?></td>
						<td class="esc">R$ <?php echo $prebendaF ?></td>
						<td class="esc">R$ <?php echo $saldo_finalF ?></td>
						<td>						

							<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $mesF ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>

							
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
						<div class="col-md-12">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Qualquer Data do Mês Fechamento </label>
								<input type="date"  class="form-control" id="data_fec" name="data_fec" required value="<?php echo date('Y-m-d') ?>">
							</div>
						</div>
						
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

		

		function limpar(){
			var data = "<?=$data_atual?>"

			$('#id').val('');
			$('#data_fec').val(data);
			
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
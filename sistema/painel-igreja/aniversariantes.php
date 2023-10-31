<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'aniversariantes';
$dataMes = Date('m');
$dataDia = Date('d');
	
if(@$_GET['filtrar'] == "dia"){
	$classe_dia = 'text-primary';
	$classe_mes = 'text-dark';

	$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and month(data_nasc) = '$dataMes' and day(data_nasc) = '$dataDia' order by data_nasc asc, id desc");

	$query_pastores = $pdo->query("SELECT * FROM pastores where igreja = '$id_igreja' and month(data_nasc) = '$dataMes' and day(data_nasc) = '$dataDia' order by data_nasc asc, id desc");
	
}else{
	$classe_mes = 'text-primary';
	$classe_dia = 'text-dark';

	$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and month(data_nasc) = '$dataMes' order by data_nasc asc, id desc");

	$query_pastores = $pdo->query("SELECT * FROM pastores where igreja = '$id_igreja' and month(data_nasc) = '$dataMes' order by data_nasc asc, id desc");
	
}

?>

<div class="col-md-12 my-3">
	<small>
		<a href="index.php?pag=aniversariantes&filtrar=mes" class="<?php echo $classe_mes ?>">Aniversáriantes do Mês</a> / 
		<a href="index.php?pag=aniversariantes&filtrar=dia" class="<?php echo $classe_dia ?>">Aniversáriantes do Dia</a>
	</small>
</div>

<div class="tabela bg-light">
	<?php 
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);

	$res_pastores = $query_pastores->fetchAll(PDO::FETCH_ASSOC);
	$total_reg_pastores = count($res_pastores);
	if($total_reg > 0 || $total_reg_pastores > 0){

		?>

		<table id="example" class="table table-striped table-light table-hover my-4 my-4" style="width:100%">
			<thead>			
				<tr>
					<th>Nome</th>
					<th>Data Nascimento</th>
					<th class="esc">Email</th>
					<th class="esc">Telefone</th>
					<th class="esc">Cargo</th>
					<th class="esc">Foto</th>
					<th class="d-none">Ativo</th>
					
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
					$data_nasc = $res[$i]['data_nasc'];
					$data_cad = $res[$i]['data_cad'];
					$obs = $res[$i]['obs'];
					$igreja = $res[$i]['igreja'];
					$cargo = $res[$i]['cargo'];
					$data_bat = $res[$i]['data_batismo'];
					$igreja = $res[$i]['igreja'];
					$ativo = $res[$i]['ativo'];
					$id = $res[$i]['id'];
					$estado = $res[$i]['estado_civil'];

					if($obs != ""){
						$classe_obs = 'text-warning';
					}else{
						$classe_obs = 'text-secondary';
					}


					$query_con = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_ig = $res_con[0]['nome'];
					}else{
						$nome_ig = $nome_igreja_sistema;
					}

					$query_con = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_cargo = $res_con[0]['nome'];
					}else{
						$nome_cargo = '';
					}


					//retirar quebra de texto do obs
					$obs = str_replace(array("\n", "\r"), ' + ', $obs);

					$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
					$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
					$data_batF = implode('/', array_reverse(explode('-', $data_bat)));


					$dia_mes = Date('d');
					$partes = explode('-', $data_nasc);
					$dia = $partes[2];

					if($dia == $dia_mes){
						$classe_aniv = 'text-primary';
						$classe_whats = '';
					}else{
						$classe_aniv = '';
						$classe_whats = 'd-none';
					}

					?>			
					<tr class="<?php echo $classe_aniv ?>">
						<td><?php echo $nome ?></td>
						<td><?php echo $data_nascF ?></td>
						<td class="esc"><?php echo $email ?></td>
						<td class="esc"><?php echo $telefone ?></td>
						<td class="esc"><?php echo $nome_cargo ?></td>
						
						<td class="esc"><img src="../img/membros/<?php echo $foto ?>" width="30px"></td>

						<td class="d-none"><?php echo $tab ?></td>
						
						<td>
							<big>
							
							<a href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $cpf ?>', '<?php echo $email ?>', '<?php echo $telefone ?>', '<?php echo $endereco ?>', '<?php echo $foto ?>', '<?php echo $data_nascF ?>', '<?php echo $data_cadF ?>', '<?php echo $nome_ig ?>', '<?php echo $data_batF ?>', '<?php echo $nome_cargo ?>', '<?php echo $estado ?>')" title="Ver Dados">	<i class="bi bi-info-square-fill text-primary"></i> </a>


							<a class="<?php echo $classe_whats ?>" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone ?>&text=Ola <?php echo $nome ?>, nos da <?php echo $nome_ig ?> desejamos a você um feliz aniversário, que Deus te abençoe e te ilumine.." title="Enviar Felicitações">
							<i class="bi bi-whatsapp text-success"></i></a>

													</big>

						</td>
					</tr>	
				<?php } ?>	



				<?php 
				
				for($i=0; $i < $total_reg_pastores; $i++){
					foreach ($res_pastores[$i] as $key => $value){} 

						$nome = $res_pastores[$i]['nome'];
					$cpf = $res_pastores[$i]['cpf'];
					$email = $res_pastores[$i]['email'];
					$telefone = $res_pastores[$i]['telefone'];
					$endereco = $res_pastores[$i]['endereco'];
					$foto = $res_pastores[$i]['foto'];
					$data_nasc = $res_pastores[$i]['data_nasc'];
					$data_cad = $res_pastores[$i]['data_cad'];
					$obs = $res_pastores[$i]['obs'];
					$igreja = $res_pastores[$i]['igreja'];
					$id = $res_pastores[$i]['id'];

					if($obs != ""){
						$classe_obs = 'text-warning';
					}else{
						$classe_obs = 'text-secondary';
					}


					$query_con = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_ig = $res_con[0]['nome'];
					}else{
						$nome_ig = $nome_igreja_sistema;
					}

					
					//retirar quebra de texto do obs
					$obs = str_replace(array("\n", "\r"), ' + ', $obs);

					$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
					$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
					

					$dia_mes = Date('d');
					$partes = explode('-', $data_nasc);
					$dia = $partes[2];

					if($dia == $dia_mes){
						$classe_aniv = 'text-primary';
						$classe_whats = '';
					}else{
						$classe_aniv = '';
						$classe_whats = 'd-none';
					}

					?>			
					<tr class="<?php echo $classe_aniv ?>">
						<td><?php echo $nome ?></td>
						<td><?php echo $data_nascF ?></td>
						<td class="esc"><?php echo $email ?></td>
						<td class="esc"><?php echo $telefone ?></td>
						<td class="esc">Pastor</td>
						
						<td class="esc"><img src="../img/membros/<?php echo $foto ?>" width="30px"></td>

						<td class="d-none"><?php echo $tab ?></td>
						
						<td>
							<big>
							
							<a href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $cpf ?>', '<?php echo $email ?>', '<?php echo $telefone ?>', '<?php echo $endereco ?>', '<?php echo $foto ?>', '<?php echo $data_nascF ?>', '<?php echo $data_cadF ?>', '<?php echo $nome_ig ?>', 'Não Lançado', 'Pastor')" title="Ver Dados">	<i class="bi bi-info-square-fill text-primary"></i> </a>


							<a class="<?php echo $classe_whats ?>" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone ?>&text=Ola <?php echo $nome ?>, nos da <?php echo $nome_ig ?> desejamos a você um feliz aniversário, que Deus te abençoe e te ilumine.." title="Enviar Felicitações">
							<i class="bi bi-whatsapp text-success"></i></a>

													</big>

						</td>
					</tr>	
				<?php } ?>	
			</tbody>
		</table>
	<?php }else{
		echo 'Não Existem Membros e Pastores Aniversáriando Este Mês';
	} ?>
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

					<span class=""><b>Data de Cadastro:</b> <span id="cadastro-dados"></span></span>
					<hr style="margin:4px">

					<span class=""><b>Data de Nascimento:</b> <span id="nasc-dados"></span></span>
					<hr style="margin:4px">

					<span class=""><b>Igreja:</b> <span id="igreja-dados"></span></span>
					<hr style="margin:4px">

					<span class=""><b>Data de Batismo:</b> <span id="batismo-dados"></span></span>
					<hr style="margin:4px">

					<div class="row">
										<div class="col-md-6">
											<span class=""><b>Cargo:</b> <span id="membro-dados"></span></span>
											<hr style="margin:4px">
										</div>

										<div class="col-md-6">
											<span id="span-estado"><b>Estado Cívil:</b> <span id="estado-dados"></span></span>
											<hr style="margin:4px">
										</div>
									</div>

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


	function dados(nome, cpf, email, telefone, endereco, foto, data_nasc, data_cad, igreja, data_bat, cargo, estado){

		if(data_bat === '00/00/0000'){
			data_bat = 'Não Batizado!';
		}

		if(estado == ""){
			document.getElementById('span-estado').style.display = 'none';
		}

		$('#nome-dados').text(nome);
		$('#cpf-dados').text(cpf);
		$('#email-dados').text(email);
		$('#telefone-dados').text(telefone);
		$('#endereco-dados').text(endereco);
		$('#cadastro-dados').text(data_cad);
		$('#nasc-dados').text(data_nasc);
		$('#igreja-dados').text(igreja);
		$('#batismo-dados').text(data_bat);
		$('#membro-dados').text(cargo);
		$('#estado-dados').text(estado);
		$('#foto-dados').attr('src', '../img/membros/' + foto);
		
		
		var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {		});
		myModal.show();
		$('#mensagem').text('');
	}


	
</script>



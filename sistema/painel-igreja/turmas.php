<?php 
require_once("../conexao.php");
require_once("verificar.php");
require_once("deslogar-tesoureiro.php");
$pagina = 'turmas';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Nova Turma</a>
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
					<th class="">Dias</th>
					<th class="esc">Horário</th>
					<th class="esc">Ministrador</th>
					<th class="esc">Data Início</th>
					<th class="esc">Data Término</th>
					<th class="esc">Status</th>	
					<th>Ações</th>
				</tr>		
			</thead>
			<tbody>
				<?php 
				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){} 

						$nome = $res[$i]['nome'];	
					$dias = $res[$i]['dias'];
					$hora = $res[$i]['hora'];
					$local = $res[$i]['local'];
					$pastor = $res[$i]['pastor'];
					$coordenador = $res[$i]['coordenador'];
					$lider1 = $res[$i]['lider1'];
					$lider2 = $res[$i]['lider2'];
					$obs = $res[$i]['obs'];
					$igreja = $res[$i]['igreja'];
					$id = $res[$i]['id'];

					$data_inicio = $res[$i]['data_inicio'];
					$data_termino = $res[$i]['data_termino'];
					$status = $res[$i]['status'];


					//totalizar membros
					$query2 = $pdo->query("SELECT * FROM celulas_membros where igreja = '$id_igreja' and celula = '$id'");
					$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					$membros_celula = count($res2);


					if($obs != ""){
						$classe_obs = 'text-warning';
					}else{
						$classe_obs = 'text-secondary';
					}


					$query_con = $pdo->query("SELECT * FROM pastores where id = '$pastor'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_pastor = $res_con[0]['nome'];
					}else{
						$nome_pastor = 'Nenhum';
					}

					$query_con = $pdo->query("SELECT * FROM membros where id = '$coordenador'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_coordenador = $res_con[0]['nome'];
					}else{
						$nome_coordenador = 'Nenhum';
					}

					$query_con = $pdo->query("SELECT * FROM membros where id = '$lider1'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_lider1 = $res_con[0]['nome'];
					}else{
						$nome_lider1 = 'Nenhum';
					}


					$query_con = $pdo->query("SELECT * FROM membros where id = '$lider2'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_lider2 = $res_con[0]['nome'];
					}else{
						$nome_lider2 = 'Nenhum';
					}

					$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
					$data_terminoF = implode('/', array_reverse(explode('-', $data_termino)));

					$classe_status = '';
					if($status == 'Não Iniciada'){
						$classe_status = '#a60d08';
					}

					if($status == 'Andamento'){
						$classe_status = '#065b80';
					}

					if($status == 'Finalizada'){
						$classe_status = '#02360e';
					}

					
					
					?>			
					<tr>

						<td>
							<a style="color:#000; text-decoration: underline;" href="#" onclick="listar_andamento('<?php echo $id ?>' , '<?php echo $nome ?>')" title="Ver Andamento">	
							<?php echo $nome ?>
						</a>
						</td>
						<td class=""><?php echo $dias ?></td>
						
						<td class="esc"><?php echo $hora ?></td>
						
						<td class="esc"><?php echo $nome_coordenador ?></td>
						<td class="esc"><?php echo $data_inicioF ?></td>
						<td class="esc"><?php echo $data_terminoF ?></td>

						<td class="esc"><div style="background: <?php echo $classe_status ?>; color:#FFF; padding:3px; font-size: 12px; width:80px; text-align: center"><?php echo $status ?></div></td>

						<td>
							<big>
								<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $nome ?>', '<?php echo $dias ?>', '<?php echo $hora ?>', '<?php echo $local ?>', '<?php echo $pastor ?>', '<?php echo $coordenador ?>', '<?php echo $lider1 ?>', '<?php echo $lider2 ?>', '<?php echo $data_inicio ?>', '<?php echo $data_termino ?>', '<?php echo $status ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>

								<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $nome ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>

								<a href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $dias ?>', '<?php echo $hora ?>', '<?php echo $local ?>', '<?php echo $nome_pastor ?>', '<?php echo $nome_coordenador ?>', '<?php echo $nome_lider1 ?>', '<?php echo $nome_lider2 ?>', '<?php echo $obs ?>', '<?php echo $membros_celula ?>', '<?php echo $data_inicioF ?>', '<?php echo $data_terminoF ?>', '<?php echo $status ?>')" title="Ver Dados">	<i class="bi bi-info-square-fill text-primary"></i> </a>

								<a href="#" onclick="obs('<?php echo $id ?>','<?php echo $nome ?>', '<?php echo $obs ?>')" title="Observações">	<i class="bi bi-chat-right-text <?php echo $classe_obs ?>"></i> </a>

								<a href="#" onclick="addMembros('<?php echo $id ?>' , '<?php echo $nome ?>', '<?php echo $igreja ?>')" title="Adicionar Membros">	<i class="bi bi-plus-square-fill text-success"></i> </a>


								<a href="#" onclick="andamento('<?php echo $id ?>' , '<?php echo $nome ?>', '<?php echo $igreja ?>', '<?php echo $coordenador ?>', '<?php echo $status ?>')" title="Lançar Andamento">	<i class="bi bi-file-earmark-check text-primary"></i> </a>


								<a href="#" onclick="listar_andamento('<?php echo $id ?>' , '<?php echo $nome ?>')" title="Ver Andamento">	<i class="bi bi-eye text-success"></i> </a>

								<a href="../rel/relTurma.php?id=<?php echo $id ?>" title="Detalhamento Turma PDF" target="_blank">	<i class="bi bi-file-pdf text-danger"></i> </a>

							</big>

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
								<label for="exampleFormControlInput1" class="form-label">Nome </label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Turma" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Dias </label>
								<input type="text" class="form-control" id="dias" name="dias" placeholder="Segundas Feiras" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Horário </label>
								<input type="text" class="form-control" id="hora" name="hora" placeholder="Das 18:00 as 20:00" >
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Data Início </label>
								<input type="date" class="form-control" id="data_inicio" name="data_inicio">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Data Término </label>
								<input type="date" class="form-control" id="data_termino" name="data_termino">
							</div>
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Status Turma</label>
								<select class="form-control" name="status" id="status">
									<option value="Não Iniciada">Não Iniciada</option>
									<option value="Andamento">Andamento</option>
									<option value="Finalizada">Finalizada</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Local </label>
								<input type="text" class="form-control" id="local" name="local" placeholder="Rua, Número e Bairro">
							</div>
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Pastor Responsável</label>
								<select class="form-control sel21" id="pastor" name="pastor" style="width:100%;">
									<option value="0">Selecione um Pastor</option>
									<?php 
									$query = $pdo->query("SELECT * FROM pastores where igreja = '$id_igreja' order by nome asc");
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

							<div class="col-md-4">
								
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Ministrador</label>
									<select class="form-control sel2" id="coordenador" name="coordenador" style="width:100%;">
										<option value="0"> Membro / Pastor</option>

										
										<?php 
										$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and ativo = 'Sim' order by  nome asc");
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
										<label for="exampleFormControlInput1" class="form-label">Ministrador 2</label>
										<select class="form-control sel2" id="lider1" name="lider1" style="width:100%;">
											<option value="0">Selecione um Membro</option>
											<?php 
											$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and ativo = 'Sim' order by nome asc");
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
											<label for="exampleFormControlInput1" class="form-label">Ministrador 3</label>
											<select class="form-control sel2" id="lider2" name="lider2" style="width:100%;">
												<option value="0">Selecione um Membro</option>
												<?php 
												$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and ativo = 'Sim' order by nome asc");
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
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Nome : <span id="nome-dados"></span>  </h5><small> <span class="mx-2">(<span id="membros-dados"></span> Membros)</span></small>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">

								<div class="row">
								<div class="col-md-6">
								<span class=""><b>Dias:</b> <span id="dias-dados"></span></span>
								<hr style="margin:4px">
								</div>
								<div class="col-md-6">
								<span class=""><b>Horário:</b> <span id="hora-dados"></span></span>
								<hr style="margin:4px">
								</div>
								</div>

								<div class="row">
								<div class="col-md-6">
								<span class=""><b>Início</b> <span id="inicio-dados"></span></span>
								<hr style="margin:4px">
								</div>
								<div class="col-md-6">
								<span class=""><b>Término</b> <span id="termino-dados"></span></span>
								<hr style="margin:4px">
								</div>
								</div>


								<div class="row">
								<div class="col-md-6">
								<span class=""><b>Status</b> <span id="status-dados"></span></span>
								<hr style="margin:4px">
								</div>
								<div class="col-md-6">
								<span class=""><b>Local:</b> <span id="local-dados"></span></span>
								<hr style="margin:4px">	
								</div>	
								</div>

								

								<div class="row">
								<div class="col-md-6">
								<span class=""><b>Pastor Responsável:</b> <span id="pastor-dados"></span></span>
								<hr style="margin:4px">
								</div>
								<div class="col-md-6">
								<span class=""><b>Ministrador:</b> <span id="coordenador-dados"></span></span>
								<hr style="margin:4px">
								</div>
								</div>

								<div class="row">
								<div class="col-md-6">
								<span class=""><b>Ministrador 2</b> <span id="lider1-dados"></span></span>
								<hr style="margin:4px">
								</div>
								<div class="col-md-6">
								<span class=""><b>Ministrador 3</b> <span id="lider2-dados"></span></span>
								<hr style="margin:4px">
								</div>
								</div>



								<span class=""><b>OBS:</b> <span id="obs-dados"></span></span>
								<hr style="margin:4px">






							</div>

						</form>
					</div>
				</div>
			</div>






			<!-- Modal -->
			<div class="modal fade" id="modalObs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Observações - <span id="nome-obs"></span></span></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form id="form-obs" method="post">
							<div class="modal-body">

								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Observações (Máximo 1000 Caracteres)</label>
									<textarea class="form-control" id="obs" name="obs" maxlength="1000" style="height:200px"></textarea>
								</div>



								<small><div id="mensagem-obs" align="center"></div></small>

								<input type="hidden" class="form-control" name="id-obs"  id="id-obs">


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-obs">Fechar</button>
								<button type="submit" class="btn btn-primary">Salvar</button>
							</div>
						</form>
					</div>
				</div>
			</div>




			<!-- Modal -->
			<div class="modal fade" id="modalAddMembros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Adicionar Membros - <span id="nome-add"></span></span></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form id="form-add" method="post">
							<div class="modal-body">

								<div class="row">
									<div class="col-md-4">
										<div class="mb-3" id="listar-membros">
											
											</div>
										</div>
										<div class="col-md-8" id="listar-membros-add">

										</div>
									</div>



									<small><div id="mensagem-add" align="center"></div></small>

									<input type="hidden" class="form-control" name="id-add"  id="id-add">
									<input type="hidden" class="form-control" name="id-igreja"  id="id-ig">


								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-add">Fechar</button>
									<button type="submit" class="btn btn-primary">Adicionar</button>
								</div>
							</form>
						</div>
					</div>
				</div>







			<!-- Modal -->
			<div class="modal fade" id="modalAndamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Lançar Andamento - <span id="nome-andamento"></span></span></h5>
							<button btn="btn-fechar-andamento" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form id="form-andamento" method="post">
							<div class="modal-body">

								
								<div class="row">
									<div class="col-md-3">
										<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Data Ministração </label>
								<input type="date" class="form-control" id="data" name="data" value="<?php echo date('Y-m-d') ?>" required>
							</div>
									</div>	


									<div class="col-md-3">
										<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Quant Membros </label>
								<input type="number" class="form-control" id="membros" name="membros" value="" required>
							</div>
									</div>	




									<div class="col-md-6">
								
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Ministrador</label>
									<select class="form-control sel30" id="ministrador_andamento" name="ministrador" style="width:100%;">
										<option value="0"> Membro / Pastor</option>

									

										<?php 
										$query = $pdo->query("SELECT * FROM membros where igreja = '$id_igreja' and ativo = 'Sim' order by  nome asc");
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
							
							<div class="col-md-6">
										<div class="mb-3">
											<label for="exampleFormControlInput1" class="form-label">Arquivo <small>(*pdf, *word, *imagens, *rar ou zip)</small></label>
											<input type="file" class="form-control" id="imagem" name="imagem" onChange="carregarImg();">
										</div>
									</div>
									<div class="col-md-2">
										<div id="divImg" class="mt-4">
											<img src="../img/documentos/sem-foto.jpg"  width="50px" id="target">									
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-12">
										<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Observações </label>
								<input type="text" class="form-control" id="obs_andamento" name="obs_andamento" value="" >
							</div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-12">
											<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Conteúdo Ministrado <small><small>(Resumo) </small></small></label>
							<textarea type="text" class="form-control textarea" id="conteudo" name="conteudo" ></textarea>
						</div>
							
									</div>
								</div>


									<small><div id="mensagem-andamento" align="center"></div></small>

									<input type="hidden" class="form-control" name="id"  id="id-andamento">
									<input type="hidden" class="form-control" name="id-igreja"  id="id-ig-andamento">


								</div>
								<div class="modal-footer">
									
									<button type="submit" class="btn btn-primary">Adicionar</button>
								</div>
							</form>
						</div>
					</div>
				</div>





			<!-- Modal -->
			<div class="modal fade" id="modalListarAndamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Andamento - <span id="nome-andamento-listar"></span></span></h5>
							<button btn="btn-fechar-listar-andamento" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						
							<div class="modal-body">
								<div id="listar_andamento">
									
								</div>
							</div>
								
						</div>
					</div>
				</div>









				<!-- Modal -->
				<div class="modal fade" id="modalExcluirAndamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Andamento</span></h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<form id="form-excluir-andamento" method="post">
								<div class="modal-body">

									Deseja Realmente excluir este Registro?

									<small><div id="mensagem-excluir-andamento" align="center"></div></small>

									<input type="hidden" class="form-control" name="id-excluir"  id="id-excluir-andamento">


								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir-andamento">Fechar</button>
									<button type="submit" class="btn btn-danger">Excluir</button>
								</div>
							</form>
						</div>
					</div>
				</div>




<!-- Modal -->
			<div class="modal fade" id="modalDadosAndamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Conteúdo Ministrado <span id="nome-andamento-listar"></span></span></h5>
							<button btn="btn-fechar-listar-dados-andamento" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						
							<div class="modal-body">
								<div id="listar_dados_andamento">
									
								</div>
							</div>
								
						</div>
					</div>
				</div>



				<script type="text/javascript">var pag = "<?=$pagina?>"</script>
				<script src="../js/ajax.js"></script>


				<script type="text/javascript">

					function editar(id, nome, dias, hora, local, pastor, coordenador, lider1, lider2, inicio, termino, status){
						$('#id').val(id);
						$('#nome').val(nome);
						$('#dias').val(dias);
						$('#local').val(local);
						$('#hora').val(hora);
						$('#pastor').val(pastor).change();
						$('#coordenador').val(coordenador).change();
						$('#lider1').val(lider1).change();
						$('#lider2').val(lider2).change();

						$('#data_inicio').val(inicio);
						$('#data_termino').val(termino);
						$('#status').val(status).change();

						$('#tituloModal').text('Editar Registro');
						var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
						myModal.show();
						$('#mensagem').text('');
					}



					function dados(nome, dias, hora, local, pastor, coordenador, lider1, lider2, obs, membros, inicio, termino, status){

						$('#nome-dados').text(nome);
						$('#dias-dados').text(dias);
						$('#hora-dados').text(hora);
						$('#local-dados').text(local);
						$('#pastor-dados').text(pastor);
						$('#coordenador-dados').text(coordenador);
						$('#lider1-dados').text(lider1);
						$('#lider2-dados').text(lider2);
						$('#obs-dados').text(obs);
						$('#membros-dados').text(membros);

						$('#inicio-dados').text(inicio);
						$('#termino-dados').text(termino);
						$('#status-dados').text(status);


						var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {		});
						myModal.show();
						$('#mensagem').text('');
					}



					function obs(id, nome, obs){
						console.log(obs)

						for (let letra of obs){  				
							if (letra === '+'){
								obs = obs.replace(' +  + ', '\n')
							}			
						}


						$('#nome-obs').text(nome);
						$('#id-obs').val(id);
						$('#obs').val(obs);



						var myModal = new bootstrap.Modal(document.getElementById('modalObs'), {		});
						myModal.show();
						$('#mensagem-obs').text('');
					}



					function addMembros(id, nome, igreja){
						console.log(obs)


						$('#nome-add').text(nome);
						$('#id-add').val(id);
						$('#id-ig').val(igreja);

						listarMembrosCB(id, igreja);
						listarMembrosAdd(id, igreja);

						var myModal = new bootstrap.Modal(document.getElementById('modalAddMembros'), {		});
						myModal.show();
						$('#mensagem-add').text('');
					}




					function limpar(){

						$('#id').val('');
						$('#nome').val('');
						$('#dias').val('');
						$('#local').val('');
						$('#hora').val('');	

						document.getElementById("pastor").options.selectedIndex = 0;
						$('#pastor').val($('#pastor').val()).change();

						document.getElementById("coordenador").options.selectedIndex = 0;
						$('#coordenador').val($('#coordenador').val()).change();

						document.getElementById("lider1").options.selectedIndex = 0;
						$('#lider1').val($('#lider1').val()).change();

						document.getElementById("lider2").options.selectedIndex = 0;
						$('#lider2').val($('#lider2').val()).change();	

					}




					$("#form-add").submit(function () {
						event.preventDefault();
						var formData = new FormData(this);

						var igreja = "<?=$id_igreja?>";
						var celula = $('#id-add').val();
						
						$.ajax({
							url: pag + "/add-membros.php",
							type: 'POST',
							data: formData,

							success: function (mensagem) {
								$('#mensagem-add').text('');
								$('#mensagem-add').removeClass()
								if (mensagem.trim() == "Adicionado com Sucesso") {

									listarMembrosCB(celula, igreja);
									listarMembrosAdd(celula, igreja);
									
								} else {

									$('#mensagem-add').addClass('text-danger')
									$('#mensagem-add').text(mensagem)
								}


							},

							cache: false,
							contentType: false,
							processData: false,

						});

					});





	function listarMembrosCB(celula, igreja){
		console.log(obs)

		
		$.ajax({
        url: pag + "/listar-membros.php",
        method: 'POST',
        data: {celula, igreja},
        dataType: "text",

        success: function (result) {
            $("#listar-membros").html(result);               
        },

    });

	}


	function listarMembrosAdd(celula, igreja){
		console.log(obs)

		
		$.ajax({
        url: pag + "/listar-membros-add.php",
        method: 'POST',
        data: {celula, igreja},
        dataType: "text",

        success: function (result) {
            $("#listar-membros-add").html(result);               
        },

    });

	}



	function excluirMembro(id){
		event.preventDefault();
		var igreja = "<?=$id_igreja?>";
		var celula = $('#id-add').val();
				
		$.ajax({
        url: pag + "/excluir-membro.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (result) {
            listarMembrosCB(celula, igreja);
			listarMembrosAdd(celula, igreja);            
        },

    });

	}


				</script>





				<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
				<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

				<script>
					$(document).ready(function() {
						$('.sel2').select2({
							placeholder: 'Selecione um Registro',
							dropdownParent: $('#modalForm')
						});

						$('.sel30').select2({
							placeholder: 'Selecione um Registro',
							dropdownParent: $('#modalAndamento')
						});
					});
				</script>

				<script>
					$(document).ready(function() {
						$('.sel21').select2({
							placeholder: 'Selecione um Pastor',
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



				<script type="text/javascript">
					

					function andamento(id, nome, igreja, ministrador, status){
						console.log(obs)

						if(status != 'Andamento'){
							alert('A turma precisa está em andamento!');
							return;
						}
						
						$('#nome-andamento').text(nome);
						$('#id-andamento').val(id);
						$('#id-ig-andamento').val(igreja);

						$('#ministrador_andamento').val(ministrador).change();

						var myModal = new bootstrap.Modal(document.getElementById('modalAndamento'), {		});
						myModal.show();
						$('#mensagem-andamento').text('');
					}



					function listar_andamento(id, nome){
						console.log(obs)

												
						$('#nome-andamento-listar').text(nome);
						
						$.ajax({
        url: pag + "/listar_andamento.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (result) {
            	$('#listar_andamento').html(result)    
        },

    });

						var myModal = new bootstrap.Modal(document.getElementById('modalListarAndamento'), {		});
						myModal.show();
						$('#mensagem-listar-andamento').text('');
					}

				</script>




<script type="text/javascript">
	$("#form-andamento").submit(function () {
	event.preventDefault();	
	nicEditors.findEditor('conteudo').saveContent();
	var formData = new FormData(this);

	$.ajax({
		url: pag + "/andamento.php",
		type: 'POST',
		data: formData,

		success: function (mensagem) {
			$('#mensagem-andamento').text('');
			$('#mensagem-andamento').removeClass()
			if (mensagem.trim() == "Salvo com Sucesso") {
                    $('#membros').val('');
                    $('#obs_andamento').val('');
                    nicEditors.findEditor("conteudo").setContent('');
                     $('#btn-fechar-andamento').click();
                     mensagemSalvar();
                     
                     setTimeout(function(){
                        window.location="index.php?pag=" + pag;
                    }, 500)
                     
                    
                     
                } else {

                	$('#mensagem-andamento').addClass('text-danger')
                	$('#mensagem-andamento').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,
            
        });

});
</script>



<script type="text/javascript">
	

$("#form-excluir-andamento").submit(function () {
    event.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: pag + "/excluir_andamento.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-excluir-andamento').text('');
            $('#mensagem-excluir-andamento').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {
                $('#btn-fechar-excluir-andamento').click();
                mensagemExcluir()

                 setTimeout(function(){
                        window.location="index.php?pag=" + pag;
                    }, 500)
               		
            } else {

                $('#mensagem-excluir-andamento').addClass('text-danger')
                $('#mensagem-excluir-andamento').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});

</script>



				<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
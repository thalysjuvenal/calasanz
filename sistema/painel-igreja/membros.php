<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'membros';
?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Novo Membro</a>
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
					<th>CPF</th>
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
					$estado = $res[$i]['estado_civil'];
					$id = $res[$i]['id'];

					$rg = $res[$i]['rg'];
					$nacionalidade = $res[$i]['nacionalidade'];
					$naturalidade = $res[$i]['naturalidade'];
					$nome_pai = $res[$i]['nome_pai'];
					$nome_mae = $res[$i]['nome_mae'];
					$membresia = $res[$i]['membresia'];

					if($obs != ""){
						$classe_obs = 'text-warning';
					}else{
						$classe_obs = 'text-secondary';
					}


					if($ativo == 'Sim'){
						$classe = 'text-success';
						$ativo = 'Desativar Membro';
						$icone = 'bi-check-square';
						$ativar = 'Não';
						$inativa = '';
						$tab = 'Ativo';

					}else{
						$classe = 'text-danger';
						$ativo = 'Ativar Membro';
						$icone = 'bi-square';
						$ativar = 'Sim';
						$inativa = 'text-muted';
						$tab = 'Inativo';
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
					$membresiaF = implode('/', array_reverse(explode('-', $membresia)));
					?>			
					<tr class="<?php echo $inativa ?>">
						<td><?php echo $nome ?></td>
						<td><?php echo $cpf ?></td>
						<td class="esc"><?php echo $email ?></td>
						<td class="esc"><?php echo $telefone ?></td>
						<td class="esc"><?php echo $nome_cargo ?></td>
						
						<td class="esc"><img src="../img/membros/<?php echo $foto ?>" width="30px"></td>

						<td class="d-none"><?php echo $tab ?></td>
						
						<td>
							<big>
								<a href="#" onclick="editar('<?php echo $id ?>', '<?php echo $nome ?>', '<?php echo $cpf ?>', '<?php echo $email ?>', '<?php echo $telefone ?>', '<?php echo $endereco ?>', '<?php echo $foto ?>', '<?php echo $data_nasc ?>', '<?php echo $igreja ?>', '<?php echo $nome_ig ?>', '<?php echo $data_bat ?>', '<?php echo $cargo ?>', '<?php echo $estado ?>', '<?php echo $rg ?>', '<?php echo $nome_pai ?>', '<?php echo $nome_mae ?>', '<?php echo $naturalidade ?>', '<?php echo $nacionalidade ?>', '<?php echo $membresia ?>')" title="Editar Registro">	<i class="bi bi-pencil-square text-primary"></i> </a>

								<a href="#" onclick="excluir('<?php echo $id ?>' , '<?php echo $nome ?>')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>

								<a href="#" onclick="dados('<?php echo $nome ?>', '<?php echo $cpf ?>', '<?php echo $email ?>', '<?php echo $telefone ?>', '<?php echo $endereco ?>', '<?php echo $foto ?>', '<?php echo $data_nascF ?>', '<?php echo $data_cadF ?>', '<?php echo $nome_ig ?>', '<?php echo $data_batF ?>', '<?php echo $nome_cargo ?>', '<?php echo $estado ?>', '<?php echo $rg ?>', '<?php echo $nome_pai ?>', '<?php echo $nome_mae ?>', '<?php echo $naturalidade ?>', '<?php echo $nacionalidade ?>', '<?php echo $membresiaF ?>')" title="Ver Dados">	<i class="bi bi-info-square-fill text-primary"></i> </a>

								<a href="#" onclick="obs('<?php echo $id ?>','<?php echo $nome ?>', '<?php echo $obs ?>')" title="Observações">	<i class="bi bi-chat-right-text <?php echo $classe_obs ?>"></i> </a>


								<a href="#" onclick="mudarStatus('<?php echo $id ?>', '<?php echo $ativar ?>')" title="<?php echo $ativo ?>">
									<i class="bi <?php echo $icone ?> <?php echo $classe ?>"></i></a>


									<a class="" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone ?>&text=" title="Enviar Mensagem">
										<i class="bi bi-whatsapp text-success"></i></a>


										<a href="../rel/relCarteirinha.php?id=<?php echo $id ?>" title="Gerar Carteirinha" target="_blank">
											<i class="bi bi-person-badge-fill text-primary"></i></a>


											<a href="#" onclick="modalTransf('<?php echo $id ?>', '<?php echo $nome ?>')" title="Carta de Recomendação">
												<i class="bi bi-clipboard-x text-danger"></i></a>


													<a href="../rel/relBatismo.php?id=<?php echo $id ?>" title="Certificado de Batismo" target="_blank">
											<i class="bi bi-award text-success"></i></a>


											<a href="#" onclick="modalApresentacao('<?php echo $id ?>', '<?php echo $nome ?>')" title="Certificado de Apresentação">
											<i class="bi bi-bookmark-star text-secondary"></i></a>

											<a href="#" onclick="transferir('<?php echo $id ?>', '<?php echo $nome ?>')" title="Transferência de Membro">
											<i class="bi bi-signpost-2 text-danger"></i></a>

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
												<label for="exampleFormControlInput1" class="form-label">Nome</label>
												<input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o Nome"  required>
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


										<div class="col-md-3">
											<div class="mb-3">
												<label for="exampleFormControlInput1" class="form-label">Data Nasc</label>
												<input type="date" class="form-control" id="data_nasc" name="data_nasc" value="<?php echo date('Y-m-d') ?>" required>
											</div>
										</div>


										<div class="col-md-3">
											<div class="mb-3">
												<label for="exampleFormControlInput1" class="form-label">Cargo Ministerial</label>
												<select class="form-control sel2" id="cargo" name="cargo" style="width:100%;">
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


											<div class="col-md-3">
												<div class="mb-3">
													<label for="exampleFormControlInput1" class="form-label">Estado Cívil</label>
													<select class="form-control sel2" id="estado" name="estado" style="width:100%;">
														<option value="Solteiro">Solteiro</option>
														<option value="Casado">Casado</option>
													</select>
												</div>

											</div>



										</div>

				<div class="row">
						<div class="col-md-3">
						<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Data Batismo</label>
									<input type="date" class="form-control" id="data_bat" name="data_bat">
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
						<div class="col-md-3">
						<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Membresia</label>
									<input type="date" class="form-control" id="membresia" name="membresia">
												</div>
										</div>


								<div class="col-md-3">
									<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">RG</label>
										<input type="text" class="form-control" id="rg" name="rg" placeholder="Insira o RG">
												</div>
											</div>


							<div class="col-md-3">
									<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nacionalidade</label>
										<input type="text" class="form-control" id="nacionalidade" name="nacionalidade" placeholder="Brasileiro">
												</div>
											</div>


												<div class="col-md-3">
									<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Naturalidade</label>
										<input type="text" class="form-control" id="naturalidade" name="naturalidade" placeholder="Belo Horizonte">
												</div>
											</div>

								
						</div>





						<div class="row">
						
							<div class="col-md-6">
									<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nome do Pai</label>
										<input type="text" class="form-control" id="nome_pai" name="nome_pai" placeholder="Nome Pai">
												</div>
											</div>


												<div class="col-md-6">
									<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nome da Mãe</label>
										<input type="text" class="form-control" id="nome_mae" name="nome_mae" placeholder="Nome da Mãe">
												</div>
											</div>

								
						</div>




										<div class="row">

											<div class="col-md-5">
												<div class="mb-3">
													<label for="exampleFormControlInput1" class="form-label">Foto</label>
													<input type="file" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
												</div>
											</div>
											<div class="col-md-2">
												<div id="divImg" class="mt-4">
													<img src="../img/membros/sem-foto.jpg"  width="100px" id="target">									
												</div>
											</div>





										</div>





										<input type="hidden" id="id" name="id">
										<input type="hidden" id="igreja2" name="igreja" value="<?php echo $id_igreja ?>">

									</div>
									<small><div align="center" id="mensagem"></div></small>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
										<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>
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
											<span id="span-estado"><b>Estado Civil:</b> <span id="estado-dados"></span></span>
											<hr style="margin:4px">
										</div>

										<div class="col-md-6">
											<span id="span-rg"><b>RG:</b> <span id="rg-dados"></span></span>
											<hr style="margin:4px">
										</div>

										<div class="col-md-6">
											<span id="span-membresia"><b>Membresia:</b> <span id="membresia-dados"></span></span>
											<hr style="margin:4px">
										</div>


										<div class="col-md-12">
											<span id="span-nacionalidade"><b>Nacionalidade:</b> <span id="nacionalidade-dados"></span></span>
											<hr style="margin:4px">
										</div>


										<div class="col-md-12">
											<span id="span-naturalidade"><b>Naturalidade:</b> <span id="naturalidade-dados"></span></span>
											<hr style="margin:4px">
										</div>


										


										<div class="col-md-12">
											<span id="span-pai"><b>Nome Pai:</b> <span id="pai-dados"></span></span>
											<hr style="margin:4px">
										</div>


										<div class="col-md-12">
											<span id="span-mae"><b>Nome Mãe:</b> <span id="mae-dados"></span></span>
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
										<label for="exampleFormControlInput1" class="form-label">Observações (Máximo 500 Caracteres)</label>
										<textarea class="form-control" id="obs" name="obs" maxlength="500" style="height:200px"></textarea>
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
				<div class="modal fade" id="modalTransf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Carta de Recomendaçao - <span id="nome-transf"></span></span></h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<form id="form-obs" method="post" action="../rel/relRecomendacao.php" target="_blank">
								<div class="modal-body">

									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label">Igreja</label>
										<input class="form-control" id="igreja-transf" name="igreja" placeholder="Nome da Igreja à Recomendar">
									</div>

									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label">Observações (Máximo 2000 Caracteres)</label>
										<textarea class="form-control" id="obs-transf" name="obs" maxlength="2000" style="height:200px"></textarea>
									</div>



									<small><div id="mensagem-transf" align="center"></div></small>

									<input type="hidden" class="form-control" name="id"  id="id-transf">


								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-transf">Fechar</button>
									<button type="submit" class="btn btn-primary">Gerar</button>
								</div>
							</form>
						</div>
					</div>
				</div>







				<!-- Modal Apresentacao -->
				<div class="modal fade" id="modalApresentacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<span class="modal-title" id="exampleModalLabel"><span id="tituloModal">Certificado de Apresentação - <span id="nome-apres"></span></span></span>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							
								<div class="modal-body">

									<div class="row">
										<div class="col-md-6" align="center">
											<a href="#" onclick="certApresentacao('menino')" title="Certificado de Menino">
											<img src="../img/apresentacao.jpg" width="70%">
											</a>
										</div>

										<div class="col-md-6" align="center">
											<a href="#" onclick="certApresentacao('menina')" title="Certificado de Menina">
											<img src="../img/apresentacao2.jpg" width="70%">
											</a>
										</div>
									</div>


									<small><div id="mensagem-apres" align="center"></div></small>

									<input type="hidden" class="form-control" name="id"  id="id-apres">


								</div>
							
							
						</div>
					</div>
				</div>







				<!-- Modal Transferir membro -->
				<div class="modal fade" id="modalTransferir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<span class="modal-title" id="exampleModalLabel"><span id="tituloModal">Transferir Membro - <span id="nome-transferir"></span></span></span>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<form id="form-transferir" method="post" action="../rel/relRecomendacao.php" target="_blank">
								<div class="modal-body">

									<div class="row">
										<div class="col-md-6" >
												<label for="exampleFormControlInput1" class="form-label">Transferir para Igreja</label>
						<select class="form-control sel3" id="igreja-membro" name="igreja" style="width:100%;" required>
							<?php 
							$query = $pdo->query("SELECT * FROM igrejas order by matriz desc, nome asc");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$total_reg = count($res);
							if($total_reg > 0){

								for($i=0; $i < $total_reg; $i++){
									foreach ($res[$i] as $key => $value){} 

										$nome_reg = $res[$i]['nome'];
									$id_reg = $res[$i]['id'];

									if($id_reg != $id_igreja){
										?>
										<option value="<?php echo $id_reg ?>" class="<?php echo $classe_ig ?>"><?php echo $nome_reg ?></option>

									<?php }}} ?>
								</select>
										</div>

										<div class="col-md-6" >
											<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Obs</label>
									<input type="text" class="form-control" id="obs" name="obs" placeholder="Observações">
								</div>
										</div>
									</div>


									<small><div id="mensagem-transferir" align="center"></div></small>

									<input type="hidden" class="form-control" name="id"  id="id-transferir">
									<input type="hidden" class="form-control" name="igreja_saida"  id="igreja_saida" value="<?php echo $id_igreja ?>">


								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-transferir">Fechar</button>
									<button type="submit" class="btn btn-primary">Transferir</button>
								</div>
							</form>
							
							
						</div>
					</div>
				</div>




				<script type="text/javascript">var pag = "<?=$pagina?>"</script>
				<script src="../js/ajax.js"></script>


				<script type="text/javascript">

					function editar(id, nome, cpf, email, telefone, endereco, foto, data_nasc, igreja, nome_ig, data_bat, cargo, estado, rg, pai, mae, naturalidade, nacionalidade, membresia){
						$('#id').val(id);
						$('#nome').val(nome);
						$('#email').val(email);
						$('#cpf').val(cpf);
						$('#telefone').val(telefone);
						$('#endereco').val(endereco);
						$('#data_nasc').val(data_nasc);
						$('#data_bat').val(data_bat);
						$('#target').attr('src', '../img/membros/' + foto);

						$('#igreja').val(igreja).change();
						$('#cargo').val(cargo).change();
						$('#estado').val(estado).change();

						$('#rg').val(rg);
						$('#nome_pai').val(pai);
						$('#nome_mae').val(mae);
						$('#naturalidade').val(naturalidade);
						$('#nacionalidade').val(nacionalidade);
						$('#membresia').val(membresia);

						$('#tituloModal').text('Editar Registro');
						var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {		});
						myModal.show();
						$('#mensagem').text('');
					}



					function dados(nome, cpf, email, telefone, endereco, foto, data_nasc, data_cad, igreja, data_bat, cargo, estado, rg, pai, mae, naturalidade, nacionalidade, membresia){

						if(estado == ""){
							document.getElementById('span-estado').style.display = 'none';
						}

						if(data_bat === '00/00/0000'){
							data_bat = 'Não Batizado!';
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


						$('#rg-dados').text(rg);
						$('#nacionalidade-dados').text(nacionalidade);
						$('#naturalidade-dados').text(naturalidade);
						$('#pai-dados').text(pai);
						$('#mae-dados').text(mae);
						$('#membresia-dados').text(membresia);


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

					function limpar(){
						var data = "<?=$data_atual?>";

						$('#id').val('');
						$('#nome').val('');		
						$('#email').val('');
						$('#cpf').val('');
						$('#telefone').val('');
						$('#endereco').val('');
						$('#data_nasc').val(data);

						$('#membresia').val('');
						$('#nome_pai').val('');
						$('#nome_mae').val('');
						$('#nacionalidade').val('');
						$('#naturalidade').val('');
						$('#rg').val('');

						document.getElementById("cargo").options.selectedIndex = 0;
						$('#cargo').val($('#cargo').val()).change();

						document.getElementById("estado").options.selectedIndex = 0;
						$('#estado').val($('#estado').val()).change();

						$('#target').attr('src', '../img/membros/sem-foto.jpg');
					}



					function modalTransf(id, nome){
						console.log(obs)

						$('#nome-transf').text(nome);
						$('#id-transf').val(id);

						var myModal = new bootstrap.Modal(document.getElementById('modalTransf'), {		});
						myModal.show();
						$('#mensagem-transf').text('');
					}



					function modalApresentacao(id, nome){
						console.log(obs)

						$('#nome-apres').text(nome);
						$('#id-apres').val(id);

						var myModal = new bootstrap.Modal(document.getElementById('modalApresentacao'), {		});
						myModal.show();
						$('#mensagem-apres').text('');
					}


					function certApresentacao(sexo){
						console.log(obs)

						var id = $('#id-apres').val();						
						
						let a= document.createElement('a');
          				a.target= '_blank';
          				a.href= '../rel/relApresentacao.php?id='+id+'&sexo='+sexo;
          				a.click();
					}



					function transferir(id, nome){
						console.log(obs)

						$('#nome-transferir').text(nome);
						$('#id-transferir').val(id);

						var myModal = new bootstrap.Modal(document.getElementById('modalTransferir'), {		});
						myModal.show();
						$('#mensagem-transferir').text('');
					}


				</script>


				<script type="text/javascript">
					
$("#form-transferir").submit(function () {
	event.preventDefault();
	var formData = new FormData(this);

	$.ajax({
		url: pag + "/transferir.php",
		type: 'POST',
		data: formData,

		success: function (mensagem) {
			$('#mensagem-transferir').text('');
			$('#mensagem-transferir').removeClass()
			if (mensagem.trim() == "Salvo com Sucesso") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                     $('#btn-fechar-transferir').click();
                     mensagemSalvar();
                     
                     setTimeout(function(){
                        window.location="index.php?pag=" + pag;
                    }, 500)
                     
                    
                     
                } else {

                	$('#mensagem-transferir').addClass('text-danger')
                	$('#mensagem-transferir').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,
            
        });

});
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


				<script>
					$(document).ready(function() {
						$('.sel3').select2({
			//placeholder: 'Selecione um Cliente',
			dropdownParent: $('#modalTransferir')
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
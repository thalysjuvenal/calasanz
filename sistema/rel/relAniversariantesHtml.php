<?php 
require_once("../conexao.php"); 

$igreja = $_GET['igreja'];
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];

$partesInicial = explode('-', $dataInicial);
$dataDiaInicial = $partesInicial[2];
$dataMesInicial = $partesInicial[1];

$partesFinal = explode('-', $dataFinal);
$dataDiaFinal = $partesFinal[2];
$dataMesFinal = $partesFinal[1];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if($dataInicial == $dataFinal){
	$texto_apuracao = 'ANIVERSÁRIANTES DO DIA '.$dataInicialF;
}else{
	$texto_apuracao = 'ANIVERSÁRIANTES DE '.$dataInicialF. ' ATÉ '.$dataFinalF;
}


$query = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_igreja = $res[0]['nome'];
$tel_igreja = $res[0]['telefone'];
$end_igreja = $res[0]['endereco'];
$imagem_igreja = $res[0]['imagem'];
$pastor_igreja = $res[0]['pastor'];
$logo_rel = $res[0]['logo_rel'];
$cab_rel = $res[0]['cab_rel'];



if($logo_rel != 'sem-foto.jpg'){ 
	$imagem_igreja = $logo_rel;

}else{
	$imagem_igreja = 'logo-rel.jpg';
}


if($cab_rel != 'sem-foto.jpg'){ 
	$cabecalho_rel = $cab_rel;

}else{
	$cabecalho_rel = 'cabecalho-rel.jpg';
}

$query = $pdo->query("SELECT * FROM pastores where id = '$pastor_igreja'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_pastor = $res[0]['nome'];


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));



?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Aniversáriantes</title>
	<link rel="shortcut icon" href="../img/favicon.ico" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 0px;

		}

		body{
			margin-top:0px;
			font-family:Times, "Times New Roman", Georgia, serif;
		}


		<?php if($relatorio_pdf == 'Sim'){ ?>

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		<?php }else{ ?>
			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;

			}

		<?php } ?>

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;
		}

		.titulo_cab{
			color:#0340a3;
			font-size:17px;
		}

		
		
		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;
		}



		hr{
			margin:8px;
			padding:0px;
		}


		
		.area-cab{
			
			display:block;
			width:100%;
			height:10px;

		}

		
		.coluna{
			margin: 0px;
			float:left;
			height:30px;
		}

		.area-tab{
			
			display:block;
			width:100%;
			height:30px;

		}


		.imagem {
			width: 100%;
		}

		.titulo_img {
		position: absolute;
		margin-top: 10px;
		margin-left: 10px;
		
		}

		.data_img {
		position: absolute;
		margin-top: 40px;
		margin-left: 10px;
		
		}



		

	</style>


</head>
<body>

	
	<?php if($cabecalho_rel_img != 'Sim'){ ?>
	<section class="area-cab">
		<div class="cabecalho">

			
			<div class="coluna titulo_cab" style="width:50%"> <u>RELATÓRIO DE ANIVERSÁRIANTES</u></div>		
						
			<div align="right" class="coluna" style="width:50%"> <img style="margin-top:5px" src="<?php echo $url_sistema ?>img/igrejas/<?php echo $imagem_igreja ?>" width="30px"> <?php echo mb_strtoupper($nome_igreja) ?></div>

			
		</div>
	</section>

	<br>

	<section class="area-cab">
		<div class="cabecalho">
			<div class="coluna" style="width:60%"><small> <small><small><?php echo mb_strtoupper($data_hoje) ?></small></small></small></div>
			<div align="right" class="coluna" style="width:40%"><small> <small><small> <?php echo $end_igreja ?></small></small></small></div>
		</div>
	</section>

	<?php }else{ ?>
		<div class="titulo_cab titulo_img"><u>RELATÓRIO DE ANIVERSÁRIANTES</u></div>	
		<div class="data_img"><small> <small><small><?php echo mb_strtoupper($data_hoje) ?></small></small></small></div>

		<img class="imagem" src="<?php echo $url_sistema ?>img/igrejas/<?php echo $cabecalho_rel ?>">
	<?php } ?>
	

	<br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>

	<div class="mx-2" style="padding-top:10px ">

		<section class="area-cab">
			
			<div class="coluna" style="width:50%">
				<small><small><small><u><?php echo $texto_apuracao ?></u></small></small></small>
			</div>

			

		</section>

		<br>

		<?php 
		$query = $pdo->query("SELECT * FROM membros where igreja = '$igreja' and month(data_nasc) >= '$dataMesInicial' and day(data_nasc) >= '$dataDiaInicial' and month(data_nasc) <= '$dataMesFinal' and day(data_nasc) <= '$dataDiaFinal' order by data_nasc asc, id asc");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($res);

		$query_pastores = $pdo->query("SELECT * FROM pastores where igreja = '$igreja' and month(data_nasc) >= '$dataMesInicial' and day(data_nasc) >= '$dataDiaInicial' and month(data_nasc) <= '$dataMesFinal' and day(data_nasc) <= '$dataDiaFinal' order by data_nasc asc, id asc");
		$res_pastores = $query_pastores->fetchAll(PDO::FETCH_ASSOC);
		$total_reg_pastores = count($res_pastores);

		$totalAniv = $total_reg + $total_reg_pastores;
						
		if($total_reg > 0 || $total_reg_pastores > 0){
			?>



			<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:30%">NOME</div>
						<div class="coluna" style="width:15%">NASCIMENTO</div>
						<div class="coluna" style="width:20%">TELEFONE</div>
						<div class="coluna" style="width:20%">CARGO</div>
						<div class="coluna" style="width:15%">FOTO</div>
						
					</div>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

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
					<section class="area-tab" style="padding-top:5px">					
						<div class="linha-cab <?php echo $classe_aniv ?>">				
							<div class="coluna" style="width:30%"><?php echo $nome ?></div>

								<div class="coluna" style="width:15%"><?php echo $data_nascF ?></div>

								<div class="coluna" style="width:20%"><?php echo $telefone ?></div>

								<div class="coluna" style="width:20%"><?php echo $nome_cargo ?></div>

								<div class="coluna" style="width:15%"><img src="<?php echo $url_sistema ?>img/membros/<?php echo $foto ?>" width="30px"></div>	

							</div>
						</section>
						<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
						</div>

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
					<section class="area-tab" style="padding-top:5px">					
						<div class="linha-cab <?php echo $classe_aniv ?>">				
							<div class="coluna" style="width:30%"><?php echo $nome ?></div>

								<div class="coluna" style="width:15%"><?php echo $data_nascF ?></div>

								<div class="coluna" style="width:20%"><?php echo $telefone ?></div>

								<div class="coluna" style="width:20%">Pastor</div>

								<div class="coluna" style="width:15%"><img src="<?php echo $url_sistema ?>img/membros/<?php echo $foto ?>" width="30px"></div>	

							</div>
						</section>
						<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
						</div>

					<?php } ?>

				</small>



			</div>


			<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
			</div>


		<?php }else{
			echo '<div style="margin:8px"><small><small>Sem Registros no banco de dados!</small></small></div>';
		} ?>


		

		<div class="col-md-12 p-2">
			<div class="" align="right">
				<small><small>TOTAL DE ANIVERSÁRIANTES <span class=""> <?php echo $totalAniv ?> </span></small></small>  
			</div>
		</div>
		<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
		</div>

	



		<div class="footer"  align="center">
			<span style="font-size:10px"><?php echo $end_igreja ?> - Telefone: <?php echo $tel_igreja ?> - Pastor Responsável: <?php echo $nome_pastor ?></span> 
		</div>



	</body>
	</html>
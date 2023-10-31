<?php 
require_once("../conexao.php"); 

$acao = $_GET['acao'];
$tabelas = $_GET['tabelas'];
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];


$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if($dataInicial == $dataFinal){
	$texto_apuracao = 'APURADO EM '.$dataInicialF;
}else if($dataInicial == '1980-01-01'){
	$texto_apuracao = 'APURADO EM TODO O PERÍODO';
}else{
	$texto_apuracao = 'APURAÇÃO DE '.$dataInicialF. ' ATÉ '.$dataFinalF;
}


$query = $pdo->query("SELECT * FROM igrejas where matriz = 'Sim'");
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



if($acao == ''){
	$acao_rel = '';
}else{
	$acao_rel = ' - '.$acao;
}


if($tabelas == ''){
	$tabelas_rel = '';
}else{
	$tabelas_rel = ' - Tabela: '.$tabelas;
}


$acao = '%'.$acao.'%';
$tabelas = '%'.$tabelas.'%';



setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));



?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Logs</title>
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

			
			<div class="coluna titulo_cab" style="width:50%"> <u>Relatório de Logs <?php echo $acao_rel ?> <?php echo $tabelas_rel ?></u></div>		
						
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
		<div class="titulo_cab titulo_img"><u>Relatório de Logs <?php echo $acao_rel ?> <?php echo $tabelas_rel ?></u></div>	
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
	$query = $pdo->query("SELECT * FROM logs where acao LIKE '$acao' and tabela LIKE '$tabelas' and data >= '$dataInicial' and data <= '$dataFinal' order by id asc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){
		?>

		

	<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:10%">DATA</div>
						<div class="coluna" style="width:10%">HORA</div>
						<div class="coluna" style="width:15%">TABELA</div>
						<div class="coluna" style="width:15%">AÇÃO</div>
						<div class="coluna" style="width:20%">USUÁRIO</div>
						<div class="coluna" style="width:10%">REGISTRO</div>
						<div class="coluna" style="width:30%">DESCRIÇÃO REGISTRO</div>

					</div>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

				<?php
				 for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){}
					$data = $res[$i]['data'];
					$hora = $res[$i]['hora'];
					$tabela = $res[$i]['tabela'];
					$acao = $res[$i]['acao'];
					$usuario = $res[$i]['usuario'];
					$registro = $res[$i]['id_reg'];
					$descricao = $res[$i]['descricao'];

					$data = implode('/', array_reverse(explode('-', $data)));

					$query_con = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_usu = $res_con[0]['nome'];
					}else{
						$nome_usu= '';
					}

										
					
				?>

				<section class="area-tab" style="padding-top:5px">					
					<div class="linha-cab <?php echo $classe_item ?> <?php echo $inativa ?>">				
						<div class="coluna" style="width:10%"><?php echo $data ?></div>

						<div class="coluna" style="width:10%"><?php echo $hora ?></div>

						<div class="coluna" style="width:15%"><?php echo $tabela ?></div>

						<div class="coluna" style="width:15%"><?php echo $acao ?></div>

						<div class="coluna" style="width:20%"><?php echo $nome_usu ?></div>		

						<div class="coluna" style="width:10%"><?php echo $registro ?></div>		

						<div class="coluna" style="width:30%"><?php echo $descricao ?></div>		

		

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
				<span class=""> <small><small><small><small>TOTAL DE REGISTROS</small> :  <?php echo $total_reg ?></small></small></small>  </span>
			</div>
		</div>
		<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
		</div>




	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $end_igreja ?> - Telefone: <?php echo $tel_igreja ?> - Pastor Responsável: <?php echo $nome_pastor ?></span> 
	</div>



</body>
</html>
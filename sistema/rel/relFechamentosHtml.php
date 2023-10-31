<?php 
require_once("../conexao.php"); 

$dataInicial = $_GET['dataInicial'];
$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));

$separar = explode("-", $dataInicial);
					$mes = $separar[1];
					$ano = $separar[0];



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




setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));



?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Fechamentos</title>
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
			height:40px;

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

			
			<div class="coluna titulo_cab" style="width:50%"> <u>Fechamentos do Mês <?php echo $mesF ?> / <?php echo $ano ?></u></div>		
						
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
		<div class="titulo_cab titulo_img"><u>Fechamentos do Mês <?php echo $mesF ?> / <?php echo $ano ?></u></div>	
		<div class="data_img"><small> <small><small><?php echo mb_strtoupper($data_hoje) ?></small></small></small></div>

		<img class="imagem" src="<?php echo $url_sistema ?>img/igrejas/<?php echo $cabecalho_rel ?>">
	<?php } ?>

	<br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>

	<div class="mx-2" style="padding-top:10px ">



		<br>
	
	<?php 
	$query = $pdo->query("SELECT * FROM fechamentos where month(data_fec) = '$mes' and year(data_fec) = '$ano' order by id asc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){
		?>

		

	<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<b><div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:10%">DATA</div>
						<div align="center" class="coluna" style="width:30%">IGREJA</div>
						<div class="coluna" style="width:12%; ">SAÍDAS</div>
						<div class="coluna" style="width:12%; ">ENTRADAS</div>
						<div class="coluna" style="width:12%">SALDO</div>
						<div class="coluna" style="width:12%">PREBENDA</div>
						<div class="coluna" style="width:12%">SALDO FINAL</div>						

					</div></b>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

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
					$igreja = $res[$i]['igreja'];
									
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

					$query_con = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_igreja = $res_con[0]['nome'];
						}
					

						if($saldo >= 0){
							$cor_saldo = 'green';
						}else{
							$cor_saldo = 'red';
						}

						if($saldo_final >= 0){
							$cor_saldo_final = 'green';
						}else{
							$cor_saldo_final = 'red';
						}
										
					
				?>

				<section class="area-tab" style="padding-top:5px">					
					<div class="linha-cab">				
						<div class="coluna" style="width:10%"><?php echo $dataF ?></div>

						<div align="center" class="coluna" style="width:30%"><?php echo $nome_igreja ?><br><small>(<?php echo $usuario_cad ?>)</small></div>

						<div class="coluna" style="width:12%; color:red">R$ <?php echo $saidasF ?></div>

						<div class="coluna" style="width:12%; color:green">R$ <?php echo $entradasF ?></div>

						<div class="coluna" style="width:12%; color:<?php echo $cor_saldo ?>">R$ <?php echo $saldoF ?></div>

						<div class="coluna" style="width:12%">R$ <?php echo $prebendaF ?></div>

						<div class="coluna" style="width:12%; color:<?php echo $cor_saldo_final ?>">R$ <?php echo $saldo_finalF ?></div>

						

		

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
				<span class=""> <small><small><small><small>TOTAL DE FECHAMENTOS</small> :  <?php echo $total_reg ?></small></small></small>  </span>
			</div>
		</div>
		<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
		</div>




	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $end_igreja ?> - Telefone: <?php echo $tel_igreja ?> - Pastor Responsável: <?php echo $nome_pastor ?></span> 
	</div>



</body>
</html>
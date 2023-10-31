<?php 
require_once("../conexao.php"); 

$igreja_rec = $_GET['igreja'];
$id = $_GET['id'];
$obs = $_GET['obs'];

$query = $pdo->query("SELECT * FROM membros where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$igreja = $res[0]['igreja'];
$nome_membro = $res[0]['nome'];
$cargo = $res[0]['cargo'];
$data_cad = $res[0]['data_cad'];
$data_batismo = $res[0]['data_batismo'];
$estado = $res[0]['estado_civil'];

$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
$data_batF = implode('/', array_reverse(explode('-', $data_batismo)));

$query = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cargo_membro = $res[0]['nome'];

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
	<title>Carta de Recomendação</title>
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

			
			<div class="coluna titulo_cab" style="width:50%"> <u>CARTA DE RECOMENDAÇÃO</u></div>		
						
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
		<div class="titulo_cab titulo_img"><u>CARTA DE RECOMENDAÇÃO</u></div>	
		<div class="data_img"><small> <small><small><?php echo mb_strtoupper($data_hoje) ?></small></small></small></div>

		<img class="imagem" src="<?php echo $url_sistema ?>img/igrejas/<?php echo $cabecalho_rel ?>">
	<?php } ?>

	<br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>



	<br>
	<div align="center" style="margin-top:20px">
		<u><?php echo mb_strtoupper($nome_membro) ?></u>
	</div>


	<div style="margin:20px">
		<p><small>Saudações no Senhor, <br>
		Apresentamos a <?php echo $nome_igreja ?> localizada em <?php echo $end_igreja ?>!</small></p>
	</div>

	<div style="margin:20px">
		<p><small>
			<b>Função:</b>	<u><?php echo $cargo_membro ?> </u><br>
			<b>Membro Desde:</b>	<u><?php echo $data_cadF ?> </u><br>
			<?php if($data_batismo != "" and $data_batismo != "0000-00-00"){ ?>
				<b>Batizado em:</b>	<u><?php echo $data_batF ?> </u><br>
			<?php } ?>
			<b>Estado Civil:</b>	<u><?php echo $estado ?> </u><br>
		</small></p>
	</div>


	<div style="margin:20px">
		<p><small>
			Por se achar em comunhão com esta igreja, nós o(a) recomendamos, para que o(a) recebais no Senhor, como usam fazer os Santos.
		</small></p>
	</div>


	<div align="center" style="margin-top:-10px">
		<p><small>
			<b>CONGREGAÇÃO: <?php echo mb_strtoupper($igreja_rec) ?></b>
		</small></p>
	</div>

	<div align="center" style="margin:20px">
		<p><small>
			Pela <?php echo $nome_igreja ?>, na data de <u><?php echo date('d/m/Y'); ?></u>
		</small></p>
	</div>


	<div style="margin:20px">
		<p><small>
			OBSERVAÇÕES<br>
			 <?php echo $obs ?>
		</small></p>
	</div>

	<br>
	<div align="center" style="margin:20px">
		<p><small>
			______________________________________________________________________
		<br>
		PASTOR RESPONSÁVEL
		</small></p>
	</div>


	

	<div class="footer"  align="center">
		<span style="font-size:10px">Essa carta de recomendação é válida até 30 dias a partir da data de geração</span> 
	</div>



</body>
</html>
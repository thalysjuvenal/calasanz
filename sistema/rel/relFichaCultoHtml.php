<?php 
require_once("../conexao.php"); 

$id = $_GET['id'];


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


$query = $pdo->query("SELECT * FROM informativos where id = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){		
						$id = $res[0]['id'];
						$preletor = $res[0]['preletor'];
					$data = $res[0]['data'];
					$texto_base = $res[0]['texto_base'];
					$tema = $res[0]['tema'];
					$evento = $res[0]['evento'];
					$horario = $res[0]['horario'];
					
					$pastor_responsavel = $res[0]['pastor_responsavel'];
					$pastores = $res[0]['pastores'];
					$lider_louvor = $res[0]['lider_louvor'];
					$obreiros = $res[0]['obreiros'];
					$apoio = $res[0]['apoio'];
					$abertura = $res[0]['abertura'];
					$recado = $res[0]['recado'];

					$oferta = $res[0]['oferta'];
					$recepcao = $res[0]['recepcao'];
					$bercario = $res[0]['bercario'];
					$escolinha = $res[0]['escolinha'];
					$membros = $res[0]['membros'];
					$visitantes = $res[0]['visitantes'];
					$conversoes = $res[0]['conversoes'];
					$total_ofertas = $res[0]['total_ofertas'];
					$total_dizimos = $res[0]['total_dizimos'];

					if($membros == 0){
						$membros = '';
					}

					if($visitantes == 0){
						$visitantes = '';
					}

					if($conversoes == 0){
						$conversoes = '';
					}

					if($total_ofertas == 0){
						$total_ofertas = '';
					}

					if($total_dizimos == 0){
						$total_dizimos = '';
					}

					$obs = $res[0]['obs'];

					$dataF = implode('/', array_reverse(explode('-', $data)));

					$query_con = $pdo->query("SELECT * FROM pastores where id = '$pastor_responsavel'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_pastor_resp = $res_con[0]['nome'];
					}else{
						$nome_pastor_resp = '';
					}
	}else{
		echo 'Id não reconhecido!';
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Informativo de Culto</title>
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

		.celula{
			padding:10px; 
			height:25px;
			border:1px solid #525252;
		}
		

	</style>


</head>
<body>

	<?php if($cabecalho_rel_img != 'Sim'){ ?>
	<section class="area-cab">
		<div class="cabecalho">

			
			<div class="coluna titulo_cab" style="width:50%"> <u>Informativo de Culto</u></div>		
						
			<div align="right" class="coluna" style="width:50%"> <img style="margin-top:5px" src="<?php echo $url_sistema ?>img/igrejas/<?php echo $imagem_igreja ?>" width="30px"> <?php echo mb_strtoupper($nome_igreja) ?></div>

			
		</div>
	</section>

	<br>

	

	<?php }else{ ?>
		<div class="titulo_cab titulo_img"><u>Informativo de Culto</u></div>	
		

		<img class="imagem" src="<?php echo $url_sistema ?>img/igrejas/<?php echo $cabecalho_rel ?>">
	<?php } ?>

	<br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>

	<div class="mx-2" style="padding-top:10px ">


	<br>

<small>
	<table style="width:100%">
	<tr>
		<td class="celula"><b>Igreja: </b> <?php echo $nome_igreja ?></td>
		<td class="celula"><b>Pregrador:</b> <?php echo $preletor ?></td>
		<td class="celula"><b>Data:</b> <?php echo $dataF ?> </td>
	</tr>

	<tr>
		<td class="celula"><b>Texto Base: </b> <?php echo $texto_base ?></td>		
		<td class="celula"><b>Evento:</b> <?php echo $evento ?> </td>
		<td class="celula"><b>Horário:</b> <?php echo $horario ?></td>
	</tr>

	<tr>
		<td colspan="3" class="celula"><b>Tema: </b> <?php echo $tema ?></td>		
		
	</tr>

	<tr>
		<td class="celula"><b>Pastor Responsável:</b> <?php echo $nome_pastor_resp ?></td>
		<td colspan="2" class="celula"><b>Demais Pastores: </b> <?php echo $pastores ?></td>		
		
	</tr>

	<tr>
		<td class="celula"><b>Líder Louvor:</b> <?php echo $lider_louvor ?></td>
		<td colspan="2" class="celula"><b>Obreiros: </b> <?php echo $obreiros ?></td>		
		
	</tr>

	<tr>
		<td class="celula"><b>Abertura:</b> <?php echo $abertura ?></td>
		<td colspan="2" class="celula"><b>Apoio: </b> <?php echo $apoio ?></td>		
		
	</tr>

	<tr>
		<td class="celula"><b>Recados:</b> <?php echo $recado ?></td>
		<td colspan="2" class="celula"><b>Recepção: </b> <?php echo $recepcao ?></td>		
		
	</tr>

	<tr>
		<td class="celula"><b>Ofertas: </b> <?php echo $oferta ?></td>		
		<td class="celula"><b>Berçário:</b> <?php echo $bercario ?> </td>
		<td class="celula"><b>Escolinha:</b> <?php echo $escolinha ?></td>
	</tr>

	<tr>
		<td colspan="3" class="celula"><b>Observações: </b> <?php echo $obs ?></td>		
		
	</tr>

	<tr>
		<td class="celula"><b>Total Membros: </b> <?php echo $membros ?></td>		
		<td class="celula"><b>Total Visitantes:</b> <?php echo $visitantes ?> </td>
		<td class="celula"><b>Total Conversões:</b> <?php echo $conversoes ?></td>
	</tr>

	<tr>
		<td class="celula"><b>Total Ofertas: </b> <?php echo $total_ofertas ?></td>		
		<td colspan="2" class="celula"><b>Total Dízimos:</b> <?php echo $total_dizimos ?> </td>
		
	</tr>

</table>
</small>

	</div>


		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
		</div>



	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $end_igreja ?> - Telefone: <?php echo $tel_igreja ?> - Pastor Responsável: <?php echo $nome_pastor ?></span> 
	</div>



</body>
</html>
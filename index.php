<?php 
require_once("sistema/conexao.php");

//trazer dados da matriz
$query = $pdo->query("SELECT * FROM igrejas where matriz = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){

$nome_igreja = $res[0]['nome'];
$foto_igreja = $res[0]['imagem'];
$endereco_igreja = $res[0]['endereco'];
$telefone_igreja = $res[0]['telefone'];
$youtube = $res[0]['youtube'];
$instagram = $res[0]['instagram'];
$facebook = $res[0]['facebook'];
$id_igreja = $res[0]['id'];
$pastor_id = $res[0]['pastor'];
$video_igreja = $res[0]['video'];
$email_igreja = $res[0]['email'];
$descricao_igreja = $res[0]['descricao'];

$query = $pdo->query("SELECT * FROM pastores where id = '$pastor_id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$pastor_resp = $res[0]['nome'];




}

$query = $pdo->query("SELECT * FROM igrejas");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$url = $res[0]['url'];
if(@count($res) == 1){
        echo "<script>window.location='igreja$url'</script>";
}
 ?>
<!DOCTYPE html>
<html>
<head>

	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	

	<link href="sistema/img/logo-icone.ico" rel="shortcut icon" type="image/x-icon">
	

	 <meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
		<link rel="stylesheet" href="css/fonts.css" />
		<link rel="stylesheet" href="css/bootstrap.weber.css" />
		<link rel="stylesheet" href="css/fx.css" />
		<link rel="stylesheet" href="css/owl.carousel.css" />
        <link rel="stylesheet" href="css/custom.css?1634436281" />
		<link rel="stylesheet" href="css/index.css?1634436281" />

	<title><?php echo $nome_igreja_sistema ?></title>
</head>
<body>


		<nav id="nav-logo-megamenu-social" class="navbar navbar-expand-lg light fixed-top" style="">
    			<div class="container">
        			<div class="row align-items-center">
            			<div class="col-auto">
                			<a class="navbar-brand" href="#">
                    			<img clas="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-original="assets/44774/images/52602002_2287578111523160_5438567145321529344_n.jpg" height="60px" class="mw-100" alt="logo" srcset="" style="">
                			</a>
                			<p class="navbar-text text-secondary ml-10" style="overflow: visible;"><?php echo $nome_igreja_sistema ?></p>
            			</div>
            			<div class="col-auto ml-auto hidden-lg">
                			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target=".main-menu-collapse" aria-controls="navbarMenuContent" aria-expanded="false" aria-label="Toggle navigation" style=""><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            			</div>
            			<div class="col-lg-auto navbar-collapse main-menu-collapse mr-auto position-inherit collapse" style="">
                			<ul class="navbar-nav" style="">
                    			<li class="nav-item"><strong class=""><mark class="">
                        			<a class="nav-link smooth" href="#header-carousel" style="" target="_self"><span class="text-uppercase">Home</span></a>
                    			</mark></strong></li><li class="nav-item"><strong class=""><mark class="">
                        			<a class="nav-link smooth" href="#blog-3col-carousel" style="" target="_self"><span style="text-transform: uppercase;" class="">Eventos</span></a>
                    			</mark></strong></li>
                    
                    
                    			<li class="nav-item">
                        			<a class="nav-link sub-menu-link" href="#" style=""><strong><span class="text-uppercase">Congregacões</span><svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 16 16" width="16" class="icon icon-pos-right svg-secondary"><path d="m8 11 4-5h-8z" fill-rule="evenodd"></path></svg></strong></a>
                        			<ul class="sub-menu bg-default">
                        				<?php 
	$query = $pdo->query("SELECT * FROM igrejas order by matriz desc, nome asc");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($res);
		for($i=0; $i < $total_reg; $i++){
			foreach ($res[$i] as $key => $value){} 

				$nome = $res[$i]['nome'];
			$url = $res[$i]['url'];
	 ?>
                            			<li class=""><a href="igreja<?php echo $url ?>"><?php echo $nome ?></a></li>
                            			<?php } ?>                           			
                            
                        			</ul>
                    			</li>
                			</ul>
            			</div>
            			<div class="col-auto navbar-collapse main-menu-collapse collapse" style="">
                			<div class="d-inline-block inline-group">
                    
                    			<a target="_blank" href="<?php echo @$facebook ?>"><svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 16 16" width="16" class="icon svg-default"><path d="m8.54611842 16h-7.66304125c-.48785295 0-.88307717-.3954695-.88307717-.8831324v-14.23379728c0-.48778708.3952863-.88307032.88307717-.88307032h14.23390773c.4876667 0 .8830151.39528324.8830151.88307032v14.23379728c0 .487725-.3954105.8831324-.8830151.8831324h-4.0772165v-6.19608178h2.0797387l.3114113-2.41472301h-2.39115v-1.54164808c0-.69911803.1941355-1.1755439 1.1966615-1.1755439l1.2786739-.00055875v-2.15974763c-.2211418-.0294274-.980176-.09517343-1.8632531-.09517343-1.84357263 0-3.10573228 1.12531866-3.10573228 3.19187953v1.78079226h-2.08507782v2.41472301h2.08507782z" fill="#4460a0" fill-rule="evenodd"></path></svg></a>
                    
                    			<a target="_blank" href="<?php echo @$instagram ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="16" viewBox="0 0 16 16" width="16" class="icon svg-default"><radialGradient id="a" cx="1.163903%" cy="98.836097%" r="139.775349%"><stop offset="0" stop-color="#ffc800"></stop><stop offset=".486454468" stop-color="#ff2a7b"></stop><stop offset="1" stop-color="#a000bc"></stop></radialGradient><path d="m8.00001588 0c2.17265372 0 2.44508882.00920925 3.29837392.04814217.8515067.03883765 1.4330552.17408667 1.9419142.37186335.5260707.20441369.9722115.47796031 1.4169867.92270379.4447435.44477523.7182901.89091598.9227355 1.41698671.197745.50885894.332994 1.09040748.3718316 1.94191421.0389329.85328506.0481422 1.12572022.0481422 3.29840565 0 2.17265372-.0092093 2.44508882-.0481422 3.29837392-.0388376.8515067-.1740866 1.4330552-.3718316 1.9419142-.2044454.5260707-.477992.9722115-.9227355 1.4169867-.4447752.4447435-.890916.7182901-1.4169867.9227355-.508859.197745-1.0904075.332994-1.9419142.3718316-.8532851.0389329-1.1257202.0481422-3.29837392.0481422-2.17268543 0-2.44512059-.0092093-3.29840565-.0481422-.85150673-.0388376-1.43305527-.1740866-1.94191421-.3718316-.52607073-.2044454-.97221148-.477992-1.41698671-.9227355-.44474348-.4447752-.7182901-.890916-.92270379-1.4169867-.19777668-.508859-.3330257-1.0904075-.37186335-1.9419142-.03893292-.8532851-.04814217-1.1257202-.04814217-3.29837392 0-2.17268543.00920925-2.44512059.04814217-3.29840565.03883765-.85150673.17408667-1.43305527.37186335-1.94191421.20441369-.52607073.47796031-.97221148.92270379-1.41698671.44477523-.44474348.89091598-.7182901 1.41698671-.92270379.50885894-.19777668 1.09040748-.3330257 1.94191421-.37186335.85328506-.03893292 1.12572022-.04814217 3.29840565-.04814217zm0 1.44143887c-2.13610246 0-2.38913467.0081613-3.23270238.04664963-.7799921.03556678-1.20358605.16589361-1.48548451.27545198-.37341939.14512515-.63991616.31848143-.91984575.59844276-.27996133.27992959-.45331761.54642636-.59844276.91984575-.10955837.28189846-.2398852.70549241-.27545198 1.48548451-.03848833.84356771-.04664963 1.09659992-.04664963 3.23270238 0 2.13607072.0081613 2.38910292.04664963 3.23267062.03556678.7799921.16589361 1.2035861.27545198 1.4854845.14512515.3734194.31851318.6399162.59844276.9198458.27992959.2799613.54642636.4533176.91984575.5984427.28189846.1095584.70549241.2398852 1.48548451.275452.84347244.0384883 1.09644114.0466496 3.23270238.0466496 2.13622952 0 2.38922992-.0081613 3.23267062-.0466496.7799921-.0355668 1.2035861-.1658936 1.4854845-.275452.3734194-.1451251.6399162-.3184814.9198458-.5984427.2799613-.2799296.4533176-.5464264.5984427-.9198458.1095584-.2818984.2398852-.7054924.275452-1.4854845.0384883-.8435677.0466496-1.0965999.0466496-3.23267062 0-2.13610246-.0081613-2.38913467-.0466496-3.23270238-.0355668-.7799921-.1658936-1.20358605-.275452-1.48548451-.1451251-.37341939-.3184814-.63991616-.5984427-.91984575-.2799296-.27996133-.5464264-.45331761-.9198458-.59844276-.2818984-.10955837-.7054924-.2398852-1.4854845-.27545198-.8435677-.03848833-1.0965999-.04664963-3.23267062-.04664963zm0 2.4504556c2.26884272 0 4.10808962 1.8392469 4.10808962 4.10812141 0 2.26884272-1.8392469 4.10808962-4.10808962 4.10808962-2.26887451 0-4.10812141-1.8392469-4.10812141-4.10808962 0-2.26887451 1.8392469-4.10812141 4.10812141-4.10812141zm0 6.77477223c1.47275033 0 2.66665082-1.19390049 2.66665082-2.66665082 0-1.47278209-1.19390049-2.66668255-2.66665082-2.66668255-1.47278209 0-2.66668255 1.19390046-2.66668255 2.66668255 0 1.47275033 1.19390046 2.66665082 2.66668255 2.66665082zm5.23041202-6.9370774c0 .53019901-.4298182.95998539-.9600172.95998539-.5301673 0-.9599854-.42978638-.9599854-.95998539 0-.53019902.4298181-.96001715.9599854-.96001715.530199 0 .9600172.42981813.9600172.96001715z" fill="url(#a)" fill-rule="evenodd"></path></svg></a>
                    
                			</div>
            			</div>
        			</div>
    			</div>
    			<div class="bg-wrap">
        			<div class="bg"></div>
    			</div>
			</nav>



			

			<?php 
	$query = $pdo->query("SELECT * FROM eventos where ativo = 'Sim' and banner != 'sem-foto.jpg' order by id desc limit 4");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){
		?>

			<header id="header-carousel" class="section-carousel overall text-center dark carousel-nav-none carousel-dots-right-bottom pt-0">
    			<div class="carousel-single carousel-stretch owl-drag">

    				<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){} 

							$titulo = $res[$i]['titulo'];
						$subtitulo = $res[$i]['subtitulo'];						
						$data_evento = $res[$i]['data_evento'];
						$id = $res[$i]['id'];
						$banner = $res[$i]['banner'];
						$url = $res[$i]['url'];
						$video = $res[$i]['video'];
						$igreja = $res[$i]['igreja'];


                        $data_banner = $res[$i]['data_banner'];
                    $titulo_banner = $res[$i]['titulo_banner'];
                    $link_banner = $res[$i]['link_banner'];
                    $video_banner = $res[$i]['video_banner'];
                    $subtitulo_banner = $res[$i]['subtitulo_banner'];

                    if($data_banner != ""){
                        $ocultar_data = 'none';
                    }else{
                        $ocultar_data = 'inline-block';
                    }

                    if($titulo_banner != ""){
                        $ocultar_titulo = 'none';
                    }else{
                        $ocultar_titulo = 'inline-block';
                    }

                    if($link_banner != ""){
                        $ocultar_link = 'none';
                    }else{
                        $ocultar_link = 'inline-block';
                    }

                    if($video_banner != ""){
                        $ocultar_video = 'none';
                    }else{
                        $ocultar_video = 'inline-block';
                    }

                    if($subtitulo_banner != ""){
                        $ocultar_subtitulo = 'none';
                    }else{
                        $ocultar_subtitulo = 'inline-block';
                    }

						$data_eventoF = implode('/', array_reverse(explode('-', $data_evento)));

						$query2 = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
					$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					$nome_ig = $res2[0]['nome'];
						?>


    				<div class="item vw-100 d-flex align-items-center pt-md-200 pb-md-200 pt-50 pb-50" style="background-image: url(sistema/img/eventos/<?php echo $banner ?>); background-size: cover; background-position: center center;">
            			<div class="container">
                			<div class="row">
                    			<div class="col" style="">

                                    <div style="display:<?php echo $ocultar_titulo ?>">
                        			<h2 class="mt-sm-75"><strong style="color:#383838"><?php echo $titulo ?></strong></h2><h4 class="mt-sm-75" style="color:#383838"><strong class="">Congregação <?php echo $nome_ig ?></strong></h4>
                                    </div>
                        
                        			<h4 style="display:<?php echo $ocultar_data ?>" class="mb-50" style="color:#383838"><strong class=""><span class="text-uppercase"><?php echo $data_eventoF ?> </span></strong></h4>
                        			<a href="evento-<?php echo $url ?>" class="btn btn-light btn-lg fx-btn-pill" style=""><strong>Detalhes</strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512" class="icon icon-pos-right" srcset=""><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a>
                    			</div>
                			</div>
            			</div>
        			</div>

        		<?php } ?>
        		

        		</div>

    			<div class="bg-wrap">
        			<div class="bg"></div>
    			</div>
			</header>

		<?php } ?>

			<section id="gallery-3col-carousel" class="section-carousel pt-75 light carousel-dots-none carousel-nav-aside-center pb-sm-20 pb-0">
    			<div class="container">
        			<div class="row">

            			<div class="col-12" style="">
                			<h2 class="text-center mt-sm--30" style="">Nossas Congregações</h2>
              			<p class="text-center mt-20 mb-50 mb-sm-30" style="">Visite Nossas congregação para saber os dias de cultos, eventos , avisos, pregações e muito mais.</p>
                
            			</div>

            			<div class="col-12">
                			<div class="carousel-3item pb-50 owl-drag">

                				<?php 

                					$query = $pdo->query("SELECT * FROM igrejas order by matriz desc, nome asc");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($res);
        if($total_reg > 0){
		for($i=0; $i < $total_reg; $i++){
			foreach ($res[$i] as $key => $value){} 

				$nome = $res[$i]['nome'];
			$url = $res[$i]['url'];
			$endereco = $res[$i]['endereco'];
	 ?>


                				<div class="item gallery-item rounded gallery-style-1 border-x2 padding"><a href="index2.html" target="_self" class="smooth">
                        
                        			</a><div class="item-title" style=""><a href="index2.html" target="_self" class="smooth">
                            
                            			<h4 class="text-center" style=""><b class=""><?php echo $nome ?></b></h4>
                            			<p class="small text-center mb-sm-10" style=""><?php echo $endereco ?></p>
                        			</a><a class="btn mb-md-0 text-center btn-sm btn-block smooth btn-outline-dark fx-btn-pill mt-30" href="igreja<?php echo $url ?>" style="" target="_self">Visitar Site<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512" class="icon icon-pos-right" srcset=""><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a></div>
                        			<div class="item-icon">
                            
                        			</div>
                            
                        			</div>

                        				<?php } } ?>


                        		


                        		</div>

                        		<div class="owl-nav"><div class="owl-prev"></div><div class="owl-next"></div></div></div>
            			</div>
        			</div>
    
    			<div class="bg-wrap">
        			<div class="bg"></div>
    			</div>
			</section>


			<?php 
	$query = $pdo->query("SELECT * FROM eventos where ativo = 'Sim' and imagem != 'sem-foto.jpg' order by id desc limit 9");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){
		?>


			<section id="blog-3col-carousel" class="section-carousel pt-50 pb-50 pt-md-100 pb-md-100 light carousel-dots-none carousel-nav-aside-center">
    			<div class="container">
        			<div class="row">

            			<div class="col-12 ml-auto mr-auto" style="">
                			<h2 class="text-center mb-10 mt--30 mt-sm-0" style="">Eventos Gerais</h2><p style="" class="mb-50 text-center">Últimos eventos de nossas Congregações!<br></p>
                			<div class="carousel-3item pb-50 owl-drag">

                				<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){} 

							$titulo = $res[$i]['titulo'];
						$subtitulo = $res[$i]['subtitulo'];						
						$data_evento = $res[$i]['data_evento'];
						$id = $res[$i]['id'];
						$imagem = $res[$i]['imagem'];
						$url = $res[$i]['url'];
						$video = $res[$i]['video'];
						$igreja = $res[$i]['igreja'];

						$data_eventoF = implode('/', array_reverse(explode('-', $data_evento)));

						$query2 = $pdo->query("SELECT * FROM igrejas where id = '$igreja'");
					$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
					$nome_ig = $res2[0]['nome'];
						?>

                				<div class="item gallery-item dark padding-x2 gallery-style-1">
                        			<a href="evento-<?php echo $url ?>" class=""><img class="item-img" class="lazyload" src="sistema/img/eventos/<?php echo $imagem ?>" alt="image"></a>
                        			<div class="item-title" style="">
                            			<h4 class=""><strong class=""><?php echo $titulo ?></strong></h4>
                            			<p class="small mb-0" style="">CONGREGAÇÃO  <?php echo mb_strtoupper($nome_ig) ?><br></p>
                        			</div>
                        			<div class="item-icon">
                            			<ul class="list-inline small text-right">
                                			<li class=""><svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 0 448 512" width="16" class="icon svg-default icon-pos-left" srcset=""><path d="m436 160h-424c-6.6 0-12-5.4-12-12v-36c0-26.5 21.5-48 48-48h48v-52c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128v-52c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48v36c0 6.6-5.4 12-12 12zm-424 32h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48h-352c-26.5 0-48-21.5-48-48v-260c0-6.6 5.4-12 12-12zm116 204c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12z" class=""></path></svg><a href="#" class=""><b class="">&nbsp;<?php echo $data_eventoF ?></b><br></a></li>
                            			</ul><ul class="list-inline text-center lead text-primary">
                                			<li class="" style=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16px" viewBox="0 0 512 512" class="icon svg-default icon-pos-left" srcset=""><path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path></svg><a href="evento-<?php echo $url ?>" class="" style=""><b class="">Ver Evento</b><br></a></li>
                            			</ul>
                        			</div>
                    			</div>

                    		<?php } ?>


                    		</div>
            			</div>
        			</div><div class="col-12 text-center" style="">
                
            			</div>
    			</div>
    			<div class="bg-wrap">
        			<div class="bg"></div>
    			</div>
			</section>


		<?php } ?>
			
		</div>

	

</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCByts0vn5uAYat3aXEeK0yWL7txqfSMX8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrapindex.min.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script src="js/jquery.smooth-scroll.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/countUp-jquery.js"></script>
        <script src="js/jquery.countdown.js"></script>
        <script src="js/custom.js?1634436281"></script>
        <script src="js/index.js?1634436281"></script>
    <script defer src='//s3.sa-east-1.amazonaws.com/cdn.webeditor.link/builder10/v01/lib.min.js'></script><script defer src='//s3.sa-east-1.amazonaws.com/cdn.webeditor.link/builder10/v01/lib.subscribers.min.js'></script><script defer src='//s3.sa-east-1.amazonaws.com/cdn.webeditor.link/builder10/v01/lib.lazyload.min.js'></script>
</html>


	
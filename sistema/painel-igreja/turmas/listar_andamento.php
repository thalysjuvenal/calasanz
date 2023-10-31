<?php 
require_once("../../conexao.php");

$id = @$_POST['id'];

$query = $pdo->query("SELECT * FROM progresso_turma where turma = '$id' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);
if($total_reg > 0){
echo '<small><table class="table table-hover">';
echo '<tr>';
echo '<th>Data</th>';
echo '<th>Ministrador</th>';
echo '<th>Membros</th>';
echo '<th>Arquivo</th>';
echo '<th>Ações</th>';
echo '</tr>';

for($i=0; $i < $total_reg; $i++){
	$data = $res[$i]['data'];	
	$membros = $res[$i]['membros'];
	$ministrador = $res[$i]['ministrador'];
	$conteudo = $res[$i]['conteudo'];
	$obs = $res[$i]['obs'];
	$id_and = $res[$i]['id'];
	$arquivo = $res[$i]['arquivo'];

	//EXTRAIR EXTENSÃO DO ARQUIVO
					$ext = pathinfo($arquivo, PATHINFO_EXTENSION);   
					if($ext == 'pdf'){ 
						$tumb_arquivo = 'pdf.png';
					}else if($ext == 'rar' || $ext == 'zip'){
						$tumb_arquivo = 'rar.png';
					}else if($ext == 'doc' || $ext == 'docx'){
						$tumb_arquivo = 'word.png';
					}else{
						$tumb_arquivo = $arquivo;
					}

	$dataF = implode('/', array_reverse(explode('-', $data)));

	$query_con = $pdo->query("SELECT * FROM membros where id = '$ministrador'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_ministrador = $res_con[0]['nome'];
					}else{
						$nome_ministrador = 'Nenhum';
					}


echo '<tr>';
echo '<td>'.$dataF.'</td>';
echo '<td>'.$nome_ministrador.'</td>';
echo '<td>'.$membros.'</td>';
echo '<td><a href="../img/turmas/'.$arquivo.'" target="_blank">
<img src="../img/turmas/'.$tumb_arquivo.'" width="30px">
</a></td>';
echo '<td><big><a style="text-decoration:none" href="#" onclick="excluirAndamento('.$id_and.')" title="Excluir Registro">	<i class="bi bi-trash text-danger"></i> </a>
	<a style="text-decoration:none" href="#" onclick="dadosAndamento('.$id_and.')" title="Ver Conteúdo">	<i class="bi bi-file-earmark-font text-primary" ></i> </a>
</big></td>';


echo '</tr>';
}

echo '</table></small>';
}else{
	echo '<small>Nenhum Andamento Lançado ainda!</small>';
}

?>


<script type="text/javascript">
	function excluirAndamento(id){
		
    $('#id-excluir-andamento').val(id);
   
    var myModal = new bootstrap.Modal(document.getElementById('modalExcluirAndamento'), {       });
    myModal.show();
    $('#mensagem-excluir-andamento').text('');
    limpar();
}


function dadosAndamento(id){	

	$.ajax({
        url: pag + "/listar_dados_andamento.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (result) {
            	$('#listar_dados_andamento').html(result)    
        },

    });
    
    var myModal = new bootstrap.Modal(document.getElementById('modalDadosAndamento'), {       });
    myModal.show();    
    
}
</script>
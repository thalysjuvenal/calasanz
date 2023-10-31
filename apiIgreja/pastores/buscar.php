<?php 

include_once('../conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);

$buscar = '%' .@$_GET['buscar']. '%';
$id_igreja = @$_GET['igreja']; 

$query = $pdo->prepare("SELECT * FROM coordenadores where (nome LIKE '$buscar' or email LIKE '$buscar' or cpf LIKE '$buscar') and igreja = '$id_igreja' order by nome ASC");

$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {  }

   

    $data_nascF = implode('/', array_reverse(explode('-', $res[$i]['data_nasc'])));
    $data_cadF = implode('/', array_reverse(explode('-', $res[$i]['data_cad'])));
  

    $dados[] = array(
        'id' => $res[$i]['id'],
        'nome' => $res[$i]['nome'],
        'telefone' => $res[$i]['telefone'],
        'email' => $res[$i]['email'],
        
        'foto' => $res[$i]['foto'],
       
        'cpf' => $res[$i]['cpf'],
        'dataCad' => $data_cadF,
        'dataNasc' => $data_nascF,
       
        'endereco' => $res[$i]['endereco'],
        
    );
}

if(count($res) > 0){
    $result = json_encode(array('success'=>true, 'clientes'=>$dados));
}else{
    $result = json_encode(array('success'=>false, 'resultado'=>'0'));
}

echo $result;

?>
<?php 

include_once('../conexao.php');
$postjson = json_decode(file_get_contents('php://input'), true);

$id = @$_GET['id'];

$query = $pdo->prepare("SELECT * from ofertas where id = '$id'");

$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {
    }  
       

    $dados = array(
    'id' => $res[$i]['id'],
    'membro' => $res[$i]['membro'],
    'dataVenc' => $res[$i]['data'],     
    'valor' => $res[$i]['valor'],
    
    
    );
}

if(count($res) > 0){
    $result = json_encode(array('success'=>true, 'dados'=>$dados));
}else{
    $result = json_encode(array('success'=>false, 'resultado'=>'0'));
}

echo $result;

?>
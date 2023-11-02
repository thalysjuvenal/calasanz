<?php
require_once("../../conexao.php");
session_start();
$id_usuario = @$_SESSION['id_usuario'];

$pagina = 'notas_moedas';

$valor_unitario = isset($_POST['valor_unitario']) ? floatval($_POST['valor_unitario']) : 0;
$quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 0;
$dizimo_oferta = isset($_POST['dizimo_oferta']) ? $_POST['dizimo_oferta'] : '';
$membro = isset($_POST['membro']) ? intval($_POST['membro']) : 0;
$data = isset($_POST['data']) ? $_POST['data'] : '';
$igreja = isset($_POST['igreja']) ? $_POST['igreja'] : '';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$valor = $valor_unitario * $quantidade;

if ($id == 0) {
    $query = $pdo->prepare("INSERT INTO $pagina (tesoureiro, quantidade, valorunitario, valortotal, usuario, igreja, data, tipoinfo) VALUES (:membro, :quantidade, :valor_unitario, :valor, :id_usuario, :igreja, :data, :dizimo_oferta)");

    $query->bindParam(':membro', $membro, PDO::PARAM_INT);
    $query->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $query->bindParam(':valor_unitario', $valor_unitario, PDO::PARAM_STR);
    $query->bindParam(':valor', $valor, PDO::PARAM_STR);
    $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $query->bindParam(':igreja', $igreja, PDO::PARAM_STR);
    $query->bindParam(':data', $data, PDO::PARAM_STR);
    $query->bindParam(':dizimo_oferta', $dizimo_oferta, PDO::PARAM_STR);

    $query->execute();
    $ult_id = $pdo->lastInsertId();

    // INSERIR NAS MOVIMENTAÇÕES
    $movimento_query = $pdo->prepare("INSERT INTO movimentacoes (tipo, movimento, descricao, valor, data, usuario, id_mov, igreja) VALUES ('Entrada', 'Contagem', :nome_membro, :valor, :data, :id_usuario, :ult_id, :igreja)");
    $movimento_query->bindParam(':nome_membro', $nome_membro, PDO::PARAM_STR);
    $movimento_query->bindParam(':valor', $valor, PDO::PARAM_STR);
    $movimento_query->bindParam(':data', $data, PDO::PARAM_STR);
    $movimento_query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $movimento_query->bindParam(':ult_id', $ult_id, PDO::PARAM_INT);
    $movimento_query->bindParam(':igreja', $igreja, PDO::PARAM_STR);

    $movimento_query->execute();
} else {
    require_once("../verificar-tesoureiro.php");
    $query = $pdo->prepare("UPDATE $pagina SET membro = :membro, valor = :valor, data = :data, usuario = :id_usuario, igreja = :igreja WHERE id = :id");
    $query->bindParam(':membro', $membro, PDO::PARAM_INT);
    $query->bindParam(':valor', $valor, PDO::PARAM_STR);
    $query->bindParam(':data', $data, PDO::PARAM_STR);
    $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $query->bindParam(':igreja', $igreja, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    $query->execute();

    // ATUALIZAR NAS MOVIMENTAÇÕES
    $movimento_query = $pdo->prepare("UPDATE movimentacoes SET descricao = :nome_membro, valor = :valor, data = :data, usuario = :id_usuario WHERE id_mov = :id AND movimento = 'Oferta'");
    $movimento_query->bindParam(':nome_membro', $nome_membro, PDO::PARAM_STR);
    $movimento_query->bindParam(':valor', $valor, PDO::PARAM_STR);
    $movimento_query->bindParam(':data', $data, PDO::PARAM_STR);
    $movimento_query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $movimento_query->bindParam(':id', $id, PDO::PARAM_INT);

    $movimento_query->execute();
}

echo 'Salvo com Sucesso';
?>

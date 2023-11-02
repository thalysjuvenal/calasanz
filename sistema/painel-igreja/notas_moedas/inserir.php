<?php
require_once("../../conexao.php");
@session_start();
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

$query_con = $pdo->prepare("SELECT nome FROM tesoureiros WHERE id = :membro AND igreja = :igreja");
$query_con->bindParam(":membro", $membro);
$query_con->bindParam(":igreja", $igreja);
$query_con->execute();
$res_con = $query_con->fetch(PDO::FETCH_ASSOC);

$nome_membro = ($res_con) ? $res_con['nome'] : 'Membro Não Informado';

if ($id == 0) {
    $query = $pdo->prepare("INSERT INTO $pagina (tesoureiro, quantidade, valorunitario, valortotal, usuario, igreja, data, tipoinfo) VALUES (:membro, :quantidade, :valor_unitario, :valor, :id_usuario, :igreja, :data, :dizimo_oferta)");
    $query->bindParam(":membro", $membro);
    $query->bindParam(":quantidade", $quantidade);
    $query->bindParam(":valor_unitario", $valor_unitario);
    $query->bindParam(":valor", $valor);
    $query->bindParam(":id_usuario", $id_usuario);
    $query->bindParam(":igreja", $igreja);
    $query->bindParam(":data", $data);
    $query->bindParam(":dizimo_oferta", $dizimo_oferta);
    $query->execute();
    $ult_id = $pdo->lastInsertId();

    // INSERIR NAS MOVIMENTAÇÕES
    $query_movimentacoes = $pdo->prepare("INSERT INTO movimentacoes (tipo, movimento, descricao, valor, data, usuario, id_mov, igreja) VALUES ('Entrada', 'Contagem', :nome_membro, :valor, :data, :id_usuario, :ult_id, :igreja)");
    $query_movimentacoes->bindParam(":nome_membro", $nome_membro);
    $query_movimentacoes->bindParam(":valor", $valor);
    $query_movimentacoes->bindParam(":data", $data);
    $query_movimentacoes->bindParam(":id_usuario", $id_usuario);
    $query_movimentacoes->bindParam(":ult_id", $ult_id);
    $query_movimentacoes->bindParam(":igreja", $igreja);
    $query_movimentacoes->execute();
} else {
    require_once("../verificar-tesoureiro.php");
    $query = $pdo->prepare("UPDATE $pagina SET tesoureiro = :membro, valor = :valor, data = :data, usuario = :id_usuario, igreja = :igreja WHERE id = :id");
    $query->bindParam(":membro", $membro);
    $query->bindParam(":valor", $valor);
    $query->bindParam(":data", $data);
    $query->bindParam(":id_usuario", $id_usuario);
    $query->bindParam(":igreja", $igreja);
    $query->bindParam(":id", $id);
    $query->execute();

    // ATUALIZAR NAS MOVIMENTAÇÕES
    $query_movimentacoes = $pdo->prepare("UPDATE movimentacoes SET descricao = :nome_membro, valor = :valor, data = :data, usuario = :id_usuario WHERE id_mov = :id AND movimento = 'Oferta'");
    $query_movimentacoes->bindParam(":nome_membro", $nome_membro);
    $query_movimentacoes->bindParam(":valor", $valor);
    $query_movimentacoes->bindParam(":data", $data);
    $query_movimentacoes->bindParam(":id_usuario", $id_usuario);
    $query_movimentacoes->bindParam(":id", $id);
    $query_movimentacoes->execute();
}

echo 'Salvo com Sucesso';
?>

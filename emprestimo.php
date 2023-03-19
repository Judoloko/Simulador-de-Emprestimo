<?php

// Recebe os dados do fórmulario 
$nome = $_POST['nome'];
$cliente = $_POST['cliente'];
$serasa = intval($_POST['serasa']);
$parcelas = intval($_POST['parcelas']);
$seguro = $_POST['seguro'] ?? "nao";
$emprestimo = floatval($_POST['emprestimo']);

$taxa_juros = 3;
$tarifa = 0;

// Se não for cliente entra na condição 
if ($cliente === 'nao') {
    $tarifa = 35;

    if (($serasa >= 700) and ($serasa <= 1000)){
        $taxa_juros = 5;
    }
    elseif (($serasa >= 500) and ($serasa <= 699)){
        $taxa_juros = 10;
    }
    elseif (($serasa >= 300) and ($serasa <= 499)){
        $taxa_juros = 15;
    }
    else {
        $taxa_juros = 20;
    }

}
// Calculando o imposto iof
$imposto_iof = $emprestimo * 0.38;

    
// Atribuindo seguro desemprego ou não    
if ($seguro == "sim"){
    $seguro = 49.90;
}   
else{
    $seguro = 0;
}

// Calculando parcelas
$custo_parcela_com_juros = ($emprestimo / $parcelas * (1 + $taxa_juros / 100));

// Calculando custo efetivo total
$custo_efetivo_total = ($custo_parcela_com_juros * $parcelas) + $imposto_iof + $seguro;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Simulador de Empréstimo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="bloco">
            <h1>Resultado do Simulador de Empréstimo</h1>
            <p><label>Nome:</label> <?= $nome; ?></p>
            <p><label>Cliente:</label> <?= $cliente; ?></p>
            <p><label>Quantidade de parcelas:</label> <?= $parcelas; ?></p>
            <p><label>Valor das parcelas:</label> <?= number_format($custo_parcela_com_juros, 2); ?></p>
            <p><label>Taxa de Juros:</label> <?= number_format($taxa_juros, 1); ?></p>
            <p><label>Custo Efetivo Total:</label> <?= number_format($custo_efetivo_total, 2); ?></p>
            <a href="index.html">Voltar</a>
        </div>
    </main>
</body>
</html>
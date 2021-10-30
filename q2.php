/**
 * Implementar uma função que exiba em uma tabela HTML os veículos
 * que pernoitaram no campus em um determinado mês (diferença entre 
 * as datas de saída e entrada maior ou igual a 1).
 */


<?php

/**
 * @throws Exception
 */

function veiculos_pernoitaram($veiculos, $mes)
{
    $arquivo = fopen($veiculos, "r");
    $registrosMes = [];

    fgetcsv($arquivo);
    while ($linha = fgetcsv($arquivo, 9999, ";")) {

        $data = new DateTime($linha[2] . $linha[3]);

        if ($data->format("m") == $mes) {
            array_push($registrosMes, [$linha[0], $data]);
        }
    }

    $copiaRegistros = $registrosMes;
    $pernoites = [];
    foreach ($registrosMes as $ocorrencia) {
        foreach ($copiaRegistros as $copia) {
            if ($ocorrencia[0] == $copia [0] && $ocorrencia[1] < $copia[1] && $ocorrencia[1]->format("d") != $copia[1]->format("d")) {
                if (!in_array($ocorrencia[0], $pernoites)) {
                    array_push($pernoites, $ocorrencia[0]);
                }
            }
        }
    }

    echo "<!DOCTYPE html>
            <html lang='pt-br'>
                <head>
                    <title>Tabela Pernoite</title>
                    <style>
                        table, th, td {
                            border: 1px solid black;
                            border-collapse: collapse;
                        }
                    </style>
                </head>
                <body>
                    <table>
                        <tr><th>Placa</th>";

    foreach ($pernoites as $placa) {
        echo "<tr><td>" .$placa .  "</td></tr>";
    }

    echo "</table></body></html>";
}

veiculos_pernoitaram("dataset.csv", "09");
?>

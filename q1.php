/**
 * Implementar uma função que retorne a quantidade de veículos
 * estacionados no campus em uma determinada data e horário.
 * Utilizar a assinatura abaixo:
 */


<?php

/**
 * @throws Exception
 */

function quantidade_veiculos($veiculos, $data, $hora)
{
    $arquivo = fopen($veiculos, "r");
    $placas = [];
    $dataComparacao = new DateTime($data . $hora);

    fgetcsv($arquivo);
    while ($linha = fgetcsv($arquivo, 9999, ";")) {

        $dataRegistro = new DateTime($linha[2] . $linha[3]);

        if ($dataComparacao >= $dataRegistro) {
            if (in_array($linha[0], $placas)) {
                unset($placas[key($placas)]);
            } else {
                array_push($placas, $linha[0]);
            }
        }
    }
    return sizeof($placas);
}

print_r(quantidade_veiculos("dataset.csv", "17-09-2021", "15:05"));
?>

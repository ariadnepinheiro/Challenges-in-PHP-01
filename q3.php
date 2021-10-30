/**
 * No corpo de uma mensagem, os nomes precedidos por @ representam
 * uma conta de usuário. Assim, implementar uma função que receba uma
 * mensagem (parâmetro string), e retorne um vetor de strings contendo 
 * as contas de usuários citados na mensagem.
 */


<?php

function processa_mensagem($msg): array
{
    $padrao = "/@\w+/";
    preg_match_all($padrao, $msg, $matches);
    $ocorrencias = $matches[0];
    $usuarios = [];
    foreach ($ocorrencias as $item) {
        if (!in_array($item, $usuarios)) {
            array_push($usuarios, $item);
        }
    }
    return $usuarios;
}

$mensagem = "Prezado @Flavio, gostaria de solicitar autorização para @Fulano realizar a operação de débito da conta de @Ciclano e crédito na conta de @Beltrano. Atenciosamente, @Fulano.";
print_r(processa_mensagem($mensagem));
?>

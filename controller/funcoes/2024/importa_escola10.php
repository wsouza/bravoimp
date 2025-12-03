<?php

function escola10($linha, $idPessoa1) { 

    $aCampos = explode("|", '|'.$linha);
    $idPessoa = $idPessoa1;
    
    $obj = new Migracao();
           
    $arrayEducacionais = array(
        'opcao_1' => campoCorrigir($aCampos[90]),
        'opcao_2' => campoCorrigir($aCampos[91]),
        'tbanosletivo_id' => 2023,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos18 = nomeCampos($arrayEducacionais);
    $tabela18 = 'educacenso.tbinfraeducacionais';
    
    $idEduca = $obj->insert($tabela18, $arrayEducacionais, $campos18);
    echo "Registro cadastrado com sucesso id" . $idEduca;
    echo  '<br>';
    
    $arrayModalidades = array(
        'opcao_1' => campoCorrigir($aCampos[92]),
        'opcao_2' => campoCorrigir($aCampos[93]),
        'opcao_3' => campoCorrigir($aCampos[94]),
        'opcao_4' => campoCorrigir($aCampos[95]),
        'org_ciclo' => campoCorrigir($aCampos[96]),
        'loc_diferenciada' => campoCorrigir($aCampos[97]),
        'tbanosletivo_id' => 2023,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos19 = nomeCampos($arrayModalidades);
    $tabela19 = 'educacenso.tbinframodalidades';
    
    $idModa = $obj->insert($tabela19, $arrayModalidades, $campos19);
    echo "Modalidades cadastrado com sucesso id" . $idModa;
    echo  '<br>';

    // Continuação do código com a mesma correção aplicada aos demais arrays...
    // ...

    $arrayAlimentacoes = array(
        'opcao_1' => campoCorrigir($aCampos[89]),
        'tbanosletivo_id' => 2023,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos = nomeCampos($arrayAlimentacoes);
    $tabela = 'educacenso.tbinfraalimentacoes';
    
    $idCampo = $obj->insert($tabela, $arrayAlimentacoes, $campos);
    echo "Alimentacoes cadastrado com sucesso id" . $idCampo;
    echo  '<br>';
    
}
?>

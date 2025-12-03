<?php

function escola00($linha) {

    $aCampos = explode("|", '|'.$linha); 
    
    $arrayPessoa = array(
        'nome' => campoCorrigir($aCampos[6]),
        'data_cad' => '2023-11-27',
        'tipo' => 'J',
        'email' => campoCorrigir($aCampos[17]),
        'situacao' => campoCorrigir($aCampos[3]),
        'origem_gravacao' => 'E'
    );
    
    $campos1 = nomeCampos($arrayPessoa);
    $tabela1 = 'cadastro.tbpessoas';
    $obj = new Migracao();
    $idPessoa = $obj->insert($tabela1, $arrayPessoa, $campos1);
    echo "Escola cadastrada com sucesso id" . $idPessoa;
    echo '<br>';

    $arrayRegistro = array(
        'cod_inep' => campoCorrigir($aCampos[2]),
        'cod_nis' => NULL,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos2 = nomeCampos($arrayRegistro);
    $tabela2 = 'cadastro.tbregistros';
    $idRegistro = $obj->insert($tabela2, $arrayRegistro, $campos2);
    echo "Registro cadastrado com sucesso id" . $idRegistro;
    echo '<br>';

    $arrayEndereco = array(
        'endereco' => campoCorrigir($aCampos[10]),
        'numero' => campoCorrigir($aCampos[11]),
        'complemento' => campoCorrigir($aCampos[12]),
        'bairro' => campoCorrigir($aCampos[13]),
        'cep' => campoCorrigir($aCampos[7]),
        'latitude' => NULL,
        'longitude' => NULL,
        'localizacao_zona' => campoCorrigir($aCampos[19]),
        'tbmunicipio_id' => campoCorrigir($aCampos[8]),
        'tbdistrito_cod' => NULL,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos3 = nomeCampos($arrayEndereco);
    $tabela3 = 'cadastro.tbpessoasenderecos';
    $idEndereco = $obj->insert($tabela3, $arrayEndereco, $campos3);
    echo "Endereço cadastrado com sucesso id" . $idEndereco;
    echo '<br>';

    $arrayFones = array(
        'ddd' => campoCorrigir($aCampos[14]),
        'telefone' => campoCorrigir($aCampos[15]),
        'telefone_publico' => NULL,
        'outro_telefone' => NULL,
        'fax' => NULL,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos4 = nomeCampos($arrayFones);
    $tabela4 = 'cadastro.tbpessoasfones';
    $idFone = $obj->insert($tabela4, $arrayFones, $campos4);
    echo "Telefones cadastrado com sucesso id" . $idFone;
    echo '<br>';

    if ($aCampos[26] == '1') {
        $arrayJuridicas = array(
            'cnpj' => campoCorrigir($aCampos[34]),
            'insc_estadual' => NULL,
            'fantasia' => NULL,
            'capital_social' => NULL,
            'tbpessoa_id' => campoCorrigir($idPessoa)
        );

        $campos5 = nomeCampos($arrayJuridicas);
        $tabela5 = 'cadastro.tbjuridicas';
        $idJuridicas = $obj->insert($tabela5, $arrayJuridicas, $campos5);
        echo "Pessoa Jurídica cadastrado com sucesso id" . $idJuridicas;
        echo '<br>';
    }

    $arrayEscolas = array(
        'dependencia_adm' => campoCorrigir($aCampos[21]),
        'regulamentacao' => campoCorrigir($aCampos[87]),
        'convenio' => NULL,
        'tborgaosregionai_id' => campoCorrigir($aCampos[18]),
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos6 = nomeCampos($arrayEscolas);
    $tabela6 = 'educacenso.tbescolas';
    $idEscola = $obj->insert($tabela6, $arrayEscolas, $campos6);
    echo "Escola cadastrada com sucesso id" . $idEscola;
    echo '<br>';

    if ($aCampos[26] == '1') {
        $arrayPrivadas = array(
            'categoria' => campoCorrigir($aCampos[32]),
            'convenio' => NULL,
            'tbanosletivo_id' => 2022,
            'tbpessoa_id' => campoCorrigir($idPessoa)
        );

        $campos7 = nomeCampos($arrayPrivadas);
        $tabela7 = 'educacenso.tbprivadas';
        $idPrivadas = $obj->insert($tabela7, $arrayPrivadas, $campos7);
        echo "Escola privada cadastrado com sucesso id" . $idPrivadas;
        echo '<br>';

        $arrayMantenedoras = array(
            'opcao_1' => campoCorrigir($aCampos[26]),
            'opcao_2' => campoCorrigir($aCampos[27]),
            'opcao_3' => campoCorrigir($aCampos[28]),
            'opcao_4' => campoCorrigir($aCampos[29]),
            'opcao_5' => campoCorrigir($aCampos[30]),
            'cnpj' => campoCorrigir($aCampos[85]),
            'tbanosletivo_id' => 2022,
            'tbpessoa_id' => campoCorrigir($idPessoa)
        );

        $campos8 = nomeCampos($arrayMantenedoras);
        $tabela8 = 'educacenso.tbmantenedoras';
        $idMantenedoras = $obj->insert($tabela8, $arrayMantenedoras, $campos8);
        echo "Mantenedora cadastrada com sucesso id" . $idMantenedoras;
        echo '<br>';
    }

    $arrayAnoletivo = array(
        'tbanoletivo_id' => 2023,
        'tbpessoa_id' => campoCorrigir($idPessoa)
    );

    $campos9 = nomeCampos($arrayAnoletivo);
    $tabela9 = 'relacionamento.tbpessoas_tbanoletivos';
    $idAnoletivo = $obj->insert($tabela9, $arrayAnoletivo, $campos9);
    echo "Ano letivo cadastrada com sucesso id" . $idAnoletivo;
    echo '<br>';

    return $idPessoa;
}
?>

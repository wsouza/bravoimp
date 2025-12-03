<?php

//função que irá inserir a escola registros 30
function profissionais30($linha)
{


    $pk = 0;
    $contCampos = 0;
    //move a string para o array 
    $aCampos = explode("|", '|' . $linha);


    /*
     * criando o array para insert, pegando array de $aCampos
     */

    if (!empty($aCampos[45]) or !empty($aCampos[47]) or !empty($aCampos[45])) { // se professor
        $origem = 'F';
    } else {
        $origem = 'A';
    }

    $arrayPessoa = array(
        'nome' => campoCorrigir($aCampos[6]),
        'data_cad' => '2023-11-27',
        'tipo' => 'F',
        'email' => campoCorrigir($aCampos[95]),
        'situacao' => 1,
        'origem_gravacao' => $origem
    );

    // pega somente o nome dos campos da array
    $campos1 = nomeCampos($arrayPessoa);

    // pega o nome da tabela
    $tabela1 = 'cadastro.tbpessoas';

    // instanciar objeto e enviar dados a classe
    $obj = new Migracao();

    $idPessoa = $obj->insert($tabela1, $arrayPessoa, $campos1);
    echo "Pessoa cadastrada com sucesso" . ' id' . $idPessoa;
    echo '<br>';


    /**
     * Cadastro dos registros
     */
    $arrayRegistro = array(
        'cod_inep' => campoCorrigir($aCampos[4]),
        'cod_nis' => NULL,
        'tbpessoa_id' => $idPessoa
    );

    // pega somente o nome dos campos da array
    $campos2 = nomeCampos($arrayRegistro);

    // pega o nome da tabela
    $tabela2 = 'cadastro.tbregistros';

    $idRegistro = $obj->insert($tabela2, $arrayRegistro, $campos2);
    echo "Registro cadastrado com sucesso" . ' id' . $idRegistro;
    echo '<br>';

    // FIM REGISTRO


    $arrayFisicas = array(
        'data_nasc' => transformarData(campoCorrigir($aCampos[7])),
        'sexo' => campoCorrigir($aCampos[11]),
        'data_uniao' => NULL,
        'data_obito' => NULL,
        'data_chegada_brasil' => NULL,
        'ultima_empresa' => NULL,
        'data_rev' => NULL,
        'date_cad' => '05/04/2022',
        'nascionalidade' => campoCorrigir($aCampos[13]),
        'raca_cor' => campoCorrigir($aCampos[12]),
        'tbpaise_id' => campoCorrigir($aCampos[14]),
        'tbmunicipio_id' => campoCorrigir($aCampos[15]),
        'tbpessoa_id' => $idPessoa,
        'nome_mae' => campoCorrigir($aCampos[9]),
        //'nome_pai' => campoCorrigir($aCampos[10]),
        'tbestado_id' => NULL,
        'estado_civil' => NULL,
        'profissao' => NULL,
        'outras_informacoes' => NULL,
        'filiacao' => NULL
    );


    // pega somente o nome dos campos da array
    $campos3 = nomeCampos($arrayFisicas);

    // pega o nome da tabela
    $tabela3 = 'cadastro.tbfisicas';

    $idFisica = $obj->insert($tabela3, $arrayFisicas, $campos3);
    echo "Pessoa física DATA DE NASCIMENTO cadastrada com sucesso" . ' id' . $idFisica;
    echo '<br>';


    /**
     * Recursos avaliação alunos
     */
    if ($aCampos[16] == '1') {

        $arrayRecrusos = array(
            'auxilio_ledor' => campoCorrigirZero($aCampos[27]),
            'auxilio_transcricao' => campoCorrigirZero($aCampos[28]),
            'guia_interprete' => campoCorrigirZero($aCampos[29]),
            'interprete_ibras' => campoCorrigirZero($aCampos[30]),
            'leitura_labial' => campoCorrigirZero($aCampos[31]),
            'prova_ampliada18' => campoCorrigirZero($aCampos[32]),
            'prova_superampliada24' => campoCorrigirZero($aCampos[33]),
            'cd_audio' => campoCorrigirZero($aCampos[34]),
            'surdos_deficientes' => campoCorrigirZero($aCampos[35]),
            'video_libras' => campoCorrigirZero($aCampos[36]),
            'prova_braille' => campoCorrigirZero($aCampos[37]),
            'nenhum' => campoCorrigirZero($aCampos[38]),
            'tbpessoa_id' => $idPessoa
        );


        // pega somente o nome dos campos da array
        $campos2r = nomeCampos($arrayRecrusos);

        // pega o nome da tabela
        $tabela2r = 'educacenso.tbv3alunodeficiencias';

        $idRecurso = $obj->insert($tabela2r, $arrayRecrusos, $campos2r);
        echo "RECURSOS DEFICIENTE cadastrado com sucesso" . ' id' . $idRecurso;
        echo '<br>';
    }

    // FIM RECURSOS AVALIAÇÃO

    /**
     * #############################
     * #########  DOCUMENTOS  ######
     * #############################
     */
    $arrayCertidoes = array(
        'certidao_civil' => NULL,
        'tipo_certidao' => NULL,
        'folha' => NULL,
        'livro' => NULL,
        'data_emissao' => NULL,
        'tbcartorio_id' => NULL,
        'numero_matricula' => campoCorrigir($aCampos[39]),
        'tbpessoa_id' => $idPessoa,
        'numero_termo' => NULL,
        'tbestado_id' => NULL,
        'tbmunicipio_id' => NULL
    );


    // pega somente o nome dos campos da array
    $campos2a = nomeCampos($arrayCertidoes);

    // pega o nome da tabela
    $tabela2a = 'cadastro.tbfisicascertidoes';

    $idCert = $obj->insert($tabela2a, $arrayCertidoes, $campos2a);
    echo "Certidão cadastrada com sucesso" . ' id' . $idCert;
    echo '<br>';

    if (!empty($aCampos[5])) { //verifica cpf
        $arrayCpf = array(
            'cpf' => campoCorrigir($aCampos[5]),
            'tbpessoa_id' => $idPessoa
        );

        // pega somente o nome dos campos da array
        $campos3a = nomeCampos($arrayCpf);

        // pega o nome da tabela
        $tabela3a = 'cadastro.tbfisicascpfs';

        $idCpf = $obj->insert($tabela3a, $arrayCpf, $campos3a);
        echo "CPFs cadastrada com sucesso" . ' id' . $idCpf;
        echo '<br>';
    } //verifica cpf

    $arrayPassaporte = array(
        'numero_passaporte' => NULL,
        'tbpessoa_id' => $idPessoa
    );

    // pega somente o nome dos campos da array
    $campos4a = nomeCampos($arrayPassaporte);

    // pega o nome da tabela
    $tabela4a = 'cadastro.tbfisicaspassaportes';

    $idPass = $obj->insert($tabela4a, $arrayPassaporte, $campos4a);
    echo "Passaporte cadastrado com sucesso" . ' id' . $idPass;
    echo '<br>';

    $arrayDocumentos = array(
        'falta_doc' => NULL,
        'tbpessoa_id' => $idPessoa
    );

    // pega somente o nome dos campos da array
    $campos5 = nomeCampos($arrayDocumentos);

    // pega o nome da tabela
    $tabela5 = 'educacenso.tbalunodocumentos';

    $idDoc = $obj->insert($tabela5, $arrayDocumentos, $campos5);
    echo "Documentos cadastrada com sucesso" . ' id' . $idDoc;
    echo '<br>';

    /**
     * Verificar endereço 
     */
    if (!empty($aCampos[43])) {
        $arrayEnderecos = array(
            'endereco' => 'NÃO INFORMADO',
            'numero' => NULL,
            'complemento' => NULL,
            'bairro' => NULL,
            'cep' => campoCorrigir($aCampos[41]),
            'latitude' => NULL,
            'longitude' => NULL,
            'localizacao_zona' => campoCorrigir($aCampos[44]),
            'tbmunicipio_id' => campoCorrigir($aCampos[43]),
            'tbdistrito_cod' => NULL,
            'tbpessoa_id' => $idPessoa,
            'tbestado_id' => $estadoImporte
        );

        // pega somente o nome dos campos da array
        $campos7 = nomeCampos($arrayEnderecos);

        // pega o nome da tabela
        $tabela7 = 'cadastro.tbpessoasenderecos';

        $idEndereco = $obj->insert($tabela7, $arrayEnderecos, $campos7);
        echo "Endereço cadastrado com sucesso" . ' id' . $idEndereco;
        echo '<br>';
    }


    /**
     * #############################
     * ###### FIM DOCUMENTOS  ######
     * #############################
     */
    /**
     * Verificar se profissional OU ALUNO tem deficiencia
     */
    if ($aCampos[16] == '1') {

        $arrayProDeficiencias = array(
            'opcao_1' => 1,
            'opcao_2' => campoCorrigirZero($aCampos[17]),
            'opcao_3' => campoCorrigirZero($aCampos[18]),
            'opcao_4' => campoCorrigirZero($aCampos[19]),
            'opcao_5' => campoCorrigirZero($aCampos[20]),
            'opcao_6' => campoCorrigirZero($aCampos[21]),
            'opcao_7' => campoCorrigirZero($aCampos[22]),
            'opcao_8' => campoCorrigirZero($aCampos[23]),
            'opcao_9' => campoCorrigirZero($aCampos[24]),
            'tbpessoa_id' => $idPessoa
        );
    } else {

        $arrayProDeficiencias = array(
            'opcao_1' => 0,
            'tbpessoa_id' => $idPessoa
        );
    }

    // pega somente o nome dos campos da array
    $campos4 = nomeCampos($arrayProDeficiencias);

    if (!empty($aCampos[47])) { // se professor
        // pega o nome da tabela
        $tabela4 = 'educacenso.tbprodeficiencias';
        $idDeficiencias = $obj->insert($tabela4, $arrayProDeficiencias, $campos4);
        echo "Deficiencias PROFISSIONAIS cadastrada com sucesso" . ' id' . $idDeficiencias;
        echo '<br>';
    } else {
        // pega o nome da tabela
        $tabela4 = 'educacenso.tbalunodeficiencias';

        $idDeficiencias = $obj->insert($tabela4, $arrayProDeficiencias, $campos4);
        echo "Deficiencias ALUNO cadastrada com sucesso" . ' id' . $idDeficiencias;
        echo '<br>';
    }


    /**
     * #############################
     * ####  dados professores  ####
     * #############################
     */
    if (!empty($aCampos[45])) { // se professor

        $arrayVariaveis = array(
            'escolaridade' => campoCorrigir($aCampos[45]),
            'tipo_ensinomedio' => campoCorrigir($aCampos[46]),
            'tbpessoa_id' => $idPessoa
        );

        // pega somente o nome dos campos da array
        $campos3c = nomeCampos($arrayVariaveis);

        // pega o nome da tabela
        $tabela3c = 'educacenso.tbprovariaveis';

        // instanciar objeto e enviar dados a classe
        $obj = new Migracao();

        $idVariavel = $obj->insert($tabela3c, $arrayVariaveis, $campos3c);
        echo "Variável cadastrada com sucesso" . ' id' . $idVariavel;
        echo '<br>';

        if (!empty(trim($aCampos[47]))) { //se possuir ensino superios
            $arrayProSuperiores1 = array(
                'numero_superior' => 1,
                'situacao' => 1,
                'com_pedagogico' => NULL,
                'tbsuperioresocupacoe_id' => NULL,
                'tbsuperioresocupacoe_id2020' => campoCorrigir($aCampos[47]),
                'ano_inicio' => NULL,
                'ano_fim' => campoCorrigir($aCampos[48]),
                'tipo_instituicao' => NULL,
                'tbie_id' => campoCorrigir($aCampos[49]),
                'tbpessoa_id' => $idPessoa
            );

            // pega somente o nome dos campos da array
            $campos1 = nomeCampos($arrayProSuperiores1);

            // pega o nome da tabela
            $tabela1 = 'educacenso.tbprosuperiores';

            $idSuperiores = $obj->insert($tabela1, $arrayProSuperiores1, $campos1);
            echo "PRIMEIRO Curso superior cadastrado com sucesso" . ' id' . $idSuperiores;
            echo '<br>';
        }

        if (!empty(trim($aCampos[50]))) {
            $arrayProSuperiores2 = array(
                'numero_superior' => 2,
                'situacao' => 1,
                'com_pedagogico' => NULL,
                'tbsuperioresocupacoe_id' => NULL,
                'tbsuperioresocupacoe_id2020' => campoCorrigir($aCampos[50]),
                'ano_inicio' => NULL,
                'ano_fim' => campoCorrigir($aCampos[51]),
                'tipo_instituicao' => NULL,
                'tbie_id' => campoCorrigir($aCampos[52]),
                'tbpessoa_id' => $idPessoa
            );


            // pega somente o nome dos campos da array
            $campos2 = nomeCampos($arrayProSuperiores2);

            // pega o nome da tabela
            $tabela2 = 'educacenso.tbprosuperiores';

            $idSup2 = $obj->insert($tabela2, $arrayProSuperiores2, $campos2);
            echo "SEGUNDO Curso superior cadastrado com sucesso" . ' id' . $idSup2;
            echo '<br>';
        }

        if (!empty(trim($aCampos[53]))) {

            $arrayProSuperiores3 = array(
                'numero_superior' => 1,
                'situacao' => 1,
                'com_pedagogico' => NULL,
                'tbsuperioresocupacoe_id' => NULL,
                'tbsuperioresocupacoe_id2020' => campoCorrigir($aCampos[53]),
                'ano_inicio' => NULL,
                'ano_fim' => campoCorrigir($aCampos[54]),
                'tipo_instituicao' => NULL,
                'tbie_id' => campoCorrigir($aCampos[55]),
                'tbpessoa_id' => $idPessoa
            );

            // pega somente o nome dos campos da array
            $campos4 = nomeCampos($arrayProSuperiores3);

            // pega o nome da tabela
            $tabela4 = 'educacenso.tbprosuperiores';

            $idSup4 = $obj->insert($tabela4, $arrayProSuperiores3, $campos4);
            echo "TERCEIRO Curso superior cadastrado com sucesso" . ' id' . $idSup4;
            echo '<br>';
        } // se possuir ensino superior


        $arrayProPos = array(
            'tipo1' => campoCorrigir($aCampos[59]),
            'area1' => campoCorrigir($aCampos[60]),
            'ano1' => campoCorrigir($aCampos[61]),

            'tipo2' => campoCorrigir($aCampos[62]),
            'area2' => campoCorrigir($aCampos[63]),
            'ano2' => campoCorrigir($aCampos[64]),

            'tipo3' => campoCorrigir($aCampos[65]),
            'area3' => campoCorrigir($aCampos[66]),
            'ano3' => campoCorrigir($aCampos[67]),

            'tipo4' => campoCorrigir($aCampos[68]),
            'area4' => campoCorrigir($aCampos[69]),
            'ano4' => campoCorrigir($aCampos[70]),

            'tipo5' => campoCorrigir($aCampos[71]),
            'area5' => campoCorrigir($aCampos[72]),
            'ano5' => campoCorrigir($aCampos[73]),

            'tipo6' => campoCorrigir($aCampos[74]),
            'area6' => campoCorrigir($aCampos[75]),
            'ano6' => campoCorrigir($aCampos[76]),

            'tbpessoa_id' => $idPessoa
        );

        // pega somente o nome dos campos da array
        $campos5 = nomeCampos($arrayProPos);

        // pega o nome da tabela
        $tabela5 = 'educacensov2.tbv2propos';

        if(!empty(campoCorrigir($aCampos[59]))){
            $idPos = $obj->insert($tabela5, $arrayProPos, $campos5);
            echo "Pos-Graduacao cadastrada com sucesso" . ' id' . $idPos;
        }else{
            echo "Não Possui Pos-Graduacao cadastrada com sucesso";
        }
        
        echo '<br>';


        $arrayComplementacao = array(
            'opcao_1' => campoCorrigir($aCampos[56]),
            'opcao_2' => campoCorrigir($aCampos[57]),
            'opcao_3' => campoCorrigir($aCampos[58]),
            'tbpessoa_id' => $idPessoa
        );

        // pega somente o nome dos campos da array
        $campos5co = nomeCampos($arrayComplementacao);

        // pega o nome da tabela
        $tabela5co = 'educacenso.tbv3proformacaocomp';

        $idComple = $obj->insert($tabela5co, $arrayComplementacao, $campos5co);
        echo "Formação/Complementação pedagógica CERTO cadastrada com sucesso" . ' id' . $idComple;
        echo '<br>';


        $arrayProOutrosCursosca = array(
            'opcao_1' => campoCorrigir($aCampos[78]),
            'opcao_2' => campoCorrigir($aCampos[79]),
            'opcao_3' => campoCorrigir($aCampos[80]),
            'opcao_4' => campoCorrigir($aCampos[81]),
            'opcao_5' => campoCorrigir($aCampos[82]),
            'opcao_6' => campoCorrigir($aCampos[83]),
            'opcao_7' => campoCorrigir($aCampos[84]),
            'opcao_8' => campoCorrigir($aCampos[85]),
            'opcao_9' => campoCorrigir($aCampos[86]),
            'opcao_10' => campoCorrigir($aCampos[87]),
            'opcao_11' => campoCorrigir($aCampos[88]),
            'opcao_12' => campoCorrigir($aCampos[89]),
            'opcao_13' => campoCorrigir($aCampos[90]),
            'opcao_14' => campoCorrigir($aCampos[91]),
            'area_conhecimento1' => campoCorrigir($aCampos[92]),
            'opcao_15' => campoCorrigir($aCampos[93]),
            'tbpessoa_id' => $idPessoa
        );

        // pega somente o nome dos campos da array
        $campos6ca = nomeCampos($arrayProOutrosCursosca);

        // pega o nome da tabela
        $tabela6ca = 'educacenso.tbprooutroscursos';

        $idOutros = $obj->insert($tabela6ca, $arrayProOutrosCursosca, $campos6ca);
        echo "OUTROS CURSOS cadastrado com sucesso" . ' id' . $idOutros;
        echo '<br>';
    } //se professor

    /**
     * #############################
     * ### FIM dados professores ###
     * #############################
     */
    return $idPessoa;
}

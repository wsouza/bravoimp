<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//função que irá inserir a escola registros 00
function turma20($linha) {
    
    $pk = 0;
    $contCampos = 0;
    //move a string para o array 
    $aCampos = explode("|", '|'.$linha);
    
    // instanciar objeto e enviar dados a classe
    $obj = new Migracao();
        
    if(!empty($obj->verescola(campoCorrigir($aCampos[2])))){
        
    $idPessoa1  = $obj->verescola(campoCorrigir($aCampos[2]));
    /*
     * criando o array para insert, pegando array de $aCampos
     */
    $hora_inicio = $aCampos[7] . ':' . $aCampos[8];
    $hora_fim = $aCampos[9] . ':' . $aCampos[10];

    $arrayTurma = array(
        'cod_inep' => campoCorrigir($aCampos[4]),
        'nome' => campoCorrigir(utf8_decode($aCampos[5])),
        'hora_inicio' => $hora_inicio,
        'hora_fim' => $hora_fim,
        //etapa_ensino => NULL,
        'tbanosletivo_id' => 2024, 
        'tbpessoa_id' => $idPessoa1 // id da escola
    );

    // pega somente o nome dos campos da array
    $campos1 = nomeCampos($arrayTurma);

    // pega o nome da tabela
    $tabela1 = 'educacenso.tbturmadados';

    // instanciar objeto e enviar dados a classe
    $obj = new Migracao();

    $idTurma = $obj->insert($tabela1, $arrayTurma, $campos1);
    echo "Turma dados cadastrada com sucesso" . ' id' . $idTurma;
    echo '<br>';

    $arrayTurmaDias = array(
        'opcao_1' => campoCorrigir($aCampos[11]),
        'opcao_2' => campoCorrigir($aCampos[12]),
        'opcao_3' => campoCorrigir($aCampos[13]),
        'opcao_4' => campoCorrigir($aCampos[14]),
        'opcao_5' => campoCorrigir($aCampos[15]),
        'opcao_6' => campoCorrigir($aCampos[16]),
        'opcao_7' => campoCorrigir($aCampos[17]),
        'tipo_atendimento' => campoCorrigir($aCampos[18]),
        'tbturmadado_id' => $idTurma,
        'prog_ensino_medio' => '0'
    );

    // pega somente o nome dos campos da array
    $campos2 = nomeCampos($arrayTurmaDias);

    // pega o nome da tabela
    $tabela2 = 'educacenso.tbturmadias';

    $idDias = $obj->insert($tabela2, $arrayTurmaDias, $campos2);
    echo "Turma dias cadastrada com sucesso" . ' id' . $idDias;
    echo '<br>';

//    $arrayComplementar = array(
//        opcao_1 => campoCorrigir($aCampos[20]),
//        opcao_2 => campoCorrigir($aCampos[21]),
//        opcao_3 => campoCorrigir($aCampos[22]),
//        opcao_4 => campoCorrigir($aCampos[23]),
//        opcao_5 => campoCorrigir($aCampos[24]),
//        opcao_6 => campoCorrigir($aCampos[25]),
//        tbturmadado_id => $idTurma
//    );
//
//    // pega somente o nome dos campos da array
//    $campos3 = nomeCampos($arrayComplementar);
//
//    // pega o nome da tabela
//    $tabela3 = 'educacenso.tbturmaacomplementares';
//
//    $idComp = $obj->insert($tabela3, $arrayComplementar, $campos3);
//    echo "Atividades complementar cadastrada com sucesso" . ' id' . $idComp;
//    echo '<br>';
    
    /**
     * Informar e corrigir etapa
     */
    $corrigiretapa = CorrecaoEtapa($aCampos[32]);

    $arrayAees = array(
        'modalidade' => campoCorrigir($aCampos[31]),
        'tbturmadado_id' => $idTurma,
        'tbetapasmodalidade_cod_etapa' => campoCorrigir($corrigiretapa)
    );

    // pega somente o nome dos campos da array
    $campos4 = nomeCampos($arrayAees);

    // pega o nome da tabela
    $tabela4 = 'educacenso.tbturmaaees';

    $idAees = $obj->insert($tabela4, $arrayAees, $campos4);
    echo "Aees cadastrada com sucesso" . ' id' . $idAees;
    echo '<br>';

//    $arrayDisciplina = array(
//        opcao_1 => campoCorrigir($aCampos[40]),
//        opcao_2 => campoCorrigir($aCampos[41]),
//        opcao_3 => campoCorrigir($aCampos[42]),
//        opcao_4 => campoCorrigir($aCampos[43]),
//        opcao_5 => campoCorrigir($aCampos[44]),
//        opcao_6 => campoCorrigir($aCampos[45]),
//        opcao_7 => campoCorrigir($aCampos[46]),
//        opcao_8 => campoCorrigir($aCampos[47]),
//        opcao_9 => campoCorrigir($aCampos[48]),
//        opcao_10 => campoCorrigir($aCampos[49]),
//        opcao_11 => campoCorrigir($aCampos[50]),
//        opcao_12 => campoCorrigir($aCampos[51]),
//        opcao_13 => campoCorrigir($aCampos[52]),
//        opcao_14 => campoCorrigir($aCampos[53]),
//        opcao_15 => campoCorrigir($aCampos[54]),
//        opcao_16 => campoCorrigir($aCampos[55]),
//        opcao_17 => campoCorrigir($aCampos[56]),
//        opcao_18 => campoCorrigir($aCampos[57]),
//        opcao_19 => campoCorrigir($aCampos[58]),
//        opcao_20 => campoCorrigir($aCampos[59]),
//        opcao_21 => campoCorrigir($aCampos[60]),
//        opcao_22 => campoCorrigir($aCampos[61]),
//        opcao_23 => campoCorrigir($aCampos[62]),
//        opcao_24 => campoCorrigir($aCampos[63]),
//        opcao_25 => campoCorrigir($aCampos[64]),
//        opcao_26 => campoCorrigir($aCampos[65]),
//        profissional_sala => campoCorrigir($aCampos[66]),
//        tbturmadado_id => $idTurma
//    );
//
//    $campos5 = nomeCampos($arrayDisciplina);
//
//    $tabela5 = 'educacenso.tbturmadisciplinas';
//
//    $idDisci = $obj->insert($tabela5, $arrayDisciplina, $campos5);
        echo "Disciplinas turma cadastrada com sucesso" . ' id' . $idDisci;
        echo '<br>';
    }else{
        echo "Turma não encontrada";    
    }
}
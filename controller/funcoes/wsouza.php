<?php
/*
 * Função WSouza
 * função para tratar o array de insert e retirar somente os nomes dos campos
 */

function nomeCampos($camposObrigatorios) {
    
    $camposObrigatoriosc = array_filter($camposObrigatorios);
    
    foreach ($camposObrigatoriosc as $chave => $valor) {
        $item[] = $chave;
    }
// função join pega dados da array e cria lista com ','
    return join(",", $item);
}

function campoCorrigir($campo){
    if($campo == ''){
        $valor = NULL;
    }elseif($campo == ' '){
        $valor = NULL;
    }else{
        $valor = $campo;
    }
    return $valor;
}

function campoCorrigirBranco($campo){
    if(!empty($campo)){
        $valor = $campo;
    }else{
        $valor = NULL;
    }
    return $valor;
}

function campoCorrigir2($campo){
    if(!empty($campo)){
        $valor = $campo;
    }else{
        $valor = '2';
    }
    return $valor;
}

function campoCorrigirEstado($campo){
    if(!empty($campo)){
        $valor = $campo;
    }else{
        $valor = '29';
    }
    return $valor;
}

function campoCorrigirZero($campo){
    if(!empty($campo)){
        $valor = $campo;
    }elseif($campo == '0'){
        $valor = '0';
    }else{
        $valor = '0';
    }
    return $valor;
}

function CorrecaoEtapa($param) {
    switch ($param) {
        case '69':
            return '43';
            break;

        case '70':
            return '44';
            break;

        case '72':
            return '51';
            break;

        default:
            return $param;
            break;
    }
}

function transformarData($data) {
    $formatoOrigem = 'd/m/Y';
    $formatoDestino = 'Y-m-d';

    $dataObj = DateTime::createFromFormat($formatoOrigem, $data);

    if ($dataObj && $dataObj->format($formatoOrigem) == $data) {
        return $dataObj->format($formatoDestino);
    } else {
        return NULL; // Retornar false se a data for inválida
    }
}
<?php

//---- ABRIR ARQUIVO----
// chamando a classe do insert
// dentro da classe insert eu chamo a conexao
include '../model/Migracao.php';

//INFORME O ESTADO
/*
* 11	"Rondônia"	"RO"
12	"Acre"	"AC"
13	"Amazonas"	"AM"
14	"Roraima"	"RR"
15	"Pará"	"PA"
16	"Amapá"	"AP"
17	"Tocantins"	"TO"
21	"Maranhão"	"MA"
22	"Piauí"	"PI"
23	"Ceará"	"CE"
24	"Rio Grande do Norte"	"RN"
25	"Paraíba"	"PB"
26	"Pernambuco"	"PE"
27	"Alagoas"	"AL"
28	"Sergipe"	"SE"
29	"Bahia"	"BA"
31	"Minas Gerais"	"MG"
32	"Espírito Santo"	"ES"
33	"Rio de Janeiro"	"RJ"
35	"São Paulo"	"SP"
41	"Paraná"	"PR"
42	"Santa Catarina"	"SC"
43	"Rio Grande do Sul"	"RS"
50	"Mato Grosso do Sul"	"MS"
51	"Mato Grosso"	"MT"
52	"Goiás"	"GO"
53	"Distrito Federal"	"DF"
99	"Exterior"	"XX"
*/
$estadoImporte = 26; // informar o estado de importação
 
/*
 * Pegando o arquivo direto em uma pasta na unidade C:
 * crie esta pasta e salve o arquivo de importação nela
 * com o nome arquivo.txt
 */

//https://wsouza.unibravo.com.br/bravoimp/controller/Migrar_all.php
$file = fopen("/home/wsouza/web/bravoimp/arq/lagoagrandepe.txt", "r");

include 'funcoes/wsouza.php';

include 'funcoes/2024/importa_escola00.php';
include 'funcoes/2024/importa_turma20.php';
include 'funcoes/2024/importa_pessoas30.php';

/*
 * 
 */

$idPessoa2 = 1;
$idPessoa = 1;
$arrayusuario = [];
$errosImportacao = [];
$totalEscolas = 0;
$totalTurmas = 0;
$totalPessoas = 0;
$duplicadosPessoas = 0;
$linhaNumero = 0;
$registrosProcessados = [
    '00' => 0,
    '20' => 0,
    '30' => 0,
];

echo "<h3>Iniciando importação do arquivo Educacenso 2024</h3>";

// ler arquivo ate o fim
while (($linha = fgets($file, 4096)) !== false) {
    $linhaNumero++;

    $linhaTrim = trim($linha);
    if ($linhaTrim === '') {
        continue;
    }

    $aCampos2 = explode("|", '|' . $linhaTrim);
    $tipoRegistro = substr($linhaTrim, 0, 2);

    if (isset($registrosProcessados[$tipoRegistro])) {
        $registrosProcessados[$tipoRegistro]++;
    }

    //dados escola
    if ($tipoRegistro === '00') {
        // envio a linha para a função que irá inserir a escola
        try {
            $idPessoa1 = escola00($linhaTrim);
            $totalEscolas++;
            echo "Linha {$linhaNumero}: Escola importada (ID {$idPessoa1}).<br>";
        } catch (Throwable $th) {
            $errosImportacao[] = [
                'linha' => $linhaNumero,
                'tipo' => 'Escola',
                'mensagem' => $th->getMessage()
            ];
        }
    }

    //turma
    if ($tipoRegistro === '20') {
        // envio a linha para a função que irá inserir a escola
        try {
            $idturma = turma20($linhaTrim);
            $totalTurmas++;
            echo "Linha {$linhaNumero}: Turma importada (ID {$idturma}).<br>";
        } catch (Throwable $th) {
            $errosImportacao[] = [
                'linha' => $linhaNumero,
                'tipo' => 'Turma',
                'mensagem' => $th->getMessage()
            ];
        }
    }

    //evitando duplicidade
    if ($tipoRegistro === '30') {
        $identificador = $aCampos2[4] ?? null;

        if ($identificador === null) {
            $errosImportacao[] = [
                'linha' => $linhaNumero,
                'tipo' => 'Pessoa física',
                'mensagem' => 'Identificador da pessoa não encontrado na linha.'
            ];
            continue;
        }

        if (in_array($identificador, $arrayusuario)) {
            $duplicadosPessoas++;
            echo "Linha {$linhaNumero}: Pessoa física duplicada ignorada (identificador {$identificador}).<br>";
            continue;
        }

        // PROFISSIONAIS
        try {
            $idPessoa = profissionais30($linhaTrim);
            $totalPessoas++;
            array_push($arrayusuario, $identificador);
            echo "Linha {$linhaNumero}: Pessoa física importada (ID {$idPessoa}).<br>";
        } catch (Throwable $th) {
            $errosImportacao[] = [
                'linha' => $linhaNumero,
                'tipo' => 'Pessoa física',
                'mensagem' => $th->getMessage()
            ];
        }
    }

}

fclose($file);

echo "<hr>";
echo "<h3>Resumo da importação</h3>";
echo "<ul>";
echo "<li>Escolas importadas: {$totalEscolas}</li>";
echo "<li>Turmas importadas: {$totalTurmas}</li>";
echo "<li>Pessoas físicas importadas: {$totalPessoas}</li>";
echo "<li>Registros lidos - 00: {$registrosProcessados['00']}, 20: {$registrosProcessados['20']}, 30: {$registrosProcessados['30']}</li>";
echo "<li>Pessoas físicas ignoradas por duplicidade: {$duplicadosPessoas}</li>";
echo "</ul>";

if (!empty($errosImportacao)) {
    echo "<h4>Ocorrências durante a importação</h4>";
    echo "<ol>";
    foreach ($errosImportacao as $erro) {
        echo "<li><strong>Linha {$erro['linha']}</strong> ({$erro['tipo']}): {$erro['mensagem']}</li>";
    }
    echo "</ol>";
} else {
    echo "<p>Importação concluída sem erros.</p>";
}

echo "<h4>Identificadores de pessoas processados (para depuração)</h4>";
echo "<pre>";
print_r($arrayusuario);
echo "</pre>";



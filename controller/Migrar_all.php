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
$estadoImporte = 31;
 
/*
 * Pegando o arquivo direto em uma pasta na unidade C:
 * crie esta pasta e salve o arquivo de importação nela
 * com o nome arquivo.txt
 */

//https://wsouza.unibravo.com.br/sipfmigrar2023/controller/Migrar_all.php
$file = fopen("/home/wsouza/web/sipfmigrar2023/arq/lagoagrandepe.txt", "r");

include 'funcoes/wsouza.php';

include 'funcoes/importa_escola00.php';

include 'funcoes/importa_turma20.php';

//include 'funcoes/importa_escola10.php';

include 'funcoes/importa_pessoas30.php';

/*
 * 
 */

$idPessoa2 = 1;
$idPessoa = 1;
$arrayusuario = [];
// ler arquivo ate o fim
while (!feof($file)) {

    //lê a linha que esta no ponteiro
    $linha = fgets($file, 4096);
    
    $aCampos2 = explode("|", '|' . $linha);
    
    //dados escola
    if (substr($linha, 0, 2) == '00') {
        // envio a linha para a função que irá inserir a escola
        $idPessoa1 = escola00($linha);
    }
    
    //turma
    if (substr($linha, 0, 2) == '20') {
        // envio a linha para a função que irá inserir a escola
        $idturma = turma20($linha);
    }

    //evitando duplicidade
    if (!in_array($aCampos2[4], $arrayusuario)) {

        // PROFISSIONAIS
        if (substr($linha, 0, 2) == '30') {
            // envio a linha para a função que irá inserir a escola
            $idPessoa = profissionais30($linha);
            array_push($arrayusuario, $idPessoa);
        }
        
    }
    
}

fclose($file);

echo "<br>";
echo "<pre>";
print_r($arrayusuario);
echo "</pre>";



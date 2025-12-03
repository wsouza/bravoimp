<?php
//incluindo a classe. verifique se diretorio e versao sao iguais, altere se precisar
include('phplot/phplot.php');
//Matriz utilizada para gerar os graficos
$data = array(
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
    array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2),
array('ESCOLAS DA REDE MUNICIPAL', 20, 2)
);
#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(1040,600);
#Tipo de borda, consulte a documentacao
$plot->SetImageBorderType('plain');
// define o formato do arquivo da imagem
$plot->SetFileFormat("png");
#Tipo de grafico, nesse caso barras, existem diversos(pizza…)
$plot->SetPlotType('bars');
#Tipo de dados, nesse caso texto que esta no array
$plot->SetDataType('text-data');
#Setando os valores com os dados do array
$plot->SetDataValues($data);
#Titulo do grafico
$plot->SetTitle('Qtd. de Alunos por Escola');
#Legenda, nesse caso serao tres pq o array possui 3 valores que serao apresentados
$plot->SetLegend(array('Alunos','Professores'));
#Utilizados p/ marcar labels, necessario mas nao se aplica neste ex. (manual) :
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

//ignora a saida para o browser e permite a saida em arquivo
$plot->SetIsInline(true);
 
//chama a saida para arquivo, no caso aqui no diretorio corrente
$plot->SetOutputFile('grafico_vendas_blog.png');

#Gera o grafico na tela
$plot->DrawGraph();
?>
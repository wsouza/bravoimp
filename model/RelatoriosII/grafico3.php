<?php
//incluindo a classe. verifique se diretorio e versao sao iguais, altere se precisar
include('phplot/phplot.php');
//Matriz utilizada para gerar os graficos
$data = array(
array('Jan', 20, 2, 4), array('Fev', 30, 3, 4), array('Mar', 20, 4, 14),
array('Abr', 30, 5, 4), array('Mai', 13, 6, 4), array('Jun', 37, 7, 24),
);
#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(1040,400);
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
$plot->SetTitle('Cadastro de usuários no Site');
#Legenda, nesse caso serao tres pq o array possui 3 valores que serao apresentados
$plot->SetLegend(array('Estudantes','Colunistas', 'Desenvolvedores'));
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
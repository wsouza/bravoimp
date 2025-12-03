 <?php

# Exemplo de gráfico em um arquivo PDF
# Ubuntu para Iniciantes - 10/2012
# http:ubuntuiniciantes.blogspot.com
# twitter : http://twitter.com/iniciantesUbunt
# faceboock: http://www.facebook.com/iniciantes.doubuntu
# Compartilhe Conhecimento

 //gerar grafico
require_once "grafico.php";

 ////inclusão da rotina para gerar e salvar o gráfico em um diretório
 require_once "fpdf/fpdf.php";

 //criar um objeto para gerar o arquivo pdf
  $relPDF = new fpdf();

 // pagina no formato retrato (Portrait) , tipo A4
   $relPDF->addPage('L','A4');


   //setar um estilo de fonte, fonte verdana, estilo bold "negrito", tamanho 14
   $relPDF->setFont('Times','b','16');
   $titulo = utf8_decode('RELATÓRIO DE VENDAS');
   $relPDF->Cell(0 , 0, $titulo , 0, 5, 'C');

  //espaço de 10 linhas;
   $relPDF->ln(5);

 //setar um estilo de fonte, fonte verdana, estilo bold "negrito", tamanho 14
   $relPDF->setFont('Times','b','14');

 //o método multicell permite escrever em varias linha sem quebrar a célula
 //use a função utf8_decode se tiver problemas com acentuação

  $texto = utf8_decode('DEUS SEJA LOUVADO');
 
  $relPDF->multicell(0, 5, $texto , 0 , 'J');

  $relPDF->ln(10);

  $relPDF->Image('grafico_vendas_blog.png',10,30,null,null,'PNG');

  
  //espaço de 80 linhas;  $relPDF->ln(80);
  /*
  $relPDF->setFont('Times','i','8');
  
  $autor= 'Marcelo Weihmayr';
  $blog = 'http://ubuntuiniciantes.blogspot.com';
  $faceboock ='http://www.facebook.com/iniciantes.doubuntu';
  $twitter = 'https://twitter.com/'; 
  
  $relPDF->cell(0, 5, 'Autor: '.$autor, 0 , 5,'R');
  $relPDF->cell(0, 5, 'Blog : '.$blog, 0 , 5,'R');
  $relPDF->cell(0, 5, 'Facebook : '.$faceboock, 0 , 5,'R');
  $relPDF->cell(0, 5, 'Twitter  : '.$twitter, 0 , 5,'R');
    */
 // saida para downlod do arquivo
 $relPDF->output();
  
?>
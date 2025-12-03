<?php 
$linha = "30|26037823||191469411007||ENZO NASCIMENTO CAMPOS|21/03/2017|1|LAILA NASCIMENTO CAMPOS||1|3|1|76|2611101|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0||76|56395000|2608750|2|8|||||||||||||||||||||||||||||||||0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|";
$aCampos = explode("|", '|'.$linha); //2015 e 2020
//$aCampos = explode("|", $linha); //2016
//$aCampos = explode("|", $linha); //2019

for ($i = 1; $i <= count($aCampos); $i++) {
    echo "Posição: {$i} = ".$aCampos[$i].'<br>';
}

echo "#########";
echo "Total de campos: ".count($aCampos);

?>
<?php

require_once 'Conexao.php';
require_once 'Model.php';

class Migracao implements Model {

    public function __construct() {
        
    }

    public function delete($id) {
        
    }

    public function insert($tabela, $dados, $campos) {
        
        $dadosc = array_filter($dados);

        // criando os value value(?,?,?)
        foreach ($dadosc as $chave => $valor) {
            $item[] = "?";
        }
        $valu = join(",", $item);

        // preparando numeração do bindParam
        $sw = 1;

        $con = Conexao::getConexao();
        
        try {
            $con->beginTransaction();
            //cena do proximo episodio!!!
            $stmt = $con->prepare("INSERT INTO $tabela ($campos)VALUES($valu) RETURNING id");

            // criando os bindParam para o value
            foreach ($dadosc as $chave => $valor) {
                $camp[] = $stmt->bindParam($sw++, $dadosc[$chave]);
                $campverlog[] = $dadosc[$chave];
            }

            // chamando todos os bindParam
            $campc = join(",", $campverlog);

            $stmt->execute();
            $con->commit();
            
            // retorna o id
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            return $result["id"]; 
             
            
        } catch (PDOException $e) {
            
            echo "<br><br><strong>";
            echo "O Sistema Wsouza encontrou um erro na tabela {$tabela}, campos {$campos}<br>";
            echo $e->getMessage();
            echo "<br><br></strong>";
            echo "<br><br><strong>";
            echo $campc;
            echo "<br><br></strong>";
            echo "<br><br>";
            print_r($dados);
            echo "<br><br>";
            $con->rollBack();
        }
    }

    public function verturma($cod_turma) {
        
        $con = Conexao::getConexao();
        
        $con->beginTransaction();
        //cena do proximo episodio!!!
        $stmt = $con->prepare("SELECT id FROM educacenso.tbturmadados WHERE cod_inep = {$cod_turma}");
        $stmt->execute();
        $con->commit();

        // retorna o id
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result["id"]; 
        
    }
    
    public function verescola($codinep_escola) {
        
        $con = Conexao::getConexao();
        
        $con->beginTransaction();
        //cena do proximo episodio!!!
        $stmt = $con->prepare("SELECT tbpessoa_id FROM cadastro.tbregistros WHERE cod_inep = {$codinep_escola} LIMIT 1;");
        $stmt->execute();
        $con->commit();

        // retorna o id
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result["tbpessoa_id"]; 
        
    }
    
    public function veraluno($codinep_aluno) {
        
        $con = Conexao::getConexao();
        
        $con->beginTransaction();
        //cena do proximo episodio!!!
        $stmt = $con->prepare("SELECT tbpessoa_id FROM cadastro.tbregistros WHERE cod_inep = {$codinep_aluno} LIMIT 1;");
        $stmt->execute();
        $con->commit();

        // retorna o id
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result["tbpessoa_id"]; 
        
    }
    
    public function select($sql) {
        
    }

    public function update($dados) {
        
    }

}

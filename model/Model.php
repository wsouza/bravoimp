<?php

interface Model {
    // alterei model para aceitar meu código maluco
    public function insert($tabela,$dados,$campos);

    public function update($dados);

    public function delete($id);

    public function select($params);
    
    
}

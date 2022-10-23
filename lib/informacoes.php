<?php 

class Informacoes{

    private $db;

    public function __construct()
    {
        $init = new Ramais();
        $this->db = new Database;
    }

    public function obterDados()
    {
        return $this->db->consultarTudo();
    }
}

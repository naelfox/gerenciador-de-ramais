<?php 

namespace Lib;
class Informacoes{

    private $db;

    public function __construct()
    {
        new Ramais();
        $this->db = new Database;
    }

    public function obterDados()
    {
        return $this->db->consultarTudo();
    }
}

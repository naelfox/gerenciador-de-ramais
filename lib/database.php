<?php

class Database
{

    private $conn;

    public function __construct()
    {
        extract($this->obterAcessos());
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    private function obterAcessos()
    {
        Environment::carregarVariaveis();
        return array(
            'host' => getenv('DB_HOST'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'database' => getenv('DB_DATABASE')
        );
    }

    public function consultarTudo()
    {
        $sql = "SELECT * FROM ramais";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir()
    {
    }

 /*

criar um CRUD
 */
}

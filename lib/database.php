<?php

namespace Lib;
use PDO;
use PDOException;
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
        $sql = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return array_filter($sql);
    }

    public function consultaRamais()
    {
        $sql = "SELECT name FROM ramais";
        $ramaisName = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ramaisName as $key => $ramal) {
            $ramaisName[$key] = $ramal['name'];
        }

        return $ramaisName;
    }

    public function mesclarDadosNoBanco(array $dados)
    {
        $ramaisDoBanco = $this->consultaRamais();

        foreach ($dados as $ramalDados) {
            if (in_array($ramalDados['name'], $ramaisDoBanco)) {
                $this->atualizar($ramalDados);
                $index = array_search($ramalDados['name'], $ramaisDoBanco);
                unset($ramaisDoBanco[$index]);
            } else {
                $this->inserir($ramalDados);
            }
        }

        if (count($ramaisDoBanco) > 0) {
            foreach ($ramaisDoBanco as $ramal) {
                $this->deletar($ramal);
            }
        }
    }

    public function inserir(array $dados)
    {

        extract($dados);

        $query = "INSERT INTO ramais (name, username, host, status_no_grupo, agente) VALUES (:name, :username, :host, :status_no_grupo, :agente)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":name", $name);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":host", $host);
        $statement->bindValue(":status_no_grupo", $status_no_grupo);
        $statement->bindValue(":agente", $agente);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function atualizar(array $dados)
    {

        extract($dados);

        $query = "UPDATE ramais SET name = :name, username = :username, status_no_grupo = :status_no_grupo, agente = :agente  WHERE name=:name";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":name", $name);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":host", $host);
        $statement->bindValue(":status_no_grupo", $status_no_grupo);
        $statement->bindValue(":agente", $agente);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deletar(int $ramal)
    {

        $query = "DELETE from ramais WHERE name = :name";

        $statement = $this->conn->prepare($query);

        $statement->bindParam(":name", $ramal);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

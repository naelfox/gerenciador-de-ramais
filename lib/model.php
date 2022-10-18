<?php
header("Content-type: application/json; charset=utf-8");
class Model{

    protected $connection;
    private $databaseConfig = array();

    public function __construct()
    {
        $this->obterAcessos();
        extract($this->databaseConfig);
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Erro na conexão: <br> $error";
        }
    }
    
    private function obterAcessos(){
        Environment::carregar();
        $this->databaseConfig = array(
            'host' => getenv('DB_HOST'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'database' => getenv('DB_DATABASE')
        );
    }

    public function consulta()
	{
        $sql = "SELECT * FROM ramais";
        return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}

}


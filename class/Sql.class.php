<?php

/**
 * Classe Sql
 */
class Sql extends PDO {

    /**
     * Conexão
     */
    private $conn;

    /**
     * Construtor da classe
     */
    public function __construct($host, $db_name, $db_login, $db_pass) {
        /**
         * Define conexão
         */
        $this->conn = new PDO(
            "mysql:host=$host;dbname=$db_name",
            $db_login,
            $db_pass
        );
    }

    /**
     * Seta todos os parâmetros do array
     */
    private function setParams($statement, $parameters = array()) {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    /**
     * Seta parâmetro
     */
    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
    }

    /**
     * Função para executar uma query
     */
    public function runQuery($raw_query, $params = array()) {

        $stmt = $this->conn->prepare($raw_query);
        
        $this->setParams($stmt, $params);

        $stmt->execute();
        
        return $stmt;

    }

    /** 
     * Função que executa a query SELECT retornando valores encontrados em um array associativo
     */
    public function runQuerySelect($raw_query, $params = array()):array {

        $stmt = $this->runQuery($raw_query, $params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

}

?>
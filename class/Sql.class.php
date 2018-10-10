<?php

/** CLASSE SQL */
class Sql extends PDO {

    /** CONNECTION */
    private $conn;

    /** CONSTRUCT */
    public function __construct($host, $db_name, $db_login, $db_pass) {
        /** DEFININDO CONEXÃO */
        $this->conn = new PDO(
            "mysql:host=$host;dbname=$db_name",
            $db_login,
            $db_pass
        );
    }

    /** SET PARAMS */
    private function setParams($statment, $parameters = array()) {
        foreach ($parameters as $key => $value) {
            $this->setParam($statment, $key, $value);
        }
    }

    /** SET PARAM */
    private function setParam($statment, $key, $value) {
        $statment->bindParams($key, $value);
    }

    /** RUM QUERY */
    public function runQuery($raw_query, $params = array()) {

        $stmt = $this->conn->prepare($raw_query);
        
        $this->setParams($stmt, $params);

        $stmt->execute();
        
        return $stmt;

    }

    /** RUM QUERY SELECT */
    public function runQuerySelect($raw_query, $params = array()):array {

        $stmt = $this->runQuery($raw_query, $params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

}

?>
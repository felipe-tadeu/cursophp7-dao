<?php

/**
 * ========================
 * ===== CLASSE TESTE =====
 * ========================
 */
class Usuario {

    /**
     * Atributos
     */
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    /**
     * Get the value of idusuario
     */ 
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set the value of idusuario
     *
     * @return  self
     */ 
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get the value of deslogin
     */ 
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * Set the value of deslogin
     *
     * @return  self
     */ 
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        return $this;
    }

    /**
     * Get the value of dessenha
     */ 
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * Set the value of dessenha
     *
     * @return  self
     */ 
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        return $this;
    }

    /**
     * Get the value of dtcadastro
     */ 
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * Set the value of dtcadastro
     *
     * @return  self
     */ 
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        return $this;
    }

    /**
     * Carregar um usuário pelo seu ID
     */
    public function carregarPorId($id) {

        $sql = new Sql("localhost", "dbphp7", "root", "");

        $results = $sql->runQuerySelect("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID' => $id
        ));

        if (count($results)) {

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));

        }

    }

    /**
     * Retorna Lista de usuário do banco
     */
    public static function retornarLista() {

        $sql = new Sql("localhost", "dbphp7", "root", "");

        return $sql->runQuerySelect("SELECT * FROM tb_usuarios ORDER BY deslogin");

    }

    /**
     * Busca usuário estaticamente pelo $login
     */
    public static function buscarUsuario($login) {

        $sql = new Sql("localhost", "dbphp7", "root", "");

        return $sql->runQuerySelect("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%" . $login . "%"
        ));

    }

    /**
     * Buscar usuário autenticado (login e senha)
     */
    public function buscarAutenticado($login, $senha) {

        $sql = new Sql("localhost", "dbphp7", "root", "");

        $results = $sql->runQuerySelect("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $senha
        ));

        if (count($results)) {

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));

        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }

    }
    
    /**
     * toString
     */
    public function __toString() {
        return json_encode(array(
            "idusuario"     => $this->getIdusuario(),
            "deslogin"      => $this->getDeslogin(),
            "dessenha"      => $this->getDessenha(),
            "dtcadastro"    => $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

}

?>
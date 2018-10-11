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
     * Construtor
     */
    public function __construct($login = "", $pass = "") {
        $this->setDeslogin($login);
        $this->setDessenha($pass);
    }

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
            $this->setarDados($results[0]);
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
            $this->setarDados($results[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }

    }

    /**
     * Setar Dados
     */
    private function setarDados($dados) {
        $this->setIdusuario($dados['idusuario']);
        $this->setDeslogin($dados['deslogin']);
        $this->setDessenha($dados['dessenha']);
        $this->setDtcadastro(new DateTime($dados['dtcadastro']));
    }

    /**
     * Insert
     */
    public function inserir() {

        $sql = new Sql("localhost", "dbphp7", "root", "");
        
        $results = $sql->runQuerySelect("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN"    => $this->getDeslogin(),
            ":PASSWORD" => $this->getDessenha()
        ));

        if (count($results)) {
            $this->setarDados($results[0]);
        }

    }
    
    public function atualizar($login, $password) {

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql("localhost", "dbphp7", "root", "");

        $sql->runQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD, where idusuario = :ID", array(
            ":LOGIN"    => $this->getDeslogin(),
            ":PASSWORD" => $this->getDessenha(),
            ":ID"       => $this->getIdusuario()
        ));

    }

    public function deletar() {

        $sql = new Sql("localhost", "dbphp7", "root", "");

        $sql->runQuery("DELETE FROM tb_usuarios where idusuario = :ID", array(
            ":ID" => $this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());

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
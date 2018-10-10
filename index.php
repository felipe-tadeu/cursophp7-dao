<?php

require_once("config.php");

//$sql = new Sql("localhost", "dbphp7", "root", "");

//$result = $sql->runQuerySelect("SELECT * FROM tb_usuarios");

//echo json_encode($result);

$usuario = new Usuario();
$usuario->carregarPorId(3);

echo $usuario;

?>
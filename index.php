<?php
/**
 * =========================
 * ===== ARQUIVO TESTE =====
 * =========================
 */

require_once("config.php");

//Teste: buscando usuários
//$sql = new Sql("localhost", "dbphp7", "root", "");
//$result = $sql->runQuerySelect("SELECT * FROM tb_usuarios");
//echo json_encode($result);

//Teste: carregando usuario pelo id
//$usuario = new Usuario();
//$usuario->carregarPorId(3);
//echo $usuario;

//Teste: retorna lista de usuarios (static)
//echo json_encode(Usuario::retornarLista());

//Teste: busando usuário por login (static)
//echo json_encode(Usuario::buscarUsuario("jo"));

//Teste: Buscar usuário autenticado
//$usuario = new Usuario();
//$usuario->buscarAutenticado("jose", "123456");
//echo $usuario;

//Teste: Insert novo usuario
$aluno = new Usuario("aluno", "alun0");

$aluno->inserir();

echo $aluno;

?>
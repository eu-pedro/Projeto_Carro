<?php
session_start();
require_once("../classes/Veiculo.php");
require_once("../modal/VeiculoDAO.php");

$meuVeiculo = new Veiculo();
$meuVeiculoDAO = new VeiculoDAO();


$_SESSION["mensagem"] = $meuVeiculo->inicio($_POST,$_FILES["imagem"]);

if($_SESSION["mensagem"]["status"]){
  $meuVeiculoDAO->inserir($meuVeiculo);
}






header("Location: ../view/CadastroView.php");
die();

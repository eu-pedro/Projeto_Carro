<?php
session_start();
require_once("../classes/Veiculo.php");
require_once("../modal/VeiculoDAO.php");

$meuVeiculo = new Veiculo();
$meuVeiculoDAO = new VeiculoDAO();


$_SESSION["mensagem"] = $meuVeiculo->inicio($_POST,$_FILES["imagem"]);
if(isset($_POST["cadastrar"])){
  if($_SESSION["mensagem"]["status"]){
    $meuVeiculoDAO->inserir($meuVeiculo);
  }
  
}

if(isset($_POST["atualizar"])){
  if($_SESSION["mensagem"]){
    $meuVeiculoDAO->atualizar($meuVeiculo, $_POST["atualizar"]);
    //print_r($meuVeiculo);
  }
}






header("Location: ../view/CadastroView.php");
die();

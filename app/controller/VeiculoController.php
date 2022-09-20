<?php
session_start();
require_once("../classes/Veiculo.php");
require_once("../model/VeiculoDAO.php");

$meuVeiculo = new Veiculo();
$meuVeiculoDAO = new VeiculoDAO();


$_SESSION["mensagem"] = $meuVeiculo->inicio($_POST,$_FILES["imagem"]);
if(isset($_POST["cadastrar"])){
  if($_SESSION["mensagem"]["status"]){
    $meuVeiculoDAO->inserir($meuVeiculo);
    header("Location: ../view/CadastroView.php");
  }
  
}

if(isset($_POST["atualizar"])){
  $_SESSION["atualizar"] = $meuVeiculo->inicio($_POST,$_FILES["imagem"]);
  if($_SESSION["atualizar"]["status"]){
    $meuVeiculoDAO->atualizar($meuVeiculo, $_POST["atualizar"]);
    //print_r($meuVeiculo);
    header("Location: ../view/AtualizarCadastroView.php");
  }
   
}

if(isset($_POST["excluir"])){
  $_SESSION["excluir"] = $meuVeiculoDAO->deletar($_POST["excluir"]);
  header("Location: ../view/VisualizarCadastroView.php");
  die();
}








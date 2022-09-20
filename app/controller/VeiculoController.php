<?php
session_start();
require_once("../classes/Veiculo.php");
require_once("../model/VeiculoDAO.php");

$meuVeiculo = new Veiculo();
$meuVeiculoDAO = new VeiculoDAO();



if(isset($_POST["cadastrar"])){
  $_SESSION["mensagem"] = $meuVeiculo->inicio($_POST,$_FILES["imagem"]);
  if($_SESSION["mensagem"]["status"]){
    $meuVeiculoDAO->inserir($meuVeiculo);
  }
  header("Location: ../view/CadastroView.php");
    die();
}

if(isset($_POST["atualizar"])){
  $_SESSION["mensagem"] = $meuVeiculo->inicio($_POST,$_FILES["imagem"]);
  if($_SESSION["mensagem"]["status"]){
    $meuVeiculoDAO->atualizar($meuVeiculo, $_POST["atualizar"]);
    //print_r($meuVeiculo);
    
  }
  header("Location: ../view/AtualizarCadastroView.php");
  die();
}

if(isset($_POST["excluir"])){
  $_SESSION["excluir"] = $meuVeiculoDAO->deletar($_POST["excluir"]);
  header("Location: ../view/VisualizarCadastroView.php");
  die();
}








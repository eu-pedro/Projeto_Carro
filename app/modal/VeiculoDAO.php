<?php
require_once("../classes/Veiculo.php");
require_once("Conexao.php");

class VeiculoDAO{

  private $tabela = "veiculo";

  public function inserir(Veiculo $veiculo){
    $sql = "INSERT INTO {$this->tabela} VALUES(NULL, :marca, :modelo, :ano_fabricacao, :locacao_inicio, :locacao_fim,:foto)";

    $preparacao = Conexao::getConexao()->prepare($sql);

    $preparacao->bindValue(":marca",$veiculo->marca);
    $preparacao->bindValue(":modelo",$veiculo->modelo);
    $preparacao->bindValue(":ano_fabricacao", $veiculo->ano);
    $preparacao->bindValue(":locacao_inicio", $veiculo->dataLocacao);
    $preparacao->bindValue(":locacao_fim",$veiculo->dataDevolucao);
    $preparacao->bindValue(":foto", $veiculo->imagem);

    

    $preparacao->execute();

    if($preparacao->rowCount() > 0){
      return true;
    }
    else{
      return false;
    }

  }
  
  public function consultar($dataBr = false){
    $sql = "SELECT * FROM {$this->tabela}";

    $preparacao = Conexao::getConexao()->prepare($sql);
    
    $preparacao->execute();

    if($preparacao->rowCount() > 0){
      $resultado = $preparacao -> fetchAll(PDO::FETCH_ASSOC);

      if($dataBr){

        

        foreach($resultado as $elemento => $itens){
         

          $dataLocacao = new DateTime($itens["locacao_inicio"]);
          $dataLocacao = $resultado[$elemento]["locacao_inicio"] = $dataLocacao->format("d/m/Y");

          $dataDevolucao = new DateTime($itens["locacao_fim"]);
          $dataDevolucao = $resultado[$elemento]["locacao_fim"] = $dataDevolucao->format("d/m/Y");

        }
      }
      
      
      return $resultado;
    }
    else{
      return false;
    }
  }

}
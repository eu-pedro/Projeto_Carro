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
          $resultado[$elemento]["locacao_inicio"] = $dataLocacao->format("d/m/Y");

          $dataDevolucao = new DateTime($itens["locacao_fim"]);
          $resultado[$elemento]["locacao_fim"] = $dataDevolucao->format("d/m/Y");

        }
      }
      
      
      return $resultado;
    }
    else{
      return false;
    }
  }

  public function consultarUnico($id){
    $sql = "SELECT * FROM {$this->tabela} WHERE id_veiculo = :id";

    $preparacao = Conexao::getConexao()->prepare($sql);
    $preparacao -> bindValue(":id", $id);

    $preparacao->execute();

    if($preparacao -> rowCount() > 0){
      $resultado = $preparacao->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    }
    
    else{
      return false;
    }
  }



  public function atualizar(Veiculo $veiculo, $id){
    $sql = "UPDATE {$this->tabela} SET modelo = :modelo, marca = :marca, ano_fabricacao = :ano, locacao_inicio = :dataLocacao, locacao_fim = :dataDevolucao, foto = :foto WHERE id_veiculo = :id";

    $preparacao = Conexao::getConexao()->prepare($sql);

    $preparacao->bindValue(":modelo", $veiculo->modelo);
    $preparacao->bindValue(":marca", $veiculo->marca);
    $preparacao->bindValue(":ano", $veiculo->ano);
    $preparacao->bindValue(":dataLocacao", $veiculo->dataLocacao);
    $preparacao->bindValue(":dataDevolucao", $veiculo->dataDevolucao);
    $preparacao->bindValue(":foto", $veiculo->imagem);
    $preparacao->bindValue(":id", $id);

    $preparacao->execute();

    //$preparacao->debugDumpParams();

    if($preparacao->rowCount() > 0){
      return true;
    }
    else { 
      return false;
    }
  }


  public function deletar($id){
    $sql = "DELETE FROM {$this->tabela} WHERE id_veiculo = :id";

    $preparacao = Conexao::getConexao()->prepare($sql);

    $preparacao->bindValue(":id", $id);

    $preparacao -> execute();

    if($preparacao -> rowCount() > 0){
      return true;
    }
    else{
      return false;
    }
  }

}
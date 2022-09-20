<?php
    session_start();
    require_once("../model/VeiculoDAO.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atualização de Dados</title>
</head>
<body class="body">
  
<header class="stick">
  <nav class="navbar navbar-expand-lg bg-dark">

    <div class="container-fluid ">
        <a href="#" class="navbar-brand fs-2 text-white me-5">Locação de Carros</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
          <li class="nav-item me-3 fs-5">
            <a class="nav-link text-white" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item me-3 fs-5">
            <a class="nav-link text-white" href="VisualizarCadastroView.php">Alugados</a>
          </li>
          <li class="nav-item me-3 fs-5">
            <a class="nav-link text-white" href="#">Logout</a>
          </li>
        </ul>
        
      </div>

    </div>

  </nav>

  <?php
    if(isset($_SESSION["mensagem"])){
      if($_SESSION["mensagem"]["status"]){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <h4 class='text-center fs-1 fw-bold'>{$_SESSION["mensagem"]["msg"]}</h4>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
      }
      else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <h4 class='text-center fs-1 fw-bold'>{$_SESSION["mensagem"]["msg"]}</h4>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
      }
  
    }
    unset($_SESSION["mensagem"]);


    
  ?>


  <h1 class="fw-bold text-center mt-4">
    Atualize os Dados do Veículo
  </h1>

  

  

   

</header>  



<main>
 
  
      <div class="col-md-7 mx-auto mt-4 glass">

      <?php

        if(!isset($_SESSION["id"])){
        $_SESSION["id"] = $_POST["id_veiculo"];
        // echo "o id escolhido é {$_SESSION["id"]}";
        }

        $meuVeiculoDAO = new VeiculoDAO();
        $resultado = $meuVeiculoDAO->consultarUnico($_SESSION["id"]);

        foreach($resultado as $elemento):
      


        ?>
        <form action="../controller/VeiculoController.php" method="POST" enctype="multipart/form-data">
          <div class=" p-4 mx-auto">
            <div class="mb-3">
                <label for="modelo" class="form-label fw-bold fs-5">Modelo <span class="text-danger">*</span></label>
                <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Digite o Modelo do Carro" value="<?=$elemento["modelo"]?>">
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label fw-bold fs-5">Marca <span class="text-danger">*</span></label>
                <input type="text" name="marca" id="marca" class="form-control" placeholder="Digite a Marca do Carro" value="<?=$elemento["marca"]?>">
            </div>

            <div class="mb-3">
                <label for="ano" class="form-label fw-bold fs-5">Ano de Fabricação <span class="text-danger">*</span></label>
                <input type="number" name="ano" id="ano" class="form-control" placeholder="Digite o Ano de Fabricação" min="1990" max="2022" value="<?=$elemento["ano_fabricacao"]?>">
            </div>

            <div class="mb-3">
                <label for="dataLocacao" class="form-label fw-bold fs-5">Data de Locação <span class="text-danger">*</span></label>
                <input type="date" name="dataLocacao" id="dataLocacao" class="form-control" placeholder="Digite a Data de Locação" value="<?=$elemento["locacao_inicio"]?>">
            </div>

            <div class="mb-3">
                <label for="dataDevolucao" class="form-label fw-bold fs-5">Data de Devolução <span class="text-danger">*</span></label>
                <input type="date" name="dataDevolucao" id="dataDevolucao" class="form-control" placeholder="Digite a Data de Devolução" value="<?=$elemento["locacao_fim"]?>">
            </div>

            <div class="mb-3">
              <label for="imagem" class="form-label fw-bold fs-5">Imagem do Carro <span class="text-danger">*</span></label>
              <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" >
            </div>
          </div>

          <input type="hidden" name="atualizar" value="<?=$elemento["id_veiculo"]?>">

          <div class="row mb-3">
            <button class="btn btn-secondary col-8 mx-auto btn-lg" type="submit">Atualizar</button>
          </div>
        </form>

      <?php
        endforeach;
        unset($_SESSION["id"]);
      ?> 
      

      </div>
       
   


</main>


<?php
require_once("../includes/Rodape.php");
?>
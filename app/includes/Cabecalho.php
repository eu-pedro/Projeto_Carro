
<?php
  session_start();
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<header class="stick">
  <nav class="navbar navbar-expand-lg bg-dark">

    <div class="container-fluid ">
        <a href="#" class="navbar-brand fs-2 text-white me-5">Gerenciamento de Carros</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
          <li class="nav-item me-3 fs-5">
            <a class="nav-link text-white" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item me-3 fs-5">
            <a class="nav-link text-white" href="#">Alugados</a>
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


  



  

   

</header>    
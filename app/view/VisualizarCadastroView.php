<?php
require_once("../includes/Cabecalho.php");
require_once("../model/VeiculoDAO.php");

?>
<main class="row mt-5 mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <h2 class="ms-3">Gerenciador de Locação</h2>
    <div class="me-4">
      <a href="CadastroView.php" class="btn btn-primary btn-lg">Cadastrar nova locação</a>
    </div>
 
  </div>



</main>

<hr>


<section class="mt-5 col-md-12 col-sm-12 mx-auto ps-3">
  
        <?php
        $meuVeiculoDAO = new VeiculoDAO();
          if($meuVeiculoDAO->consultar()):
            
        ?>

  <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center">Foto</th>
          <th scope="col" class="text-center">Marca</th>
          <th scope="col" class="text-center">Modelo</th>
          <th scope="col" class="text-center">Ano de Fabricação</th>
          <th scope="col" class="text-center">Data de Locação</th>
          <th scope="col" class="text-center">Data de Devolução</th>
          <th scope="col" class="text-center">Ações</th>
        </tr>
      </thead>
      
      

      <tbody>

      <?php
        foreach($meuVeiculoDAO->consultar(true) as $elementos):


      ?>
        <tr>

          <th class="text-center">
            <img src="<?=$elementos["foto"]?>" height="100px" alt="">
          </th>


          <td class="text-center">
            <p class="mt-4"><?=$elementos["marca"]?></p>
          </td>


          <td class="text-center">
            <p class="mt-4"><?=$elementos["modelo"]?></p>
          </td>


          <td class="text-center">
            <p class="mt-4"><?=$elementos["ano_fabricacao"]?></p> 
          </td>


          <td class="text-center">
            <p class="mt-4"><?=$elementos["locacao_inicio"]?></p>
          </td>


          <td class="text-center">
            <p class="mt-4"><?=$elementos["locacao_fim"]?></p> 
          </td>


          <td>
            <div class="d-flex justify-content-around">
              <form action="AtualizarCadastroView.php" method="post">
             
              
              <button type="submit" class="btn btn-info me-4 mt-4">Editar</button>

                <input type="hidden" name="id_veiculo" value="<?=$elementos["id_veiculo"]?>">

                <button type="button" id="<?=$elementos["id_veiculo"]?>" class="btn btn-danger mt-4 excluir" data-bs-toggle="modal" data-bs-target="#exampleModal">Excluir</button>  
                
               
              </form>
            </div>
          </td>
        </tr>


        <?php
          endforeach;
          endif;
          unset($_SESSION["id"]);
        ?>
      </tbody>
      

  </table>

  


</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../controller/VeiculoController.php" method="post">
        <div class="modal-body">
          <p class="text-center">Você tem certeza que deseja excluir esta locação?</p>
        </div>
      
      

        <div class="modal-footer">
          
          <input type="hidden" name="excluir" id="excluirCadastro">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar</button>


        </div>

      </form>
    </div>
  </div>
</div>







<?php
require_once("../includes/Rodape.php");

?>
<?php

// $modelo = $_POST["modelo"];
// $marca = $_POST["marca"];
// $ano = $_POST["ano"];
// $dataLocacao = $_POST["dataLocacao"];
// $dataDevolucao = $_POST["dataDevolucao"];
// $imagem = $_FILES["imagem"];
// echo "<pre>";
// print_r($modelo);
// print_r($marca);
// print_r($ano);
// print_r($dataLocacao);
// print_r($dataDevolucao);
// print_r($imagem);
// echo "</pre>";

class Veiculo{
    private $modelo;
    private $marca;
    private $ano; 
    private $dataLocacao;
    private $dataDevolucao;
    private $imagem;

    public function validaCampos($campo,$arquivo){
        $this->modelo = $campo["modelo"];
        $this->marca = $campo["marca"];
        $this->ano = $campo["ano"];
        $this->dataLocacao = $campo["dataLocacao"];
        $this->dataDevolucao = $campo["dataDevolucao"];
        $this->imagem = $arquivo["imagem"];

        if(empty($this->modelo) || empty($this->marca) || empty($this->ano) || empty($this->dataLocacao) || empty($this->dataDevolucao) || empty($this->imagem["name"])){
            // echo "arquivo vazio";
        }
        else{
            // echo "dados cadastrados";
            echo "<pre>";
            $nomeArquivo = $this->imagem;
            print_r($this->imagem["name"]);
            echo "</pre>";

            echo "<pre>";
            $infoArquivo = pathinfo($nomeArquivo["name"]);
            print_r($infoArquivo); 
            echo "</pre>";

            $extensaoArquivo = $infoArquivo["extension"];

            if($extensaoArquivo == "jpg" || $extensaoArquivo == "png" || $extensaoArquivo == "jpeg"){
                echo "formato de arquivo válido";

                $pasta = "../imagem/";

                

                if(!file_exists($pasta)){
                    mkdir($pasta, 0777,true);
                }

                $caminhoFinal = $pasta.$this->imagem["name"];

                move_uploaded_file($this->imagem["tmp_name"], $caminhoFinal);
            }
            
        }
    }

    public function validaData($campo){
        $this->dataLocacao = $campo["dataLocacao"];
        $this->dataDevolucao = $campo["dataDevolucao"];

        $dataLocacao = new DateTime($this->dataLocacao);
        $dataDevolucao = new DateTime($this->dataDevolucao);

        $dataAtual = new DateTime("now");
        
        echo "<pre>";
        print_r($dataLocacao);
        echo "</pre>";

        echo "<pre>";
        print_r($dataAtual);
        echo "</pre>";

        echo "<pre>";
        print_r($dataDevolucao);
        echo "</pre>";


        if($dataLocacao < $dataAtual || $dataDevolucao < $dataLocacao){
            echo "Datas inválidas";
        } 
        else{ echo "data válida";}
        
    }
}
$meuVeiculo = new Veiculo();
$meuVeiculo->validaData($_POST);
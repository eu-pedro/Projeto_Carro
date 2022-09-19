<?php


class Veiculo{
    private $modelo;
    private $marca;
    private $ano; 
    private $dataLocacao;
    private $dataDevolucao;
    private $imagem;
    private $mensagem = [];

    public function inicio($campo,$arquivo){
        if($this->validaCampos($campo)){
            if($this->validaData($campo)){
                if($this->recebeArquivo($arquivo)){
                    $this->mensagem = [
                        "status" => true,
                        "msg" => "Dados cadastrados com sucesso!"
                    ];
                }
                else{
                    $this->mensagem = [
                        "status" => false,
                        "msg" => "Formato do arquivo inválido!"
                    ];
                }
            }
            else{
                $this->mensagem = [
                    "status" => false,
                    "msg" => "Data inválida!",
                ];
            }
        }  
        else{
            $this->mensagem = [
                "status" => false,
                "msg" => "Campos vazios, preencha-os!"
            ];
        }
        return $this->mensagem;
    }
    
    public function validaCampos($campo){
        $this->modelo = $campo["modelo"];
        $this->marca = $campo["marca"];
        $this->ano = $campo["ano"];
        $this->dataLocacao = $campo["dataLocacao"];
        $this->dataDevolucao = $campo["dataDevolucao"];
        

        if(empty($this->modelo) || empty($this->marca) || empty($this->ano) || empty($this->dataLocacao) || empty($this->dataDevolucao)){
            return false;
        }
        else{
            return true;
        }
    }

    public function validaData($campo){
        date_default_timezone_set("America/Sao_Paulo");
        $this->dataLocacao = $campo["dataLocacao"];
        $this->dataDevolucao = $campo["dataDevolucao"];

        $dataLocacao = new DateTime($this->dataLocacao);
        $dataDevolucao = new DateTime($this->dataDevolucao);

        

        $dataAtual = new DateTime("now");
        
        


        if($dataLocacao < $dataAtual || $dataDevolucao <= $dataLocacao){
            return false;
        } 
        else{
            return true;
        }
    }


    public function recebeArquivo($arquivo){
        $this->imagem = $arquivo;

        if(empty($this->imagem["name"])){
            return false;
        } 
        else{
            $infoArquivo = pathinfo($this->imagem["name"]);
            
            $extensaoArquivo = $infoArquivo["extension"];

            if($extensaoArquivo == "jpg" || $extensaoArquivo == "png" || $extensaoArquivo == "jpeg"){
                

            $pasta = "../imagem/";

            

            if(!file_exists($pasta)){
                mkdir($pasta, 0777,true);
            }

            $data = new DateTime();

            $nomeFinal = $data->getTimestamp().".".$extensaoArquivo;

            $caminhoFinal = $pasta.$nomeFinal;

            move_uploaded_file($this->imagem["tmp_name"], $caminhoFinal);

            

            $this->imagem = $caminhoFinal;
            return true;
        }
        else{
            return false;
        }
        }
        
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}


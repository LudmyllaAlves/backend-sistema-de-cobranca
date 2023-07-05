<?php
class Upload{
    public $nome;
    public $extenção;
    public $tmpnome;
    public $tipo;
    public $error;
    public $duplicado =0;


    public function __construct ($file){
        $this->tipo = $file['type'];
        $this->tmpnome = $file['tmp_name'];
        $this->error = $file['error'];

        $info = pathinfo($file['name']);
        $this->nome= $info['filename'];
        $this->extenção = $info['extension'];
    }
    public function getBasename(){
        $extenção = strlen($this->extenção) ? '.'.$this->extenção : ''; 
        $duplicado = $this->duplicado > 0 ? '-'.$this->duplicado: '';
        return $this->nome.$duplicado.$extenção;
    }

    private function getPossibleBasename($dir, $overwrite){
        if($overwrite){
            return $this->getBasename();
        }
        $basename = $this->getBasename();

        if(!file_exists($dir ."/".$basename)){
            return $basename;
        }
        $this->duplicado++;
        return $this->getPossibleBasename($dir, $overwrite);
    }

    public function upload($dir, $overwrite = true){
        if($this->error!=0){
            return false;
        }
        $path = $dir. '/'.$this->getPossibleBasename($dir,$overwrite);
        
        return move_uploaded_file($this->tmpnome,$path);
    }
    public function getRota($dir, $overwrite = true){
        $path = $dir. '/'.$this->getPossibleBasename($dir,$overwrite);
        return $path;
    }
}



?>
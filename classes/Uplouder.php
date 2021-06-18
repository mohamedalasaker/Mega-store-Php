<?php 

class Uplouder {

    public $file;
    public $filename;
    public $filepath;
    public $uploudDir;
    public $rootDir;
    protected $errors = [];
    
    public function __construct($uploudDir,$rootDir = null)
    {
        
        if($rootDir){
            $this->rootDir = $rootDir;
        }else{
            $this->rootDir = $_SERVER['DOCUMENT_ROOT'] .DIRECTORY_SEPARATOR.'/study/mega store';
        }
        $this->filepath = $uploudDir;
        $this->uploudDir = $this->rootDir .'/'. $uploudDir;

    }

    protected function validate(){
       if(!$this->isSizedAllowed()){
           array_push($this->errors,'File size is too large');
       }
       if(!$this->isMimeType()){
        array_push($this->errors,'File Type is not allowed');
       }
       return $this->errors;
       
    }
    protected function createDir(){

        if(!is_dir($this->uploudDir)){

            if(!mkdir($this->uploudDir,0775)){
                array_push($this->errors,'Dir did not created succesfuly');
                return false;
            }

        }
        return true;
    }

    public function uploud(){
        $this->filename = time().$this->file['name'];
        $this->filepath .=  '/'.$this->filename;
        if($this->validate()){
            return $this->errors;
        }
        if(!$this->createDir()){
            return $this->errors;
        }
        if(!move_uploaded_file($this->file['tmp_name'], $this->uploudDir .'/'. $this->filename)){
            array_push($this->errors,'File did not uploud please try again');
            return $this->errors;
        }


        

    }
    protected function isMimeType(){
        $allowed = [
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ];
        
        $file_mime_type = mime_content_type($this->file['tmp_name']);

        if(!in_array($file_mime_type,$allowed)){
            return false;
        }
        
        return true;
    }
    protected function isSizedAllowed(){
        $maxZize = 1000000000;
        $fileSize = $this->file['size'];
        if($fileSize > $maxZize) return false;

        return true;

    }

}
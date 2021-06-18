<?php 

function validateString($string){
    $feild = filter_var(trim($string),FILTER_SANITIZE_STRING);
    return $feild;
}

function validateEmail($email){
    $feild = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($feild,FILTER_VALIDATE_EMAIL)){
        return $feild;
    }else{
        return false;
    }
}
function validateFile($file){
    global $errors;
    $allowed = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
    ];
    if(empty($file['tmp_name'])){
        return false;
    } 
    $file_mime_type = mime_content_type($file['tmp_name']);
    if(!in_array($file_mime_type,$allowed)){
        die('file type not allowed');
    }
    
    return true;
}


?>
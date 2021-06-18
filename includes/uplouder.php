<?php
 $uploud_dir = 'uplouds';
 require __DIR__.'/../config/connection.php';
 require_once 'validates.php';



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    global $errors;
    
    
    
    $name = validateString($_POST['name']);
    if(!$name){
        $errors['name'] = 'name is reqiured'; 
    }else $_SESSION['contact_form']['name'] = $name;
        
    
    $email = validateEmail($_POST['email']);
    if(!$email){
        $errors['email'] = 'email is reqiured'; 
    }else $_SESSION['contact_form']['email'] = $email;
    
    $dec = validateString($_POST['dec']);
    if(!$dec){
        $errors['dec'] = 'decription is reqiured'; 
    }else $_SESSION['contact_form']['dec'] = $dec;  
    
    $file = validateFile($_FILES['doc']);
    if($_FILES['doc']['size'] > 1000000000) $errors['file'] = 'file size is to large';


    
    $service = $_POST['services_id']; 
    if(!$service){
        $errors['service'] = 'you must choose a service';
    }else $_SESSION['contact_form']['service'] = $service;

    
    if($name && $email && $service && $dec){
        $filename = time().$_FILES['doc']['name'];
        $file ? $filepath =  $uploud_dir.'/'.$filename : $filepath = '';
        $sql = $conn->prepare("insert into messages (contact_name,email,document,describtion,service_id)
            values (?,?,?,?,?)
        ");
        
        $sql->bind_param('ssssi',$contactName,$email,$document ,$describtion ,$serviceId);
        
        $contactName = $name;
        $email = $email;
        $document = $filepath ;
        $describtion = $dec;
        $serviceId = $_POST['services_id'];
       
        $sql->execute();
        
        $conn->close();        
        
        if(!is_dir($uploud_dir)){
            umask(0);
            mkdir($uploud_dir,0755);
        }
        if(file_exists($uploud_dir.'/'.$filename)){
            $errors['file'] = 'file already exists in our database -_-';
        }else{
            move_uploaded_file($_FILES['doc']['tmp_name'], $uploud_dir.'/'.$filename);
        }
        unset($_SESSION['contact_form']); 
    };
    
        
        
    
    }   
    
    

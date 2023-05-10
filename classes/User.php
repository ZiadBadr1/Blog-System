<?php

session_start();
class User
{
    private $pdo ;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function register($username , $email , $password)
    {
        $Errors = array();
        $stm =  $this->pdo->prepare("SELECT COUNT(*)FROM users WHERE email = :email ");
        $stm->execute(array(":email"=> $email));
        $count = $stm->fetchColumn();

        if($count > 0)
        {
            $Errors[]=  "The email is already used";
        }
        $stm =  $this->pdo->prepare("SELECT COUNT(*)FROM users WHERE username = :username ");
        $stm->execute(array(":username"=> $username));
        $count = $stm->fetchColumn();
        if($count > 0)
        {
            $Errors[]=  "The username is already used";
        }
        
        if(empty($Errors))
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $stm =  $this->pdo->prepare("INSERT  INTO users (username,email,password) VALUES (:username , :email , :password)");
            $stm->execute(array(":username"=> $username , ":email"=>$email,":password"=>$hash)) ;
            return true;
        }
        else
        {
            return $Errors;
        }
    }

    public function login($email , $password)
    {
        
        $Errors = array();
        
        $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stm->execute(array(":email"=>$email));
        
        $data = $stm->fetch(PDO::FETCH_ASSOC);

    if(!$data)
    {
        $Errors[] = "This Email not found";
    }
     if(empty($Errors)&&password_verify($password , $data['password']))
     {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
       
        header('Location: ../index.php');
        return true;
        
     }
     
     else 
     {
        if(empty($Errors))
        {
            $Errors[] = "The Password not correct";
        }   
        return $Errors;
     }   
        
    }
}
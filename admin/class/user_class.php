<?php

class Users{

public $id, $name, $username, $email, $password, $status, $role, $last_login;

public function login(){

	include('Magzine/connection.php');
     
    $this->password = md5($this->password);

    $query = "SELECT * FROM `users` WHERE `username` ='$this->username' AND `password` = '$this->password'";

    $result = mysqli_query($link, $query);
    
    
    $u = mysqli_fetch_object($result);

    if (mysqli_num_rows($result) > 0) {

        session_start();
        
        $_SESSION['name'] = $u->name;
        $_SESSION['username'] = $u->username;
        $_SESSION['role'] = $u->role;
        setcookie('username', $u->username, time() + 60 * 60);
    	header("location:Magzine/dashboard.php");
        }else
            {
                return '<div role="alert" class="alert alert-danger"><strong>Login Failed. Try Again!</strong></div>'; 

            }
    } 
}







?>
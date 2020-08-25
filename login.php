<?php
//<!--Start session-->
session_start();
include('connection.php'); 

//<!--Check user inputs-->
//    <!--Define error messages-->

$missingemail = '<p>Please enter your email address!</p>';
$missingpassword = '<p>Please enter a Password!</p>';
$errors='';
//Get email
if(empty($_POST["loginemail"])){
    $errors .= $missingemail;   
}else{
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
   
}
if(empty($_POST["loginpassword"])){
    $errors .= $missingpassword;   
}else{
    $password = filter_var($_POST["loginpassword"], FILTER_SANITIZE_STRING);
   
}
if(strlen($errors)>0)
{
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}
$email=mysqli_real_escape_string($link,$email);
$password=mysqli_real_escape_string($link,$password);

$sql="SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
if($result!==1){
      echo '<div class="alert alert-danger">Wrong username or Password.</div>';
      exit;
}
else{
    $row=mysqli_fetch_array($results,MYSQLI_ASSOC);
    $_SESSION["user_id"]=$row["user_id"];
    $_SESSION["username"]=$row["username"];
    $_SESSION["email"]=$row["email"];
    echo "success";
    
   
    
}


?>
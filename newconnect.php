<?php
//<!--Start session-->
session_start();
include('connection.php'); 

//<!--Check user inputs-->
//    <!--Define error messages-->

$missingusername = '<p>Please enter a username.</p>';
$usernamenotexist = '<p>The username entered does not exist.</p>';
$usernameconnected='<p>The username is already connected with you.</p>';
$errors='';
//Get email
if(empty($_POST["newconnectusername"])){
    $errors .= $missingusername;   
}else{
    $username = filter_var($_POST["newconnectusername"], FILTER_SANITIZE_STRING);
   
}

if(strlen($errors)>0)
{
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}
$username=mysqli_real_escape_string($link,$username);

$sql="SELECT * FROM users WHERE username='$username'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
if($result!==1){
      echo '<div class="alert alert-danger">The user with specified username does not exist.</div>';
      exit;
}
else{

         $user=$_SESSION["username"];
    $user=mysqli_real_escape_string($link,$user);
    $sql="SELECT * FROM connection WHERE member1='$user' AND member2='$username'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
   $sql2="SELECT * FROM connection WHERE member2='$user' AND member1='$username'";
$results2=mysqli_query($link,$sql2);
if(!$results2)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
$result2=mysqli_num_rows($results2);
if($result==0&&$result2==0){
    $time=time();
      $sql = "INSERT INTO notifications (`userfrom`, `userto`, `type`, `time`) VALUES ('$user', '$username', 'CONNECTR', '$time')";
$results = mysqli_query($link, $sql);
if(!$results){
    echo '<div class="alert alert-danger">An error occured.Sorry for the inconvenience.Please try again!</div>'; 
    exit;
}
else
{
    echo '<div class="alert alert-success">Request has been successfully.You will be notified about his/her reaction.</div>'; 
    exit;
}
}
else
{
    echo '<div class="alert alert-danger">The user with this username is already connected with you.</div>';
}
    
}


?>
<?php
//<!--Start session-->
session_start();
include('connection.php'); 

//<!--Check user inputs-->
//    <!--Define error messages-->
$missingusername = '<p>Please enter atleast 1 username!</p>';
$missingamount = '<p>Please enter amount of money you want to send!</p>';
$invalidamount = '<p>Please enter a amount greater than 0!</p>';

//    <!--Get username, email, password, password2-->
//Get username
$errors='';
$username=array("","","","","","");
if(empty($_POST["username1"])&&empty($_POST["username2"])&&empty($_POST["username3"])&&empty($_POST["username4"])&&empty($_POST["username5"])){
    $errors .= $missingusername;
}else{
    $username[1] = filter_var($_POST["username1"], FILTER_SANITIZE_STRING); 
     $username[2] = filter_var($_POST["username2"], FILTER_SANITIZE_STRING); 
      $username[3] = filter_var($_POST["username3"], FILTER_SANITIZE_STRING); 
       $username[4] = filter_var($_POST["username4"], FILTER_SANITIZE_STRING); 
        $username[5] = filter_var($_POST["username5"], FILTER_SANITIZE_STRING); 
}
//Get amount
if(empty($_POST["sendamount"])){
    $errors .= $missingamount;   
}else{
   
    if($_POST["sendamount"]<1){
        $errors .= $invalidamount;   
    }
    else
    {
        $amount=$_POST["sendamount"];
    }
}

//If there are any errors print error
if(strlen($errors)>0){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
    
}
//preparing variables for query
for($i=1;$i<6;$i++){
if(strlen($username[$i])>0){
$username[$i]=mysqli_real_escape_string($link,$username[$i]);
$user=$_SESSION["username"];
    
    $sql="SELECT * FROM connection WHERE member2='$username[$i]' AND member1='$user'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
   $sql2="SELECT * FROM connection WHERE member1='$username[$i]' AND member2='$user'";
$results2=mysqli_query($link,$sql2);
if(!$results2)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
$result2=mysqli_num_rows($results2);
if($result==0&&$result2==0){
      echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">There is no user with this '.$username[$i].'in your connections.Try a different username</div>';
      
}
else
{
    $time=time();
     $sql = "INSERT INTO notifications (`userfrom`, `userto`, `type`, `time`,`amount`) VALUES ('$user', '$username[$i]', 'PAYR', '$time','$amount')";
$results = mysqli_query($link, $sql);
if(!$results){
    echo '<div class="alert alert-danger">An error occured.Sorry for the inconvenience.Please try again!</div>'; 
    exit;
}
else
{
    echo '<div class="alert alert-success">Request has been successfully sent to '.$username[$i].'.You will be notified about his/her reaction.</div>'; 
    
} 
}
}
}


?>
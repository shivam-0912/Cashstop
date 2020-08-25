<?php
//<!--Start session-->
session_start();
include('connection.php'); 

//<!--Check user inputs-->
//    <!--Define error messages-->
$missingusername = '<p>Please enter a username!</p>';
$missingemail = '<p>Please enter your email address!</p>';
$invalidemail = '<p>Please enter a valid email address!</p>';
$invalidalt_email = '<p>Please enter a valid alternative email address!</p>';

//    <!--Get username, email, password, password2-->
//Get username
$errors='';
if(empty($_POST["updateinfousername"])){
    $errors .= $missingusername;
}else{
    $username = filter_var($_POST["updateinfousername"], FILTER_SANITIZE_STRING);   
}
//Get email
if(empty($_POST["updateinfoemail"])){
    $errors .= $missingemail;   
}else{
    $email = filter_var($_POST["updateinfoemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;   
    }
}
if(!empty($_POST["updateinfoalt_email"])){
$alt_email = filter_var($_POST["updateinfoalt_email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($alt_email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidalt_email;   
    }
}
else
{
    $alt_email=$_POST["updateinfoalt_email"];
}

//If there are any errors print error
if(strlen($errors)>0){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
    
}
//setting varibles
//preparing variables for query
$username=mysqli_real_escape_string($link,$username);
$email=mysqli_real_escape_string($link,$email);
$alt_email=mysqli_real_escape_string($link,$alt_email);
$name=mysqli_real_escape_string($link,$_POST['updateinfoname']);
$company=mysqli_real_escape_string($link,$_POST['updateinfocompany']);
$occupation=mysqli_real_escape_string($link,$_POST['updateinfooccupation']);
$upi=mysqli_real_escape_string($link,$_POST['updateinfoupi']);
$DOB=$_POST["updateinfoDOB"];
$paytm=$_POST["updateinfopaytm"];
$gpay=$_POST["updateinfogpay"];
$user_id=$_SESSION["user_id"];
$usernamesession=mysqli_real_escape_string($link,$_SESSION["username"]);
$emailsession=mysqli_real_escape_string($link,$_SESSION["email"]);
//username already exists

if($username!=$usernamesession){
$sql="SELECT * FROM users WHERE username='$username'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
if($result){
      echo '<div class="alert alert-danger">The username is already registered</div>';
      exit;
}}
//email already exists
if($email!=$emailsession){
$sql="SELECT * FROM users WHERE email='$email'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);

if($result){
      echo '<div class="alert alert-danger">The email id is already registered.</div>';
      exit;
}}
$sql="UPDATE users SET username='$username',email='$email',name='$name',company='$company',DOB='$DOB',occupation='$occupation', upi='$upi',paytm='$paytm',gpay='$gpay',alt_email='$alt_email' WHERE user_id='$user_id'";
$sql2="UPDATE connection SET member1='$username'WHERE member1='$usernamesession'";
$sql3="UPDATE connection SET member2='$username'WHERE member2='$usernamesession'";
$sql4="UPDATE notifications SET userfrom='$username'WHERE userfrom='$usernamesession'";
$sql5="UPDATE notifications SET userto='$username'WHERE userto='$usernamesession'";


$results = mysqli_query($link, $sql);
$results2 = mysqli_query($link, $sql2);
$results3 = mysqli_query($link, $sql3);
$results4 = mysqli_query($link, $sql4);
$results5 = mysqli_query($link, $sql5);
if(!$results||!$results2||!$results3||!$results4||!$results5){
    echo '<div class="alert alert-danger">There was an error inserting the user details in the database!.Please do not leave empty DOB , Gpay and PayTM.</div>'; 
    exit;
}
else{
       echo "<div class='alert alert-success'>Your information has been successfully updated.</div>";
}

?>
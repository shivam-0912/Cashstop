<?php
//<!--Start session-->
session_start();
include('connection.php'); 

//<!--Check user inputs-->
//    <!--Define error messages-->
$missingusername = '<p>Please enter a username!</p>';
$missingemail = '<p>Please enter your email address!</p>';
$invalidemail = '<p>Please enter a valid email address!</p>';
$missingpassword = '<p>Please enter a Password!</p>';
$invalidpassword = '<p>Your password should be at least 6 characters long and include one number!</p>';
$differentpassword = '<p>Passwords do not match!</p>';
$missingpassword2 = '<p>Please confirm your password!</p>';
//    <!--Get username, email, password, password2-->
//Get username
$errors='';
if(empty($_POST["registerusername"])){
    $errors .= $missingusername;
}else{
    $username = filter_var($_POST["registerusername"], FILTER_SANITIZE_STRING);   
}
//Get email
if(empty($_POST["registeremail"])){
    $errors .= $missingemail;   
}else{
    $email = filter_var($_POST["registeremail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;   
    }
}
//Get passwords
if(empty($_POST["registerpassword"])){
    $errors .= $missingpassword; 
}elseif(!(strlen($_POST["registerpassword"])>6 and preg_match('/[0-9]/',$_POST["registerpassword"]) ) )
{
    $errors .= $invalidpassword; 
}else{
    $password = filter_var($_POST["registerpassword"], FILTER_SANITIZE_STRING); 
    if(empty($_POST["registerconfirmpassword"])){
        $errors .= $missingpassword2;
    }else{
        $password2 = filter_var($_POST["registerconfirmpassword"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentpassword;
        }
    }
}
//If there are any errors print error
if(strlen($errors)>0){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
    
}
//preparing variables for query
$username=mysqli_real_escape_string($link,$username);
$email=mysqli_real_escape_string($link,$email);
$password=mysqli_real_escape_string($link,$password);

//username already exists
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
}
//email already exists
$sql="SELECT * FROM users WHERE email='$email'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));
if($result){
      echo '<div class="alert alert-danger">The email id is already registered.Do you want to <u><a href="index.php" style="color:#A98739">login</a></u></div>';
      exit;
}
$sql = "INSERT INTO users (`username`, `email`, `password`, `activation`) VALUES ('$username', '$email', '$password', '$activationkey')";
$results = mysqli_query($link, $sql);
if(!$results){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
}
$headers="Content-type:text/html;";
//Send the user an email with a link to activate.php with their email and activation code
$message = "<p>Hello ".$username." ,<br> Thank you for registering to <u>CashStop</u>.<br>Please click on this <b>link</b> to activate your account:<br><br>";
$message.= "http://random0505.000webhostapp.com/activate.php?email=" . urlencode($email) . "&key=$activationkey";
if(mail($email, 'Confirm your Registration', $message,$headers)){
       echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to <b>$email</b>. Please click on the activation link to activate your account.</div>";
}

?>
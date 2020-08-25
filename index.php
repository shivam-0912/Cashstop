<?php
session_start();
include('connection.php');

if(isset($_GET["logout"])){
    include("logout.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CashStop : Login</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="header">
            <h1 id="heading">CashStop</h1>
            <p id="tagline">Stop here to Manage Cash !!</p>
        </div>
        <div class="container">
        <div class="login">
                <div id="loginmessage">
                    
                </div>
            <form method="post" id="loginform">
                <div class="form-group">
                    <label for="loginemail"  class="pull-left">Email</label>
                    <input type="text" class="form-control" placeholder="Email" id="loginemail" name="loginemail">
                 </div>
                 
                 <div class="form-group">
                    <label for="loginpassword" class="pull-left">Password</label>
                    <input type="password" class="form-control" placeholder="Password" id="loginpassword" name="loginpassword">
                 </div>
                 <input type="submit" id="login" value="Login" name="login">
            </form>
            <p id="registernotify">Not a user ! <a href="register.php" id="linkregister">Register</a> here</p>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="javascript.js"></script>
        </body>
    </body>
</html>
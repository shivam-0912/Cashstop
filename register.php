<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CashStop : Register</title>
    
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
        <div class="register">
                <div id="registermessage">
                    
                </div>
            <form method="post" id="registerform">
                <div class="form-group">
                    <label for="registerusername" class="pull-left">Username</label>
                    <input type="text" class="form-control" placeholder="Username" id="registerusername" name="registerusername">
                 </div>
                 <div class="form-group">
                     <label for="registeremail" class="pull-left">Email</label>
                     <input type="text" class="form-control" placeholder="Email Address" id="registeremail" name="registeremail">
                  </div>
                  <div class="form-group">
                     <label for="registerpassword" class="pull-left">Password<span id="instruct"> (At least 6 characters and include 1 number) </span></label>
                     
                     <input type="password" class="form-control" placeholder="Choose a passsword" id="registerpassword" name="registerpassword">
                  </div>
                  <div class="form-group">
                     <label for="registerconfirmpassword" class="pull-left">Confirm Password</label>
                     <input type="password" class="form-control" placeholder="Confirm password" id="registerconfirmpassword" name="registerconfirmpassword">
                  </div>
                 <input type="submit" id="register" value="Register" name="register">
            </form>
            <p id="loginnotify">Already a user ! <a href="index.php" id="linklogin">Login</a> here</p>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="javascript.js"></script>
        </body>
    
</html>
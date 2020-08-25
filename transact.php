<?php
session_start();

if(!isset($_SESSION["user_id"]))
{
    
    header('location:index.php',true);
}
// echo "<div style='margin-top:50px'>hi". $_SESSION['user_id']."</div>";

?>
<?php
include('connection.php');
$user_id=$_SESSION["user_id"];
$sql="SELECT * FROM users WHERE user_id='$user_id'";
$results=mysqli_query($link,$sql);
$result=mysqli_num_rows($results);
$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
$_SESSION["username"]=$row["username"];
$_SESSION["email"]=$row["email"];
$_SESSION["name"]=$row["name"];
$_SESSION["company"]=$row["company"];
$_SESSION["DOB"]=$row["DOB"];
$_SESSION["occupation"]=$row["occupation"];
$_SESSION["alt_email"]=$row["alt_email"];
$_SESSION["upi"]=$row["upi"];
$_SESSION["paytm"]=$row["paytm"];
$_SESSION["gpay"]=$row["gpay"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Transact</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="mainstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <style>
            .transactcontainer{
                margin:30px 20%;
            }
            .formrow{
                margin-top:15px;
            }
            .left{
                color:rgba(169,135,57);
                font-size:18px;
            }
            .send{
                text-align:center;
               
            }#submitamount{
                 background-color:rgb(169,135,57);
                 padding:5px 30px;
                 font-size:16px;
                 color:white;
            }
            #submitamount:hover{
                 background-color:rgb(169,135,57);
                 padding:5px 30px;
                 font-size:16px;
                 color:black;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header ">
                    <a class="navbar-brand" href="home.php">
                        CashStop
                    </a>
                  
                   
                        <button type="button" class="navbar-toggle" data-target="#collapsible" data-toggle="collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                   
                </div>
                <div class="navbar-collapse collapse" id="collapsible">
                    <ul class="nav navbar-nav">
                        <li ><a href="home.php" id="home" >Home</a></li>
                        <li><a href="cards.php">Cards</a></li>
                        <li><a href="transact.php">Transact</a></li> 
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="connect.php">Connections</a></li>
                        <li><a href="notifications.php">Notifications</a></li>
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <li class="navbar-right"><a id="logout" class="btn" href="index.php?logout=1">Logout</a></li>
                    </ul>
             </div>
    
            </div>
        </nav>
        <div class="header">
            <h1>Transact</h1>
        </div>
        <div class="transactcontainer">
            <div id="transactmessage"></div>
            <form method="post" id="transactform">
                         <div class="row formrow">
                        <div class="col-sm-3 left">Send</div>
                    <div class="col-sm-2">  <input type="number" class="form-control" placeholder="Amount" id="sendamount" name="sendamount" min="1"></div>  
                     </div>
                                              <div class="row formrow">
                        <div class="col-sm-3 left">Username1</div>
                    <div class="col-sm-6">  <input type="text" class="form-control" placeholder="@username" id="username1" name="username1"></div>  
                     </div>
                     
                                                                   <div class="row formrow">
                        <div class="col-sm-3 left">Username2</div>
                    <div class="col-sm-6">  <input type="text" class="form-control" placeholder="@username" id="username2" name="username2"></div>  
                     </div>
                                                                   <div class="row formrow">
                        <div class="col-sm-3 left">Username3</div>
                    <div class="col-sm-6">  <input type="text" class="form-control" placeholder="@username" id="username3" name="username3"></div>  
                     </div>
                                                                   <div class="row formrow">
                        <div class="col-sm-3 left">Username4</div>
                    <div class="col-sm-6">  <input type="text" class="form-control" placeholder="@username" id="username4" name="username4"></div>  
                     </div>
                                                                                        <div class="row formrow">
                        <div class="col-sm-3 left">Username5</div>
                    <div class="col-sm-6">  <input type="text" class="form-control" placeholder="@username" id="username5" name="username5"></div>  
                     </div>
                     <div class="row formrow send">
                           <input class="btn " id="submitamount" type="submit" name="submitamount" value="Send">
                         </div>
                     

                  
            </form>
        </div>
            
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="home.js"></script>
    </body>
    </html>
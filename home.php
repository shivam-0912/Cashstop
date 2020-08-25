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
        <title>Home</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="mainstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .maincontainer{
                color:white;
                width:80vw;
                margin:5vh 10vw;
                font-size:19px;
                line-height:30px;
            }
            #cash{
                color:rgb(142,115,53);
            }
            .small{
                font-size:14px;
            }
            #email{
                color:white;
                font-size:15px;
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
            <h1>Home</h1>
        </div>
        <div class="maincontainer">
            <span id="cash"><b>Cashstop</b></span> is an app which can be used for maintaining account(khaata) with your family,friends or anyone.With the help of this app you will not forget how much you owe to others and how much others owe to you.
            <h2 id="cash">Features</h2>
            <p>1. The app can be accessed from mobile also.</br>
                2. You can easily connect with your friends.</br>
                3. Each transaction is represented in an easy format called <i>cards</i></br>
                4. All the credentials of your friends are easily available so that you can easily transact with them.
            </p>
            <h3 id="cash">Upcoming Features</h3>
            <p>1. Payemnt via Gpay,Paytm will be added.</br>
            2. A new chat bot will be there so that you can easily talk with your connections.</p>
            
            <p id="cash" class="small">Explore different feeatures of the app by visiting different tabs on the statusbar.</p>
            <h4 id="cash">For help , contact us at : <span id="email">icomplex09@gmail.com</span></h4>
            
           
        </div>
        
    <footer class="footer mt-auto py-3">
        <div>
          <i class="fa fa-github" style="font-size:24px"></i>
          <span ><a href="https://github.com/shivam-0912" id="git">icomplex09</a> &nbsp; &nbsp; Copyright &copy; 2020</span>
        </div>
    </footer>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="javascript.js"></script>
    </body>
    </html>
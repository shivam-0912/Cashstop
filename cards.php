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
        <title>Cards</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="mainstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <style>
            .cardcontainer{
                margin-top:40px;
            }
                    
            .profilecard{
                margin-right:10%;
                margin-left:10%;
               background-color:rgba(169,135,57,0.5);
                border-radius:6px;
                height:50vh;
                margin-bottom:30px;
            }
            .head{
                height:23%;
               margin-right:0px;
               margin-left:0px;
                background-color:rgba(169,135,57,1);
                border-radius:6px;
            }
            .cardname
            {
                
                height:100%;
                text-align:left;
                line-height:90px;
               font-size:29px;
                
                color:white;
            }
            .cardpic
            {
                height:100%;
                margin:0px;
                padding:5px;
            }
            .cardinfor{
                height:77%;
                border-radius:6px;
                background-color:rgba(248,68,42,0.6);
            }
                        .cardinfog{
                height:77%;
                border-radius:6px;
                background-color:green;
            }
            .category{
                padding-top:10px;
                text-align:center;
                font-size:20px;
                color:white;
            }
            .amount{
                padding:10%;
                text-align:center;
                color:white;
                font-size:80px;
                font-weight:bold;
            }
            #buttons{
                text-align:center;
            }
            #pay{
                background-color:rgba(169,135,57);
                font-size:20px;
                padding:10px 20px;
                color:white;
                border-radius:6px;
                
            }
            #pay:hover{
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
            <h1>Cards</h1>
        </div>
                <div class="cardcontainer">
            <div class="row">
               
               
                
<?php    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
include("connection.php");
 $user=$_SESSION["username"];

    
 $sql="SELECT * FROM connection WHERE member1='$user'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
   $sql2="SELECT * FROM connection WHERE member2='$user'";
$results2=mysqli_query($link,$sql2);
if(!$results2)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
$result2=mysqli_num_rows($results2);
if($result==0&&$result2==0){
      echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Currently you have no pending transactions.</div>';
      exit;
}
else
{
    while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
        $member2=$row["member2"];
        $amount=$row["amount"];
   if($amount>0){
        echo '  <div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$member2.'</div>
                </div>
                <div class="cardinfog">
                    <div class="category">To take:</div>
                    <div class="amount">'.$amount.'</div>
                </div></div></div>';
    }
    elseif($amount<0)
    {
        echo '  <div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$member2.'</div>
                </div>
                <div class="cardinfor">
                    <div class="category">To pay:</div>
                    <div class="amount">'.-1*$amount.'</div>
                </div></div></div>';        
    }
    }
    while($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){
        $member1=$row["member1"];
        $amount=$row["amount"];
   if($amount>0){
        echo '  <div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$member1.'</div>
                </div>
                <div class="cardinfor">
                    <div class="category">To pay:</div>
                    <div class="amount">'.$amount.'</div>
                </div></div></div>';
    }
    elseif($amount<0)
    {
        echo '  <div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$member1.'</div>
                </div>
                <div class="cardinfog">
                    <div class="category">To Take:</div>
                    <div class="amount">'.-1*$amount.'</div>
                </div></div></div>';        
    }
    }
    
}


?>
 </div>
                </div>
                
<div id="buttons">
    <a href="transact.php" id="pay">Make a Transaction</a>
</div>      

        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="javascript.js"></script>
    </body>
    </html>
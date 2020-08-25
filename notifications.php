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
        <title>Notifications</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="mainstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <style>
            .notificationcontainer{
                margin-top:20px;
                
                
            }
            .notification{
                
               
                margin:10px 15%;
                padding:10px;
            }
            .message{
                padding:6px;
                color:white;
                font-size:16px;
                background-color:rgba(169,135,57,0.6);
                border-radius:6px;
                color:rgba(256,256,256,0.8);
            }
            .action{
                text-align:center
            }
            .acceptp,.rejectp,.acceptc,.rejectc{
                padding:5px 10px;
                font-size:16px;
                margin:0 8px;
                border:none;
            }
            .ok{
                padding:5px 30px;
                font-size:16px;
                margin:0 8px;
                border:none;
            }
            .acceptp:hover,.rejectp:hover,.ok:hover,.acceptc:hover,.rejectc:hover{
                color:black;
            }
            @media (max-width:768px){
                .message{
                    margin-bottom:8px
                }
                 .accept,.reject{
                padding:5px 20px;
                font-size:16px;
                margin:0 8px;
                border:none;
            }
              .ok{
                padding:5px 50px;
                font-size:16px;
                margin:0 8px;
                border:none;
            }
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
            <h1>Notifications</h1>
        </div>
        <div class="notificationcontainer">
        
        
     <?php    
     $user=$_SESSION["username"];
     $sql = "SELECT * FROM notifications WHERE userto ='$user' ORDER BY time DESC";

//shows notes or alert message
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $id = $row['id'];
            $from = $row['userfrom'];
            $type=$row["type"];
            $amount=$row["amount"];
            if($type=='PAYR')
            {
                echo ' <div class="notification row"><div class="message col-sm-9">
                <div class="text">'.$from.' sent you an amount of Rs. '.$amount.'.Do you want to accept it.You might need to repay later.</div></div>
                   <div class="col-sm-3 action" id="'.$id.'='.$from.'='.$user.'='.$amount.'">
                <button class="btn-lg btn-success acceptp" >Accept</button>
                <button class="btn-lg btn-danger rejectp" >Reject</button>
            
            </div>
        </div>';
            }
            elseif($type=='CONNECTR')
            {
                 echo ' <div class="notification row"><div class="message col-sm-9">
                <div class="text">'.$from.' would like to add you as a contact.</div></div>
                   <div class="col-sm-3 action" id="'.$id.'='.$from.'='.$user.'">
                <button class="btn-lg btn-success acceptc" >Accept</button>
                <button class="btn-lg btn-danger rejectc" >Reject</button>
            
            </div>
        </div>';
            }
                        elseif($type=='PAYA')
            {
                 echo ' <div class="notification row"><div class="message col-sm-9">
                <div class="text">'.$from.' accepted Rs. '.$amount.' sent by you.He owe you that money.</div></div>
                   <div class="col-sm-3 action" id="'.$id.'='.$from.'='.$user.'">
                <button class="btn-lg btn-success ok" >OK</button>
                
            
            </div>
        </div>';
            }
                        elseif($type=='CONNECTA')
            {
                 echo ' <div class="notification row"><div class="message col-sm-9">
                <div class="text">'.$from.' can now exchange money with you.</div></div>
                   <div class="col-sm-3 action" id="'.$id.'='.$from.'='.$user.'">
                <button class="btn-lg btn-success ok" >OK</button>
            
            </div>
        </div>';
            }
                        elseif($type=='PAYREJECT')
            {
                 echo ' <div class="notification row"><div class="message col-sm-9">
                <div class="text">'.$from.' did not take Rs. '.$amount.'sent by you. </div></div>
                   <div class="col-sm-3 action" id="'.$id.'='.$from.'='.$user.'">
                <button class="btn-lg btn-success ok" >OK</button>
            
            </div>
        </div>';
            }
            
       
        }
    }else{
        echo '<div class="alert alert-warning" style="margin:0px 20%">You have no notifications.</div>'; exit;
    }
    
}else{
    echo '<div class="alert alert-warning" style="margin:0px 20%">An error occured!</div>'; exit;
//    echo "ERROR: Unable to excecute: $sql." . mysqli_error($link);
}   
?>
</div>

        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="home.js"></script>
    </body>
    </html>
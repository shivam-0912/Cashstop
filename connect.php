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
        <title>Connections</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="mainstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
        <style>
            
            
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
            .cardinfo{
                margin-top:15px;
                margin-left:15px;
            }
            #buttons{
                text-align:center;
            }
            #buttons input{
     background-color:rgb(169, 135, 57);
     color:white;
     border:none;
     border-radius:6px;
     padding:10px;
     margin-right:10px;
}
#buttons input:hover{
     
     color:black;
    
}
#newconnectsubmit{
       background-color:rgb(169, 135, 57);
     color:white;
    
     
     
}
#newconnectsubmit:hover{
       background-color:rgb(169, 135, 57);
     color:black;
    
     
     
}
            
         @media (max-width:768px){
        .cardpic{
         display:none;
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
            <h1>Connections</h1>
        </div>
        <div class="searchbox">
            <form method="post">
                <input type="text" placeholder="@username" id="searchtext" name="searchtext">
                <input type="submit" id="searchsubmit" value="Go" name="searchsubmit" value="searchsubmit">
            </form>
        </div>
        <div class="connectcontainer">
            <div class="row">

<?php
include("connection.php");
if($_POST["searchsubmit"]){
    $user=$_SESSION["username"];
    $username=mysqli_real_escape_string($link,$_POST["searchtext"]);
    $sql="SELECT member2 FROM connection WHERE member2 LIKE '$username%' AND member1='$user'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
   $sql2="SELECT member1 FROM connection WHERE member1 LIKE '$username%' AND member2='$user'";
$results2=mysqli_query($link,$sql2);
if(!$results2)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
$result2=mysqli_num_rows($results2);
if($result==0&&$result2==0){
      echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">There is no user with this username in your connections.Try a different username</div>';
      
}
else
{
    while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
        $member2=$row["member2"];
       $sql3="SELECT * FROM users WHERE username='$member2'";
$results3=mysqli_query($link,$sql3);
if(!$results3)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
else{
    
$row2=mysqli_fetch_array($results3,MYSQLI_ASSOC);
$pmt='uploads/'.$row2['user_id'];
    if(file_exists($pmt)){ $img= $pmt;}else{$img= 'images/profile.png';}; 
        echo '<div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$row2["username"].'</div><div class="col-sm-4 cardpic"><img src="'.$img.'" width="100%" height="100%" style="border-radius:6px"></div>
                </div>
                <div class="cardinfo">
                    <div class="clear"></div>
                    <div>
                        <div class="property">Name</div>
                        <div class="value">'.$row2["name"].'</div>
                    </div>
                    <div class="clear"></div>
                    
                    
                        <div>
                        <div class="property">UPI id</div>
                        <div class="value">'.$row2["upi"].'</div>
                    </div>
                    <div class="clear"></div>
                     <div>
                        <div class="property">Alt. Email</div>
                        <div class="value">'.$row2["alt_email"].'</div>
                    </div>
                    <div class="clear"></div>
                      <div>
                        <div class="property">PayTM</div>
                        <div class="value">'.$row2["paytm"].'</div>
                    </div>
                    <div class="clear"></div>
                                        <div>
                        <div class="property">GPay </div>
                        <div class="value">'.$row2["gpay"].'</div>
                    </div>
                    <div class="clear"></div>
                </div></div></div>';
    }}
    while($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){
        $member1=$row["member1"];
       $sql3="SELECT * FROM users WHERE username='$member1'";
$results3=mysqli_query($link,$sql3);
if(!$results3)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
else{
    
$row2=mysqli_fetch_array($results3,MYSQLI_ASSOC);
    $pmt='uploads/'.$row2['user_id'];
    if(file_exists($pmt)){ $img= $pmt;}else{$img= 'images/profile.png';}; 
        echo '<div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$row2["username"].'</div><div class="col-sm-4 cardpic"><img src="'.$img.'" width="100%" height="100%" style="border-radius:6px"></div>
                </div>
                <div class="cardinfo">
                    <div class="clear"></div>
                    <div>
                        <div class="property">Name</div>
                        <div class="value">'.$row2["name"].'</div>
                    </div>
                    <div class="clear"></div>
                    
                    
                        <div>
                        <div class="property">UPI id</div>
                        <div class="value">'.$row2["upi"].'</div>
                    </div>
                    <div class="clear"></div>
                     <div>
                        <div class="property">Alt. Email</div>
                        <div class="value">'.$row2["alt_email"].'</div>
                    </div>
                    <div class="clear"></div>
                      <div>
                        <div class="property">PayTM</div>
                        <div class="value">'.$row2["paytm"].'</div>
                    </div>
                    <div class="clear"></div>
                                        <div>
                        <div class="property">GPay </div>
                        <div class="value">'.$row2["gpay"].'</div>
                    </div>
                    <div class="clear"></div>
                </div></div></div>';
    }}
}
        
    }
else
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $user=$_SESSION["username"];
    
    $sql="SELECT member2 FROM connection WHERE member1='$user'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
   $sql2="SELECT member1 FROM connection WHERE member2='$user'";
$results2=mysqli_query($link,$sql2);
if(!$results2)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
$result=mysqli_num_rows($results);
$result2=mysqli_num_rows($results2);
if($result==0&&$result2==0){
      echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Currently you are not connected to any user.</div>';
      
}
else
{
    while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
        $member2=$row["member2"];
       $sql3="SELECT * FROM users WHERE username='$member2'";
$results3=mysqli_query($link,$sql3);
if(!$results3)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
else{
    
$row2=mysqli_fetch_array($results3,MYSQLI_ASSOC);
     $pmt='uploads/'.$row2['user_id'];
    if(file_exists($pmt)){ $img= $pmt;}else{$img= 'images/profile.png';};    
        echo '<div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$row2["username"].'</div><div class="col-sm-4 cardpic"><img src="'.$img.'" width="100%" height="100%" style="border-radius:6px"></div>
                </div>
                <div class="cardinfo">
                    <div class="clear"></div>
                    <div>
                        <div class="property">Name</div>
                        <div class="value">'.$row2["name"].'</div>
                    </div>
                    <div class="clear"></div>
                    
                    
                        <div>
                        <div class="property">UPI id</div>
                        <div class="value">'.$row2["upi"].'</div>
                    </div>
                    <div class="clear"></div>
                     <div>
                        <div class="property">Alt. Email</div>
                        <div class="value">'.$row2["alt_email"].'</div>
                    </div>
                    <div class="clear"></div>
                      <div>
                        <div class="property">PayTM</div>
                        <div class="value">'.$row2["paytm"].'</div>
                    </div>
                    <div class="clear"></div>
                                        <div>
                        <div class="property">GPay </div>
                        <div class="value">'.$row2["gpay"].'</div>
                    </div>
                    <div class="clear"></div>
                </div></div></div>';
    }}
    while($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){
        $member1=$row["member1"];
       $sql3="SELECT * FROM users WHERE username='$member1'";
$results3=mysqli_query($link,$sql3);
if(!$results3)
{
    echo '<div class="col-xs-offset-2 col-xs-8 alert alert-danger">Error running the query.</div>';
    exit;
    
}
else{
    
$row2=mysqli_fetch_array($results3,MYSQLI_ASSOC);
        $pmt='uploads/'.$row2['user_id'];
    if(file_exists($pmt)){ $img= $pmt;}else{$img= 'images/profile.png';}; 
        echo '<div class="col-md-4 connectioncard"><div class="profilecard"><div class="head row">
                    <div class="col-sm-8 cardname">'.$row2["username"].'</div><div class="col-sm-4 cardpic"><img src="'.$img.'" width="100%" height="100%" style="border-radius:6px"></div>
                </div>
                <div class="cardinfo">
                    <div class="clear"></div>
                    <div>
                        <div class="property">Name</div>
                        <div class="value">'.$row2["name"].'</div>
                    </div>
                    <div class="clear"></div>
                    
                    
                        <div>
                        <div class="property">UPI id</div>
                        <div class="value">'.$row2["upi"].'</div>
                    </div>
                    <div class="clear"></div>
                     <div>
                        <div class="property">Alt. Email</div>
                        <div class="value">'.$row2["alt_email"].'</div>
                    </div>
                    <div class="clear"></div>
                      <div>
                        <div class="property">PayTM</div>
                        <div class="value">'.$row2["paytm"].'</div>
                    </div>
                    <div class="clear"></div>
                                        <div>
                        <div class="property">GPay </div>
                        <div class="value">'.$row2["gpay"].'</div>
                    </div>
                    <div class="clear"></div>
                </div></div></div>';
    }}
}   
}
?>
</div>
        </div>
        
        
<!--this is done to add a new connection..................................................................
...........................................................................................................
..................................................................................-->
<div id="buttons">
    <input type="submit" class="newconnect" value="Connect to a new user" data-target="#newconnectmodal" data-toggle="modal" >
    <input type="submit" class="viewprofile" value="View Profile" data-target="#viewprofilemodal" data-toggle="modal" >

</div>
     <form method="post" id="newconnectform">
    <div class="modal" id="newconnectmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!--close class is used to align the close icon to the right-->
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 id="order">Enter the username of the user to connect.</h4>
                </div>
                <div class="modal-body">
                  <div id="newconnectmessage"></div>
                     <div class="form-group">
                        <label for="newconnectusername">Username</label>
                        <input type="text" class="form-control" placeholder="@username" id="newconnectusername" name="newconnectusername">
                     </div>
                <div class="modal-footer">
                <input class="btn " id="newconnectsubmit" type="submit" name="newconnectsubmit" value="Connect">
                 <button class="btn" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

   </form> 
                    
<!--this is done to add a new connection..................................................................
...........................................................................................................
..................................................................................-->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="home.js"></script>
    </body>
    </html>
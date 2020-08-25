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
           
<?php
if($_POST["changeprofilepic"])
{
    
    
    //_FILES store all the info of uploaded file in the form of an array
    $name=$_FILES["profilepic"]["name"];//here file is the value of the name attribute of input
    $type=$_FILES["profilepic"]["type"];
    $tmp=$_FILES["profilepic"]["tmp_name"];
    $err=$_FILES["profilepic"]["error"];
    $pmt="uploads/".$_SESSION["user_id"];
    $size=$_FILES["profilepic"]["size"];

    //errors
    $noupload="Please upload a file.";
   
    $oversize="Please upload a file having size less than 3Mb.";
    $wrongtype="Please upload a jpeg or png image.";

    //allowed types
    $allowed=array("image/jpeg","image/png");


    if($err==4){//this error code occurs when no file is uploaded
        $error.=$noupload;
    }
    else{
        if(file_exists($pmt))
        {
            unlink($pmt);
        }
        if($size>3*1024*1024){
            $error.=$oversize;
        }
        if(!in_array($type,$allowed)){
            $error.=$wrongtype;
        }
    }
    if($error)
    {
        $result='<script>alert("'.$error.'")</script>';
        echo $result;
    }
    else{
        if(move_uploaded_file($tmp,$pmt)){//this fn moves the file from tmp-location to pmt-location
         
            $result='<script>alert("Profile picture changed successfully")</script>';
             echo $result;
        }
        else{
                $result='<script>alert("Image not able to upload .Please try again.")</script>';
                echo $result;
        }

    }
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Profile</title>
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="mainstyle.css">
        <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
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
                    <li class="navbar-right"><a id="homelogin" class="btn" href="index.php?logout=1">Logout</a></li>
                    </ul>
             </div>
    
            </div>
        </nav>
        <div class="header">
            <h1>Profile</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-6">
                    <div>
                        <div class="property">Username</div>
                        <div class="value"><?php echo $_SESSION['username']; ?></div>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <div class="property">Email</div>
                        <div class="value"><?php echo $_SESSION['email']; ?></div>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <div class="property">Name</div>
                        <div class="value"><?php echo $_SESSION['name']; ?></div>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <div class="property">Date of Birth</div>
                        <div class="value"><?php echo $_SESSION['DOB']; ?></div>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <div class="property">Occupation</div>
                        <div class="value"><?php echo $_SESSION['occupation']; ?></div>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <div class="property">Company</div>
                        <div class="value"><?php echo $_SESSION['company']; ?></div>
                    </div>
                    <div class="clear"></div>
                        <div>
                        <div class="property">UPI id</div>
                        <div class="value"><?php echo $_SESSION['upi']; ?></div>
                    </div>
                    <div class="clear"></div>
                     <div>
                        <div class="property">Alternate Email id</div>
                        <div class="value"><?php echo $_SESSION['alt_email']; ?></div>
                    </div>
                    <div class="clear"></div>
                      <div>
                        <div class="property">PayTM Number</div>
                        <div class="value"><?php echo $_SESSION['paytm']; ?></div>
                    </div>
                    <div class="clear"></div>
                                        <div>
                        <div class="property">GPay Number</div>
                        <div class="value"><?php echo $_SESSION['gpay']; ?></div>
                    </div>
                    <div class="clear"></div>
                    <div id="updateinfodiv">
                  <input type="submit" class="updateinfo" value="Update Profile Info" data-target="#updateinfomodal" data-toggle="modal" >
                    </div>
                </div>
                <div class="col-sm-3" id="right">
                        <div class="image">
                            <img src="<?php  $pmt='uploads/'.$_SESSION['user_id'];if(file_exists($pmt)){ echo $pmt;}else{echo 'images/profile.png';}; ?>"  width="100%" height="100%">
                        </div>
                        <div id="uploadprofilepic">
                         <form method="post" enctype="multipart/form-data" >
                          
                           
                            
                             <input type="file" name="profilepic" id="profilepic" placeholder="Select a profile picture">
                             <br>
              
            
                             <input type="submit" name="changeprofilepic" value="Change profile pic" id="changeprofilepic">
                        </form>
                       </div>
                </div>
            </div>
        </div>
   
              <form method="post" id="updateinfoform">
      <div class="modal" id="updateinfomodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!--close class is used to align the close icon to the right-->
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 id="order"> Update Profile Information</h4>
                </div>
                <div class="modal-body">
                    <div id="updateinfomessage"></div>
                   
                       <div class="form-group">
                       <label for="updateinfousername" class="sr-only">Username</label>
                       <input type="text" class="form-control" placeholder="Username" id="updateinfousername" name="updateinfousername" value="<?php echo $_SESSION['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="updateinfoemail" class="sr-only">Email</label>
                        <input type="text" class="form-control" placeholder="Email Address" id="updateinfoemail" name="updateinfoemail" value="<?php echo $_SESSION['email']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfoname" class="sr-only">Name</label>
                        <input type="text" class="form-control" placeholder="Name" id="updateinfoname" name="updateinfoname" value="<?php echo $_SESSION['name']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfoDOB" class="sr-only">DOB</label>
                        <input type="date" class="form-control" placeholder="Date of Birth" id="updateinfoDOB" name="updateinfoDOB" value="<?php echo $_SESSION['DOB']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfoocupation" class="sr-only">Occupation</label>
                        <input type="text" class="form-control" placeholder="Occupation" id="updateinfooccupation" name="updateinfooccupation" value="<?php echo $_SESSION['occupation']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfocompany" class="sr-only">Company</label>
                        <input type="text" class="form-control" placeholder="Company" id="updateinfocompany" name="updateinfocompany" value="<?php echo $_SESSION['company']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfoupi" class="sr-only">UPI</label>
                        <input type="text" class="form-control" placeholder="UPI ID" id="updateinfoupi" name="updateinfoupi" value="<?php echo $_SESSION['upi']; ?>">
                     </div><div class="form-group">
                        <label for="updateinfoalt_email" class="sr-only">Alt Email</label>
                        <input type="text" class="form-control" placeholder="Alternate Email Address" id="updateinfoalt_email" name="updateinfoalt_email" value="<?php echo $_SESSION['alt_email']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfopaytm" class="sr-only">Paytm</label>
                        <input type="number" class="form-control" placeholder="PayTM Number" id="updateinfopaytm" name="updateinfopaytm" value="<?php echo $_SESSION['paytm']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="updateinfogpay" class="sr-only">GPay</label>
                        <input type="text" class="form-control" placeholder="GPay Number" id="updateinfogpay" name="updateinfogpay" value="<?php echo $_SESSION['gpay']; ?>">
                     </div>
                   
                 
 
                </div>
                <div class="modal-footer">
                    <input class="btn " id="updateinfo" type="submit" name="updateinfo" value="Update">
                 <button class="btn cancel" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
   
      </form>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <script src="home.js"></script>
    </body>
    </html>
<?php
session_start();
include('connection.php');

$text = $_POST['id'];
$text=explode('=',$text);
$id=$text[0];
$from=$text[1];
$to=$text[2];
$amount=$text[3];
$time=time();
$sql = "INSERT INTO notifications (`userfrom`, `userto`, `type`, `time`,`amount`) VALUES ('$to', '$from', 'PAYA', '$time','$amount')";
$results = mysqli_query($link, $sql);
if(!$results){
    echo 'error'; 
    exit;
}

$sql = "DELETE FROM notifications WHERE id = $id";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';   
    exit;
}
$sql="SELECT * FROM connection WHERE member2='$from' AND member1='$to'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo 'error';
    exit;
    
}
$result=mysqli_num_rows($results);
if($result!=0)
{
    $row=mysqli_fetch_array($results,MYSQLI_ASSOC);
    $originalamount=$row["amount"];
    $newamount=$originalamount-$amount;
    $connectid=$row["connect_id"];
    $sql="UPDATE connection SET amount='$newamount' WHERE connect_id='$connectid'";

$results = mysqli_query($link, $sql);
if(!$results){
    echo 'error'; 
    exit;
}
else
{
    exit;
}
}
$sql="SELECT * FROM connection WHERE member1='$from' AND member2='$to'";
$results=mysqli_query($link,$sql);
if(!$results)
{
    echo 'error';
    exit;
    
}
$result=mysqli_num_rows($results);
if($result!=0)
{
    $row=mysqli_fetch_array($results,MYSQLI_ASSOC);
    $originalamount=$row["amount"];
    $newamount=$originalamount+$amount;
    $connectid=$row["connect_id"];
    $sql="UPDATE connection SET amount='$newamount' WHERE connect_id='$connectid'";

$results = mysqli_query($link, $sql);
if(!$results){
    echo 'error'; 
    exit;
}
else
{
    exit;
}
}

?>
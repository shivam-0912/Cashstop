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
$sql = "INSERT INTO notifications (`userfrom`, `userto`, `type`, `time`,`amount`) VALUES ('$to', '$from', 'PAYREJECT', '$time','$amount')";
$results = mysqli_query($link, $sql);
if(!$results){
    echo 'error'; 
    exit;
}

$sql = "DELETE FROM notifications WHERE id = $id";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';   
}

?>
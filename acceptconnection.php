<?php
session_start();
include('connection.php');

$text = $_POST['id'];
$text=explode('=',$text);
$id=$text[0];
$from=$text[1];
$to=$text[2];
$time=time();
$sql = "INSERT INTO notifications (`userfrom`, `userto`, `type`, `time`) VALUES ('$to', '$from', 'CONNECTA', '$time')";
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
$sql = "INSERT INTO connection (`member1`,`member2`) VALUES ('$from','$to')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';   
}

?>
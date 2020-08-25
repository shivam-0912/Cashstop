<?php
session_start();
include('connection.php');

$text = $_POST['id'];
$text=explode('=',$text);
$id=$text[0];


$sql = "DELETE FROM notifications WHERE id = $id";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';   
}


?>
<?php

require 'config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "delete from users where id='$id'";
    $res= mysqli_query($con, $sql);
    if($res){
        header('location:show.php');
    }
}
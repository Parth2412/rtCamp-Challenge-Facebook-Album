<?php

session_start();
if(isset($_SESSION['accessToken']))
{
    unset($_SESSION['accessToken']);
}
if(isset($_SESSION['accessToken']))
{
    $sess=new FacebookSession($_SESSION['accessToken']);
}
session_destroy();
header("location:index.php");
?>
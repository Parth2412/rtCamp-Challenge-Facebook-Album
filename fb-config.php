<?php
session_start();
require_once './Facebook/autoload.php';
$facebook=new \Facebook\Facebook([
    'app_id'=>'1907596985964868',
    'app_secret'=>'262bf7031a2f1cd1610e780eb2a6f21e',
    'default_graph_version'=>'v2.10'
]);

$helper=$facebook->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    if (!isset($_SESSION['state'])) {
        $_SESSION['fbState'] = $_GET['state'];
        $helper->getPersistentDataHandler()->set('state', $_SESSION['fbState']);
    } else {
        $helper->getPersistentDataHandler()->set('state', $_SESSION['fbState']);
    }
}
?>
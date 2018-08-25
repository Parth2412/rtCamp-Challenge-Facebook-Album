<?php
    require_once './fb-config.php';
    if(isset($_SESSION['access_token']))
    {
        header('location:index.php');
        exit();
    }
    $redirectURL="https://fbalbumchallenge.000webhostapp.com/fb-callback.php";
    $permissions=['email'];
    $loginURL=$helper->getLoginUrl($redirectURL,$permissions);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Facebook Album Challenge</title>
<style>
    
body {
    font-family: 'Catamaran', sans-serif;
    font-size: 100%;
    background: linear-gradient(to left top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
    min-height: 97.8vh;
    text-align: center;
}
    .button
    {
        background: #000;
        border:none;
        color:#f0ad4e;
        padding: 28px 56px;
        font-size: 24px;
        border-radius: 8px;
        display: inline-block;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        position: absolute;
        right:40%;
        top:40%;
    }
    .button:hover
    {
        background: #f0ad4e;
        color:#000;
    }
    
    .wrapper
    {
        z-index:99999;
    }
</style>
</head>
<body>
    
    <div class="wrapper">
        <button class="button" onclick="window.location='<?php echo $loginURL;?>'">Login With Facebook</button>
    </div>
</body>
</html>
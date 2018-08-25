<?php
require_once("functions.php");
require_once './fb-config.php';


header('Content-Type: text/html; charset=utf-8');

global $CLIENT_ID, $CLIENT_SECRET, $REDIRECT_URI;
$client = new Google_Client();
$client->setClientId($CLIENT_ID);
$client->setClientSecret($CLIENT_SECRET);
$client->setRedirectUri($REDIRECT_URI);
$client->setScopes('email');

$authUrl = $client->createAuthUrl();	
getCredentials($_GET['code'], $authUrl);

$userName = $_SESSION["userInfo"]["name"];
$userEmail = $_SESSION["userInfo"]["email"];


$permissions = ['user_photos'];
$accessToken =  $_SESSION['access_token'];  

if (isset($accessToken)) 
{
    $fb = new Facebook\Facebook([
    'app_id' => '1907596985964868', // Replace {app-id} with your app id
    'app_secret' => '262bf7031a2f1cd1610e780eb2a6f21e',
    'default_graph_version' => 'v2.2',
    'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token']  : '262bf7031a2f1cd1610e780eb2a6f21e'
    ]);
    
    $re = $fb->get(
            '/'.$_SESSION['album_id'].'/photos?limit=100',
            $accessToken
          );
    $graphEdge = $re->getGraphEdge()  


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Facebook Album Challenge</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="style/css/lightgallery.css" rel="stylesheet">
  <style>
            body{
                margin: 0;
                font-family: 'Catamaran', sans-serif;
                font-size: 1rem;
                background: linear-gradient(to left top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                -ms-background-size: cover;
                min-height: 97.8vh;
                
            }
            .demo-gallery > ul {
                margin-bottom: 0;
            }
            .demo-gallery > ul > li {
                float: left;
                margin-bottom: 15px;
                margin-right: 20px;
                width: 400px;
            }
            .demo-gallery > ul > li a {
                
                display: block;
                overflow: hidden;
                position: relative;
                float: left;
            }
            .demo-gallery > ul > li a > img {
                -webkit-transition: -webkit-transform 0.15s ease 0s;
                -moz-transition: -moz-transform 0.15s ease 0s;
                -o-transition: -o-transform 0.15s ease 0s;
                transition: transform 0.15s ease 0s;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                height: 70%;
                width: 80%;
            }
            .demo-gallery > ul > li a:hover > img {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }
            .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
                opacity: 1;
            }
            .demo-gallery > ul > li a .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.1);
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
                -webkit-transition: background-color 0.15s ease 0s;
                -o-transition: background-color 0.15s ease 0s;
                transition: background-color 0.15s ease 0s;
            }
            .demo-gallery > ul > li a .demo-gallery-poster > img {
                left: 50%;
                margin-left: -10px;
                margin-top: -10px;
                opacity: 0;
                position: absolute;
                top: 50%;
                -webkit-transition: opacity 0.3s ease 0s;
                -o-transition: opacity 0.3s ease 0s;
                transition: opacity 0.3s ease 0s;
            }
            .demo-gallery > ul > li a:hover .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.5);
            }
            .demo-gallery .justified-gallery > a > img {
                -webkit-transition: -webkit-transform 0.15s ease 0s;
                -moz-transition: -moz-transform 0.15s ease 0s;
                -o-transition: -o-transform 0.15s ease 0s;
                transition: transform 0.15s ease 0s;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                height: 100%;
                width: 100%;
            }
            .demo-gallery .justified-gallery > a:hover > img {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }
            .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
                opacity: 1;
            }
            .demo-gallery .justified-gallery > a .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.1);
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
                -webkit-transition: background-color 0.15s ease 0s;
                -o-transition: background-color 0.15s ease 0s;
                transition: background-color 0.15s ease 0s;
            }
            .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
                left: 50%;
                margin-left: -10px;
                margin-top: -10px;
                opacity: 0;
                position: absolute;
                top: 50%;
                -webkit-transition: opacity 0.3s ease 0s;
                -o-transition: opacity 0.3s ease 0s;
                transition: opacity 0.3s ease 0s;
            }
            .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.5);
            }
            .demo-gallery .video .demo-gallery-poster img {
                height: 48px;
                margin-left: -24px;
                margin-top: -24px;
                opacity: 0.8;
                width: 48px;
            }
            .demo-gallery.dark > ul > li a {
                border: 3px solid #04070a;
            }
            .home .demo-gallery {
                padding-bottom: 80px;
            }
        </style>
</head>
<body class="home">

        <div class="demo-gallery">
            <ul  id="lightgallery" class="list-unstyled row" style="list-style-type: none;">
                
             <?php 
    try{
        ini_set("maxicum_execution_time", 500);
        for($j=0;$j<count($graphEdge);$j++)
            {
                $res = $fb->get('/'.$graphEdge[$j]['id'].'?fields=images',$accessToken);
                $graphNode = $res->getGraphNode();
                $path=$graphNode['images'][0]; 
                ?>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="<?php echo $path['source']?>" data-src="<?php echo $path['source']?>" data-sub-html="<h4></h4><p></p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                    <a href="">
                         <img src="<?php echo $path['source']?>" alt="<?php echo $path['source']?>" >
                    </a>
                </li>
               
                <?php
            }
        }catch(Facebook\Exceptions\FacebookSDKException $e){
            echo "SDK Exception: ".$e->getMessage();
        }
     ?>
            </ul>
        </div>
        
    <script src="style/js/picturefill.min.js"></script>
        <script src="style/js/lightgallery.js"></script>
        <script src="style/js/lg-pager.js"></script>
        <script src="style/js/lg-autoplay.js"></script>
        <script src="style/js/lg-fullscreen.js"></script>
        <script src="style/js/lg-zoom.js"></script>
        <script src="style/js/lg-hash.js"></script>
        <script src="style/js/lg-share.js"></script>
        <script>
            lightGallery(document.getElementById('lightgallery'));
        </script>
    </body>
</html>
      
<?php 
        
} else {
    $loginUrl = $helper->getLoginUrl('https://www.album-challenge.000webhostapp.com/display-album.php', $permissions);
}
?>


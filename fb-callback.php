<?php
require_once './fb-config.php';
require_once './display-album.php';
try
{
    $accessToken=$helper->getAccessToken();
}
catch(\Facebook\Exceptions\FacebookResponseException $ex)
{
    echo "Response exception: ".$ex->getMessage();
    exit();
}
catch(\Facebook\Exceptions\FacebookSDKException $ex)
{
    echo "SDK exception: ".$ex->getMessage();
    exit();
}
if(!$accessToken)
{
    header('location:index.php');
    exit();
}
    $oAuth2Client=$facebook->getOAuth2Client();
    if(!$accessToken->isLongLived())
    {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    }    
    $response=$facebook->get("me?fields=id,name,email",$accessToken);
    $userData=$response->getGraphNode()->asArray();
    $_SESSION['userData']=$userData;
    $_SESSION['access_token']=(string)$accessToken;
    header('location:display-album.php');
    exit();
?>
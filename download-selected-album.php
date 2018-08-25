<?php


require_once './fb-config.php';

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
    
    
    //For Selected Album Download
            $album_list=$_GET['albumid'];
            $selected_album_list=explode("/",$album_list);
            print_r($selected_album_list);
            for($i=1;$i<=count($selected_album_list);$i++)
            {
                $re = $fb->get('/'.$selected_album_list[$i].'/photos?limit=100',$accessToken);
                $graphEdge = $re->getGraphEdge();
                $album_id=$_GET['albumid'];
                $zip=new ZipArchive();
                try{
                    $zip->open('Downloads/'.$selected_album_list[$i].'.zip', ZipArchive::CREATE);
                    ini_set('max_execution_time', 300);
                    for($j=0;$j<count($graphEdge);$j++)
                    {
                        $res = $fb->get('/'.$graphEdge[$j]['id'].'?fields=images',$accessToken);
                        $graphNode = $res->getGraphNode();
                        $path=$graphNode['images'][0]; 
                        $image_path=$path['source'];
                        $zip->addFromString($j.'.jpg', file_get_contents($image_path));
                    }
                    $zip->close();
                    header('Content-Disposition: attachment; filename=Downloads/'.$selected_album_list[$i].'.zip');
                    header('Content-Type: application/zip');
                    readfile('Downloads/'.$selected_album_list[$i].'.zip');
                    header("location:display-album.php");
                    echo "<script>alert('Album successfully downloaded');</script>";
                }catch(Facebook\Exceptions\FacebookSDKException $e){
                    echo "SDK Exception: ".$e->getMessage();
                }
            }
    //For Selected Ablum Download End
    
    
}else {
    $loginUrl = $helper->getLoginUrl('fbalbumchallenge.000webhostapp.com/display-album.php', $permissions);
}

?>

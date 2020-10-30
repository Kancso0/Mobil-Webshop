<?php


require_once('config.php');


if(isset($_GET['code']))
{
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token['error']))
    {
        $gClient->setAccessToken($token['access_token']);
        $_SESSION['GOG_accessToken'] = $token['access_token'];

        $oAuth = new Google_Service_Oauth2($gClient);
        $userData = $oAuth->userinfo->get();
   
        $_SESSION['email_gAuth'] = $userData['email'];
        $_SESSION['fullname_gAuth'] = $userData['name'];

    
    header('Location: ../dashboard.php');
    
    }
   
}






?>
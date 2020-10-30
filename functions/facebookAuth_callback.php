<?php


require_once('config.php');

if(isset($_GET['code']))
{
    if(isset($_SESSION['Face_accesToken']))
    {
        $Face_accesToken = $_SESSION['Face_accesToken'];
    }
    else
    {
        $Face_accesToken = $facebook_helper->getAccessToken();

        $oAuth2Client = $facebook->getOAuth2Client();
        if(!$Face_accesToken->isLongLived())
           {
             $Face_accesToken = $oAuth2Client->getLongLivedAccessToken($Face_accesToken);
           }

        $_SESSION['Face_accesToken'] = $Face_accesToken;

        $facebook->setDefaultAccessToken($_SESSION['Face_accesToken']);
    }

    $graph_response = $facebook->get("/me?fields=name,email",  $Face_accesToken);

    $facebook_user_info = $graph_response->getGraphUser();


    if(!empty($facebook_user_info['name']))
    {
    $_SESSION['fullname_fAuth'] = $facebook_user_info['name'];
    }
    if(!empty($facebook_user_info['email']))
    {
    $_SESSION['email_fAuth'] = $facebook_user_info['email'];
    }

    header('Location: ../dashboard.php');

}


?>
<?php

ob_start();
session_start();

require_once('db.php');

// Google API LOGIN settings


require_once('c:/xampp/htdocs/vendor/autoload.php');

$gClient = new Google_Client();
$gClient->setClientId("1045880518531-7v1vr5pn8bnm07ca68rs7nfs9enh2bvn.apps.googleusercontent.com");
$gClient->setClientSecret("wnIG_Y6in6llzzVDWfrbD156");
$gClient->setApplicationName("CPI Login");
$gClient->setRedirectUri("http://localhost/CarWebshop/functions/googleAuth_callback.php");
$gClient->addScope('email');
$gClient->addScope('profile');


//  END Google API settings

// Facebook API LOGIN settings

$facebook = new \Facebook\Facebook([
    'app_id' => '1173709949641532',
    'app_secret' => '42942a5ed2364c7e9286359fd464cf72',
    'default_graph_version' => 'v2.10',
  ]);

$facebook_helper = $facebook->getRedirectLoginHelper();



// END Facebook API LOGIN settings

require_once('functions.php');
require_once('Get_Post_Sessions.php');

?>
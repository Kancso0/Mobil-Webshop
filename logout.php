<?php

require_once('functions/config.php');
session_destroy();
unset($_SESSION['Username']);

if(isset($_COOKIE['Username']))
    {
        unset($_COOKIE['Username']);
        setcookie('Username','',time()-86400);
    }
unset($_SESSION['GOG_accessToken']);
$gClient->revokeToken();

unset($_SESSION['shopping_cart']);

redirect('login.php');


?>
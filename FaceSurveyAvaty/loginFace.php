<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
require "facebook-php-sdk-master/src/facebook.php";

$facebook = new Facebook(array(
    'appId' => '571246082923560',
    'secret' => 'db04d971285a41859ba9d1529510a960',
        ));

$user = $facebook->getUser();

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl();
}

?>

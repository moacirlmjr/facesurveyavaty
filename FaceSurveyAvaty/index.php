<!DOCTYPE html>
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
    header("Location: " + $loginUrl);
}

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>FaceSurveyAvaty</title>
    </head>
    <body>
        <h1>php-sdk</h1>

        <?php if ($user): ?>
            <h3>You</h3>
            <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

            <h3>Your User</h3>
            <pre><?php print($user_profile['id']); ?></pre>
            <pre><?php print($user_profile['username']); ?></pre>
        <?php else: ?>
            <strong><em>You are not Connected.</em></strong>
        <?php endif ?>

    </body>
</html>

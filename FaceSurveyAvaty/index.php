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
            <a href="<?php echo $logoutUrl; ?>">Logout</a>
        <?php else: ?>
            <div>
                Login using OAuth 2.0 handled by the PHP SDK:
                <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
            </div>
        <?php endif ?>

        <h3>PHP Session</h3>
        <pre><?php print_r($_SESSION); ?></pre>

        <?php if ($user): ?>
            <h3>You</h3>
            <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

            <h3>Your User Object (/me)</h3>
            <pre><?php print_r($user_profile); ?></pre>
        <?php else: ?>
            <strong><em>You are not Connected.</em></strong>
        <?php endif ?>

    </body>
</html>

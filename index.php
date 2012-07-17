<?php 
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php'; 
$twitterObj = new EpiTwitter($consumerKey, $consumerSecret); 
echo '<a href="' . $twitterObj->getAuthorizationUrl() . '">Connect Twitter  </a>';  
?> 
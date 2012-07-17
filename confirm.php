<?php
session_start();
include("db.php"); 
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';  
$Twitter = new EpiTwitter($consumerKey, $consumerSecret); 
$Twitter->setToken($_GET['oauth_token']);  
$token = $Twitter->getAccessToken();  
setcookie('oauth_token', $token->oauth_token);
setcookie('oauth_token_secret', $token->oauth_token_secret);
$token->oauth_token;  
$token->oauth_token_secret;  
$Twitter->setToken($token->oauth_token, $token->oauth_token_secret); 
$user= $Twitter->get_accountVerify_credentials();  
$_SESSION['username']=$username; //Authenticated username
$_SESSION['oauth_token']=$token->oauth_token;
$_SESSION['oauth_token_secret']=$token->oauth_token_secret;
if($_SESSION['username']){
header('Location:home.php'); //Redirecting Page
} 
?>
 
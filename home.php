<?php  
session_start();
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';  
include 'secret.php';  
$Twitter = new EpiTwitter($consumerKey, $consumerSecret);
$Twitter->setToken($_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
$hometimeline = $Twitter->get_statusesHome_timeline(array('count'=>10,'page'=>1));
$tweeters = $hometimeline->response; 
$my_array['timeline'] = array('headline' => 'TimeLine','type' => 'default','startDate' => 1888,'text'=>'TimeLine'); 
$i=0;
$stamp=0;
foreach($tweeters as $tweets ){ 
 $stamp =date("Y,m,d,H:i:s", strtotime($tweets['created_at']));  
 $my_array['timeline']['date'][$i] =array(
 									 'startDate'=>$stamp,
									 'headline'=>$tweets['user']['name'],
									 'text'=>$tweets['user']['description'],
									 'asset'=>array(
									 	  'media'=>'http://twitter.com/'.$tweets['user']['screen_name'].'/status/'.$tweets['id_str'],
										  'credit'=>'',
										  'caption'=>'', 
									 )
 									);
									$i++;
}
file_put_contents('twitt.json',json_encode($my_array));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Twitter Timeline">
<title>Twitter Timeline</title>
<style>
			html, body {
				height:100%;
				padding: 0px;
				margin: 0px;
			}
			#timeline-embed{
				margin:0px !important;
				border:0px solid #CCC !important;
				padding:0px !important;
				-webkit-border-radius:0px !important;
				-moz-border-radius:0px !important;
				border-radius:0px !important;
				-moz-box-shadow:0 0px 0px rgba(0, 0, 0, 0.25) !important;
				-webkit-box-shadow:0 0px 0px rgba(0, 0, 0, 0.25) !important;
				box-shadow:0px 0px 0px rgba(0, 0, 0, 0.25) !important;
			}
			
		</style>
</head> 
<body>
<!-- BEGIN Timeline Embed -->
		<div id="timeline-embed"></div>
		<script type="text/javascript">
		    var timeline_config = {
				width: 	"100%",
				height: "100%",
				source: 'twitt.json',
				//start_at_end:	true,								//OPTIONAL
				hash_bookmark: true,								//OPTIONAL
				css: 	'compiled/css/timeline.css',				//OPTIONAL
				js: 	'compiled/js/timeline-min.js'				//OPTIONAL
			}
		</script>
		<script type="text/javascript" src="compiled/js/timeline-embed.js"></script>
		<!-- END Timeline Embed   -->
</body>
</html>

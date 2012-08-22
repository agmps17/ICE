<?php
 ob_start();
 session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript"
  src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js">
</script>
</head>

<body style="background: url(simple_blue.jpg) no-repeat;background-size: 100%;overflow:hidden;">
<div><img src="logo_text.png" style="display: block; margin-left: auto; margin-right: auto; vertical-align: middle; margin-top: "/></div>

<?php

/** 
 * DropPHP sample
 *
 * http://fabi.me/en/php-projects/dropphp-dropbox-api-client/
 *
 * @author     Fabian Schlieper <fabian@fabi.me>
 * @copyright  Fabian Schlieper 2012
 * @version    1.0
 * @li
 cense    See license.txt
 *
 
 */
error_reporting(E_ALL);
require_once("DropboxClient.php");

// you have to create an app at https://www.dropbox.com/developers/apps and enter details below:
$dropbox = new DropboxClient(array(
	'app_key' => "", 
	'app_secret' => "",
	'app_full_access' => true,
),'en');
// first try to load existing access token
$access_token = @unserialize($_SESSION['token']);
if(!empty($access_token)) {
	$dropbox->SetAccessToken($access_token);
}
elseif(!empty($_GET['auth_callback'])) // are we coming from dropbox's auth page?
{
	// then load our previosly created request token
	$request_token = load_token($_GET['oauth_token']);
	if(empty($request_token)) die('Request token not found!');
	
	// get & store access token, the request token is not needed anymore
	$access_token = $dropbox->GetAccessToken($request_token);	
	//store_token($access_token, "access");
	$_SESSION['token']=serialize($access_token);
	delete_token($_GET['oauth_token']);
}

// checks if access token is required
if(!$dropbox->IsAuthorized())
{
	// redirect user to dropbox auth page
	$return_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?auth_callback=1";
	$auth_url = $dropbox->BuildAuthorizeUrl($return_url);
	$request_token = $dropbox->GetRequestToken();
	store_token($request_token, $request_token['t']);
?>
 <a href="<?php echo $auth_url; ?>"><img src="login_button.png" style="height:100px; display: block; margin-left: auto; margin-right: auto; vertical-align: middle" /></a>	
<?php	
}

function store_token($token, $name)
{
	file_put_contents("tokens/$name.token", serialize($token));
}

function load_token($name)
{
	if(!file_exists("tokens/$name.token")) return null;
	return @unserialize(@file_get_contents("tokens/$name.token"));
}

function delete_token($name)
{
	@unlink("tokens/$name.token");
}
if(isset($_SESSION['token'])){
//unset($_SESSION['token']);
header("Location:welcome.php");
}
?>
</body>
</html>

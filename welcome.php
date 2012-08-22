<?php
ob_start();
session_start();
if(!isset($_SESSION['token'])){
header("Location:index.php");

}
function logout(){

if(isset($_SESSION['token'])){
unset($_SESSION['token']);
header("Location:welcome.php");
}



}

/** 
 * DropPHP sample
 *
 * http://fabi.me/en/php-projects/dropphp-dropbox-api-client/
 *
 * @author     Fabian Schlieper <fabian@fabi.me>
 * @copyright  Fabian Schlieper 2012
 * @version    1.0
 * @license    See license.txt
 *
 
 
 */
error_reporting(E_ALL);
require_once("DropboxClient.php");

// you have to create an app at https://www.dropbox.com/developers/apps and enter details below:
$dropbox = new DropboxClient(array(
	'app_key' => "8ln3100x6d7cmn5", 
	'app_secret' => "lv2vbedkojiuhpt",
	'app_full_access' => true,
),'en');


// first try to load existing access token
$access_token = @unserialize($_SESSION['token']);
if(!empty($access_token)) {
	$dropbox->SetAccessToken($access_token);
	//print_r($access_token);
	
}

//echo "<pre>";
//echo "<b>Account:</b>\r\n";
//print_r($dropbox->GetAccountInfo());

function musicFile($path)
{
	global $dropbox;
	
	global $dropbox;
			$dl = explode("/", $path);
			
			$sd = $dl[count($dl)-1];
	$dropbox->DownloadFile($sd, $sd);
}


function thumbnail($path)
		{

			global $dropbox;
			$dl = explode("/", $path);
			
			$sd = $dl[count($dl)-1];
			echo $sd;
			$dropbox->DownloadThumbnail($sd, $sd);
			
		}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"
><head>
	<title>ICE-Interactive Cloud Environment</title>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
	  <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
	 <link type='text/css' href='css/ui-lightness/jquery-ui-1.8.23.custom.css' rel='stylesheet' />
		<script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
		<script type='text/javascript' src='js/jquery-ui-1.8.23.custom.min.js'></script>
	<link type='text/css' href='css/ui-lightness/jquery-ui-1.8.23.custom.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" media="screen" href="css/dock-example1.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/stack-example3.css">
	<script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
		<script type='text/javascript' src='js/jquery-ui-1.8.23.custom.min.js'></script>
    	<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
	<script type="text/javascript" src="js/fisheye-iutil.min.js"></script>
	<script type="text/javascript" src="js/dock-example1.js"></script>
	<script type="text/javascript" src="js/stack-1.js"></script>
	<script type="text/javascript" src="mediaPlayer.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
	
	  <script type="text/javascript">
    $(function() {
        $('.grid_boxes a').lightBox();
    });
    </script>
	<style type="text/css">
.grid_boxes
{float:left; width:100px; height:100px; margin:10px;padding:10px;border:0px solid #aaaaaa;}
</style>
<script type="text/javascript">
function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);

}

function drop(ev)
{
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
ev.target.appendChild(document.getElementById(data));
}

// set of dialog boxes

<!--
var folder_link = '';

$(function(){

				
				// Dialog
				$('#folder_dialog').dialog({
					autoOpen: false,
					height : 350,
					width: 500,
					open: function(){
					$('#folder_dialog').open(folder_link);
					},
					buttons: {
						'Minimize' : function(){
							$(this).dialog('close');
						}
					}
				});
				$('#pdf_dialog').dialog({
					autoOpen: false,
					height : 600,
					width: 800,
					open: function(){
					$('#pdf_dialog').open(pdf_link);
					},
					buttons: {
						'Minimize' : function(){
							$(this).dialog('close');
						}
					}
				});
				

				
				$('#video_dialog').dialog({
					autoOpen: false,
					height : 600,
					width: 600,
					buttons: {
						'Minimize' : function(){
							$(this).dialog('close');
						}
					}
				});

				// Dialog Link
				//$('#dialog_link').click(function(){
				//	mediaSongs();
				//	$('#dialog').dialog('open');
				//	return false;
				//})
	});



	function openFolder(link)
	{
		folder_link = link;
		$('#folder_dialog').dialog('open');
		
		document.getElementById('folder_dialog').innerHTML="<iframe src='"+link+"' style='width:100%;height:100%;'></iframe>";
	}
	function openPdf(link)
	{
		pdf_link = link;
		$('#pdf_dialog').dialog('open');
		
		document.getElementById('pdf_dialog').innerHTML="<iframe src='"+link+"' style='width:100%;height:100%;'></iframe>";
	}
	
	

	function openVideo(link)
	{
		$('#video_dialog').dialog('open');
		
		document.getElementById('video_dialog').innerHTML="<iframe src='video.php?q="+link+"' style='width:100%;height:100%;'></iframe>"
			
/*
  var flashvars = { file:link,autostart:'true' };
  var params = { allowfullscreen:'true', allowscriptaccess:'always' };
  var attributes = { id:'player1', name:'player1' };

  swfobject.embedSWF('player.swf','cont1','480','270','9.0.115','false',
    flashvars, params, attributes);
*/
	
	}

	

-->
</script>
	
</head>

<style type="text/css">
body {
  background: url(images/ice_final.jpg) no-repeat;
  background-size: 100%;
  overflow:hidden;
} 
</style>

<body scroll="no" onload='startSongs()'>

	<div class="wrap background">
		
		
		<!-- BEGIN DOCK 1 ============================================================ -->
		<div id="dock" style="position: fixed;	bottom: 0;background-color:black;opacity:0.8;width:88%;left: 0;">
			<div class="dock-container" >
				<a class="dock-item" href="index.php"><span>Go to home</span><img src="images/dock/home.png" alt="home" /></a> 
				<a class="dock-item" href="example2.html"><span>Example&nbsp;2</span><img src="images/dock/email.png" alt="contact" /></a> 
				<a class="dock-item" href="example3.html"><span>Example&nbsp;3</span><img src="images/dock/portfolio.png" alt="portfolio" /></a> 
				<a class="dock-item" href="all-examples.html"><span>All&nbsp;Examples</span><img src="images/dock/music.png" alt="music" /></a> 
				<a class="dock-item" href="#"><span>Video</span><img src="images/dock/video.png" alt="video" /></a> 
				<a class="dock-item" href="#"><span>History</span><img src="images/dock/history.png" alt="history" /></a> 
				<a class="dock-item" href="#"><span>Calendar</span><img src="images/dock/calendar.png" alt="calendar" /></a> 
				<a class="dock-item" href="#"><span>Links</span><img src="images/dock/link.png" alt="links" /></a> 
				<a class="dock-item" href="#"><span>Upload File to cloud</span><img src="images/dock/rss.png" alt="rss" /></a> 
				<a class="dock-item" href="logout.php"><span>Logout</span><img src="images/dock/rss2.png" alt="rss"/></a> 
			</div><!-- end div .dock-container -->
		</div><!-- end div .dock #dock -->
		<!-- END DOCK 1 ============================================================ -->
		<div id="stacksNav">Navigation</div>
	
	<!-- BEGIN STACK ============================================================ -->
	<div class="stack">
		<img src="images/stacks/stack.png" alt="stack"/>
		<ul id="stack">
			<li><a href="logout.php"><span>Aperture</span><img src="images/dock/rss2.png" alt="logout" /></a></li>
			<li><a href="all-examples.html"><span>All&nbsp;Examples</span><img src="images/stacks/photoshop.png" alt="Photoshop" /></a></li>
			<li><a href="example3.html"><span>Example&nbsp;3</span><img src="images/stacks/safari.png" alt="Safari" /></a></li>
			<li><a href="example2.html"><span>Example&nbsp;2</span><img src="images/stacks/coda.png" alt="Coda" /></a></li>
			<li><a href="index.html"><span>Example&nbsp;1</span><img src="images/stacks/finder.png" alt="Finder" /></a></li>			
		</ul>
	</div><!-- end div .stack -->
	<!-- END STACK ============================================================ -->
		
	</div><!-- end div .wrap -->
<?php

		




	$files = $dropbox->GetFiles("",false);
	
	//echo "\r\n\r\n<b>Files:</b>\r\n";
	$dumm=array_keys($files);
	//print_r($files[$dumm[0]]->size);
	//print_r(sizeof($dumm));
	?>
	<div id="grid_of_divs">
	<?php
	for ($i=0; $i<sizeof($dumm); $i++)
	{	
		
		if($files[$dumm[$i]]->is_dir == "1"){
		?>
		<div id='div<?php echo $i; ?>' ondrop='drop(event)' ondragover='allowDrop(event)' onclick= "openFolder('function.php?folder=<?php echo $dumm[$i];?>&parent=')" class = 'grid_boxes'>
    		<div draggable='true' ondragstart='drag(event)' id='drag<?php echo $i; ?>' >
  			<img src='images/icons/folder_icon.png' width='100' height='88' ondragstart='drag(event)' id='drag<?php echo $i; ?>' alt="<?php print_r('size:'.$files[$dumm[$i]]->size);  ?>"/>
  			<br> <div align="center"> <?php print_r($dumm[$i]);?> </div>
  			</div>
		</div>
		
		<?php
		
		}
		else {
			if($files[$dumm[$i]]->mime_type == "application/pdf")
			{
			$dropbox_path=$files[$dumm[$i]]->path;
			$link1=$dropbox->GetMedia($dropbox_path);
			$link=$link1->url;
			?>
			
			<div id='div<?php echo $i; ?>' ondrop='drop(event)' ondragover='allowDrop(event)' class = 'grid_boxes' onclick="openPdf('<?php echo $link; ?>')">
    		<div draggable='true' ondragstart='drag(event)' id='drag<?php echo $i; ?>' >
  			<img src='images/icons/pdf_icon.png' width='100' height='88' ondragstart='drag(event)' id='drag<?php echo $i; ?>' alt="<?php print_r('size:'.$files[$dumm[$i]]->size);  ?>"/>
  			<br> <div align="center"><?php print_r($dumm[$i]);?> </div>
  			</div>
			</div>
			<?php
			}
			else
			{
			if($files[$dumm[$i]]->mime_type == "audio/mpeg")
			{
			$dropbox_path=$files[$dumm[$i]]->path;
			musicFile($dropbox_path);
			?>
			
			
			<div id='div<?php echo $i; ?>' ondrop='drop(event)' ondragover='allowDrop(event)' onclick="playMusic('<?php echo $files[$dumm[$i]]->path;?>' )" class = 'grid_boxes'>
    		<div draggable='true' ondragstart='drag(event)' id='drag<?php echo $i; ?>' >
  			<img src='images/icons/music_icon.png' width='100' height='88' ondragstart='drag(event)'  id='drag<?php echo $i; ?>' alt="<?php print_r('size:'.$files[$dumm[$i]]->size);  ?>"/>
  			<br><div align="center"> <?php print_r($dumm[$i]);?></div>
  			</div>
			</div>
			<?php
			}
			else
			{
				if($files[$dumm[$i]]->mime_type == "image/jpeg" || $files[$dumm[$i]]->mime_type == "image/png" || $files[$dumm[$i]]->mime_type == "image/gif")
				{
				$dropbox_path=$files[$dumm[$i]]->path;
			$link1=$dropbox->GetMedia($dropbox_path);
			//print_r($link1);
			$link=$link1->url;
					?>
					
					<div id='div<?php echo $i; ?>' ondrop='drop(event)' ondragover='allowDrop(event)' class = 'grid_boxes'>
		    		<div draggable='true' ondragstart='drag(event)' id='drag<?php echo $i; ?>' >
		  			<a href="<?php echo $link; ?>" rel="lightbox"><img src='images/icons/photo_icon.png' width='100' height='88' ondragstart='drag(event)'  id='drag<?php echo $i; ?>' alt="<?php print_r('size:'.$files[$dumm[$i]]->size);  ?>"/></a>
		  			<br><div align="center"> <?php print_r($dumm[$i]);?></div>
		  			</div>
					</div>
					<?php
			}
			else
			{	
			if($files[$dumm[$i]]->mime_type == "video/mp4")
			{$dropbox_path=$files[$dumm[$i]]->path;
			$link1=$dropbox->GetMedia($dropbox_path);
			$link=$link1->url;
			?>
			
			<div id='div<?php echo $i; ?>' ondrop='drop(event)' ondragover='allowDrop(event)' onclick="openVideo('<?php echo $link; ?>')" class = 'grid_boxes'>
    		<div draggable='true' ondragstart='drag(event)' id='drag<?php echo $i; ?>' >
  			<img src='images/icons/video_icon.png' width='100' height='88' ondragstart='drag(event)' id='drag<?php echo $i; ?>' alt="<?php print_r('size:'.$files[$dumm[$i]]->size);  ?>"/>
  			<br> <div align="center"><?php print_r($dumm[$i]);?></div>
  			</div>
			</div>
			<?php
			}	  	
			}
			}
}
}
}
?>	



 

	
</div> <!--end grid_of_divs-->

<div id='folder_dialog'></div>

<div id='music_dialog'><div id= 'player'></div><div id ='SongList'></div></div>

<div id='video_dialog'><div id='cont1'></div></div>

<div id='pdf_dialog'></div>




</body>
</html>
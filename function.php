<?php
ob_start();
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
	<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
	<script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
	 <script type="text/javascript">
    $(function() {
        $('.grid_boxes a').lightBox();
    });
    </script>
	
	<style type='text/css'>
	
	.files	
	{
		position:relative;
		height:100px;
		width:100px;
		float:left;
		margin:20px;
	}
	.files img
	{
		position:relative;
		width:100px;
		height:88px;	
	}
	.files	div
	{	
		position:relative;
		display:inline;
	}
	
	</style>
</head>
<?
$parentFolder;
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
// Open folder is taking two arguments, one the folder to open, and another the parent link so that we can retrace our path
function openFolder($folder,$parent){
global $dropbox;
if($parent=="")
$path=$folder;
else
	$path=$folder;
	
	$getfiles = $dropbox->GetFiles($path,false);
$getkeys=array_keys($getfiles);
?>
<div style="display:block;min-height:300px;">
<?php

for ($i=0; $i<sizeof($getkeys); $i++)
{
	if($getfiles[$getkeys[$i]]->is_dir == '1')
	{
	
	$parentFolder=$_GET['folder'];	
	?>
		<div class="files" onDblClick= "self.location='function.php?folder=<?php echo $getkeys[$i]?>& parent=<?php echo $parentFolder; ?>'" >
			<img src="images/icons/folder_icon.png" style="width:100px;height:88px;	"/>
			<div>
				<?php 
					$fol=$getkeys[$i];
					$j=strlen($fol);
					$k=strrpos($fol, '/',-1 );
					$foldername = substr($fol, $k+1, $j);
					echo $foldername;
				?>
				
			</div>
		</div>
		<?php
	}
	else
	{
		
		if($getfiles[$getkeys[$i]]->mime_type == "application/pdf")
		{
		
		$dropbox_path=$getfiles[$getkeys[$i]]->path;
			$link1=$dropbox->GetMedia($dropbox_path);
			$link=$link1->url;
		
		echo "<div class='files' ><a href='".$link."'><img src='images/icons/pdf_icon.png'/></a>";
		
		
		}
		else if($getfiles[$getkeys[$i]]->mime_type == "audio/mpeg")
		{echo "<div class='files' ><img src='images/icons/music_icon.png'/>";}
		else if($getfiles[$getkeys[$i]]->mime_type == "video/mp4")
		{
			$dropbox_path=$getfiles[$getkeys[$i]]->path;
			$link1=$dropbox->GetMedia($dropbox_path);
			$link=$link1->url;
		?>
		<div class='files' ><a href="video.php?q=<?php echo $link;?>"><img src='images/icons/video_icon.png'/></a>
		<?php
		
		
		}
		else if($getfiles[$getkeys[$i]]->mime_type == "image/jpeg" || $getfiles[$getkeys[$i]]->mime_type == "image/png" || $getfiles[$getkeys[$i]]->mime_type == "image/gif")
		{
		
			$dropbox_path=$getfiles[$getkeys[$i]]->path;
			$link1=$dropbox->GetMedia($dropbox_path);
			$link=$link1->url;
			
		?>
		<div class='files'><a href="<?php echo $link;?>"><img src='images/icons/photo_icon.png'/></a>";
		<?php
		
		
		}
		else
		{echo "<div class='files' ><img src='images/icons/general_file_icon.png'/>";}
		?>
		
			<div>
				<?php 
					$fol=$getkeys[$i];
					$j=strlen($fol);
					$k=strrpos($fol, '/',-1 );
					$foldername = substr($fol, $k+1, $j);
					echo $foldername;		
				?>
			</div>
		</div>
		<?php
	}
}
?>
</div>
<?php


}
if(isset($_GET['folder'])&&isset($_GET['parent'])){
$folder=$_GET['folder'];
$parent=$_GET['parent'];
$parentFolder=$folder;
openFolder($folder,$parent);



}
$foo=$_GET['parent'];
$i=strrpos($foo, '/',-1 );
//echo $i;
$parentPath= substr($foo, 0, $i);

if(!($_GET['parent']==""))
{
?>
<div style="display:block;">
<a href="function.php?folder=<?php echo $_GET['parent']; ?>&parent=<?php echo $parentPath;?>">Back</a>
</div>

<?php
}
?>
</html>
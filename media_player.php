<?php
ob_start();
session_start();



$songs = $_SESSION['songs'];
$totalSongs = $_SESSION['totalSongs'];
$currentPlaying = $_SESSION['currentPlaying'];


function start()
{
	global $songs, $totalSongs, $currentPlaying;
	$songs = null;
	$totalSongs = 0;
	$currentPlaying = -1;

}


function closePlaylist()
{
	global $songs, $totalSongs, $currentPlaying;
	$songs = null;
	$totalSongs = 0;
	$currentPlaying = -1;
} 

function queue_song($song_name, $song_time="1:20", $song_link)
{
	global $songs, $totalSongs, $currentPlaying;
	$songs[$totalSongs]['name'] = $song_name;
	$songs[$totalSongs]['time'] = $song_time;
	$songs[$totalSongs]['link'] = $song_link;
	$totalSongs++;
}

function play_next()
{
	global $songs, $totalSongs, $currentPlaying;
	$currentPlaying++;
	if($currentPlaying == $totalSongs)
	{
		$currentPlaying = -1;
	}
	
	return $songs[$currentPlaying]['link']; 
}

function play_prev()
{
	global $songs, $totalSongs, $currentPlaying;
	if($currentPlaying == 0)
	{
		$currentPlaying = $totalSongs - 1;
	}
	else
	{
		$currentPlaying--;
	}
	
	return $songs[$currentPlaying]['link']; 
	
}

function play($index)
{
	global $songs, $totalSongs, $currentPlaying;
	if($index < 0)
	{
		return "";
	}
	if($index >= $totalSongs)
	{
		return "";
	}
	
	$currentPlaying = $index;
	
	return $songs[$currentPlaying]['link'];
}

function remove_song($index)
{
	global $songs, $totalSongs, $currentPlaying;
	if($totalSongs == 0)
	{
		return;
	}
	
	$totalSongs--;
	
	for($i = $index; $i < $totalSongs; $i++)
	{
		$songs[$i] = $songs[$i + 1];
	}
	
	if($currentPlaying === $index)
	{
		$currentPlaying--;
	}
}


function createResponse($index)
{
global $songs, $totalSongs, $currentPlaying;
$mename = $songs[$index]['name'];
$metime = $songs[$index]['time'];
$melink = $songs[$index]['link'];

$a =  $index."*".$mename."*".$metime."*".$melink;
return $a;
}


$q=$_GET["q"];


switch($q)
{
case "qus":
	$p=$_GET["p"];
	queue_song($p,"1:20",  $p);
	$response = createResponse($currentPlaying);
	break;
case "rms":
	$p=$_GET["p"];
	remove_song($p);
	$response = createResponse($currentPlaying);
	break;

case "pl":
	$p=$_GET["p"];
	play($p);
	$response = createResponse($currentPlaying);
	break;

case "pl_n":
	play_next();
	$response = createResponse($currentPlaying);
	break;
case "pl_p":
	play_prev();
	$response = createResponse($currentPlaying);
	break;
case "sen":
	if($songs == null)
	{
	$response = "";
	break;
	}
	$arr = $songs[0]['name'];
	for($i = 1; $i < $totalSongs; $i++)
	{
		$arr = $arr."*".($songs[$i]['name']);
	}
	$arr = $arr."*".($songs[0]['link']);
	$response = $arr;
	break;
case "cls":
	closePlaylist();
	$response = "";
	break;
case "srt":
	start();
	$response = "";
	break;
default:
		$response = '';
}


$_SESSION['songs'] = $songs;
$_SESSION['totalSongs'] = $totalSongs;
$_SESSION['currentPlaying'] = $currentPlaying;
echo $response;

?>
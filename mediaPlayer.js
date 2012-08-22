			
			
		var songs;
		var totalSongs;
		var currentPlaying;
		var currLink;
		
		var isopen = false;
		function playNext()
		{
			var foo = "pl_n";
			var i = 0;
			var xmlhttp;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					playNextCallback(xmlhttp.responseText);
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		}
		
		
		function playNextCallback(res)
		{
			var tmp = res.split("*");
			currentPlaying = tmp[0];
			currLink = tmp[3];
			
		}
		
		
		function playPrev()
		{
			var foo = "pl_p";
			var i = 0;
			var xmlhttp;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					playPrevCallback(xmlhttp.responseText);
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		}
		
		
		function playPrevCallback(res)
		{
			var tmp = res.split("*");
			currentPlaying = tmp[0];
			currLink = tmp[3];
			
		}
		
		function play(i)
		{
			var foo = "pl";
			var xmlhttp;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					playCallback(xmlhttp.responseText);
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		}
		
		
		function playCallback(res)
		{
			var tmp = res.split("*");
			currentPlaying = tmp[0];
			currLink = tmp[3];
			playLink();
		}
		
		function mediaSongs()
		{
			var foo = "sen";
			var i = 0;
			var xmlhttp;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					mediaSongsCallback(xmlhttp.responseText);
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		}
		
		function mediaSongsCallback(res)
		{
			//alert(res);
			
			songs = res.split("*");
			totalSongs = songs.length - 1;
			currLink = songs[totalSongs];
			currentPlaying = 0;
			if (totalSongs > 0)
			{
				playLink();
			}
			if(isopen == false)
			{
				//alert(currentPlaying+" "+currLink);
				isopen = true;
				$('#music_dialog').dialog('open');
			}
		}
		
		
		function playLink()
		{
			//alert("playing"+currLink);
			document.getElementById('player').innerHTML = "<audio controls='controls' autoplay='autoplay' ><source src='"+currLink+"' type='audio/mpeg' />Your browser does not support the audio element.</audio>";
			playList();
		}		
		
		function playList()
		{
			var i;
				var str = "<font size='4'>";
				
				for(i = 0; i < totalSongs; i++)
				{
					str = str+"<div id='Songs_"+ i +"' onClick='play("+i+")' >";
					if(i == currentPlaying)
					{
					str = str+"<b>"+songs[i]+"</b>";
					}
					else
					{
						str=str+songs[i];
					}
					str=str+"</br></div>";
				}
				str=str+"</font>";
				document.getElementById('SongList').innerHTML=str;
			
		}
		
		function ClosePlaylist()
		{
			songs = null;
			totalSongs = 0;
			currentPlaying = -1;
			currLink = "";
			playLink();
			
			var foo = "cls";
			var i = 0;
			var xmlhttp;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		}
		
	
		$(function(){

				
				// Dialog
				$('#music_dialog').dialog({
					autoOpen: false,
					resizable : false,
					height : 600,
					width: 350,
					Close: ClosePlaylist,
					buttons: {
						'Minimize' : function(){
							isOpen = false;
							$(this).dialog('close');
						},
						'Next': function() {
							playNext();
						},
						'Prev': function() {
							playPrev();
						}
					}
				});

				// Dialog Link
				//$('#dialog_link').click(function(){
				//	mediaSongs();
				//	$('#dialog').dialog('open');
				//	return false;
				//});


				
				//hover states on the static widgets
				//$('#dialog_link, ul#icons li').hover(
				//	function() { $(this).addClass('ui-state-hover'); },
				//	function() { $(this).removeClass('ui-state-hover'); }
				//	);


	});
	
	function playMusic(filename)
	{
		
		var foo = "qus";
		var i = filename;
		var xmlhttp;
				
		i = filename.split("/");
		i = i[1];
		//alert("i ="+ i);	
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					//playPrevCallback(xmlhttp.responseText);
					
					playMusicCallback();
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		
		
	}
	
	  
	
	function playMusicCallback()
	{
		if(isopen)
		{
		
		}
		else
		{
		mediaSongs();
		}
	}
	
	function startSongs()
		{
			var foo = "srt";
			var i = 0;
			var xmlhttp;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					
				}
			}
			
			xmlhttp.open("GET","media_player.php?q="+foo+"&p="+i,true);
			
			xmlhttp.send(null);
		}
		
		
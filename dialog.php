<html>
<head>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
		<title>jQuery UI Example Page</title>
		<link type='text/css' href='css/ui-lightness/jquery-ui-1.8.23.custom.css' rel='stylesheet' />
		<script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
		<script type='text/javascript' src='js/jquery-ui-1.8.23.custom.min.js'></script>
		<script type='text/javascript'>
		$(function(){

				// Accordion
				$('#accordion').accordion({ header: 'h3' });

				// Tabs
				$('#tabs').tabs();

				// Dialog
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					open: function(){
					$('#dialog').open('index.php');
					},
					buttons: {
						'Minimize' : function(){
							$(this).dialog('close');
						},
						'Ok': function() {
							$(this).dialog('close');
						},
						'Cancel': function() {
							$(this).dialog('close');
						}
					}
				});

				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});

				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});

				// Progressbar
				$('#progressbar').progressbar({
					value: 20
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
					);

				$('#dialog2').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						'Ok': function() {
							$(this).dialog('close');
						},
						'Cancel': function() {
							$(this).dialog('close');
						}
					}
				});

				// Dialog Link
				$('#dialog_link2').click(function(){
					$('#dialog2').dialog('open');
					return false;
				});



	});
	
	function foo()
	{
		$('#dialog').dialog('close');
		$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						'Minimize' : function(){
							$(this).dialog('close');
						},
						'Ok': function() {
							$(this).dialog('close');
						},
						'Cancel': function() {
							$(this).dialog('close');
						}
					}
				});
		$('#dialog').dialog('open');
	}
		</script>
		<style type='text/css'>
			/*demo page css*/
			body{ font: 62.5% 'Trebuchet MS', sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>
	</head>
	<body>
		<h2 class='demoHeaders'>Dialog</h2>
		<p><a href='#' id='dialog_link' class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-newwin'></span>Open Dialog</a></p>
		
		<h2 class='demoHeaders'>Dialog2</h2>
		<p><a href='#' id='dialog_link2' class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-newwin'></span>Open Dialog</a></p>

		<!-- ui-dialog -->
		<div id='dialog' title='papu'>
		<div onClick='foo()'><iframe src="http://www.facebook.com" style='width:100%;height:100%;'></iframe></div>
		</div>

		<div id='dialog2' title='hi'>
			<p> shivam</p>
		</div>
	</body>
	
	
	</html>
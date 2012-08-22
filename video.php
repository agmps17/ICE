<?php

$q=$_GET['q'];

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
 <script type="text/javascript">	
 var flashvars = { file:'<?php echo $q;?>',autostart:'true' };
  var params = { allowfullscreen:'true', allowscriptaccess:'always' };
  var attributes = { id:'player1', name:'player1' };

  swfobject.embedSWF('player.swf','cont1','480','270','9.0.115','false',
    flashvars, params, attributes);

</script>

<div id = 'cont1'></div>


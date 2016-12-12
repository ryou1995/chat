<?php
	$name = $_REQUEST['name'];
	if($name === "")
	{?>
<html>
<head>
	<title>Chat-Error101</title
></head>
<body>
<style type="text/css">
	h2{color:red;}
</style>
	<h1>Chat</h1>
	<h2 class="text">Error</h2>
	<h3>"You Name" is required.Please your name.</h3>
	<form action="login.html">
	<input type="submit" value="back">
	</form>
 </body>
</html>
	<?php
	}
	else
	{?>
	
<html>
<head>
<title>Chat</title>

	<script type="text/javascript">
	function getText(){
		var text = document.getElementById('dispText');
		text.innerText = document.textform.textbox.value;
		}
	</script>

</head>
<body>
	<?php
	 print $name;
	 $chatdata = ['sysOP','text',date('Y-m-d H:i:s')];
	  ?>
	<form style="display:inline" name='textform'>

	</form>
	
	<form style="display:inline" >
	
	
		<input type='hidden' name='name' value="<?php print $name; ?>">
		<input type='text' name='textbox'>
		<?php 
		
		if(isset($_REQUEST['submitbutton']))
		{
		$chatdata[0] = $name;
		$chatdata[1] = $_REQUEST['textbox'];
}
		$fp = fopen('chat.log','a');
		fwrite($fp, implode("\t",[
								implode(',',$chatdata)
									 ]));
		fwrite($fp,"\n");
		fclose($fp);
		?>
		   
	<input type='submit' name='submitbutton' value='Write' onClick='getText()'>
	</form>
	<div id='dispText'></div>
	
	<form action='chat.php'>	
	<?php
		$chat = [];
		$fp = fopen('chat.log','r');
		while ( ($data = fgets($fp) ) !== false ) 
		{
			$data = rtrim($data);
		 	$buff = explode(',',$data);
		 	$chat[] = $buff;		
		}
		
		$count = count($chat);
		
		for($i = 0; $i < 15; $i++)
		{
			$r = $count - $i - 1;
		
			for($j = 0; $j < 3; $j++)
			{
				print $chat[$r][$j]."  ";

			}
				?>
				<br>
				<?php
		}
	?>
	
	<input type='hidden' name='name' value="<?php print $name; ?>">
	<input type='submit' value='Refresh'>
	</form>
		
</body>
</html>
	<?php } ?>

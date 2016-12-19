<html>
<head>
	<title>History</title>
</head>
<body>
	
	<h1>Chat History</h1>
			
	<form action='chat.php'>	
			<input type='submit' value='Refresh'>
			
	<div style="padding: 10px; margin-bottom: 10px; border: 1px dashed #FF3333;">

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
		
		for($i = 0; $i <= $count - 1 ; $i++)
		{		
			for($j = 0; $j < 3; $j++)
			{
				print $chat[$i][$j]."  ";

			}
				?>
				<hr/>
				<?php
		}
		
	?>
	</div>
	
	</form>
	
	<hr/>
	
	<input type='button' value='close' onclick='window.close();'>

	
		
</body>
</html>

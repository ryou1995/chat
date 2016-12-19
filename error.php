<?php

 $errortype = $_REQUEST['errortype']; 
 ?>

<html>
<head>
	<title>Chat-Error101</title
></head>
<body>
<style type="text/css">
	h2,h3{color:red;}
</style>
	<h1>Chat</h1>
	<h2 class="text">Error</h2>
	<?php 
	if($errortype == 1)
	{
	?>
		<h3>Plese inout your id and password.</h3>
	<?php
	} 
	else  if($errortype == 2)
	{
	?>
			<h3>Not found id.</h3>
	<?php
	}
	else if($errortype == 3)
	{
	?>
			<h3>Password is incorrect.</h3>
	<?php
	}
	?>
	
	<form action="login.php">
	<input type="submit" value="back">
	</form>
 </body>
</html>



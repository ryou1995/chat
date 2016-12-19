<?php

//SQL準備
$dsn = 'mysql:dbname=ChatDB;host=127.0.0.1';
$user = 'root';
$pw ='H@chiouji1';

$user_sql = 'SELECT * FROM ChatUser';

//SQLを実行
$dbh = new PDO($dsn,$user,$pw);//接続
$sth = $dbh->prepare($user_sql);//SQL準備
$sth->execute();//実行

while(($buff = $sth->fetch())!== false)
{
	$id[]      = $buff['id'];
	$loginid[]    = $buff['loginid'];
	$password[] = $buff['password'];
	$dispname[] = $buff['dispname'];
	$del_flag[] = $buff['del_flag'];
}

	$input_id = $_REQUEST['id'];
	$input_password = $_REQUEST['password'];
	
	//何も入力されていない場合
	if($input_id === "" || $input_password === "")
	{
		header('Location: error.php?errortype=1');
		exit();
	}
	//IDは入力されているが存在しない
	if(!in_array($input_id,$loginid))
	{
		header('Location: error.php?errortype=2');
		exit();
	}
	//PWは入力されているが一致しない
	if(!in_array($input_password,$password))
	{
		header('Location: error.php?errortype=3');
		exit();
	}
	
	for($i = 0; $i < count($loginid); $i++)
	{
		if($input_id == $loginid[$i])
		{
			$name = $dispname[$i];
		}
	}
	
	?>
<html>
<head>
<title>Chat</title>
</head>
<body>
	<style type="text/css">

	</style>
	<?php
	 print $name;
	 $chatdata = ['sysOP',$name.' Login.',date('Y-m-d H:i:s')];
	  ?>
	<form style="display:inline" name='textform'>

	</form>
	
	<form style="display:inline" >
	
		<input type='hidden' name='id' value="<?php print $input_id; ?>">
		<input type='hidden' name='password' value="<?php print $input_password; ?>">
		<input type='text' name='textbox'>
		<?php 
		
		$content_sql = 'SELECT * FROM Content';

		//SQLを実行
		$dbh = new PDO($dsn,$user,$pw);//接続
		$sth = $dbh->prepare($content_sql);//SQL準備
		$sth->execute();//実行
				
		if(isset($_REQUEST['submitbutton']))
		{
			$chatdata[0] = $name;
			$chatdata[1] = $_REQUEST['textbox'];
		}
		
		if($chatdata[1] !== "")
		{	
			$content_sql = 'INSERT INTO Content values($chatdata[0],$chatdata[1],$chatdata[2])';
		
			$sth = $dbh->prepare($content_sql);//SQL準備
			$sth->execute();//実行
		}
		
		?>
		   
	<input type='submit' name='submitbutton' value='Write'>
	</form>
		
<hr/>
	
	<form action='chat.php'>	
			<input type='submit' value='Refresh'>
	<div style="padding: 10px; margin-bottom: 10px; border: 1px dashed #FF3333;">

	<?php
		$chat = [];
		/*$fp = fopen('chat.log','r');
		while ( ($data = fgets($fp) ) !== false ) 
		{
			$data = rtrim($data);
		 	$buff = explode(',',$data);
		 	$chat[] = $buff;		
		}*/
		
		$content_sql = 'SELECT * FROM Content';

		//SQLを実行
		$dbh = new PDO($dsn,$user,$pw);//接続
		$sth = $dbh->prepare($content_sql);//SQL準備
		$sth->execute();//実行
		
		while(($buff = $sth->fetch())!== false)
		{
			$chat = implode(',',$buff);
		}
		
		$count = count($buff);
		
		if($count < 15)
		{
			for($i = 0; $i < $count; $i++)
			{
				$r = $count - $i - 1;
		
				for($j = 0; $j < 3; $j++)
				{
					print $chat[$r][$j]."  ";
				}
					?>
					<hr/>
					<?php
			}
		}
		else
		{
			for($i = 0; $i < 15; $i++)
			{
				$r = $count - $i - 1;
		
				for($j = 0; $j < 3; $j++)
				{
					print $chat[$r][$j]."  ";

				}
					?>
					<hr/>
					<?php
			}
		}
	?>
	</div>
	<input type='hidden' name='name' value="<?php print $name; ?>">
	<input type='hidden' name='password' value="<?php print $input_password; ?>">

	</form>
	<hr/>
	
	<a href = 'history.php' target='_blank'>History</a>
		
	<form action='login.php' style='float:right'>	
		<input type='submit' value='Logout'>
	</form>
	
		
</body>
</html>

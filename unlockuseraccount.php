<?php 
	error_reporting(0);
	session_start();
	if($_SESSION['user']){
$employeeId=$samname=$inputValue="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	//$mployeeId=trim($_POST["eid"]);
	$samname=trim($_POST["samname"]);
	$inputValue=trim($_POST["input"]);
}
if($inputValue==1){
	
	//generating .csv file from PHP 
	try{
	$list=array('samname',
				$samname );
				
	$file = fopen("C:/Users/Administrator/Desktop/Test/unlock.csv","w");

	foreach ($list as $line)
	  {
	  fputcsv($file,explode(',',$line));
	  }
	fclose($file);
	
	// executing the .ps1 file from PHP code
	
	$output=shell_exec('powershell C:\Users\Administrator\Desktop\Test\checkUnlockUser.ps1');
	
	
	}catch(Exception $e) {
		echo 'Message: Employee creation Failed please Try Again ';
	}


?>

		
<html>
<head>
<title>Innominds</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<script src="script.js"></script>
<div class="container page-starts">
	<div class="row">
		<nav class="navbar navbar-default header-nav">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="home.php"><img class="logo" src="images/logo.png"></a>
			</div>
			<ul class="nav navbar-nav logout-text">
			  <li class="user_name"><?php 
					echo $_SESSION['user'];
				?></li><li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
			</ul>
		  </div>
		</nav>
	</div>
	<div class="innominds-head">
		<h2>USER ACCOUNT MANAGEMENT</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Unlock User Account</h3><br>
		<div class="row">
			<div class="col-md-12">
					<div class="col-md-6 userid-box">
					<!--<?php 
					echo "<pre>",$output ?> -->
					</div>
					<div class="col-md-4" >
						
							<div class="submitbtn">
								
								<button  class="user-btn"><a href="unlockuseraccount.php"> Back </a></button>
							</div>
							
	
						
					</div>
					<?php 
						if($output == "true"){
							echo "<div class='col-md-4' style='margin-top: 60;'>
								<form action='unlockuseraccount.php' method='post' >
									<div class='submitbtn'>
										<!--<button class='btn btn-primary' type='submit'>Enter</button>-->
										<button  type='submit' class='user-btn'>proceed to unlock</button>
									</div>
									<input type='hidden' value='3' name='input' >
									<input type='hidden' value=<?php echo $samname?> name='samname' >
								</form>
							</div>";
						}
						else{
							echo "<div class='col-md-8'>
									</div>
									<div class='row'>
										<div class='col-md-12'>
											<h1 align='center' style='color:white;'> user is already unlocked </h1>
										</div>
									</div>";
						}
					?>
					
					
					
					
					
				
			</div>		
		</div>
	</div>
	<div class="col-md-2"></div>
	<div class="row">
		<footer class="footer1">
			<div class="col-md-6 col-xs-6 copyright">
				<p>Copyright &copy; 2017 All Right Reserved</p>
			</div>
			<div class="col-md-6 col-xs-6 designedby">
				<p>Designed by<a href="http://www.innominds.com" target="_blank"> Innominds</a></p>
			</div>
		</footer>
	</div>
</div>


</body>

</html>

<?php 
}else if($inputValue==3){ 

	// executing the .ps1 file from PHP code
	
	$output=shell_exec('powershell C:\Users\Administrator\Desktop\Test\unlock.ps1');

?>	

		
<html>
<head>
<title>Innominds</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<script src="script.js"></script>
<div class="container page-starts">
	<div class="row">
		<nav class="navbar navbar-default header-nav">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="home.php"><img class="logo" src="images/logo.png"></a>
			</div>
			<ul class="nav navbar-nav logout-text">
			  <li class="user_name">asdfss<?php 
					echo $_SESSION['user'];
				?></li><li class="active"><button class="btn btn-danger" id="logout">Logoutttt</button></li>
			</ul>
		  </div>
		</nav>
	</div>
	<div class="innominds-head">
		<h2>INNOMINDS USER ACCOUNT MANAGEMENT</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Unlock User Account</h3><br>
		<div class="row">
			<div class="col-md-12">
				
					<div class="col-md-6 userid-box">
						<?php 
						echo "<pre>",$output ?>
					</div>
					
			</div>		
		</div>
	</div>
	<div class="col-md-2"></div>
	<div class="row">
		<footer class="footer1" >
			<div class="col-md-6 copyright">
				<p>Copyright &copy; 2017 All Right Reserved</p>
			</div>
			<div class="col-md-6 designedby">
				<p>Designed by<a href="www.innominds.com" target="_blank"> Innominds</a></p>
			</div>
		</footer>
	</div>
</div>


</body>

</html>







<?php }else{?>	
<html>
<head>
<title>Innominds</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<script src="script.js"></script>
<div class="container page-starts">
	<div class="row">
		<nav class="navbar navbar-default header-nav">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="home.php"><img class="logo" src="images/logo.png"></a>
			</div>
			<ul class="nav navbar-nav logout-text">
			  <li class="user_name"><?php 
					echo $_SESSION['user'];
				?></li><li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
			</ul>
		  </div>
		</nav>
	</div>
	<div class="innominds-head">
		<h2>INNOMINDS USER ACCOUNT MANAGEMENT</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Unlock User Account</h3><br>
		<div class="row">
			<div class="col-md-12">
				<form class="form-signin" action="unlockuseraccount.php" method="post">
					<div class="col-md-4">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">User ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="samname" id="name" required placeholder="Enter UserID" />
								</div>
							</div>
						</div>
						
						<div class="submitbtn">
							<!--<button class="btn btn-primary" type="submit">Enter</button>-->
							<button class="user-btn">Enter</button>
						</div>
					</div>
					
					<input type="hidden" value="1" name="input"/>
				</form>
			</div>		
		</div>
	</div>
	<div class="col-md-2"></div>
	<div class="row">
		<footer class="footer1">
			<div class="col-md-6 copyright">
				<p>Copyright &copy; 2017 All Right Reserved</p>
			</div>
			<div class="col-md-6 designedby">
				<p>Designed by<a href="www.innominds.com" target="_blank"> Innominds</a></p>
			</div>
		</footer>
	</div>
</div>


</body>

</html>
<?php 
} 
}else{
	echo "login first";
}
?>	
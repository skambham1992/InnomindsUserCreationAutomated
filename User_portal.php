<?php 
	error_reporting(0);
	session_start();
	if($_SESSION['user']){
$employeeId=$emailId=$userName=$inputValue="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$employeeId=trim($_POST["eid"]);
	$userName=trim($_POST["uname"]);
	$emailId=trim($_POST["email"]);
	$inputValue=trim($_POST["input"]);

}
if($inputValue==3){	


	//generating .csv file from PHP 
	try{
	$list=array('employeeid,username,emailid',
				$employeeId.','.$userName.','.$emailId );
				
	$file = fopen("C:/Users/Administrator/Desktop/Test/ADUserReset.csv","w");

	foreach ($list as $line)
	  {
	  fputcsv($file,explode(',',$line));
	  }
	fclose($file);
	
	// executing the .ps1 file from PHP code
	
	$output=shell_exec('powershell C:\Users\Administrator\Desktop\Test\ADUserReset.ps1');
	
	
	}catch(Exception $e) {
		echo 'Message: Employee creation Failed please Try Again ';
	}
	

?>
<html>
<head>
<title>Innominds</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body class="bodybackground">
<script src="script.js"></script>
<h4 align="center">Password Reset Details</h4>
<div class="container" >
    <div class="row" style="
    padding-top: 50px;
">
       <?php echo "<pre>",$output ?>
    </div>
	<br/><br/>
	<div class="row">
		<div class="col-md-2 col-md-offset-5">
			<button  class="user-btn"><a  href="home.php">Home Page</a></button>
		</div>
	</div>
</div>

 
</body>

</html>
	
<?php
	
}else{
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
			<?php 
					echo $_SESSION['user'];
				?>
			  <li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
			</ul>
		  </div>
		</nav>
	</div>
	<div class="innominds-head">
		<h2>INNOMINDS USER ACCOUNT MANAGEMENT</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Reset Password</h3><br>
		<div class="row">
			<div class="col-md-12">
				<form class="form-signin" action="resetpassword.php" method="post">
				<div class="row col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="asf">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Employee ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="eid" id="name" required placeholder="Employee ID" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">User ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="uname" id="name"   placeholder="User ID" />
								</div>
							</div>
						</div>
					</div>
					<div class="saf">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Personal Email ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="name" required placeholder="Personal Email ID" />
								</div>
							</div>
						</div>
						<input type="hidden" name="input" value="3">
						
						
					</div>
					</div>
					</div>
					<div class="row col-md-12 sendbtnbottom">
					<div class="col-md-3"></div>
						<div class="col-md-6 submitbtn disablebtn">
							<button class="btn btn-primary " type="submit" >Reset Password</button>
						</div>
					</div>
				</div>
				</form>
			</div>		
		</div>
	</div>
	<div class="col-md-2"></div>
	<div class="row">
		<footer>
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
}
} else{
	echo "login first";
}
?>
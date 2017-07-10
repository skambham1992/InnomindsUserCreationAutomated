
<?php


$empid=$userid="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$empid=trim($_POST["empid"]);
	$userid=trim($_POST["userid"]);
	$inputValue = trim($_POST["input"]);
if($inputValue==1){	

	//generating .csv file from PHP 
	try{
	$list=array('userid,empid',
				$userid.",".$empid );
				
	$file = fopen("C:\Users\Administrator\Desktop\Sandeep_test\add_empid.csv","w");
  
  
	foreach ($list as $line)
	  {
	  fputcsv($file,explode(',',$line));
	  }
	fclose($file);
	
	// executing the .ps1 file from PHP code
	
	$output = shell_exec('powershell C:\Users\Administrator\Desktop\Sandeep_test\add_emp.ps1');
	
	
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
<h4 align="center">ADD EMPLOYEE ID</h4>
<div class="container" >
    <div class="row" style=" padding-top: 50px;">
		<?php echo "$output"; ?>
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
	
}
}
else{
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

<body class="bodybackground">
<script src="script.js"></script>
<div class="container page-starts">
	<div class="row">
		<nav class="navbar navbar-default header-nav">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="home.php"><img class="logo" src="images/logo.png"></a>
			</div>
			<ul class="nav navbar-nav logout-text">
				
			  <li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
			</ul>
		  </div>
		</nav>
	</div>
	<div class="innominds-head">
		<h2> ADD EMPLOYEE ID</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Please Enter Details</h3><br>
		<div class="col-md-12 ">
			<form class="form-signin" action="Sandeep_test_add_empID.php" method="post">
				<div class="row col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Empid</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="empid" id="name" required placeholder="Enter userid"/>
								</div>
							</div>
						</div>
						
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Userid</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="userid" id="name"  required placeholder="Enter emp id"/>
								</div>
							</div>
						</div>
						
				</div>
				<div class="row col-md-12 sendbtnbottom">
					<div class="submitbtn">
						<button class="btn btn-primary" type="submit" >Submit</button>
					</div>
				</div>
				<input type="hidden" value="1" name="input"/>
			</form>
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


?>


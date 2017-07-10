
<?php 
	error_reporting(0);
	session_start();
	if($_SESSION['user']){
$Ticketid=$firstName=$middleName=$mailId=$lastName=$deptName=$inputValue=$title=$manager="";
//$managersList = "sairam";

// getting managers list
	$ldap_dn = "cn=Sandeep Reddy Kambham,ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com";
	$ldap_password = "Inno123$";
	
	$ldap_con = ldap_connect("corp.innominds.com");
	
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	if(ldap_bind($ldap_con, $ldap_dn, $ldap_password)) {

		$filter = '(title=*Manager*)';
		$result = ldap_search($ldap_con,"ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com",$filter) or exit("Unable to search");
		$mangerList = ldap_get_entries($ldap_con, $result);
		
		//print "<pre>";
		//print_r ($mangerList);
		//print "</pre>";
		//echo $entries[0]["title"][0];
	  
	} else {
		$mangerList = '';
	}
// end of getting managers list

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$Ticketid=trim($_POST["Ticketid"]);
	$firstName=trim($_POST["fname"]);
	$middleName=trim($_POST["mname"]);
	$lastName=trim($_POST["lname"]);
	$mailId=trim($_POST["email"]);
	$deptName=trim($_POST["deptname"]);
	$title=trim($_POST["title"]);
	$manager=trim($_POST["manager"]);
	$inputValue=trim($_POST["input"]);

}
if($inputValue==5 && $_SESSION['count'] == 1){	
	$_SESSION['count'] = 2;
	$output=shell_exec('powershell Server\InnomindsUserCreation.ps1');
	echo '
		<html>
		<head>
		<title>Innominds</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		</head>

		<body class="bodybackground">
		<script src="script.js"></script>
		<h4 align="center">User Creation Details</h4>
		<div class="container" >
			
			<div class="col-md-8 col-md-offset-2">
					<h1 class="output_text"><pre>'
					.$output.'
					</h1>
					</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<button  class="user-btn hometop"><a  href="home.php">Home Page</a></button>
				</div>
			</div>
		</div>

		 
		</body>

		</html>
	';
}
else if($inputValue==5 && $_SESSION['count'] == 2){
	header("Location:createuserpage.php");
}
else if($inputValue==1){	
	$_SESSION['count'] = 0;
	if(empty($middleName)){
		$middleName="";
	}

	//generating .csv file from PHP 
	try{
	$list=array('Ticketid,firstname,middlename,lastname,mailid,deptame,title,manager,createdby',
				$Ticketid.",".$firstName .",".$middleName .",". $lastName .",".$mailId .",". $deptName .",". $title.",". $manager.",". $_SESSION['user']);
				
	$file = fopen("Server/InnomindsUserCreation.csv","w");

	foreach ($list as $line)
	  {
	  fputcsv($file,explode(',',$line));
	  }
	fclose($file);
	
	// executing the .ps1 file from PHP code
	
	$output=shell_exec('powershell Server\PreviewUserCreation.ps1');
	$_SESSION['count'] = 1;
	
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
<h4 align="center">User Creation Details</h4>
<div class="container" >
    <div class="row" style="
    padding-top: 50px;
">
       <?php echo "<pre>",$output ?>
    </div>
	<br/><br/>
	<form class="form_main" action="createuserpage.php" method="POST">
				<input type="hidden" value="5" name="input">
				<button  class="user-btn" type="submit">Proceed</button>
				<button  class="user-btn"><a href="createuserpage.php"> Back </a></button>
			</form>
	<div class="row">
		<div class="col-md-2 col-md-offset-5">
			<button  class="user-btn hometop"><a  href="home.php">Home Page</a></button>
		</div>
	</div>
</div>

 
</body>

</html>
	
<?php
	
}
else{
?>
<html>
<head>
<title>Innominds</title>
 <meta charset="utf-8">
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />    

<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
</head>
<script src="script.js"></script>
<body class="bodybackground" style="overflow: auto; background-color: #999;">







 <div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container">
        <div class="navbar-header"><a class="" href="home.php"><img class="logo" style="padding-top: 8px;" src="images/logo.png"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
			<ul class="nav navbar-nav navbar-right logout-text">
			  <li class="user_name"><?php 
					echo $_SESSION['user'];
				?></li><li class="active"><button class="btn btn-default" id="logout">Logout</button></li>
			</ul>
        </div>
    </div>
</div>

        <div class="container">
			<div class="row">
				<div class="col-md-4"></div>
			   <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
			   <div id="banner">
				<h1>USER ACCOUNT MANAGEMENT for INNOMINDS Employees</h1>
				<h5><strong>www.innominds.com</strong></h5>
			   </div>
				</div>-->
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="">
				<form class="form-horizontal form-signin form-register" action="createuserpage.php" method="post">
					<h2>Create User</h2>
					<fieldset>
					  <div class="form-group">
					   <div class="col-lg-12">
						<input type="text" class="form-control" name="fname" id="name" required placeholder="Enter First Name">
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<input type="text" class="form-control" name="mname" id="name"   placeholder="Enter Middle Name">
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<input type="text" class="form-control" name="lname" id="name"  required placeholder="Enter Last Name">
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<input type="text" class="form-control" name="title" id="name"  required placeholder="Enter Title">
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<input type="text" class="form-control" name="Ticketid" id="name" required placeholder="Enter Ticket ID">
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<input type="email" class="form-control" name="email" id="name" required placeholder="Enter Personal Email ID">
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<select class="form-control" id="name" name="deptname" required>
						 <option disabled selected hidden >Select Department</option>
						 <option>Finance</option>
						 <option>HR</option>
						 <option>IT</option>
						 <option>Mobility</option>
						 <option>Security</option>
						 <option>DevOps</option>
						 <option>QA</option>
						 <option>UI</option>
						</select>
					   </div>
					  </div>
					  <div class="form-group">
					   <div class="col-lg-12">
						<select class="form-control" id="name" name="manager" required>
						 <option disabled selected hidden>Select Manager</option>
						 <?php 
						  for($i=0; $i<count($mangerList)-2; $i++){
						   echo "<option>".$mangerList[$i]["cn"][0]."</option>";
						  }
						 ?>
						</select>
					   </div>
					  </div>
					  <div class="form-group registerbtns">
						<button type="submit" class="btn btn-primary">
						 Submit</button>					  
					  </div>
					  <div class="form-group registerbtns">
						<button type="reset" class="btn btn-danger">
						 Cancel</button>					  
					  </div>
					  <input type="hidden" value="1" name="input"/>
				 </fieldset>
				</form>
			 </div>
			 </div>
			 <div class="col-md-3"></div>
		 </div>
		 <div class="col-md-12">
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
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery.backstretch.js" type="text/javascript"></script>
        <script src="js/myjs.js" type="text/javascript"></script>
		
		
		
		









<!--
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
		<h2> USER ACCOUNT MANAGEMENT</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Please Enter Details</h3><br>
		<div class="col-md-12 ">
			<form class="form-signin" action="createuserpage.php" method="post">
				<div class="row col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">First Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="fname" id="name" required placeholder="Enter First Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Middle Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="mname" id="name"   placeholder="Enter Middle Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Last Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="lname" id="name"  required placeholder="Enter Last Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="title" id="name"  required placeholder="Enter Title"/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Ticket ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="Ticketid" id="name" required placeholder="Enter Ticket ID"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Email ID</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="name" required placeholder="Enter Personal Email ID"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Dept</label>
							<div class="cols-sm-10">
								<select class="form-control" id="name" name="deptname" required>
									<option selected>Select Department</option>
									<option>Finance</option>
									<option>HR</option>
									<option>IT</option>
									<option>Mobility</option>
									<option>Security</option>
									<option>DevOps</option>
									<option>QA</option>
									<option>UI</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Select Manager</label>
							<div class="cols-sm-10">
								<select class="form-control" id="name" name="manager" required>
									<option selected>Select Manager</option>
									<?php 
										for($i=0; $i<count($mangerList)-2; $i++){
											echo "<option>".$mangerList[$i]["cn"][0]."</option>";
										}
									?>
								</select>
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
-->

</body>

</html>

<?php	
}
}
else{
	echo "login first";
}
?>


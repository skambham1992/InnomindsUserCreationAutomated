<?php
error_reporting(0);
	session_start();
	$inputValue=$admin=$password="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$admin=trim($_POST["admin"]);
	$password=trim($_POST["pass"]);
	$inputValue=trim($_POST["input"]);

}

if($inputValue==1 ){
	$ldap_dn = "CN=sandeep reddy kambham,ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com";
	$ldap_password = "Inno123$";
	$ldap_con = ldap_connect("corp.innominds.com");
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	if(ldap_bind($ldap_con, $ldap_dn, $ldap_password)) {
		$filter = '(sAMAccountName='.$admin.')';
		$result = ldap_search($ldap_con,"ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com",$filter) or exit("Unable to search");
		$entries = ldap_get_entries($ldap_con, $result);
		$ldap_dn ="CN=".$entries[0]["cn"][0].",ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com";
		$ldap_password = $password;
		if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){
			//echo $entries[0]["cn"][0];
			$_SESSION['user'] = $entries[0]["cn"][0];
			header("Location: http://localhost/Project/home.php");
		}
		else
			echo 					'<html>
		<head>
		<title>Innominds</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		</head>

		<body class="bodybackground">
		<script src="script.js"></script>
		<div class="container" >
			<div class="row">
			<h2 align="center" class="hometop entervalid">Enter valid credentials</h2><br><br>
				<div class="col-md-2 col-md-offset-5">
					
					<button  class="user-btn "><a  href="ldap_auth.php"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button>
				</div>
			</div>
		</div>

		 
		</body>

		</html>';
	}
	
}else{?>

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
<div class="container page-starts">
	<div class="row">
		<nav class="navbar navbar-default header-nav">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="home.php"><img class="logo" src="images/logo.png"></a>
			</div>
		  </div>
		</nav>
	</div>
	<div class="innominds-head">
		<h2> USER ACCOUNT MANAGEMENT</h2>
	</div>
	<div class="col-md-2"></div>
	<div class="col-sm-6 col-md-8 ldapusers-main">
		<h3 class="login-title">Please Enter Details</h3><br>
		<div class="row">
			<div class="col-md-12">
				<form class="form-signin" action="#" method="post">
				<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Admin Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="admin" id="name" required placeholder="Enter Admin Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key fa" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="pass" id="name"   placeholder="Enter Password"/>
								</div>
							</div>
						</div>
						<div class="submitbtn submitbtn1"><br><br>
							<button class="btn btn-primary" type="submit">Authenticate</button>
						</div>
					
					</div>
					<div class="col-md-3"></div>
					<input type="hidden" value="1" name="input"/>
				</form>
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


<?php }?>


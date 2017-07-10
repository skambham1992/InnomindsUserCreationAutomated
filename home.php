<?php 
	error_reporting(0);
	session_start();
	if($_SESSION['user']){
		echo '
			<html>
			<head>
			<title>Innominds</title>
			 <meta charset="utf-8">
			<!-- Set the viewport width to device width for mobile -->
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<link rel="stylesheet" type="text/css" href="styles.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
			  <link href="css/style.css" rel="stylesheet" type="text/css" />    
		   
			<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />


			</head>
			<body>
			<script src="script.js"></script>
		
			<div class="container page-starts">
				<div class="row">
					<nav class="navbar navbar-default header-nav">
					  <div class="container-fluid">
						<div class="navbar-header">
						  <a class="" href="home.php"><img class="logo" src="images/logo.png"></a>
						</div>
						
						<ul class="nav navbar-nav navbar-right logout-text">
						  <li class="user_name">'.$_SESSION['user'].'
							</li><li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
						</ul>
					  </div>
					</nav>
				</div>
				<div class="innominds-head">
					<h2> USER ACCOUNT MANAGEMENT</h2>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-sm-6 col-md-8 ldapusers-main">
						<h4 class="login-title">Welcome '.$_SESSION['user'].'</h4>
						<br>	
						<div class="row">
							<div class="col-md-4">
								<button class="user-btn"><a href="createuserpage.php">Create User Account</a></button><br>
								
								<button class="user-btn"><a href="unlockuseraccount.php">Unlock User Account</a></button><br>
								<button class="user-btn"><a href="resetpassword.php">Reset User Account</a></button>
								
							</div>
							<div class="col-md-8 home-img">
								<img src="images/new.jpg">
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row container">
					<footer class="footermain footer1">
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
		';
	}
	else{
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
		<div class="container" >
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<button  class="user-btn hometop"><a  href="ldap_auth.php">Login First</a></button>
				</div>
			</div>
		</div>

		 
		</body>

		</html>
		';
	}
	
?>



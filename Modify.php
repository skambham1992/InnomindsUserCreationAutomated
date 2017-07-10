<?php 
	error_reporting(0);
	session_start();
	if($_SESSION['user']){
		if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["input"] == 1) {
			$userid=trim($_POST["userid"]);
			$empid=trim($_POST["empid"]);
			$inputValue=trim($_POST["input"]);
			try{
				$list=array('userid,empid',
							$userid .",". $empid);
							
				$file = fopen("C:/Users/Administrator/Desktop/Test/add_empid.csv","w");

				foreach ($list as $line)
				  {
				  fputcsv($file,explode(',',$line));
				  }
				fclose($file);
				
				// executing the .ps1 file from PHP code
				
				$output=shell_exec('powershell C:\Users\Administrator\Desktop\Test\add_empid.ps1');
				echo '
					<html>
						<head>
							<title>Innominds</title>
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
							<link rel="stylesheet" type="text/css" href="styles.css">
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
							<script src="script.js"></script>
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
										  <li class="user_name">'.$_SESSION["user"].'</li><li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
										</ul>
									  </div>
									</nav>
								</div>
								<div class="innominds-head">
									<h2> USER ACCOUNT MANAGEMENT</h2>
								</div>
								<div class="row">
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
										<h1 align="center">' 
											.$output.
										'</h1>
									</div>
									<div class="col-md-4">
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
										<div class="submitbtn">
											<a href="modify.php"><button class="btn btn-primary">Back to Modify page</button></a>
										</div>
									</div>
									<div class="col-md-4">
										
									</div>
								</div>
							</div>
						</body>
					</html>
				';
				
				
			}catch(Exception $e) {
					echo 'Message: Employee creation Failed please Try Again ';
			}	
		}
		else{
			echo '
			<html>
			<head>
			<title>Innominds</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="styles.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="script.js"></script>
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
						  <li class="user_name">'.$_SESSION["user"].'</li><li class="active"><button class="btn btn-danger" id="logout">Logout</button></li>
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
						<h3 class="login-title">INNOMINDS USERS</h3>
						<br>	
						<div class="row">
							<div class="col-md-12">
								<div id="accordion">
									<div class="acc_a">
										<a href="#one" class="first col-md-12">Add EMPID</a>
									</div>
									<div class="acc_tab" id="one">
										<form class="form-signin" action="Modify.php" method="post">
											<div class="row col-md-12">
												<div class="col-md-6">
													<div class="form-group">
														<label for="name" class="cols-sm-2 control-label">USER ID</label>
														<div class="cols-sm-10">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
																<input type="text" class="form-control" name="userid" id="name" required placeholder="Enter User id"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="name" class="cols-sm-2 control-label">NEW EMPID</label>
														<div class="cols-sm-10">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
																<input type="text" class="form-control" name="empid" id="name" required placeholder="Enter EMPID"/>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row col-md-12 acc_submit">
												<div class="submitbtn">
													<button class="btn btn-primary" type="submit" >Submit</button>
												</div>
											</div>
											<input type="hidden" value="1" name="input"/>
										</form>
									</div>
									<div class="acc_a">
										<a href="#two" class="col-md-12">Add Member of</a>
									</div>
									<div class="acc_tab" id="two">
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
												</div>
											</div>
											<div class="row col-md-12 acc_submit">
												<div class="submitbtn">
													<button class="btn btn-primary" type="submit" >Submit</button>
												</div>
											</div>
											<input type="hidden" value="1" name="input"/>
										</form>
									</div>
									<div class="acc_a">
										<a href="#three" class="col-md-12">Some Text</a>
									</div>
									<div class="acc_tab" id="three">
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
												</div>
											</div>
											<div class="row col-md-12 acc_submit">
												<div class="submitbtn">
													<button class="btn btn-primary" type="submit" >Submit</button>
												</div>
											</div>
											<input type="hidden" value="1" name="input"/>
										</form>
									</div>
								</div>
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
	}
?>
			
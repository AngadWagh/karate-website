<?php
if(!empty($_POST["register"])) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirm_password']){ 
	$error_message = 'Passwords should be same<br>'; 
	}

	/* Email Validation */
	if(!isset($error_message)) {
		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$error_message = "Invalid Email Address";
		}
	}

	/* Validation to check if gender is selected */
	if(!isset($error_message)) {
	if(!isset($_POST["gender"])) {
	$error_message = " All Fields are required";
	}
	}

	/* Validation to check if Terms and Conditions are accepted */
	if(!isset($error_message)) {
		if(!isset($_POST["terms"])) {
		$error_message = "Accept Terms and Conditions to Register";
		}
	}

	if(!isset($error_message)) {
		require_once("dbconnect.php");
		$db_handle = new dbcon();
		$query = "INSERT INTO users (Sname, addr, dob, pcont, password, email, gender) VALUES
		('" . $_POST["Sname"] . "', '" . $_POST["addr"] . "', '" . $_POST["dob"] . "', '" .$_POST["pcont"] . "', '" . ($_POST["password"]) . "', '" . $_POST["email"] . "', '" . $_POST["gender"] . "')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "Thanks! You have registered successfully!";	
			unset($_POST);
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	}
}
?>
<html>
<head>
<title>ASKA Registration Form</title>
 <link href="css/reg.css" rel="stylesheet">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
 <link href="img/logo1.png" rel="icon">
  <link href="img/logo1.png" rel="apple-touch-icon">
<style>

.bg {
  /* The image used */
  background-image: url("img/k1.jpg") ;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.error-message {
	text-align: center;
	margin: 2px 0px 0px 0px;
	padding: 7px 10px;
	background: #fff1f2;
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	text-align: center;
	margin: 2px 0px 0px 0px;
	padding: 7px 10px;
	background: #cae0c4;
	border: #c3d0b5 1px solid;
	color: #027506;
	border-radius: 4px;
}
</style>

</head>
<body class="bg">
		<?php if(!empty($success_message)) { ?>	
<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
<?php } ?>
<?php if(!empty($error_message)) { ?>	
<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
<?php } ?>
	<div class="header">
		<h2>Registeration Form</h2>
	<form name="frmRegistration" method="post" action="">
<table border="0" align="center" class="demo-table">
<input type="text" placeholder="Student name" name="Sname" value="<?php if(isset($_POST['Sname'])) echo $_POST['Sname']; ?>">
<input type="text" placeholder="Address" name="addr" value="<?php if(isset($_POST['addr'])) echo $_POST['addr']; ?>">
<input type="date" placeholder="Date Of Birth" name="dob" value="<?php if(isset($_POST['dob'])) echo $_POST['dob']; ?>">
<input type="number" placeholder="Mobile Number" name="pcont" value="<?php if(isset($_POST['pcont'])) echo $_POST['pcont']; ?>">
<input type="password" placeholder="Password" name="password" value="">
<input type="password" placeholder="Confirm Password" name="confirm_password" value="">
<input type="text" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
<input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female<br>
<input type="checkbox" name="terms"> I accept Terms and Conditions
<input type="submit" name="register" value="Submit">
</form>
</div>
</body>
</html>
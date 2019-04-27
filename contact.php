<?php
$name= $_POST['name'];
$email= $_POST['email'];
$subject= $_POST['subject'];
$messsage= $_POST['message'];

if(!empty ($name)|| !empty($email) || !empty($subject) || !empty($message))
{
	$host="localhost";
	$dbUsername="root";
	$dbpassword="";
	$dbname="registration";

	$conn= new mysqli($host, $dbUsername, $dbpassword, $dbname);

	if (mysqli_connect_error()) {
		
		die('Connect Error(' . mysqli_connect_error().')'. myysqli_connnect_error());

	}else{
		$SELECT ="SELECT email from contact where email=? Limit 1";
		$INSERT ="INSERT into contact(name, email, subject, message) VALUES('" . $_POST["name"] . "', '" . $_POST["email"] . "', '" . $_POST["subject"] . "', '" .$_POST["message"]. "')";

		$stmt=$conn->prepare($SELECT);
		$stmt->execute();
	
		$stmt->store_result();
		$rnum=$stmt->num_rows;

		if ($rnum==0) {
			$stmt->close();
			$stmt=$conn->prepare($INSERT);
			$stmt->execute();
			echo "New record inserted sussessfully";
		}else{
			echo "Someone already register using this email";
		}
		$stmt->close();
		$conn->close();
	}

}else
{

	echo "All field are required";
	die();
}


$query = "INSERT INTO contact (name, email, subject, message) VALUES
		('" . $_POST["name"] . "', '" . $_POST["email"] . "', '" . $_POST["subject"] . "', '" .$_POST["message"] . "')";
		
?>
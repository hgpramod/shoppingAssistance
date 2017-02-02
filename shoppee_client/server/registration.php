<?php
// Fetching Values From URL
$name2 = $_POST['name1'];
$email2 = $_POST['email1'];
$password2 = $_POST['password1'];
$contact2 = $_POST['contact1'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname="batabase";
   
$link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (isset($_POST['name1'])) 
{
	$query = mysqli_query($link,"insert into sample(name, email, password, contact) values ('$name2', '$email2', '$password2',$contact2)"); //Insert Query
	echo "Form Submitted succesfully";
}
mysqli_close($link); // Connection Closed
?>
<?php
// Fetching Values From URL
$name2 = $_POST['fullname1'];
$email2 = $_POST['email1'];
$password2 = $_POST['password1'];


$dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $dbname="shoppingassist";
   
   
 $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (!$link) {
    die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully';

$sql=mysqli_query("SELECT FROM client_reg_table (fullName,password) WHERE fullName=$name2 and password=$password2");
 if(mysqli_num_rows($sql)>=1)
   {
    alert("name already exists");
   }
   else
  {
     $query = mysqli_query($link,"insert into client_reg_table(fullName, emailId, password) values ('$name2', '$email2', '$password2')"); //Insert Query
     echo "Form Submitted succesfully";
  }
mysqli_close($link); // Connection Closed
?>
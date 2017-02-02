<?php
		// TODO: BCC not working
		require_once "Mail.php";
		//configure the mail
		$from = "No Reply <no_reply@vivikta.in>"; 
		$to = "pramod.hg@vivikta.in"; 
		$subject = "List of Donors";
		$body = "<!DOCTYPE html>
				<html>
				<body>
				<table border=1 style='border-color: #666;text-align:center;margin: 25px auto;border-collapse: collapse;border: 1px solid #eee;border-bottom: 2px solid #00cccc;box-shadow: 0px 0px 20px rgba(0,0,0,0.10),0px 10px 20px rgba(0,0,0,0.05),0px 20px 20px rgba(0,0,0,0.05),0px 30px 20px rgba(0,0,0,0.05);' cellpadding='10'>
					<tr style='	background: #f4f4f4;text-transform:uppercase;'>
						<th style='color: #555;background: #00cccc;color: black;text-transform: uppercase;font-size: 16px;'>Name</th>
						<th style='color: #555;background: #00cccc;color: black;text-transform: uppercase;font-size: 16px;'>Email Id</th>
						<th style='color: #555;background: #00cccc;color: black;text-transform: uppercase;font-size: 16px;'>Phone Number</th>
					</tr>";
		$host = "www.vivikta.in";
		$username = "no_reply@vivikta.in"; 
		$password = "Junkcrap123";
		
		//get the details of the donors
		$donorsList = explode(",", $donorDetails);
		$sizeOfDonorsList = count($donorsList);
		/*
		** iterate through all the donors and fetch the details of the donors
		** and send the details of each donors to the user through a mail
		*/
		
		$body = $body."</table></body></html>";
		//set the headers to send the mail
		$headers = array ('From' => $from,   
						'To' => $to,   
						'Subject' => $subject,
						'Content-Type'=>'text/html',
						'MIME-Version'=>'1.0'); 
		$smtp = Mail::factory('smtp', array ('host' => $host,'auth' => true,'username' => $username,'password' => $password));  
		$mail = $smtp->send($to, $headers, $body);
		//check if the mail is sent  
		if (PEAR::isError($mail)) 
			echo "FAILURE"; 
		else 
			echo "SUCCESS";
?>
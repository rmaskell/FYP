<?php


//Clean strings for security
function secureStrings($input, $con){
	
	$con->real_escape_string($input);
	
	//Return
	return $output;
}

//Instance class
function createInstance(){
	
	//Instancing
	$obj = new declarations;
	return $obj;

}

function resetPassword($ticket, $emailAddress, $newPassword){
	//Create query
	$databaseQuery = "SELECT * FROM login WHERE emailAddress='$emailAddress'";
	
	//Execute Database query
	$result = executeDatabase($databaseQuery);
	
	//Fetch array
	while($row = mysqli_fetch_array($result)){

		//Create ticket based off database
		$hash = $row['hash'];
		$password = $row['password'];
		$checkTicket = $hash.$password;
		
		if ($checkTicket == $ticket){
		  
			//Clean query input
			$con = createInstance();
			$emailAddress = $con->real_escape_string($emailAddress);
		
			$newPassword = saltPassword($newPassword);
			$databaseQuery = "UPDATE login SET password='$newPassword' WHERE emailAddress='$emailAddress'";
			executeDatabase($databaseQuery);
			print ('reset');
		}
		
		else {
			print ('brequest');
		}
				
	}
	
}

?>

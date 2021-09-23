<?php
/**
Student Name: Peifen Lu
Student ID: 18008550
assign.php is a server-side program that allows the admin to assgign a taxi to the booking requests
with booking number as input and update the status of booking request in database
**/
	$bookingNumber = $_POST["bookingNumber"];
	require_once("../../conf/sqlassign2.php");

	echo $bookingNumber;
	$conn = @mysqli_connect($sql_host,$sql_user,$sql_pass,$sql_db);

	if (!$conn) {
		//display an error upon unsuccessful connection to database
		echo "<p>Fail to connect to the database</p>";
	} else {
		//sql query that select the required booking request
		$query = "select * from $sql_table where bookingNumber = '$bookingNumber' and status = 'unassigned'";
		$result = mysqli_query($conn, $query);
		
		if(!$result) {
			echo "<p>There is something wrong with the query: ", $query, "</p>";
		} else {
			//obtain the row numbers of the search
			$result_count =mysqli_num_rows($result);
			
			//chech if there is any row of the search
			if($result_count != 0) {
				
				//make an update to the database to change the status from unassigned to assigned
				$query = "update $sql_table set status = 'assigned' where bookingNumber = '$bookingNumber'";
				$result = mysqli_query($conn, $query);

				if(!$result) {
					echo "<p>There is something wrong with the query: ", $query, "</p>";
				} else {
					
					//return the confirmation to admin upon successful assignment
					echo "<p>The booking request ", $bookingNumber, " has been properly assigned.</p>";
				}
			} else {
				//Return confirmation messsage to the admin upon unsuccessful assignment
				echo "Fail to find the booking number unassigned in the database";
			}
		}
		mysqli_free_result($result_count);
		mysqli_close($conn);
	}
?>
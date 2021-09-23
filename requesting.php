<?php
/**
Student Name: Peifen Lu
Student ID: 18008550
requesting.php is a server-side program that finds the unassigned booking requests with 
a pick-up time less than 2 hour from now and return relevant infomation to the client
**/

	require_once("../../conf/sqlassign2.php");

	$conn = @mysqli_connect($sql_host,$sql_user,$sql_pass,$sql_db);

	if (!$conn) {
		echo "<p>Fail to connect to the database</p>";
	} else {
		$pickupDate = $_POST["pickupDate"];
		$currentDate = date("Y-m-d");
		$currentTime = date("H:i:s");
		$maxTime = date("H:i:s", strtotime("+2 hours"));

		//sql query that finds the unassigned requests with pick-up time within 2 hours from now
		$query = "select bookingNumber, customerName, phoneNumber, suburb, destination, pickupDate, pickupTime"
					." from $sql_table Where status = 'unassigned' and pickupTime between '$currentTime' and '$maxTime' "
					."and pickupDate = '$currentDate' ";

		//execute the query
		$chech_unassigned = mysqli_query($conn, $query);
		if(!$chech_unassigned) {
			echo "<p>There is something wrong with the query: ", $query, "</p>";
		}
		else {
			//check the number of requested results
			$result_count = mysqli_num_rows($chech_unassigned);

			if($result_count == 0) {
				echo "<p>There is no unassigned booking requests in the system</p>";
			} else {
				echo "<table border-collapse='collapse'>
						<tr style ='color: blue;'>
							<th>Booking Number</th>
							<th>Customer Name</th>
							<th>Phone</th>
							<th>Pick-up Suburb</th>
							<th>Destination</th>
							<th>Pick-up Date</th>
							<th>Pick-up Time</th>
						</tr>";

				//display the relevant booking information upon successful search
				while($row = mysqli_fetch_array($chech_unassigned))	{
						echo "<tr>";
							for($index = 0; $index <=7; $index++)	{
								echo "<td><p>",$row[$index],"</p>";
							}
						echo "</td></tr>";	
					}
				echo"</table>";
				mysqli_free_result($chech_unassigned);
				mysqli_close($conn);
			}
		}
	}
?>
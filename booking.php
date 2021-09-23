<?php
/**
Student Name: Peifen Lu
Student ID: 18008550
booking.php is a server-side program that validates all the inputs for the booking request from customer
and store all the booking information unpon successful booking
**/
	require_once('../../conf/sqlassign2.php');
			
	$conn = @mysqli_connect($sql_host,$sql_user,$sql_pass,$sql_db);
					
	if (!$conn) {
		echo "<p>Fail to connect to the database</p>";
	} else {
		//Create the Database table if not exists
		$query="CREATE TABLE IF NOT EXISTS $sql_table ("
			."bookingNumber INT(11) NOT NULL PRIMARY KEY,"
			."status VARCHAR(30) NOT NULL,"
			."customerName VARCHAR(30) NOT NULL,"
			."phone INT(11) NOT NULL,"
			."unitNO VARCHAR(30),"
			."streetNO VARCHAR(30) NOT NULL,"
			."streetName VARCHAR(30) NOT NULL,"
			."suburb VARCHAR(30) NOT NULL,"
			."destination VARCHAR(30) NOT NULL,"
			."pickupDate DATE NOT NULL,"
			."pickupTime TIME NOT NULL,"
			."bookingDate DATE NOT NULL,"
			."bookingTime TIME NOT NULL)";

		$result=mysqli_query($conn, $query);
		//display error message if query operates unsuccessfully.
		if(!$result) {
			echo "<p>There is something wrong with the query: ", $query, "</p>";
		}
	}

	$customerName = $_POST["customerName"];
	$phone = $_POST["phone"];
	$unitNO = $_POST["unitNO"];
	$streetNO = $_POST["streetNO"];
	$streetName = $_POST["streetName"];
	$suburb = $_POST["suburb"];
	$pickupDate = $_POST["pickupDate"];
	$pickupTime = $_POST["pickupTime"];
	$destination = $_POST["destination"];
	$bookingDate = date("Y-m-d");
	$bookingTime = date("h:i:sa");
	
	$isValid=0;
	
	//validate whether customer name has been provided
	if(empty($customerName)){
		$customer_name_error = "<p>Customer name cannot be empty.</p>";
	}else{
		//validate whether customer name only contain letters
		if(!preg_match("/^[A-Za-z\s]+$/", $customerName)) {
			$customer_name_error = "<p>Invalid customer name is invalid. It can only contain letters and space.</p>";
		}else{
			$customer_name_error="";
			$isValid++;
		}
	}

	//validate whether contact phone number has been provided
	if(empty($phone)){
		$phone_error = "<p>Contact phone cannot be empty.</p>";
	}else{
		//validate whether contact phone number only contain numbers
		if(!is_numeric($phone)) {
			$phone_error = "<p>Invalid phone number. It can only contain numbers.</p>";
		}else{
			$phone_error="";
			$isValid++;
		}
	}
	
	//validate whether unit number only contain letters and numbers
	if(empty($unitNO)){
		$isValid++;
	}else{
		if(!preg_match("/[A-Za-z0-9]/", $unitNO)) {
			$unit_error = "<p>Invalid unit number. It can only contain letters and numbers.</p>";
		}else{
			$unit_error="";
			$isValid++;
		}
	}

	//validate whether street number has been provided
	if(empty($streetNO)){
		$street_num_error = "<p>Street number cannot be empty.</p>";
	}else{
		//validate whether street number only contain letters and numbers
		if(!preg_match("/[A-Za-z0-9]/", $streetNO)) {
			$street_num_error = "<p>Invalid street number. It can only contain letters and numbers.</p>";
		}else{
			$street_num_error="";
			$isValid++;
		}
	}
	
	//validate whether street name has been provided
	if(empty($streetName)){
		$street_name_error = "<p>Street name cannot be empty.</p>";
	}else{
		//validate whether street name only contain letters
		if(!preg_match("/^[A-Za-z\s]+$/", $streetName)) {
			$street_name_error = "<p>Invalid street name. It can only contain letters and space.</p>";
		}else{
			$street_name_error="";
			$isValid++;
		}
	}

	//validate whether suburb name has been provided
	if(empty($suburb)){
		$suburb_error = "<p>Suburb cannot be empty.</p>";
	}else{
		//validate whether suburb name only contain letters
		if(!preg_match("/^[A-Za-z\s]+$/", $suburb)) {
			$suburb_error = "<p>Invalid suburb name. It can only contain letters and space.</p>";
		}else{
			$suburb_error="";
			$isValid++;
		}
	}
	
	//validate whether destination suburb has been provided
	if(empty($destination)){
		$destination_error = "<p>Destination cannot be empty.</p>";
	}else{
		//validate whether destination suburb only contain letters
		if(!preg_match("/^[A-Za-z\s]+$/", $destination)) {
			$destination_error = "<p>Invalid destination suburb. It can only contain letters and space.</p>";
		}else{
			$destination_error="";
			$isValid++;
		}
	}
	
	//validate whether pick-up date has been provided
	if(empty($pickupDate)){
		$pickupDate_error = "<p>Pick-up Date cannot be empty.</p>";
	}else{
		$pickupDate_error="";
	}
	
	//validate whether pick-up time has been provided
	if(empty($pickupTime)){
		$pickupTime_error = "<p>Pick-up Date cannot be empty.</p>";
	}else{
		$pickupTime_error="";
	}
	
	//validate whether pick-up date/time is no earlier than current date/time
	if(!empty($pickupTime)&&!empty($pickupDate)){
		if($bookingDate<$pickupDate){
			$pickup_error="";
			$isValid++;
		}elseif($bookingDate==$pickupDate){
			if($bookingTime<$pickupTime){
				$pickup_error="";
				$isValid++;
			}else{
				$pickup_error="<p>Pick-up date/time cannot be earlier than the current date/time</p>";
			}
		}else{
			$pickup_error="<p>Pick-up date/time cannot be earlier than the current date/time</p>";
		}
	}

	//display the error message if there is any error
	if($isValid<8) {
		echo $customer_name_error . $phone_error . $unit_error . $street_num_error . $street_name_error 
		. $suburb_error . $destination_error . $pickupDate_error . $pickupTime_error . $pickup_error;
	} else {
		//assign the default value to status
		$status="unassigned";
				
		//randomly create a unique booking Number
		$bookingNumber=rand(111111,1000000000);
					
		$isBookingNoValid=false;
					
		//validate whether the bookingNumber is unique
		while(!isBookingNoValid){
			$query="select * from $sql_table where bookingNumber='$bookingNumber'";
			$check_unique=mysqli_query($conn, $query);
			$count=mysqli_num_rows($check_unique);
						
			//create another bookingNumber until the bookingNumber is unique
			if($count==0){
				$isBookingNoValid=true;
			}else{
				$bookingNumber=rand(111111,1000000000);
			}
		}
		
		//insert a booking detail to the database table
		$query = "insert into $sql_table"
			."(bookingNumber, status, customerName, phoneNumber, unitNO, streetNO, streetName, suburb, destination, pickupDate, pickupTime, bookingDate, bookingTime)"
			."values"
			."('$bookingNumber', '$status', '$customerName', '$phone', '$unitNO', '$streetNO',"
			."'$streetName', '$suburb', '$destination', '$pickupDate', '$pickupTime', '$bookingDate', '$bookingTime')";

		$result = mysqli_query($conn, $query);

		if(!$result) {
			echo "<p>Fail to make a booking!</p>";
		} else {
			//display relevant booking information upon successful booking
			echo "<p>Booking successful! Your booking number is ". $bookingNumber ." <br> You will be picked up at $pickupTime on $pickupDate</p>";
		}
		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

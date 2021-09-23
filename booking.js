/**
Student Name: Peifen Lu
Student IS: 18008550
booking.js is a client program that validate the customer input and send them to the server 
and reset the input after sending request
**/


var xhr = createRequest();

function createRequest() {
    var xhr = false;  
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
}

function booking(dataSource, divID, customerName, phone, unitNO, streetNO, streetName, suburb, pickupDate, pickupTime, destination) {
	if(xhr) {
		var isVaild=true;
		
		if(!customerName){
			document.getElementById(divID).innerHTML="<p>Error: Customer name cannot be empty!</p>";
			isVaild=false;
		}else if(!phone){
			document.getElementById(divID).innerHTML="<p>Error: Phone cannot be empty!</p>";
			isVaild=false;
		}else if(!streetNO){
			document.getElementById(divID).innerHTML="<p>Error: Street number cannot be empty!</p>";
			isVaild=false;
		}else if(!streetName){
			document.getElementById(divID).innerHTML="<p>Error: Street Name cannot be empty!</p>";
			isVaild=false;
		}else if(!suburb){
			document.getElementById(divID).innerHTML="<p>Error: Pick-up suburb cannot be empty!</p>";
			isVaild=false;
		}else if(!pickupDate){
			document.getElementById(divID).innerHTML="<p>Error: Pick-up date cannot be empty!</p>";
			isVaild=false;
		}else if(!pickupTime){
			document.getElementById(divID).innerHTML="<p>Error: Pick-up time cannot be empty!</p>";
			isVaild=false;
		}else if(!destination){
			document.getElementById(divID).innerHTML="<p>Error: Destination cannot be empty!</p>";
			isVaild=false;
		}
		
		if(isVaild){
			var obj = document.getElementById(divID);
			var requestbody ="&customerName="+encodeURIComponent(customerName)
			+"&phone="+encodeURIComponent(phone)
			+"&unitNO="+encodeURIComponent(unitNO)
			+"&streetNO="+encodeURIComponent(streetNO)
			+"&streetName="+encodeURIComponent(streetName)
			+"&suburb="+encodeURIComponent(suburb)
			+"&pickupDate="+encodeURIComponent(pickupDate)
			+"&pickupTime="+encodeURIComponent(pickupTime)
			+"&destination="+encodeURIComponent(destination);
			xhr.open("POST", dataSource, true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) { 
					obj.innerHTML = "<span style='color:red'>" + xhr.responseText + "</span>";
				} 
			} 
			xhr.send(requestbody);
		//	reset();
		}
	}
} 

/**function reset(){
	document.getElementsByName("customerName")[0].value="";
	document.getElementsByName("phone")[0].value="";
	document.getElementsByName("unitNO")[0].value="";
	document.getElementsByName("streetNO")[0].value="";
	document.getElementsByName("streetName")[0].value="";
	document.getElementsByName("suburb")[0].value="";
	document.getElementsByName("pickupDate")[0].value="";
	document.getElementsByName("pickupTime")[0].value="";
	document.getElementsByName("destination")[0].value="";
}**/

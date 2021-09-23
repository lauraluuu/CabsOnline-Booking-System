/**
Student Name: Peifen Lu
Student IS: 18008550
admin.js is a client program that validate the booking number input and issue
a query request to the server and reset the input after sending request
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

function requesting(dataSource, divID, date) {
	if(xhr) {
		var obj = document.getElementById(divID);
		var requestbody ="date="+encodeURIComponent(date);
 		xhr.open("POST", dataSource, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) { 
				obj.innerHTML = "<span style='color:red'>" + xhr.responseText + "</span>";
			}
		}
 		xhr.send(requestbody);
	}
}

function assigning(dataSource, divID, bookingNumber) {
	if(xhr) {
		var isVaild=true;
		
		if(!bookingNumber){
			document.getElementById(divID).innerHTML="<p>Error: Booking number cannot be empty!</p>";
			isVaild=false;
		}
		
		if(isVaild){
			var obj = document.getElementById(divID);
			var requestbody ="bookingNumber="+encodeURIComponent(bookingNumber);
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
	document.getElementsByName("bookingNumber")[0].value="";
}**/


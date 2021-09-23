# CabsOnline-Booking-System
Web Development Assignment. This assignment got 38/40 marks.
Assignment Tasks: To develop simple web-based taxi booking system called CabsOnline. 
CabsOnline allows passengers to book taxi services. The techniques I used include the Ajax techniques
(JavaScript/HTML, XMLHttpRequest, CSS, and DOM), MySQL and PHP. For client-server
communication, I used XMLHttpRequest. 


## Users

- **Passenger:** Book a Taxi
- **Admin:** View Bookings, Assign a Taxi

## Two Components

## **Booking:** 
This component is used to allow a passenger to put in a taxi booking request in Auckland and
surrounding areas. The inputs for such a request include customer name, contact phone, pick-up
address (unit number if applicable, street number, street name, and suburb), destination suburb,
and pick-up date/time. Once the user enters inputs, a unique booking reference number is generated , booking date/time and
status with initial value “unassigned” for the request, add the request in a MySQL database on the
server side are created.

#### User Story: 
- As a passenger user, I want to be able to book a taxi in Auckland and surrounding areas.
<img align="left" src="https://github.com/lauraluuu/CabsOnline-Booking-System/blob/main/page_images/booking_page.PNG?raw=true">




## **Admin:** 
This component allows administrative people of CabsOnline to view those taxi booking requests
that need to be assigned as soon as possible and to assign taxi for a particular booking request. 

#### User Story: 
- As an admin user, I want to be able to view taxi bookings within 2 hours so that I can manage the booking requests.
- As an admin user, I want to be able to assign a taxi to a particular booking request.
<img align="left" src="https://github.com/lauraluuu/CabsOnline-Booking-System/blob/main/page_images/admin_page.PNG?raw=true">





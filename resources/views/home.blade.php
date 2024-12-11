@extends('layouts.app')

@section('content')
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- First Card -->
            <div class="card mb-3">
                <div class="card-header">{{ __('Aluth Gamak Aluth Ratak Program') }}</div>
                <div class="card-body">
                    Sri Lanka's "Aluth Gamak Aluth Ratak" program, which translates to "New Village, New Way" in Sinhalese, is a comprehensive initiative aimed at revitalizing the country's rural areas. Launched in response to recent economic challenges, the program goes beyond just increasing food production. It takes a multi-pronged approach, bringing together various government departments like agriculture, infrastructure, and education to address the specific needs of each village. This could involve providing farmers with better access to resources and training, improving rural infrastructure like roads and irrigation systems, or even investing in education and healthcare initiatives to create a more skilled and healthy rural workforce. The ultimate goal is to empower these communities by fostering economic diversification and creating a more sustainable future for rural Sri Lanka. The program's success is seen as a potential key to national economic recovery, with the hope that thriving rural economies will contribute to a more stable and prosperous Sri Lanka.
                </div>
            </div>
            <!-- Second Card -->
            <div class="card mb-3">
                <div class="card-header">{{ __('Aluth Gamak – Aluth Ratak') }}</div>
                <div class="card-body">
                    <strong>National Integrated Participatory Development Programme</strong><br><br>
                    Implemented based on the instruction of the Hon. President and vision of Hon. Prime Minister.<br>
                    National Integrated Participatory Development Programme.<br>
                    Obtaining support/contribution of all stakeholders.<br>
                    While targeting people’s needs centered around family factor & rural economy.<br><br>
                    Implemented under the 07 main fields:<br>
                    01. Food Security<br>
                    02. Employment and enterprise Security<br>
                    03. Family health and nutritional Security<br>
                    04. Educational Security<br>
                    05. Securing Women, Child and community rights<br>
                    06. Securing the rights of the elderly and retired community<br>
                    07. Establishing market Protection and fair pricing system
                </div>
            </div>
            <!-- Third Card -->
            <div class="card mb-3">
                <div class="card-header">{{ __('Programme Implementation') }}</div>
                <div class="card-body">
                    This programme will be implemented in 25 District Secretariats throughout the year involving 8 main fields as per the agreement entered into with the secretary of the ministry by District Secretaries.<br><br>
                    8 Main fields are:<br>
                    1. Economic<br>
                    2. Social<br>
                    3. Poverty alleviation<br>
                    4. Health and Nutritional<br>
                    5. Agricultural<br>
                    6. Environmental<br>
                    7. State Income<br>
                    8. State Expenditure
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup Icon at the far right -->
<div class="popup" onclick="myFunction()">
    <i class="fas fa-info-circle fa-2x" style="color: #fff;"></i> <!-- Changed icon size to large -->
    <span class="popuptext" id="myPopup">Hi there, Welcome to Performance Agreement. This System Developed by Gayan Kavinda (Software Engineer) IT Division in Ministry of Home Affairs. Graduate from Sri Lanka Institute of Information Technology. The System Developed Framework is Laravel v10.48.12 (PHP v8.1.25). Find more about me on <a href="https://github.com/GayanKavinda" target="_blank">GitHub</a> or <a href="https://www.linkedin.com/in/gayan-gamlath-k98/" target="_blank">LinkedIn</a>.</span>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM3+NKH6iK9zSKDlD7ww8RTDR2KLv1ktE2EKx2u" crossorigin="anonymous"></script>

<script>
// When the user clicks on the div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>

<style>
/* Popup container - can be anything you want */

.popup {
    position: fixed;
    bottom: 10px;
    right: 40px; /* Adjusted for far right placement */
    cursor: pointer;
    user-select: none;
    z-index: 9999; /* Ensure popup is on top */
    background-color: #3d8e97; /* Changed button background color */
    color: white; /* Text color */
    padding: 5px; /* Reduced padding */
    border-radius: 50%; /* Make it a circle */
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px; /* Adjusted width */
    height: 45px; /* Adjusted height */
}

/* The actual popup */
.popup .popuptext {
    visibility: hidden;
    width: 250px;
    background-color: #555;
    color: #fff;
    text-align: justify;
    border-radius: 6px;
    padding: 10px; /* Increased padding */
    position: absolute;
    z-index: 9999; /* Ensure popup is on top */
    bottom: 60px; /* Position above the icon */
    right: 0;
    font-size: 13px;
}

/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    right: 20px; /* Position arrow to align with the popup */
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent; /* Arrow pointing down */
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>

@endsection

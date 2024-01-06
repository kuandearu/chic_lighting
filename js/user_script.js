let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = ()=>{
    profile.classList.toggle('active');
    navbar.classList.remove('avtive');
}
// menu open when screen size is smaller than 700px 
let navbar = document.querySelector('.header .flex .navbar');
document.querySelector('#menu-btn').onclick = ()=>{
    profile.classList.remove('active');
    navbar.classList.toggle('active');
}
// hide menu when scroll page 
window.onscroll = () =>{
    profile.classList.remove('active');
    navbar.classList.remove('active');
}

// show date time location 
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var location = "Latitude: " + latitude + ", Longitude: " + longitude;
    document.getElementById("location").innerHTML = location;
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;
}

var today = new Date();
		var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		var dateTime = date+' '+time;
		document.getElementById("datetime").innerHTML = dateTime;    
/* admin menu on click  */
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
//change image in detail
subImages.forEach(images => {
    images.onclick = () => {
        let src = images.getAttribute('src');
        mainImage.src = src;
    }
    
});



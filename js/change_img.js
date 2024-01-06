
//change image in quick view
subImages = document.querySelectorAll('.quick-view .box .main-img .small-img img');
mainImage = document.querySelector('.quick-view .box .main-img .big-img img');
subImages.forEach(images => {
    images.onclick = () => {
        let src = images.getAttribute('src');
        mainImage.src = src;
    }
    
});
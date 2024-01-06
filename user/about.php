<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 

<!-- about section  -->
<section class="about">
    <div class="row">
       <div class="image">
        <img src="../img/about.jpg" alt="">
       </div> 
       <div class="content">
        <h3>Why choose us?</h3>
        <p>Chic Lighting & Design has its presence since 1971. We offer unique lighting and
          accessories from the most elegant traditional to refined contemporary for today’s eclectic
          interiors. <br>
          Chic Lighting & Design is an online retailer that specializes in LED Lights, Lamps,
          Chandeliers and Pendant lighting. We have a range of collections that include; crystal
          chandeliers, traditional chandeliers, modern chandeliers, glass pendant lights, industrial
          and retro pendant lights, metal pendant lights and many more. <br>
          At Chic Lighting & Design, we are dedicated to customer service. When you call or email
          during normal business hours, you will speak or get reply from a design professional. Our
          knowledgeable and experienced staff receives ongoing education and training and is
          available to assist with all of your lighting projects.</p>
        <a href="./contact.php" class="btn">Contact Us</a>

       </div>
    </div>
</section>

<!-- review section  -->
<section class="reviews">
    <h1 class="heading">Client's review</h1>
    <div class="review">
        <div class="w">
            <div class="slide">
                  <img src="../img/1.jpg" alt="">
                  <p>Thanks for visit our website!!</p>
                  <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h3>Giang Khank Quan</h3>
            </div>

            <div class="slide">
                  <img src="../img/6.jpg" alt="">
                  <p>Thanks for visit our website!!</p>
                  <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="fa-regular fa-star"></i>
                  </div>
                  <h3>Trinh Huy Hoang</h3>
            </div>

            <div class="slide">
                  <img src="../img/3.jpg" alt="">
                  <p>Thanks for visit our website!!</p>
                  <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h3>Nguyen Phuc Toan</h3>
            </div>

            <div class="slide">
                  <img src="../img/1.jpg" alt="">
                  <p>Thanks for visit our website!!</p>
                  <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </div>
                  <h3>Nguyen Anh Duc</h3>
            </div>
            
        </div>

        
    </div>
</section>



<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>
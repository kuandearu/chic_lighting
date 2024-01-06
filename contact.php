<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $msg = $_POST['msg'];

    $select_message = $conn->query("SELECT * FROM `messages` WHERE name ='$name' AND email= '$email' AND number='$number' AND message = '$msg'");
    $check = $select_message->num_rows;
    if($check > 0) {
        $message[] = 'message sent already!';
    }else{
        $send_message = $conn->query("INSERT INTO `messages`(name, email, number, message) VALUES('$name','$email','$number','$msg') ");
        $message[] = 'message sent successfully!';
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 

<!-- contact section -->

<section class="form-container">
    <h1 class="heading">contact us</h1>
    <form action="" method="post" class="box">
        <h3>send us message!</h3>
        <input type="text" name="name" required placeholder="enter your name" maxlength="20" class="box">
        <input type="number" name="number" required placeholder="enter your number" max="9999999999" min="0" class="box" onkeypress="if(this.value.length == 10) return false;">
        <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box">
        <textarea name="msg" placeholder="Enter your message" required class="box" cols="30" rows="10"></textarea>
        <input type="submit" value="send message" class="btn" name="send">
    </form>
</section>


<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>
<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

if(isset($_POST['signup'])){
    $name = $_POST['txtname'];
    $email = $_POST['txtemail'];
    $pass = md5($_POST['pass']);
    $cpass = md5($_POST['cpass']);

        $select_user = "SELECT * FROM `users` where name = '$name' or email = '$email'";
        $result = $conn->query($select_user);
        
        if($result->num_rows > 0){
            $message[]= 'Username or Password is already exist';
        }else{
            if($pass != $cpass){
                $message[]= 'New password does not match';
            }else{
                $conn->query("insert into `users`(name,email,password) values('$name','$email','$cpass')");
                $message[]= 'Register successfully';
                header('Location: ./user_login.php');
            }
        }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 
        <section class = "form-container">
            <form action="" method="post">
               <h3>Sign Up</h3>
               <input type="text" name="txtname" placeholder="Username" 
                required class = "box">
               <input type="email" name="txtemail" placeholder="Enter your email" 
                required class = "box">
               <input type="password" name="pass" placeholder="Enter your password" 
                required class = "box">
               <input type="password" name="cpass" 
                placeholder="Confirm your password" required class = "box">
               <input type="submit" name = "signup" value="Sign up now"  class="btn">
               <p>Already signed up? </p>
               <a href="./user_login.php" class="option-btn">Login</a>
            </form>
        </section>
        
<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>
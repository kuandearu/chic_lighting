<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

if(isset($_POST['submit'])){
    $name = $_POST['txtname'];
    $pass = md5($_POST['txtpass']);

    $check = $conn->query("select * from `admins` where name = '$name' and password = '$pass'");
    if($check->num_rows >0){
            $getId = $check->fetch_assoc();
            $_SESSION['admin_id'] = $getId['id'] ;
            $message[]= 'Login success!';
            header('location:../admin/dashboard.php');
    }
    else{
        $select_user = $conn->query("select * from `users` where name = '$name' and password = '$pass'");
        $check = $select_user->num_rows;

        if($check >0){
            $user_id = $select_user->fetch_assoc();
            $_SESSION['user_id'] = $user_id['id'] ;
            $message[]= 'Login success!';
            header('location:./home.php');
        }else{
            $message[]= 'incorrect username or password!';
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 
    
    <section class = "form-container">
        <form action="" method="post">
            <h3>Login</h3>
            <input type="text" name="txtname" placeholder="Username" 
            required class = "box">
            <input type="password" name="txtpass" placeholder="Enter your password" 
            required class = "box">
            <input type="submit" name = "submit" value="Login" class="btn">
            <p>Not sign up?</p>
            <a href="./user_register.php" class = "option-btn">Sign up now</a>
        </form>
    </section>

<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>
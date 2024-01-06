<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header("location:./user_login.php");
}

if(isset($_POST['update'])){
    $name = $_POST['txtname'];
    $email = $_POST['email'];
    $oldpass = md5($_POST['oldpass']);
    $newpass = md5($_POST['newpass']);
    $cpass = md5($_POST['cpass']);

    $empty_pass = 'd41d8cd98f00b204e9800998ecf8427e';  /* md5 hash for null string */
    /* Check the previous password */
    $select_prev_pass = "SELECT password FROM users WHERE id = '$user_id'";
    $result = $conn->query($select_prev_pass);
    $fetch_prev_pass = $result->fetch_assoc();
    $prev_pass = $fetch_prev_pass['password'];

    
        if($oldpass == $empty_pass){
            $message[]= 'Please enter your old password';
        }else if($oldpass != $prev_pass){
            $message[]= 'Old password does not match';
        }else{
            if($newpass != $cpass){
                $message[]= 'New password does not match';
            }else{
                if($newpass != $empty_pass){
                    $update_profile = "UPDATE `users` SET name = '$name', 
                                                        email = '$email',
                                                        password = '$cpass'
                                                        WHERE id = '$user_id'";
                    $conn->query($update_profile);
                    $message[]= 'Your profile has been updated';
                }else{
                    $message[]= 'Please enter your new password';
                }
            }
        } 
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 
        <section class = "form-container">
            <form action="" method="post">
               <h3>Update profile</h3>
               <input type="text" name="txtname" placeholder="Username" 
                required class = "box">
               <input type="email" name="email" placeholder="Enter your email" required
                class = "box">
               <input type="password" name="oldpass" placeholder="Enter your old password" 
                class = "box">
               <input type="password" name="newpass" placeholder="Enter your new password" 
                class = "box">
               <input type="password" name="cpass" placeholder="confirm new your password" 
                class = "box">
               <input type="submit" name = "update" value="Update" class="btn">
            </form>
        </section>





<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>
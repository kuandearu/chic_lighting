<?php 
include('../component/connect.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $pass = md5($_POST['userpass']);
    $pass_c = md5($_POST['userpass_c']);

    $select_admin = $conn->query("select * from `admins` where name = '$name'");
    $check_name = $select_admin->num_rows;

    if($check_name >0){
        $message[] ='Username already exists!';
    }else{
        if($pass != $pass_c){
            $message[]= 'Confirm password does not match!';
        }
        else{
            $add_admin = $conn->query("insert into `admins`(name,password) values('$name','$pass_c')");
            $message[] ='New admin account added!';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>



<?php include ('../component/admin_header.php'); ?>

<body>
    <!-- admin registration section  -->
    <section class="form-container">
        <form action="" method="post">
            <h3>Administrator register</h3>
            <input type="text" name="username" maxlength="20" required placeholder="Enter username" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="userpass" maxlength="20" required placeholder="Enter password" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="userpass_c" maxlength="20" required placeholder="Confirm password" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Register" name="submit" class="btn">
        </form>
    </section>



</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
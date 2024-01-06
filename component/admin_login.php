<?php 
include('../component/connect.php');
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $pass = md5($_POST['userpass']);

    $select_admin = $conn->query("select * from `admins` where name = '$name' and password = '$pass'");
    $check = $select_admin->num_rows;

    if($check >0){
        $getId = $select_admin->fetch_assoc();
        $_SESSION['admin_id'] = $getId['id'] ;
        $message[]= 'Login success!';
        header('location:../admin/dashboard.php');
    }else{
        $message[]= 'incorrect username or password!';
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

<!-- custom css file link  -->
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>



<?php 
    if(isset($message)){
        foreach ($message as $mes ) {
           echo '
           <div class="message">
    <span>' . $mes .'</span>
    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
        '; 
    }
}
?>

    <!-- admin logn form section start  -->
    <section class="form-container">
        <form action="" method="post">
            <h3>Login as Administrator</h3>
            <p>Default username = <span>admin</span> & password = <span>123</span></p>
            <input type="text" name="username" maxlength="20" required placeholder="Enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="userpass" maxlength="20" required placeholder="Enter password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <!-- this.value.replace(/\s/g, '') to remove spaces from the input string  -->
            <input type="submit" value="Log In" name="submit" class="btn">
        </form>
    </section>
    <!-- admin logn form section end  -->

</body>
</html>
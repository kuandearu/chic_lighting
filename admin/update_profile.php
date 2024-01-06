<?php 
include('../component/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];


if(!isset($admin_id)){
    header('location:../component/admin_login.php');
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $update_name = $conn->query("update `admins` set name = '$name' where id = '$admin_id'");

    $empty_pass = 'd41d8cd98f00b204e9800998ecf8427e';
    $getPass = $conn->query("select password from `admins` where id = '$admin_id'")->fetch_assoc();
    $check_pass = $getPass['password'];

    $old_pass = md5($_POST['old_pass']);
    $new_pass = md5($_POST['new_pass']);
    $new_pass_c = md5($_POST['new_pass_c']);

    if($old_pass == $empty_pass){
        $message[] = 'please enter old password!';
    }
    else if($old_pass != $check_pass){
        $message[] = "Old password inccorect!";
    }
    else{
        if($new_pass != $new_pass_c){
            $message[] = 'Confirm password does not match!';
        }
        else{
            if($new_pass != $empty_pass){
                $update_pass = $conn->query("update `admins` set password = '$new_pass_c' where id = '$admin_id'");
                $message[]= "Password changed successfully!";
            }
            else{
                $message[] = 'please enter new password!';
            }
        }
    }
    

}

?>

<?php include ('../component/admin_header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin update profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <!-- admin profile update section  -->
    <section class="form-container">
        <form action="" method="post">
            <h3>Update profile</h3>
            <!-- get username  -->
            <input type="text" name="name" maxlength="20" required placeholder="Enter username" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')" value=<?php echo $fetch_profile['name']?>>
            <!-- old password  -->
            <input type="password" name="old_pass" maxlength="20" required placeholder="Enter old password" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <!-- new password  -->
            <input type="password" name="new_pass" maxlength="20" required placeholder="Enter new password" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <!-- confirm  -->
            <input type="password" name="new_pass_c" maxlength="20" required  placeholder="Confirm password" 
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Update" name="submit" class="btn">
        </form>
    </section>




</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
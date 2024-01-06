<?php 
include('../component/connect.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_admin = $conn->query("DELETE FROM `admins` WHERE id = $delete_id");
    header('location: admin_accounts.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin account</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    
<?php include '../component/admin_header.php' ?>

<!-- admins accounts section -->

<section class="accounts">
    
    <h1 class="heading">admins accounts</h1>

    <div class="box-container">

        <div class="box">
            <p>register new admin</p>
            <a href="admin_register.php" class="option-btn">register</a>
        </div>

        <?php
            $select_account = $conn->query("SELECT * FROM `admins`");
            $check = $select_account->num_rows;
            if($check > 0){
                while($fetch_accounts = $select_account->fetch_assoc()){           
        ?>
        <div class="box">
            <p>admin id: <span><?= $fetch_accounts['name']?></span></p>
            <p>username: <span><?= $fetch_accounts['name']?></span></p>
            <div class="flex-btn">
            <a href="../admin/admin_accounts.php?delete=<?=$fetch_accounts['id'];?>" class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
            <?php
                if($fetch_accounts['id'] == $admin_id){
                    echo '<a href="update_profile.php" class="option-btn">update</a>';
                }
            ?>
            </div>
        </div>
        <?php
             }

            }else{
                echo '<p class="empty">no accounts availabale</p>';
            }
        ?>
    </div>

</section>
</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
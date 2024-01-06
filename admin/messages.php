<?php 
include('../component/connect.php');;
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_message = $conn->query("DELETE FROM `messages` WHERE id = $delete_id");
    header('location: messages.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/admin_style.css">   
</head>


<body>
    
<?php include '../component/admin_header.php'?>

<!-- messeages section  -->
<section class="messages">
    <h1 class="heading">new messeages</h1>
    <div class="box-container">
        <?php
            $select_messages = $conn->query("SELECT * FROM `messages`");
            $check = $select_messages->num_rows;
            if($check > 0 ){
                while ($fetch_messages = $select_messages->fetch_assoc()){

        ?>
        <div class="box">
            <p>id: <span><?= $fetch_messages['id']?></span></p>
            <p>name: <span><?= $fetch_messages['name']?></span></p>
            <p>number: <span><?= $fetch_messages['number']?></span></p>
            <p>email: <span><?= $fetch_messages['email']?></span></p>
            <p>message: <span><?= $fetch_messages['message']?></span></p>
            <a href="../admin/messages.php?delete=<?=$fetch_messages['id'];?>" class="delete-btn" onclick="return confirm('Delete this message?');">Delete</a>
        </div>
        <?php
                }

            }else{
                echo '<p class="empty">you have no messages</p>';
            }
        ?>
    </div>
    
</section>



</body>
</html>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
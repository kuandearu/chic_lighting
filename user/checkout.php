<?php
include '../component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

if(isset($_POST['order'])){
    $name = $_POST['txtName'];
    $number = $_POST['Number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $address = $_POST['flat'] .', '.$_POST['street'].', '.$_POST['city']
    .', '.$_POST['state'].', '.$_POST['country'].' - '.$_POST['pin_code'];
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = $conn->query($check_cart);

    if($result->num_rows > 0){
        $insert_order = "INSERT INTO orders(user_id, name, number, email, method, address, total_products, total_price,payment_status)
        VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price','pending')";
        $conn->query($insert_order);
        $message[] = 'Your order has been placed successfully';
        $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
        $conn->query($delete_cart);
    }else{
        $message[] = 'Your cart is empty';
    }
}   
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../component/user_header.php';?> 
    <h1 class= "heading">Your orders</h1>
    <!-- checkout section start -->
    <section class="checkout">
        <div class="display-orders">
            <?php
                $grand_total = 0;
                $cart_item[] = 0;
                $select_cart = "SELECT * FROM cart WHERE user_id = '$user_id'";
                $result = $conn->query($select_cart);

                if($result->num_rows > 0){
                    while($fetch_cart = $result->fetch_assoc()){
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                        $cart_item[] = $fetch_cart['name'] .' ('.$fetch_cart['quantity'].') -';
                        $total_products = implode($cart_item);
                   
            ?>
            <p> <?= $fetch_cart['name'];?> <span>$<?= $fetch_cart['price']; ?> x 
            <?= $fetch_cart['quantity'];?></span> </p>
            <?php
                    }
                }else{
                    echo '<p class = "empty">Your cart is empty</p>';
                }
            ?>
        </div>

        <p class = "grand-total">Grand total: <span>$<?= $grand_total; ?></span></p>

        <form action="" method = "post">
            <h1 class = "heading1">Place your orders</h1>
            <input type="hidden" name = "total_products" value="<?= $total_products; ?>">
            <input type="hidden" name = "total_price" value="<?= $grand_total; ?>">
            <div class = "flex">
                <div class = "inputBox">
                    <span>Your name</span>
                    <input type="text" maxlength = "20" placeholder = "Enter your name"
                    required class = "box" name = "txtName">
                </div>
                <div class = "inputBox">
                    <span>Your number</span>
                    <input type="number" min = "0" onkeypress="if(this.value.length == 10) return false;" 
                    placeholder = "Enter your number" required class = "box" name = "Number">
                </div>
                <div class = "inputBox">
                    <span>Your email</span>
                    <input type="email" maxlength = "100" placeholder = "Enter your email"
                    required class = "box" name = "email">
                </div>
                <div class = "inputBox">
                    <span>Payment method</span>
                    <select name="method" class="box">
                        <option value="cash on delevery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="debit card">debit card</option>
                        <option value="paypal">paypal</option>
                    </select>
                </div>
                <div class = "inputBox">
                    <span>Address line 01</span>
                    <input type="text" maxlength = "50" placeholder = "E.g: flat no"
                    required class = "box" name = "flat">
                </div>
                <div class = "inputBox">
                    <span>Address line 02</span>
                    <input type="text" maxlength = "50" placeholder = "E.g: street name"
                    required class = "box" name = "street">
                </div>
                <div class = "inputBox">
                    <span>City</span>
                    <input type="text" maxlength = "50" placeholder = "E.g: Ha Noi"
                    required class = "box" name = "city">
                </div>
                <div class = "inputBox">
                    <span>State</span>
                    <input type="text" maxlength = "50" placeholder = "E.g: Quang Ninh"
                    required class = "box" name = "state">
                </div>
                <div class = "inputBox">
                    <span>Country</span>
                    <input type="text" maxlength = "50" placeholder = "E.g: Viet Nam"
                    required class = "box" name = "country">
                </div>
                <div class = "inputBox">
                    <span>Pin code</span>
                    <input type="text" min="0" max="9999999" placeholder = "E.g: 123456"
                    onkeypress="if(this.value.length == 6) return false;"
                    required class = "box" name = "pin_code">
                </div>
            </div>
            <input type="submit" value="Place order" class = "btn 
            <?= ($grand_total > 1)?'': 'disabled'; ?>" name = "order">
        </form>
    </section>
<?php include '../component/footer.php';?>
<!-- custom js file link -->
<script src="../js/user_script.js"></script>
</body>
</html>
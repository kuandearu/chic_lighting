<?php

if(isset($_POST['add_to_wishlist'])){
    if($user_id == ''){
        header('location:./user_login.php');
    }
    else {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $check_wishlist_num = $conn->query("select * from `wishlist` where name='$name' and user_id='$user_id'");
        $count1 = $check_wishlist_num->num_rows;

        if($count1 > 0){
           $message[] =  'Already added to your wishlist!';
        }
        else{
            $insert_wishlist = $conn->query("insert into wishlist(user_id,product_id,name,price,mainImg) values('$user_id','$pid','$name','$price','$image')");
            $message[] = 'Added to your wishlist!';
        }
    }  
}

else if(isset($_POST['add_to_cart'])){
    if($user_id == ''){
        header('location:./user_login.php');
    }
    else {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $qty = $_POST['qty'];
        
        $check_cart_num = $conn->query("select * from `cart` where name='$name' and user_id='$user_id'");
        $count2 = $check_cart_num->num_rows;

        if($count2 >0){
            $message[] =  'Already added to your cart!';
        }
        else{
            $check_wishlist_num = $conn->query("select * from `wishlist` where name='$name' and user_id='$user_id'");
            $count1 = $check_wishlist_num->num_rows;
            if($count1 >0){
                $delete_wishlist = $conn->query("delete from `wishlist` where name='$name' and user_id='$user_id'");
                
            }
            $insert_cart = $conn->query("insert into cart(user_id,product_id,name,price,quantity,mainImg) values('$user_id','$pid','$name','$price','$qty','$image')");
                $message[] = 'Added to your cart!';


            
        }
    }  
}

?>
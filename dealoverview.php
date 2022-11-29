<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>


<section class="deal">

   <form action="loaninfo.php" method="post">
      <h3>Deal Overview</h3>
      <div class="flex">
      <div class="inputBox">
            <input type="text"  name="flat" placeholder="How much would you like to borrow?" required >
      </div>
        <div class="inputBox">
            <input type="text"  name="flat" placeholder="What is the property's current market value?" required >
        </div>
        <div class="inputBox">
            <input type="text"  name="flat" placeholder="City" required >
        </div>
    

   
           
         <div class="inputBox">
          
            <select name="method" required>
               <option disabled selected value>How would you describe the location?</option>
               <option value="cash on delivery">Urban</option>
               <option value="credit card">Suburban</option>
               <option value="paypal">Rural</option>
            </select>
         </div>
         
         <div class="inputBox">
            
            <select name="method" required>
               <option disabled selected value>Province</option>
               <option value="cash on delivery">Alberta</option>
               <option value="credit card">British Columbia</option>
               <option value="paypal">Manitoba</option>
               <option value="paypal">New Brunswick</option>
               <option value="paypal">Newfoundland and Labrador</option>
               <option value="paypal">Northwest Territories</option>
               <option value="paypal">Nova Scotia</option>
               <option value="paypal">Nunavut</option>
               <option value="paypal">Ontario</option>
               <option value="paypal">Prince Edward Island</option>
               <option value="paypal">Quebec</option>
               <option value="paypal">Saskatchewan</option>
               <option value="paypal">Yukon</option>
            </select>
         </div>
         <div class="inputBox">
            
            <select name="method" required>
               <option disabled selected value>How would you describe the current condition of the property?</option>
               <option value="cash on delivery">Brand New Build</option>
               <option value="credit card">Newly Renovated</option>
               <option value="paypal">Excellent</option>
               <option value="paypal">Good</option>
               <option value="paypal">Fair</option>
               <option value="paypal">Poor</option>
               <option value="paypal">Not Applicable</option>
               <option value="paypal">Vacant Land</option>
               <option value="paypal">I don't know</option>
            </select>
         </div>
     
         
      </div>
      <input type="submit" value="Next" class="btn" name="order_btn">
   </form>

</section>

<section class="products">

  

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         // echo '<p class="empty"></p>';
      }
      ?>
   </div>
<!-- 
   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div> -->

</section>

<!-- <section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/heading-bg.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section> -->

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

<?php
include 'config.php';
$db=mysqli_select_db($conn,'loan_db');
if(isset($_POST['submit']))
{
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $company=$_POST['company'];
   $email=$_POST['email'];
   $phone=$_POST['phone'];
   $query="INSERT INTO `contact`(`fname`, `lname`, `company`, `email`, `phone`) VALUES ('$fname','$lname','$company','$email','$phone')";
   $query_run=mysqli_query($conn,$query);
   if($query_run)
   {
      echo '<script type="text/javascript"> alert("Data Saved") </script>';
   }
   else
   {
      echo '<script type="text/javascript"> alert("Data Not Saved") </script>';
   }
}

?>

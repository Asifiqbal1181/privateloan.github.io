<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<!-- <div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div> -->

<section class="contact">
   
<form action="dealoverview.php" method="post">

      <h3>Contact information.</h3>
   
      <div>
         <input type="text" name="fname" required placeholder="What's your First Name?" class="box">
      <input type="text" name="lname" required placeholder="What's your Last Name?" class="box">
      <input type="text" name="company" required placeholder="What's your Company Name?" class="box">
      <input type="email" name="email" required placeholder="What's your Email?" class="box">
      <input type="text" name="phone" required placeholder="What's your Phone Number?" class="box">
    
</div>
     
  
      
      <input type="submit" value="Next" name="submit" class="btn">
</form>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

<?php
include 'config.php';
$db=mysqli_select_db($conn,'loan_db');
if(isset($_POST['search']))
{
   $loan=$_POST['loan'];
   $property=$_POST['property'];
   $province=$_POST['province'];
   $loanamount=$_POST['loanamount'];

   $query="INSERT INTO `loan_type` (`loan`, `property`, `province`, `loanamount`) VALUES ('$loan', '$property', ' $province', '$loanamount')";
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
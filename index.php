<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
$insert = false; 
if(isset($_POST['name'])){
$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server,$username,$password);

if(!$con){
    die("connection to this data base is failed due to ".mysqli_connect_error());
}
// else{
//     echo("data base connected successfully......");
// }

$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$description = $_POST['description'];

$sql = "INSERT INTO `usa-trip`.`trip` (`name`, `age`, `gender`, `email`, `phone`, `description`, `dt`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$description', CURRENT_TIMESTAMP);
";
// echo $sql;

if($con->query($sql) == true)
{
    $insert = true;
    // echo"data has been inserted";
}
else{
    echo"error: $sql <br> $con->error";

}

$con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header class="header">
            <h2>Welcome to PU University US trip form</h2>
            <p>Enter your details and submit this form to confirm your participation in this trip</p>
            <?php
            if($insert == true)
            {
                echo "<p class='green-color'>thanks for submitting your form. We are happy to see you joining us for the US trip</p>";
            }
            ?>
            <link rel="stylesheet" href="./index.php">
        </header>
        <form action="index.php" method="post" class="form">
            <div class="manage-form">
                <input type="text" name="name" id="name" placeholder="User Name">
            </div>
            <div class="manage-form">
                <input type="text" name="age" id="age" placeholder="Age">
            </div>
            <div class="manage-form">
                <input type="text" name="gender" id="gender" placeholder="Gender">
            </div>
            <div class="manage-form">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="manage-form">
                <input type="text" name="phone" id="phone" placeholder="Mobile Number">
            </div>
            <div class="manage-form">
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            </div>
            <div class="manage-form">
                <button class="btn">submit</button>
            </div>

        </form>
    </div>
    <div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
</body>
</html>

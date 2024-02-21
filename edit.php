<?php
  $error=0;
include "db_conn.php";
include "header.php";

$id = $_GET["id"];



if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];

  if(empty($first_name))
{
   $name_error = "Please fill the name";
   $error=1;
}
else if(!preg_match("/^[a-zA-Z ]*$/", $first_name))
{
   $name_error = "Only letters are allowed";
   $error=1;
}

if(empty($last_name))

{
   $last_name_error = "Please fill the Last name";
   $error=1;
}
elseif(!preg_match("/^[a-zA-Z ]*$/", $last_name))
{
   $last_name_error = "Only letters are allowed";
   $error=1;
}

if(empty($email))
{
  $email_error = "Please enter the Email Id";
  $error=1;
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
  $email_error = "Invalid Email Format";
  $error=1;
}


if(empty($phone))

{
   $phone_error = "Please fill the phone number";
   $error=1;
}

if($error==0)
$checkUser = "SELECT * from crud where email = '$email'";
$result = mysqli_query($conn,$checkUser);
$count = mysqli_num_rows($result);

if($count>0){
echo "User already signed up";

}
else

{


  $sql = "UPDATE `crud` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`phone`='$phone',`gender`='$gender' WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
 
    header("Location:http://localhost/php-crud/index.php?msg=New record created successfully");


  }
  else{
     echo "error";
  }
  }
}
  else{
     echo "please fill all the fields";
  }
  
  


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>
<style>
  .error
{
  color: red;
  font-weight: 700;
} 
  </style>
<body>
  

  <div class="container">
    <div class="text-center mb-2 mt-5">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `crud` WHERE id = $id Limit 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form  class="post-form" action="" name="myForm" id="sform" method="post">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" placeholder="Ahmad"  value="<?php echo $row['first_name'] ?>"><b><span class="formerror"> </span></b>
            <span class="text-danger"><?php if(!empty($name_error)){echo $name_error; }?></span>
          </div>

          <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" placeholder="Saeed" value="<?php echo $row['last_name'] ?>"><b><span class="formerror"> </span></b>
            <span class="text-danger"><?php if(!empty($last_name_error)){echo $last_name_error; }?></span>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo $row['email'] ?>"><b><span class="formerror"> </span></b>
          <span class="text-danger"><?php if(!empty($email_error)){echo $email_error; }?></span>
        </div>
        <div class="mb-3">
          <label class="form-label">phone:</label>
          <input type="phone" class="form-control" name="phone" placeholder="Saeed" value="<?php echo $row['phone'] ?>"><b><span class="formerror"> </span></b>
          <span class="text-danger"><?php if(!empty($phone_error)){echo $phone_error; }?></span>
        </div>
        <div class="form-group mb-3">
          <label>Gender:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
          <label for="male" class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?>>
          <label for="female" class="form-input-label">Female</label>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="validation.js"></script>
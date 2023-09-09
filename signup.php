<?php
$showAlert=false;
$showError=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    // $exists=t;
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";

    $result=mysqli_query($conn, $existSql);
    $numExistRows=mysqli_num_rows($result);
    if ($numExistRows>0) {
      // $exists=true;
      $showError="Username Already Exists";
    }
    else{
      // $exists=false;
    if ($password==$cpassword) {
        $sql="INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password' ,current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert=true;                  
        }
    }
    else {
      $showError="Passwords do not match.";
    }
  }
}
?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php'?>

    <?php
    if($showAlert){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is created.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
    if($showError){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
    <div class="container">
        <h1 class="text-center">Sign Up</h1>
        <form action="/loginsystem/signup.php" method="post">
            <div class="mb-3 ">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3 ">
      <label for="cpassword" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="cpassword" name="cpassword">
    </div>
    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>               
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
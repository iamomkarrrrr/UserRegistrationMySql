<?php
$sucess=0;
$user=0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Password = mysqli_real_escape_string($con, $_POST['Password']);

    // Check if the username already exists
    $sql = "SELECT * FROM registration WHERE Username='$Username'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die(mysqli_error($con));
    }

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        // echo "User Already Exists";
        $user=1;
    } else {
        // Hash the password securely
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $sql = "INSERT INTO registration (Username, Password) VALUES ('$Username', '$hashedPassword')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // echo "Sign Up Successfully";
            $sucess=1;
            header('location:login.php');

        } else {
            die(mysqli_error($con));
        }
    }
}

?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
         button {
            background-color: #5d54d8;
            width: 400px;
            color: rgb(248, 248, 248);
            padding: 10px;
            margin: 10px 0px;
            border: none;
            cursor: pointer;}

        input[type=text],
        input[type=password] {
            
            padding: 12px 20px;
            margin: 8px 0;
            border: 2px solid rgb(209, 174, 220);
            box-sizing: border-box;
            width: 400px;
           
        }
        button:hover {
            opacity: 0.6;
        }

    </style>
  </head>
  <body>
    <?php

    if($user){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry! </strong> This User Already Exist.
      </div>';
    }
    ?>

    <?php

    if($sucess){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> You are Successfully SignUp.
      </div>';
    }
    ?>
    <div class = "container  mt-5">
        <form action = "sign.php" method="post" align = "center">
            <div style="padding:23px;background-color:white">
                <h1 class="text-centre">Sign up page</h1>
            <label >Name</label ><br>
            <input type="text" placeholder="Phone number,email or username" name="Username" required>
            <br>
            <label >Password</label ><br>
            <input type="password" placeholder="Password" name="Password" required>
            <br>
            <button width="2px">Sign up</button><br>
            
            <br><br><br><br><br><br><br>
        </div>
    </form>
    </div>
  </body>
</html>
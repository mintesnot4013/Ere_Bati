<?php
include "partials/header.php";



if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    $query = "select * from user where name = '$name'";
    $userNames = $conn->query($query);
    foreach ($userNames as $userName) {
    }

    $query = "select * from user where email = '$email'";
    $userEmails = $conn->query($query);
    foreach ($userEmails as $userEmail) {
    }
    if (empty($name)) {
        $error['error'] = 'name is requered';
    } elseif ($userName['name'] == $name) {
        $error['error'] = 'user name is already used';
    } elseif (empty($email)) {
        $error['error'] = 'email is requered';
    } elseif ($userEmail['email'] == $email) {
        $error['error'] = 'email name is already used';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['error'] = 'Invalid email';
    } elseif (empty($password)) {
        $error['error'] = 'Password is requer';
    } elseif (strlen($password) < 6) {
        $error['error'] = 'your password length is ' . strlen($password);
    } else {



        $query = "insert into user(name,email,password,description) values('$name','$email','$password','')";
        if ($conn->query($query)) {
            session_start();
            $_SESSION['email'] = $email;
            header("location:/");
        }
    }
}

?>

<div class="login_container">

    <div class="login_side_image">
        <img src="/assets/banner_3.png" alt="">
    </div>


    <form method="post">
        <span id="error"> <?php if (isset($error['error'])) {
                                echo $error['error'];
                            } ?> </span>
        <p>
            welcome to shebelaw music party
        </p>
        <input placeholder="full name" type="text" value="<?= $_POST['name']; ?>" name="name">

        <input placeholder="email" value="<?= $_POST['email'] ?>" type="text" name="email">
        <div style="display: flex;"> <input placeholder="password" type="password" value="<?= $_POST['password'] ?>" name="password">
            <button onclick="password.type = 'txt'" type="button" style=" cursor: pointer;  position: absolute;right: 20px;height: 50px;border: none;background: transparent;">show</button>
        </div>
        <input type="submit" id="register" value="SIGNUP" name="register">
        <span> you have an account? <a href="login.php">
                LOGIN </a> </span>
    </form>

</div>
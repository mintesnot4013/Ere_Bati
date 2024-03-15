<?php
include "partials/header.php";
?>
<?php

if (isset($_POST['submit'])) {
    $email  =  $_POST['email'];
    $password =  $_POST['password'];

    if (empty($email)) {
        $error['email'] = 'email is empty';
    } elseif (empty($password)) {
        $error['password'] = 'email is empty';
    } else {
        $query = "SELECT * FROM `user` WHERE email = '$email' and password = '$password'";
        $users = $conn->query($query);
        foreach ($users as $user) {
        }

        if ($user['email'] === $email && $user['password'] == $password) {

            session_start();
            $_SESSION['email'] = $email;
            header("location:/");
        } else {
            $error['error'] = "cheke email or password";
        }
    }
}

?>

<div class="login_container">

    <div class="login_side_image">
        <img src="/assets/banner_3.png" alt="">
    </div>

    <form class="login" method="post">
        <p>
            welcome to shebelaw music party
        </p>


        <input placeholder="email" type="email" name="email" id="email">
        <span id="error"> <?php if (isset($error["error"])) {
                            } ?> </span>
        <input oninput="ValidatePassword(this)" placeholder="password" type="password" name="password" id="password">
        <input type="submit" name="submit" value="LOGIN" id="submitUser">
        <span> you have't an account? <a href="register.php">
                SIGNUP </a> </span>
    </form>



</div>
</div>
<script>
    var error = document.getElementById('error');
    var error = document.getElementById('error');
    submitBtn.type = 'button';



    function ValidateEmail(input) {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (input.value.match(validRegex)) {
            error.innerHTML = '';
            return true;
            submitBtn.type = 'submit';


        } else {
            error.innerHTML = 'invalid email';
            return false;
            submitBtn.type = 'button';


        }


    }

    function ValidatePassword(pass) {
        if (pass.value === '') {
            error.innerHTML = 'password is requer';
        }

    }
</script>
<?php

@include 'config.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    // $string = mysqli_real_escape_string($conn, $_POST['password']);
    // $password=hash("sha256", $string);

    // $oop = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
    // $confirmpassword=hash("sha256", $oop);

    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';

    } else {

        if ($password != $confirmpassword) {
            $error[] = 'password not matched';
        } else {
            $insert = "INSERT INTO user_form (email, username, password,type)  VALUES ('$email', '$username', '$password',0)";
            mysqli_query($conn, $insert);
            header('location:form_login.php');
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">

            <form method="post">
                <h3>Create account</h3> <br>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class ="error-msg">' . $error . '</span>';
                    }
                }
                ?>
                <input type="email" name="email" required placeholder="email address">
                <input type="text" name="username" required placeholder="username">
                <input type="password" name="password" required placeholder="password">
                <input type="password" name="confirmpassword" required placeholder="confirm password">

                <input type="submit" name="submit" value="Sign Up" class="form-btn">
                <p>Already have account?<a href="form_login.php"> login </a>here.</p>
            </form>
        </div>
    </div>
</body>

</html>
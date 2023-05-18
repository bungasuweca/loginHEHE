<?php

@include 'config.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_array($result);
        if ($rows['type'] == 0) {
            header('Location: user_page.php');
        } else {
            header('Location: admin_page.php');
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
    <title>Log in</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Log In</h3> <br>
            <input type="text" name="username" required placeholder="username">
            <input type="password" name="password" required placeholder="password">
            <input type="submit" name="submit" value="Log In" class="form-btn">
            <p>Don't have account? <a href="register.php"> Sign Up </a>here.</p>
        </form>
    </div>
</body>

</html>
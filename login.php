<?php

// here we will include the database in this file
include("config.php");

//start the session 
session_start();

// array of error
$error = array();

// this will check if submit button is clicked with the method of postt
if (isset($_POST['submit'])) {
    // getting the input values
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    // creating the mysql query that will select the email and password from the user database
    $select = " SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    // check if the email and password are correct if not it will throw an error
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);
        $_SESSION['email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        $error[] = 'Incorrect email or password';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="style/login.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Login</title>
</head>

<body>
    <div class='container'>
        <div class="form-container" data-aos="fade-up-left" data-aos-duration="3900">
            <form method="POST">
                <div class="head">
                    <h1>Hello again!</h1>
                    <p>It is long established fact that.</p>
                </div>
                <div class="inputs">
                    <input type="text" name="email" placeholder="Email Address">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="submit">Login</button>
                </div>
                <a href="register.php">Don't have an account yet? Sign up</a>
            </form>
            <img src="https://images.pexels.com/photos/3536235/pexels-photo-3536235.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="img">
        </div>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        AOS.refresh();
    </script>
</body>

</html>
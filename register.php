<?php

//include the database file
include("config.php");

// array of error
$error = array();

//check if submit is clicked with post method
if (isset($_POST["submit"])) {
    //get the value from the inputs
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    // Select the username and email in the user table to check if there is a match
    $select = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $select);
    // if the username and email match it will throw an error
    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        // if the username and email did not match the user will be insert in the user table data
        $insert = "INSERT INTO user (username, email, password) VALUES ('$username', '$email' , '$password')";
        mysqli_query($conn, $insert);
        // then redirect to the login page
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="style/register.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Register</title>
</head>

<body>
    <div class='container'>
        <div class="form-container" data-aos="fade-up-right" data-aos-duration="3900">
            <form method="POST">
                <div class="head">
                    <h1>Hello again!</h1>
                    <p>It is long established fact that.</p>
                </div>

                <div class="inputs">
                    <input type="text" name="name" placeholder="Username">
                    <input type="text" name="email" placeholder="Email Address">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="submit">SignUp</button>
                </div>
                <a href="login.php">Already have an account? Sign in</a>
            </form>
            <img src="https://images.pexels.com/photos/1337825/pexels-photo-1337825.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
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
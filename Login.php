<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="CSS/login.css">

    <script>

    </script>
</head>

<body>
    <div class="main-image">
    </div>
    <div class="secondary-image">
    </div>
    <div class="form-container">
        <text class="mytext1">Login</text>
        <text class="mytext2">Welcome</text>
        <text class="mytext3">to Health Coach OR <br> If you are new to this portal <br>create a new account</text>

        <form name="f1" method="post" action="">
            <p class="texts" id="p1" style="position: relative; top: 200px; left: 20px;">
                Email id<br>
                <input type="text" class="inputs" name="email">

            <p class="texts" id="p1" style="position: relative; top: 175px; left: 20px;">
                Password<br>
                <input type="password" class="inputs" name="pass">
                <br><input type="text" class="message" id="m3" value="" readonly="true">
            </p>
            <input type="submit" class="block1" name="submit" value="Sign In" />

            <p><a href="createAccount.php"><input type="button" class="block1" name="name" value="Create Account" /></a>
            </p>
        </form>

        <?php
        $host = "localhost";
        $user = "root";
        $database_name = "health";
        $password = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['email'];
            $pass = $_POST['pass'];
            $conn = mysqli_connect($host, $user, $password, $database_name);

            $query = "SELECT '$username', '$pass' FROM `user` WHERE `email`='$username' AND `password`='$pass'";

            //fetching result
            $result = mysqli_query($conn, $query);
            $user_info = mysqli_fetch_assoc($result);

            // Check if user exists and password is
            if (!$user_info) { //if user not found in the database
                echo "<script> alert('Invalid username or password!!!')</script>";
            } else {
                echo "<script>alert('Successfully logged in!');
                window.location.href='profile.html';</script> ";
            }
            mysqli_close($conn);
        }

        ?>

    </div>

</body>

</html>
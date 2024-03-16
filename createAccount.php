<?php
session_start();
?>
<!DOCTYPE html>
<html lang='en'>
<link rel="stylesheet" href="footer.css">

<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="CSS/crtaccnt.css">
</head>

<body>

    <div id="form-container" style="background-color: lightgray; height: 680px; width: 59%;">
        <form name="f1" method="post">
            <h2>SIGN UP</h2>
            <p class="texts">
                Enter your Name<br>
                <input type="text" class="inputs" name="n">

            </p>

            <p class="texts">
                Email id<br>
                <input type="text" class="inputs" name="e" id="e" required>

            </p>

            <p class="texts">
                Password<br>
                <input type="password" class="inputs" name="p" id="p" required>

            </p>

            <div class="buttonCont">
                <input style="position: relative; top: 40px;" type="submit" class="block1" name="submit" id="b1" value="Create Account" onclick="CookieCreate()">
            </div>
            <?php
            $host = "localhost";
            $user = "root";
            $database_name = "health";
            $password = "";


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['n'];
                $email = $_POST['e'];
                $pass = $_POST['p'];
                if (preg_match("/([A-Za-z]+)[0-9]*@{1}([A-Za-z0-9])+.com/", $email) != 1) {
                    echo "<script> alert('Please enter a valid e-mail');</script>";
                } else if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}/", $pass) != 1) {
                    echo "<script> alert('Password should be a combination of letters and numbers and should be min 8 characters with atleast 1 uppercase letter');</script>";
                } else {

                    $conn = mysqli_connect($host, $user, $password, $database_name);
                    $query = "INSERT INTO `user`(`name`,`email`,`password`) VALUES ('$name', '$email', '$pass')";
                    if (!mysqli_query($conn, $query)) {
                        if (mysqli_errno($conn) == 1062) {
                            echo "<script> alert('Entered email already exists in our systems');</script>";
                        } else {

                            die("Error: " . mysqli_error($conn));
                        }
                    } else {
                        echo "<script>alert('Successfully Signed up! Your email is your username');window.location.href='login.php'</script > ";
                    }
                    mysqli_close($conn);
                }
            }

            ?>
            <script>
                const mail = document.getElementById("e");
                const pass = document.getElementById("p");
                mail.addEventListener("keyup", () => {
                    RegExpMail = "([A-Za-z]+)[0-9]*@{1}([A-Za-z0-9])+.com";
                    inpMail = mail.value;
                    let match1 = inpMail.match(RegExpMail);
                    if (!match1) {
                        document.styleSheets[0].addRule(
                            ".buttonCont::before",
                            'content: " * Invalid mail ";'
                        );
                    } else {
                        document.styleSheets[0].addRule(".buttonCont::before", 'content: " ";');
                    }
                });

                pass.addEventListener("keyup", () => {
                    RegExpPass = "regex";
                    inpPass = pass.value;
                    let match1 = inpPass.match(RegExpPass);
                    if (!match1) {
                        document.styleSheets[0].addRule(
                            ".buttonCont::before",
                            'content: " * Password should be a combination of letters and numbers and should be min 8 characters  ";'
                        );
                    } else {
                        document.styleSheets[0].addRule(".buttonCont::before", 'content: " ";');
                    }
                });
            </script>
    </div>
</body>

</html>
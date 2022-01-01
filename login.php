<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login In </title>
    <!-- Main Css File  -->
    <link rel="stylesheet" href="styles/login.css" />
    <!-- Normalize File  -->
    <link rel="stylesheet" href="styles/normalize.css" />
</head>

<body>
    <!-- Satrt The Form  -->
    <?php
    echo '<form action="" method="POST">
        <!-- Email Adress   -->
        <label for="email">Email </label>
        <input type="email" name="email" id="email" placeholder="Enter Your Email Adress." required><br>
        <!-- PassWord   -->
        <label for="password">Password </label>
        <input type="password" name="password" id="password" placeholder="Enter Your Password." required><br>
        <!-- Sumit  -->
        <div>
            <input type="submit" value="login " name="login">
            <p onclick="window.location.href = `index.php`">Do You Not Have An Account?</p>
        </div>
    </form>';
    ?>
    <!-- End The Form  -->
    <!-- Start PHP Block Of Code   -->
    <?php
    // Bind Data Base File 
    require_once "database.php";

    if (isset($_POST['login'])) {

        // Check If This User Have An Account Or Not? 
        $check = $database->prepare("SELECT * FROM `users` 
            WHERE email = :email AND password = :password");
        // Values 
        $check->bindParam('email', $_POST['email']);
        $check->bindParam('password', $_POST['password']);

        if ($check->execute()) {
            if ($check->rowCount() < 1) {
                // If This Account Not Exist Make This 
                echo "<p class='worning'>Sorry You Don't Have An Account. Please Create Account</p>";
            }
            // Else Open The Home Page 
            else {
                // Save The User Data On Session To Use It The Home Page 
                $check = $check->fetchObject();
                session_start();
                $_SESSION["userData"] = $check;

                header("Location:inPost.php");
            }
        }
    }
    ?>
    <!-- End PHP Block Of Code   -->
    <script src="scripts/main.js"></script>
</body>

</html>
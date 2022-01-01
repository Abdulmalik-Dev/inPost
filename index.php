<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create An Account</title>
    <!-- Main Css File  -->
    <link rel="stylesheet" href="styles/login.css" />
    <!-- Normalize File  -->
    <link rel="stylesheet" href="styles/normalize.css" />
</head>

<body>
    <!-- Satrt The Form  -->
    <?php
  echo '<form action="" method="post">
    <!-- First Name  -->
    <label for="fName">First Name</label>
    <input type="text" name="fName" id="fName" placeholder="Enter Your First Name." required maxlength="25"><br>
    <!-- Last Name   -->
    <label for="lName">Last Name</label>
    <input type="text" name="lName" id="lName" placeholder="Enter Your Last Name." required maxlength="25"><br>
    <!-- Email Adress   -->
    <label for="email">Email </label>
    <input type="email" name="email" id="email" placeholder="Enter Your Email Adress." required><br>
    <!-- PassWord   -->
    <label for="password">Password </label>
    <input type="password" name="password" id="password" placeholder="Enter Your Password." required><br>
    <!-- Sumit  -->
    <div>
      <input type="submit" value="Sign Up" name="signUp">
      <p onclick= "window.location.href = `login.php`">Do You Have An Account?</p>
    </div>
</form>';
  ?>
    <!-- End The Form  -->

    <!-- Start PHP Block Of Code  -->
    <?php
  // Bind Data Base File 
  require_once "database.php";

  if (isset($_POST['signUp'])) {

    // Check If This User Have An Account Or Not? 
    $check = $database->prepare("SELECT * FROM `users`
      WHERE email = :email");
    // Values 
    $check->bindParam('email', $_POST['email']);

    $check->execute();
    if ($check->rowCount() == 1) {
      // If This Account Exist Make This 
      echo "<p class='worning'>You Are Already Have An Account</p>";
    }
    // Else Create This Account 
    else {
      $setNewUser = $database->prepare("INSERT INTO USERS (fName, lName, email, password) 
      VALUES (:fName, :lName, :email, :password)");
      // Values 
      $setNewUser->bindParam('fName', $_POST['fName']);
      $setNewUser->bindParam('lName', $_POST['lName']);
      $setNewUser->bindParam('email', $_POST['email']);
      $setNewUser->bindParam('password', $_POST['password']);

      // If Create The Account Succused Make This 
      if ($setNewUser->execute()) {
        header("Location:login.php");
      }
    }
  }
  ?>
    <!-- End PHP Block Of Code  -->

    <script src="scripts/main.js"></script>
</body>

</html>
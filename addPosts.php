<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Posts</title>
    <!-- Main Css File  -->
    <link rel="stylesheet" href="styles/addPosts.css" />
    <!-- Posts Styles  -->
    <link rel="stylesheet" href="styles/thePost.css" />

    <link rel="stylesheet" href="styles/login.css" />
    <!-- Normalize File  -->
    <link rel="stylesheet" href="styles/normalize.css" />
</head>

<body>
    <!-- Start PHP Block Of Code   -->
    <?php
    // Bind Data Base File 
    require_once "database.php";

    // To Get The User Data From Sesstion 
    session_start();
    if (isset($_SESSION['userData'])) {
        $userData = $_SESSION['userData'];
        // Set The User Data On The Page
        echo
        "<div class='info'>
            <p> Your Full Name: $userData->fName " . $userData->lName . "</p>
            <p>Your Email: " . $userData->email . "</p>
            <p onclick='window.location.href=`inPost.php`'>Show Pepole Posts </p>
        </div>";
    }

    // Start The Form 
    echo
    '<form action="" method="post">
        <label for="tilte">The Title</label>
        <input type="text" id="tilte" name="title" placeholder="Type Title ..." required><br>
        <label for="post">The Post</label>
        <textarea id="post" name="post" placeholder="Type Your Post ..." required></textarea>
        <input type="submit" name="submit" value="Submit">
    </form>';
    // End The Form 

    // To Set The Post 
    if (isset($_POST['submit'])) {
        $setPost = $database->prepare("INSERT INTO posts (title, ownerName, post, postID)
         VALUES (:tilte, :ownerName, :post, :postID)");

        // Values 
        $fullName = $userData->fName . " " . $userData->lName;
        $setPost->bindParam("tilte", $_POST['title']);
        $setPost->bindParam("ownerName", $fullName);
        $setPost->bindParam("post", $_POST['post']);
        $setPost->bindParam("postID", $userData->userID);

        if ($setPost->execute()) {
            header("Location:addPosts.php");
        }
    }

    // To Get All Posts For This User 
    $getAllPosts = $database->prepare("SELECT * FROM posts WHERE postID = :ID");
    $getAllPosts->bindParam("ID", $userData->userID);
    $getAllPosts->execute();

    $posts = $getAllPosts->fetchAll();

    echo "<p class='main' >Your Posts</p>";
    // Set The Posts On The Page 
    if ($posts && $getAllPosts->rowCount() > 0) {
        foreach ($posts as $post) {
            echo
            '<div class="post-box">
                <h3>' . $post['ownerName'] . '</h3>
                <div class="child-box">
                    <h5>' . $post['title'] . '</h5>
                    <p>' . $post['post'] . '</p>
                </div>
            </div>';
        }
    }

    ?>

    <!-- End PHP Block Of Code   -->

    <!-- <div class="post-box">
        <h3>" . $post->ownerName . "</h3>
        <div class="child-box">
            <h5>" . $post->title . "</h5>
            <p>" . $post->post . "</p>
            <p>show Comments</p>
            <div class=comment>
                <h4>COmmerner Name</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, nobis!</p>
            </div>
        </div>
    </div> -->
    <script src="scripts/main.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>inPost</title>
    <!-- Main Css File  -->
    <link rel="stylesheet" href="styles/inPost.css" />
    <!-- Posts Styles  -->
    <link rel="stylesheet" href="styles/thePost.css" />
    <!-- Normalize File  -->
    <link rel="stylesheet" href="styles/normalize.css" />
</head>

<body>
    <header>
        <div class="layout"></div>
        <p onclick='window.location.href=`addPosts.php`'>Add New Posts</p>
        <!-- To Make Log Out Botton  -->
        <form method="get">
            <input type="submit" value="Log Out" name="logOut" class="logOut">
        </form>
        <?php if (isset($_GET['logOut'])) {
            session_destroy();
            session_unset();
            header('Location:login.php', true);
        } ?>

        <img src="images/تنزيل (5).jfif" alt="">
    </header>
    <!-- Start PHP Block Of Code   -->
    <?php
    // Bind Data Base File 
    require_once "database.php";

    // To Get All Posts 
    $getAllPosts = $database->prepare("SELECT * FROM posts");
    $getAllPosts->execute();
    $posts = $getAllPosts->fetchAll();

    // check If The Data Base Have Datas! 
    if ($posts && $getAllPosts->rowCount() > 0) {
        // To Set The Posts On The Page 
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

    <script src="scripts/main.js"></script>
</body>

</html>
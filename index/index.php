<?php
session_start();
$isSignIn = isset($_SESSION['name']) && !empty($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../navbars/navbar.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>index.php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="welcome-text">
        <?php
        if ($isSignIn) {
            echo '<h1>Welcome ' . $_SESSION['name'] . '</h1>';
        } else {
            echo '<h1>Welcome to Good Buddies</h1>';
        }
        ?>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="../catalog/catalog.html" class="nav-button">Shop</a></li>
            <li><a href="../about/about.html" class="nav-button">About</a></li>
            <li><a href="../contact/contact.html" class="nav-button">Contact</a></li>
        </ul>
    </nav>
</div>
</body>
</html>

<?php
session_start();
global $conn;
include "../config/config.php";

$login = false;
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        if (password_verify($password, $row["password"])) {
            // Password is correct, start the session
            $_SESSION['username'] = $row['username'];
            $_SESSION['loggedin'] = true;
            header("Location: ../catalog_logged/catalog_logged.html");
            exit;
        } else {
            $errorMsg = 'Invalid password!';
        }
    } else {
        $errorMsg = 'Invalid username or password!';
    }
}
?>

<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br><br>
<div id="form">
    <h1 id="heading">Login Form</h1>
    <?php if ($errorMsg): ?>
        <p><?php echo $errorMsg; ?></p>
    <?php endif; ?>
    <form name="form" action="login.php" method="POST">
        <label>Enter Username/Email: </label>
        <input type="text" id="user" name="user" required></br></br>
        <label>Password: </label>
        <input type="password" id="pass" name="pass" required></br></br>
        <input type="submit" id="btn" value="Login" name="submit"/>
    </form>
</div>
</body>
</html>

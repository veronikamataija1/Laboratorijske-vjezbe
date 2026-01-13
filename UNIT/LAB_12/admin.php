<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3 class="text-center">Admin</h3>

    <p>This is admin page visible only by logged in users.</p>

    <a href="logout.php">Logout</a>
</div>

</body>
</html>


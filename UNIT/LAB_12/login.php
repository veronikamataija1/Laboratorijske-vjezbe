<?php
session_start();

if (isset($_SESSION['login'])) {
    header('Location: admin.php');
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3 class="text-center">Login</h3>

    <?php
    if (isset($_POST['submit'])) {

        $fileHandle = fopen("podaci.csv", "r");
        if (!$fileHandle) {
            die("Ne mogu otvoriti podaci.csv");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $error = true;

        while (($row = fgetcsv($fileHandle, 0, ",")) !== false) {
            if ($username === $row[2] && $password === $row[3]) {
                $_SESSION['login'] = true;
                header('Location: admin.php');
                die();
            }
        }

        fclose($fileHandle);

        echo "<div class='alert alert-danger'>Username and Password do not match.</div>";
    }
    ?>


    <form method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-default">Login</button>
    </form>
</div>

</body>
</html>


<?php
include 'dashboard.php';
if (isset($_COOKIE['visits_resit'])) {
    $visits_resit = $_COOKIE['visits_resit'] + 1;
} else {
    $visits_resit = 1;
}
setcookie('visits_resit', $visits_resit, time() + (86400 * 30));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>You have visited this page <?php echo $visits_resit; ?> times.</p>
    <h2>This is my resit page</h2>
</body>

</html>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
}
?>
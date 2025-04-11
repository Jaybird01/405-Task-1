<?php
include 'dashboard.php';
if (isset($_COOKIE['visits_mycourses'])) {
    $visits_mycourses = $_COOKIE['visits_mycourses'] + 1;
} else {
    $visits_mycourses = 1;
}
setcookie('visits_mycourses', $visits_mycourses, time() + (3600));
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
    <p>You have visited this page <?php echo $visits_mycourses; ?> times.</p>
    <h2>This is my courses page</h2>0
</body>

</html>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
}
?>
<?php
session_start();
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "userdb";
$conn = "";
try {
    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_password,
        $db_name
    );
} catch (mysqli_sql_exception) {
    echo "Could not connect!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cosc405</title>
</head>

<body>
    <div class="container">
        <h1>Login Page</h1>
        <form action="login.php" method="post">
            <div class="input-group">
                <input type="text" name="username" required>
                <label>Username: </label>
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password:</label>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <h3>Don't have an account? <a href="register.php">Register Here</a></h3>
    </div>
</body>

</html>

<?php
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {
        $query = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p>Invalid password</p>";
            }
        } else {
            echo "<p>Invalid username</p>";
        }

        $query->close();
    } else {
        echo "<p>Please enter both username and password</p>";
        
    }

    mysqli_close($conn);
}
?>
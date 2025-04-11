<?php
include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<style>
    .container {
        position: relative;
    }

    .error-message {
        position: absolute;
        padding: .5rem;
        box-shadow: 4px -4px 3rem rgba(0, 0, 0, 0.1);
        background-color: #fff;
        top: -20px;
        left: 50px;
        border-radius: 10px;
    }

    .error-message h4 {
        text-align: center;
    }
</style>

<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="post">
            <div class="input-group">
                <input type="text" name="username" required>
                <label>Username: </label>
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password:</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" required>
                <label>Enter your email:</label>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        <h3>Already have an account? <a href="login.php">Login Here</a></h3>
    </div>
</body>

</html>

<?php
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<div class=\"error-message\">
            <h4>User registered successfully</h4>
        </div>";
        header("Location: login.php");
    } else {
        echo "<p>Couldn't register user</p>";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>
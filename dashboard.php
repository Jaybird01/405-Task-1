<?php
session_start();
include("database.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$query = $conn->prepare("SELECT username, email FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem;
            box-shadow: 4px -4px 3rem rgba(0, 0, 0, 0.1);
            margin: 1.5rem;
            border-radius: 8px;
        }

        a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            border-bottom: 2px solid #333333;
        }

        ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #6c757d;
            color: #333333;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s ease;
            text-align: center;
        }

        button:hover {
            border: 1px solid #6c757d;
            background: rgba(255, 255, 255, 0.6);
        }

        h2 {
            padding-left: 2rem;
        }

        p {
            color: #e30a0a;
            font-size: 1rem;
            font-weight: 900;
            padding-left: 2rem;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            border-collapse: collapse;
            margin: 2.5rem;
        }
    </style>
</head>

<body>

    <div class="nav-bar">
        <ul>
            <li><a href="dashboard.php" class="active">DASHBOARD</a></li>
            <li><a href="mycourses.php">MY COURSES</a></li>
            <li> <a href="biodata.php">BIODATA</a></li>
            <li> <a href="resit.php">RESIT</a></li>
        </ul>
        <form action="dashboard.php" method="post">
            <button type="submit" name="logout">Logout </button>
        </form>
    </div>
    <h2> Welcome, <?php echo ($user["username"]); ?></h2>
    <!-- <h2>Email: <?php echo ($user["email"]); ?></h2> -->
    <table>
        <tr>
            <th>username</th>
            <td> <?php echo ($user["username"]) ?> </td>
        </tr>
        <tr>
            <th>email </th>
            <td><?php echo ($user["email"]) ?> </td>
        </tr>
    </table>
</body>

</html>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
}
?>
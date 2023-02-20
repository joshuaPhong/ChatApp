<!--login.php-->
<?php
include("databaseConnection.php");
session_start();
$message = "";
if (isset($_POST['login'])) {
    $query = "SELECT * FROM login WHERE username = :username";
    $statement = $connect->prepare($query);
    $statement->execute(array(':username' => $_POST["username"]));
    $count = $statement->rowCount();
    if ($count > 0) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['userId'] = $row['userId'];
                $_SESSION['username'] = $row['username'];
                $subQuery = "INSERT INTO loginDetails(userId) VALUES ('" . $row['userId'] . "')";
                $statement = $connect->prepare($subQuery);
                $statement->execute();
                $_SESSION['loginDetailsId'] = $connect->lastInsertId();
                header('location: index.php');
            }
        }
    } else {
        $message = '<lable>Wrong Username</lable>';
    }
}

?>

<html lang="en-NZ">
<head>
    <title>Chat Application using PHP Ajax JQuery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet"
          href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
            integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <br>
    <h3 class="text.center">Application using PHP Ajax Jquery and Bootstrap</h3>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">Chat Application Login</div>
        <br>
        <div class="panel-body">
            <form method="post" action="">
                <p class="text-danger"><?php echo $message; ?></p>
                <div class="form-group">
                    <label for="username">Enter Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Enter Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="login" id="login" class="btn btn-info" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
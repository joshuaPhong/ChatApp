<!--INDEX.PHP-->

<?php
echo "hello app";

include('database_connection.php');

session_start();
// redirect user if not logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
?>

<html lang="en-NZ">
<head>
    <title>Chat Application with Ajax and JQuery</title>
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
    <br />

    <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
    <br />

    <div class="table-responsive">
        <h4 align="center">Online User</h4>
        <p align="right">Hi - <?php echo $_SESSION['username'];  ?> - <a href="logout.php">Logout</a></p>
        <div id="user_details"></div>
    </div>
</div>
</body>
</html>


<script>
    $(document).ready(function () {

        fetch_user();

        setInterval(function (){
            update_last_activity();
            fetch_user();
        }, 5000);

        function fetch_user()
        {
            $.ajax({
                url:"fetch_user.php",
                method:"POST",
                success:function(data){
                    $('#user_details').html(data);
                }
            })
        }

        function update_last_activity() {
            $.ajax({
                url: "update_last_activity.php",
                success: function () {

                }
            })
        }

    });
</script>
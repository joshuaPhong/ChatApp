<?php
$connect = new PDO("mysql:host=localhost;dbname=chat", "root", "root");

function fetch_user_last_activity($user_id, $connect){
    $query = "
    SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1
    ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

//    this loop returns data from the last_activity table
    foreach ($result as $row){
        return $row['last_activity'];
    }

}
?>
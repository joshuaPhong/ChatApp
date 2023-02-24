<?php
// update_last_activity page

include("database_connection.php");

session_start();

$query = "update login_details set last_actiivty = now() where login_details_id = '" . $_SESSION["login_details_id"] . "'";

$statement = $connect->prepare($query);

$statement->execute();

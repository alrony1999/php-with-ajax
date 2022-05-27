<?php
$id = $_POST["id"];
$first_name = $_POST["fname"];
$last_name = $_POST["lname"];
$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");
$sql = "UPDATE students SET f_name='{$first_name}', l_name='{$last_name}' WHERE id='{$id}'";
if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}

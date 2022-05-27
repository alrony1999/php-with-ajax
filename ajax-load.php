<?php

require 'controller/load.php';

$l_p = 5;
$page = "";
if (isset($_POST["page_no"])) {

    $page = $_POST["page_no"];
} else {

    $page = 1;
}

$offset = ($page - 1) * $l_p;

$sql = "SELECT * FROM students LIMIT {$offset} , {$l_p}";
echo Load($sql, $page);

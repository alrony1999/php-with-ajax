<?php
$search_value = $_POST["search"];

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");
$limit = 5;
if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
    $limit = $limit * $page;
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM students WHERE f_name LIKE '%{$search_value}%' OR l_name LIKE '%{$search_value}%' OR id LIKE '%{$search_value}%' LIMIT 1,{$limit}";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");
$output = "";
if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
    <tr>
        <th width="100px">Id</th>
        <th>Name</th>
        <th width="90px" >Edit</th>
        <th width="90px" >Delete</th>
    </tr>';

    while ($row = mysqli_fetch_assoc($result)) {

        $output .= "<tr>
                        <td> {$row["id"]}</td>
                        <td>{$row["f_name"]} {$row["l_name"]}</td>
                        <td> <button class='edit-btn' data-eid='{$row["id"]}'> Edit</button></td>
                        <td> <button class='delete-btn' data-id='{$row["id"]}'> Delete</button></td>
                   </tr>";
    }
    $output .= "</table>";
    $sql2 = "SELECT * FROM students WHERE f_name LIKE '%{$search_value}%' OR l_name LIKE '%{$search_value}%' OR id LIKE '%{$search_value}%'";
    $records = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");
    $row_no = mysqli_num_rows($records);
    if ($limit <= $row_no) {
        $output .= "<div id='pagination'><button id='ajaxbtn' data-id='{$page}'>Load More</button> </div>";
    }


    mysqli_close($conn);
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}

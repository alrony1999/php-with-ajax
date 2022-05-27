<?php
function Load($sql, $page)
{
    $conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed");

    $sql = $sql;

    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

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

        $sql2 = "SELECT * FROM students";

        $records = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");

        $total_record = mysqli_num_rows($records);

        $total_pages = ceil($total_record / 5);

        $output .= '<div id="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $class_name = "active";
            } else {
                $class_name = "";
            }
            $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
        }
        $output .= '</div>';

        mysqli_close($conn);

        return $output;
    } else {

        return "<h2>No Record Found.</h2>";
    }
}

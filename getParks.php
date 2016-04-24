<?php

include "db_connect.php";

$query = "SELECT * FROM PARK";

    $result = mysql_query($query, $mysql_access);
    $row = mysql_fetch_array($result);

?>

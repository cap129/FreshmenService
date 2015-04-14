<?php

$q = $_GET["q"];

$con = mysql_connect('localhost', 'zyy', '123456');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("Building", $con);

////////////////////////////////
date_default_timezone_set('America/New_York'); //set the timezone
$now = strtotime(date("H:i")); //shown in hour:min format, converted to unix timestamp
////////////////////////////////

$sql = "SELECT * FROM Building";
//echo $sql;

$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>Building</th>
<th>" . $q . "</th>
<th>More Info</th>
</tr>";

while ($row = mysql_fetch_array($result)) {
    if ($row[$q]) {
        //////////////////////////
        $fromtime = strtotime($row['open_time']);
        $totime = strtotime($row['close_time']);
        if ($row[$q] and $now > $fromtime and $now < $totime) {
            //////////////////////////
            echo "<tr>";
            echo "<td onclick='showMarker(" . $row['Bid'] . ")'><span style='cursor:pointer'>"
            . $row['Bname'] . "</span></td>";
            echo "<td>" . $row[$q] . "</td>";
            echo "<td><a href='getInfo2.php?q=".$row['Bid']."'>More</a></td>";
            echo "</tr>";
        }
    }
}
echo "</table>";

mysql_close($con);
?>

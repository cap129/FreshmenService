<?php

$q = $_GET["q"];

$con = mysql_connect('localhost', 'zyy', '123456');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("Building", $con);

$sql = "SELECT Bid,Bname,lat,lng,content," . $q . " FROM Building";
//echo $sql;

$result = mysql_query($sql);

echo "<table border='1' >
<tr>
<th>Building</th>
<th>" . $q . "</th>
</tr>";

$n = 0;
while ($row = mysql_fetch_array($result)) {
    if ($row[$q]) {
        echo "<tr>";
        echo "<td onclick='showMarker(" . $row['Bid'] . ")'><span style='cursor:pointer'>"
        . $row['Bname'] . "</span></td>";
        echo "<td>" . $row[$q] . "</td>";
        echo "</tr>";
        $Bid_list[$n] = $row['Bid'];
        $lat_list[$n] = $row['lat'];
        $lng_list[$n] = $row['lng'];
        $content_list[$n] = $row['content'];
        $n++;
    }
}
echo "</table>";
$j = 0;
echo "<script type='text/javascript'>";
echo "function aa(){
    if ('".$q."' == 'study') {
                    var mapOptions = {
                        center: new google.maps.LatLng(40.4447, -79.9561),
                        zoom: 16,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById('map_canvas'),
                            mapOptions);";
while ($j < $n) {
    echo "
                    var marker_" . $j . " = new google.maps.Marker({
                        position: new google.maps.LatLng(" . $lat_list[$j] . "," . $lng_list[$j] . "),
                        map: map,
                        title: '" . $content_list[$j] . "'
                    })
                    google.maps.event.addListener(marker_" . $j . ", 'click', function () {
                        setupMap(" . $lat_list[$j] . "," . $lng_list[$j] . ", '" . $content_list[$j++] . "');
                    }) ";  
};
echo "} alert('hello'); };";


echo "</script>";
echo "<script type='text/javascript' language='javascript'>setTimeout('aa()',10)　</script>";

mysql_close($con);
?>

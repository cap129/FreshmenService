<?php
$q=$_GET["q"];

$con = mysql_connect('localhost', 'zyy', '123456');
if (!$con)
 {
 die('Could not connect: ' . mysql_error());
 }

mysql_select_db("Building", $con);

//////////////////////////////////////
date_default_timezone_set('America/New_York');//set the timezone
$now=strtotime(date("H:i"));//returns current time in hour:min format and converts to unix timestamp
/////////////////////////////////////


$sql="SELECT * FROM Building WHERE Bid = '".$q."'";
//echo $sql;

$result = mysql_query($sql);

echo "<table>";
while($row = mysql_fetch_array($result))
{
//////////////////////////////////////
    $fromtime=strtotime($row['open_time']);
    $totime=strtotime($row['close_time']);
    if($now>$fromtime and $now<$totime )
     {
        $open="Now open";
     }
     else{
     $open="Now closed";
     }
    //////////////////////////////////////
   echo "<tr><td>Name:</td><td>".$row['Bname']."</td></tr>" ;
   echo "<tr><td>Open Time:</td><td>".$row['open_time']."-".$row['close_time']."</td></tr>" ;
   //revised: "open_time"-"close_time"
   echo "<tr><td>Food:</td><td>".$row['food']."</td></tr>" ;
   echo "<tr><td>Print:</td><td>".$row['print']."</td></tr>" ;
   echo "<tr><td>Study Area:</td><td>".$row['study']."</td></tr>" ;
   //////////////////////////////////
   echo "<tr><td>".$open."</td></tr>" ;
   /////////////////////////////////
   echo "<tr><td><a href='getInfo2.php?q=".$row['Bid']."'>More info here...</a></td></tr>";
}
echo "</table>";

//return [$lat,$lng,$content];
mysql_close($con);
?>
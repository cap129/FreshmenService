<?php

$q = $_GET["q"];

$con = mysql_connect('localhost', 'zyy', '123456');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("Building", $con);

//////////////////////////////////////
date_default_timezone_set('America/New_York'); //set the timezone
$now = strtotime(date("H:i")); //returns current time in hour:min format and converts to unix timestamp
/////////////////////////////////////


$sql = "SELECT * FROM Building WHERE Bid = '" . $q . "'";
//echo $sql;

$result = mysql_query($sql);

$row = mysql_fetch_array($result);

$fromtime = strtotime($row['open_time']);
$totime = strtotime($row['close_time']);
if ($now > $fromtime and $now < $totime) {
    $open = "Now open";
} else {
    $open = "Now closed";
}

echo "<html>
    <head>
        <title>Profile</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='css/bootstrap.min.css'>
        <script src='http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js'></script>
        <script>
            
        </script>
    </head>
    <body>
    <div class='page-header' align='center'>
        <h2>Building Information</h2>
    </div>
    <div class='container-fluid'>
        <div class='row'>
                
            <div class='col-sm-6 col-sm-offset-3'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Basic Infomation
                        </div>
                        <div class='panel-body'>
                            <form class='form-horizontal' role='form'>
                                <div class='form-group'>
                                    <label class='col-sm-4 control-label'>Building</label>
                                    <div class='col-sm-6'>
                                        <p class='form-control-static'>" . $row['Bname'] . "</p>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='col-sm-4 control-label'>Open Time</label>
                                    <div class='col-sm-6'>
                                        <p class='form-control-static'>" . $row['open_time'] . "-" . $row['close_time'] . "</p>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='col-sm-4 control-label'>Status</label>
                                    <div class='col-sm-6'>
                                        <p class='form-control-static'>" . $open . "</p>
                                    </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Food
                        </div>
                        <div class='panel-body'>
                          <form class='form-horizontal' role='form'>
                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Location</label>
                                <div class='col-sm-6'>
                                    <p class='form-control-static'>" . $row['food'] . "</p>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Time</label>
                                <div class='col-sm-6'>
                                    <p class='form-control-static'>...</p>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Study Area
                        </div>
                        <div class='panel-body'>
                          <form class='form-horizontal' role='form'>
                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Location</label>
                                <div class='col-sm-6'>
                                    <p class='form-control-static'>" . $row['study'] . "</p>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Time</label>
                                <div class='col-sm-6'>
                                    <p class='form-control-static'>...</p>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Print
                        </div>
                        <div class='panel-body'>
                          <form class='form-horizontal' role='form'>
                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Location</label>
                                <div class='col-sm-6'>
                                    <p class='form-control-static'>" . $row['print'] . "</p>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Time</label>
                                <div class='col-sm-6'>
                                    <p class='form-control-static'>...</p>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
            </div>
            
        </div>
    </div>
    
</body>
</html>
    ";

mysql_close($con);
?>
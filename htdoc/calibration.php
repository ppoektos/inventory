<html>
<head>
    <title>Calibration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./my_style.css">
</head>

<body>

<?php
include 'connector.php';

$sql = "SELECT local_id, description, location, calibration_class,
        calibration_interval, calibration_last, calibration_next,
        DATEDIFF(calibration_next,CURDATE()) as days_left
        from items WHERE calibration = 'Yes'
        AND calibration_next != '0000-00-00' order by calibration_next";
        
$result = mysqli_query($conn, $sql);

if (!$result) {
    $message  = 'Wrong query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message); }
?>

<h1 align="center">Time left for calibration</h1>

<table>
<tr>
  <th>Id</th>
  <th>Description</th>
  <th>location</th>
  <th>Class</th>
  <th>Interval</th>
  <th>Calibration last</th>
  <th>Calibration next</th>
  <th>Days left</th>
</tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    if ( $row['calibration_class'] == "C1" ) { $status_colors = "#b30047"; }
    else { $status_colors = ""; }
  echo "<tr>";
  echo "<td> <a href=\"item.php?id=" . $row['local_id'] . "\">" . $row['local_id'] . "</a></td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td>" . $row['location'] . "</td>";
  echo "<td style=\"background-color: " . $status_colors . "\">" . $row['calibration_class'] . "</td>";
  echo "<td>" . $row['calibration_interval'] . "</td>";
  echo "<td>" . $row['calibration_last'] . "</td>";
  echo "<td>" . $row['calibration_next'] . "</td>";
  echo "<td>" . $row['days_left'] . "</td>";
  echo "</tr>"; }
?>
</table>

</body> 
</html>


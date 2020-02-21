<html>
<head>
    <link rel="stylesheet" type="text/css" href="./my_style.css">
</head>
<body>

<?php
//print_r($_GET);
#print_r($_POST);

include 'connector.php';
$office = $_GET["office"];

$order = isset($_GET["order"]) ? $_GET["order"] : 'last_update desc';

if ( $office == "ALL" ) {
    $sql = "SELECT local_id AS ID, category AS Category, description AS Description,
            location AS Location, calibration_class AS Calibration_class, status AS Status,
            last_update AS Updated from items order by $order";
    } else {
    $sql = "SELECT local_id AS ID, category AS Category, description AS Description,
            location AS Location, calibration_class AS Calibration_class, status AS Status,
            last_update AS Updated from items WHERE location = '$office' order by $order";
    }

    $result = mysqli_query($conn, $sql);
    
echo "<h3 align=\"center\">$office</h3>
<table>
<tr>
  <th>Id</th>
  <th>Category</th>
  <th>Description</th>
  <th>Location</th>
  <th>Calibration_class</th>
  <th>Status</th>
  <th>Created</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    if ( $row['Calibration_class'] == "C1" ) { $status_colors = "#b30047"; }
    else { $status_colors = ""; }
  echo "<tr>";
  echo "<td> <a href=\"item.php?id=" . $row['ID'] . "\">" . $row['ID'] . "</a></td>";
  echo "<td>" . $row['Category'] . "</td>";
  echo "<td>" . $row['Description'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "<td style=\"background-color: " . $status_colors . "\">" . $row['Calibration_class'] . "</td>";
  echo "<td>" . $row['Status'] . "</td>";
  echo "<td>" . $row['Updated'] . "</td>";
  echo "</tr>"; }

echo "</table>";
mysqli_close($conn);
?>
</body>
</html>

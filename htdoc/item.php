<html>
<head>
    <title><?php echo $_GET['id'] ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="my_style.css">
</head>

<body>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connector.php';

$ID = $_GET['id'];

$sql = "SELECT *,
round((purchase_value - ((year(curdate()) - year(purchase_date)) * (purchase_value / depreciation))),0)
AS ActualValue,
DATEDIFF(calibration_next,CURDATE()) as days_left
FROM items WHERE local_id = $ID";
$result = mysql_query($sql);

if (!$result) {
    $message  = 'Wrong query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message); }
    
$sql_picture = "SELECT filename FROM images WHERE item_id = $ID";
$result_picture = mysql_query($sql_picture);

$sql_document = "SELECT filename FROM attachments WHERE item_id = $ID";
$result_document = mysql_query($sql_document);

$sql_log = "SELECT date, log, comment FROM history WHERE item_id = $ID";
$result_log = mysql_query($sql_log);

?>

<h1 align="center">Details of <?php echo $ID ?> </h1>

<table id='tb1'>
<tr>
  <th>Name</th>
  <th>Details</th>
</tr>

<?php
while ($row = mysql_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>Category</td>";
  echo "<td>" . $row['category'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Status</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "</tr>";
  echo "<td>Description</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Manufacture</td>";
  echo "<td>" . $row['manufacture'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Model</td>";
  echo "<td>" . $row['model'] . "</td>";
  echo "</tr>";
  echo "<td>Serial</td>";
  echo "<td>" . $row['serial'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Location</td>";
  echo "<td>" . $row['location'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>In transport to</td>";
  echo "<td>" . $row['transport'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Responsible</td>";
  echo "<td>" . $row['responsible'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Supplier</td>";
  echo "<td>" . $row['supplier'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Warranty</td>";
  echo "<td>" . $row['warranty'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Purchase value</td>";
  echo "<td>" . $row['purchase_value'] . "</td>";
  echo "</tr>";
  echo "<td>Ownership</td>";
  echo "<td>" . $row['ownership'] . "</td>";
  echo "</tr>";
  echo "<td>Purchase date</td>";
  echo "<td>" . $row['purchase_date'] . "</td>";
  echo "<tr>";
  echo "<td>Depreciation</td>";
  echo "<td>" . $row['depreciation'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Insurance value</td>";
  echo "<td>" . $row['insurance_value'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Insurance date</td>";
  echo "<td>" . $row['insurance_date'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Insurance duration</td>";
  echo "<td>" . $row['insurance_duration'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Scrap value</td>";
  echo "<td>" . $row['scrap'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Liquidation value</td>";
  echo "<td>" . $row['liquidation'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Calibration</td>";
  echo "<td>" . $row['calibration'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Class</td>";
  echo "<td>" . $row['calibration_class'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Category</td>";
  echo "<td>" . $row['category'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Calibration interval</td>";
  echo "<td>" . $row['calibration_interval'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Calibration last date</td>";
  echo "<td>" . $row['calibration_last'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Calibration next date</td>";
  echo "<td>" . $row['calibration_next'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td><b>Calibration days left</b></td>";
  echo "<td>" . $row['days_left'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Calibration verified by</td>";
  echo "<td>" . $row['calibration_virified_by'] . "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Old id</td>";
  echo "<td>" . $row['id_old'] . "</td>";
  echo "</tr>";
  echo "<td><b>Depreciated value</b></td>";
  echo "<td>" . $row['ActualValue'] . "</td>";
  echo "</tr>";
}
?>
</table>

<h3 align="center">Journal</h3>

<table id='tb2'>
<tr>
  <th>Date</th>
  <th>Log</th>
  <th>Comment</th>
</tr>

<?php
while ($row = mysql_fetch_assoc($result_log)) {
  echo "<tr>";
  echo "<td>" . $row['date'] . "</td>";
  echo "<td>" . $row['log'] . "</td>";
  echo "<td>" . $row['comment'] . "</td>";
  echo "</tr>";
}
?>
</table>

<h3 align="center"><a href="edit.php?id=<?php echo $ID ?>">Edit</a></h3>
<hr>

<h3 align="center">Documents</h3>

<?php while ($row = mysql_fetch_assoc($result_document)) { ?>
    <p style="text-align:center;"><a href="uploads/<?php echo $ID ?>/<?php echo $row['filename'] ?>"><?php echo $row['filename'] ?></a></p>
<?php } ?>

<hr>
<h3 align="center">Images</h3>
<?php while ($row = mysql_fetch_assoc($result_picture)) { ?>
    <img src="uploads/<?php echo $ID ?>/<?php echo $row['filename'] ?>">
<?php } ?>

</body>
</html>

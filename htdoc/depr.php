<html>
<head>
    <title>Depreciation values</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./my_style.css">
</head>

<body>

<?php
include 'connector.php';

$sql = "select local_id AS ID, location AS Location,
purchase_date AS PurchaseDate, purchase_value AS PurchaseValue,
round((purchase_value - ((year(curdate()) - year(purchase_date)) * (purchase_value / depreciation))),0)
AS ActualValue from items";
#	union select '' AS ,'' AS ,'Sum' AS Sum, sum(purchase_value) AS SUM, '' AS from items

$result = mysqli_query($conn, $sql);

if (!$result) {
    $message  = 'Wrong query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message); }
?>

<h1 align="center">Depreciation</h1>

<table>
<tr>
  <th>Id</th>
  <th>Location</th>
  <th>PurchaseDate</th>
  <th>PurchaseValue</th>
  <th>ActualValue</th>
</tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "<td>" . $row['PurchaseDate'] . "</td>";
  echo "<td>" . $row['PurchaseValue'] . "</td>";
  echo "<td>" . $row['ActualValue'] . "</td>";
  echo "</tr>"; }
?>
</table>

</body> 
</html>


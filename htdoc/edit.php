<html>
<head>
    <title><?php echo $_GET['id'] ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="my_style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
    $( ".datepicker" ).datepicker({
    changeMonth: true,
    numberOfMonths: 1,
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true
    })});
    </script>
</head>

<body>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connector.php';

$ID = $_GET['id'];

$sql = "SELECT *,
round((purchase_value - ((year(curdate()) - year(purchase_date)) * (purchase_value / depreciation))),0)
AS ActualValue
FROM items WHERE local_id = $ID";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $message  = 'Wrong query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message); }
    
$sql_picture = "SELECT filename FROM images WHERE item_id = $ID";
$result_picture = mysqli_query($conn, $sql_picture);

$sql_document = "SELECT filename FROM attachments WHERE item_id = $ID";
$result_document = mysqli_query($conn, $sql_document);
?>

<h1 align="center">Edit <?php echo $ID ?> </h1>

<form enctype="multipart/form-data" method="POST" action="process.php?id=<?php echo $ID ?>">

<table id='tb2'>
<tr>
  <th>Name</th>
  <th>Details</th>
</tr>

<?php
while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td>Category</td>
<td><select name="category">
                <option value="" disabled selected style="display: none;"><? echo $row['category'] ?></option>
                <option value="Laboratory">Laboratory</option>
                <option value="IT">IT</option>
                <option value="Project">Project equipment</option>
                <option value="Furniture">Furniture</option>
                <option value="Other">Other</option>
    </select></td>
</tr>
<tr>
<tr>
<td>Status</td>
<td><select name="status">
                <option value="" disabled selected style="display: none;"><? echo $row['status'] ?></option>
                <option value="Active">Active</option>
                <option value="Defect">Defect</option>
    </select></td>
</tr>
<td>Description</td>
<td><input type="text" name="description" placeholder="<? echo $row['description'] ?>"/></td>
</tr>
<tr>
<td>Manufacture</td>
<td><input type="text" name="manufacture" placeholder="<? echo $row['manufacture'] ?>"/></td>
</tr>
<tr>
<td>Model</td>
<td><input type="text" name="model" placeholder="<? echo $row['model'] ?>"/></td>
</tr>
<tr>
<td>Serial</td>
<td><input type="text" name="serial" placeholder="<? echo $row['serial'] ?>"/></td>
</tr>
<tr>
<td>Location</td>
<td><select name="location">
                <option value="" disabled selected style="display: none;"><? echo $row['location'] ?></option>
                <option value="Office1">Office1</option>
                <option value="Office2">Office2</option>
    </select></td>
</tr>
<tr>
<td>In transport to</td>
<td><select name="transport">
                <option value="" disabled selected style="display: none;"><? echo $row['transport'] ?></option>
                <option value="none">none</option>
                <option value="Office1">Office1</option>
                <option value="Office2">Office2</option>
    </select></td>
</tr>
<tr>
<td>Responsible</td>
<td><input type="text" name="responsible" placeholder="<? echo $row['responsible'] ?>"/></td>
</tr>
<tr>
<td>Supplier</td>
<td><input type="text" name="supplier" placeholder="<? echo $row['supplier'] ?>"/></td>
</tr>
<tr>
<td>Warranty</td>
<td><input type="text" name="warranty" placeholder="<? echo $row['warranty'] ?>"/></td>
</tr>
<tr>
<td>Purchase value</td>
<td><input type="text" name="purchase_value" placeholder="<? echo $row['purchase_value'] ?>"/></td>
</tr>
<tr>
<td>Ownership</td>
<td><input type="text" name="ownership" placeholder="<? echo $row['ownership'] ?>"/></td>
</tr>
<tr>
<td>Purchase date</td>
<td><input type="text" class="datepicker" name="purchase_date" placeholder="<? echo $row['purchase_date'] ?>"/></td>
</tr>
<tr>
<td>Depreciation</td>
<td><select name="depreciation">
                <option value="" disabled selected style="display: none;"><? echo $row['depreciation'] ?></option>
                <option value=""></option>
                <option value="10">1/10 each year</option>
    </select></td>
</tr>
<tr>
<td>Insurance value</td>
<td><input type="text" name="insurance_value" placeholder="<? echo $row['insurance_value'] ?>"/></td>
</tr>
<tr>
<td>Insurance date</td>
<td><input type="text" class="datepicker" name="insurance_date" placeholder="<? echo $row['insurance_date'] ?>"/></td>
</tr>
<tr>
<td>Insurance duration</td>
<td><input type="text" name="insurance_duration" placeholder="<? echo $row['insurance_duration'] ?>"/></td>
</tr>
<tr>
<td>Scrap value</td>
<td><input type="text" name="scrap" placeholder="<? echo $row['scrap'] ?>"/></td>
</tr>
<tr>
<td>Liquidation value</td>
<td><input type="text" name="liquidation" placeholder="<? echo $row['liquidation'] ?>"/></td>
</tr>
<tr>
<tr>
<td>Calibration</td>
<td><select name="calibration">
                <option value="" disabled selected style="display: none;"><? echo $row['calibration'] ?></option>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
    </select>
</tr>
<tr>
<tr>
<td>Class</td>
<td><select name="calibration_class">
                <option value="" disabled selected style="display: none;"><? echo $row['calibration_class'] ?></option>
                <option value=""></option>
                <option value="C1">C1</option>
                <option value="C2">C2</option>
                <option value="C3">C3</option>
                <option value="C4">C5</option>
            </select>
</tr>
<tr>
<td>Calibration interval</td>
<td><select name="calibration_interval">
                <option value="" disabled selected style="display: none;"><? echo $row['calibration_interval'] ?></option>
                <option value="3">6</option>
                <option value="6">6</option>
                <option value="9">9</option>
                <option value="12">12</option>
    </select></td>
</tr>
<tr>
<td>Calibration last date</td>
<td><input type="text" class="datepicker" name="calibration_last" placeholder="<? echo $row['calibration_last'] ?>"/></td>
</tr>
<tr>
<td>Calibration next date</td>
<td><input type="text" class="datepicker" name="calibration_next" placeholder="<? echo $row['calibration_next'] ?>"/></td>
</tr>
<tr>
<td>Old id</td>
<td><input type="text" name="id_old" placeholder="<? echo $row['id_old'] ?>"/></td>
</tr>
<tr>
<td>Upload pictures</td>
<td><input type="file" name="picture[]" multiple><br>
    <input type="file" name="picture[]" multiple></td>
</tr>
<tr>
<td>Upload documents</td>
<td><input type="file" name="document[]" multiple><br>
    <input type="file" name="document[]" multiple></td>
</tr>
<?php } ?>
</table><br>

<div id="centerButton">
    <input type="text" name="comment" placeholder="type comment here"/>
    <input type="submit" name="Update" value="Update"/>
</div>

</form>
</body>
</html>

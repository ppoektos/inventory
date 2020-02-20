<html>
<head>
    <title>Add new item</title>
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

<form enctype="multipart/form-data" method="post" action="process.php">

<hr>
Local id:   <input type="text" name="local_id" placeholder="3009xxxx" /><br><br>
Category:   <select name="category">
                <option value="Laboratory">Laboratory</option>
                <option value="IT">IT</option>
                <option value="Project">Project equipment</option>
                <option value="Furniture">Furniture</option>
                <option value="Other">Other</option>
            </select><br><br>
Status:     <select name="status">
                <option value="Active">Active</option>
                <option value="Defect">Defect</option>
            </select><br><br>
<hr>
Description:<input type="text" name="description" placeholder="smth about item" /><br><br>
Manufacture:<input type="text" name="manufacture"/><br><br>
Model:      <input type="text" name="model"/><br><br>
Serial:     <input type="text" name="serial"/><br><br>
<hr>
Location:   <select name="location">
                <option value="Office1">Office1</option>
                <option value="Office2">Office2</option>
            </select><br><br>
In transport to:<select name="transport">
                <option value=""></option>
                <option value="Office1">Office1</option>
                <option value="Office2">Office2</option>
            </select><br><br>
Responsible:    <input type="text" name="responsible"/><br><br>
<hr>
Supplier:       <input type="text" name="supplier"/><br><br>
Warranty:       <input type="text" name="warranty"/><br><br>
Purchase value: <input type="text" name="purchase_value"/><br><br>
Ownership:      <input type="text" name="ownership"/><br><br>
Purchase date:  <input type="text" class="datepicker" name="purchase_date"/><br><br>
Depreciation:   <select name="depreciation">
                <option value=""></option>
                <option value="10">1/10 each year</option>
                </select><br><br>
Insurance value:<input type="text" name="insurance_value"/><br><br>
Insurance date: <input type="text" class="datepicker" name="insurance_date"/><br><br>
Insurance duration:<input type="text" name="insurance_duration" placeholder="number of months"/><br><br>
Scrap value:    <input type="text" name="scrap"/><br><br>
Liquidation value:<input type="text" name="liquidation"/><br><br>
<hr>
Calibration:    <select name="calibration">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select><br><br>
Class:       <select name="calibration_class">
                <option value=""></option>
                <option value="C1">C1</option>
                <option value="C2">C2</option>
                <option value="C3">C3</option>
                <option value="C4">C5</option>
            </select><br><br>
Calibration interval:   <select name="calibration_interval">
                <option value=""></option>
                <option value="3">6</option>
                <option value="6">6</option>
                <option value="9">9</option>
                <option value="12">12</option>
            </select><br><br>
Calibration last date:  <input type="text" class="datepicker" name="calibration_last"/><br><br>
Calibration next date:  <input type="text" class="datepicker" name="calibration_next"/><br><br>
Calibration verified by:<input type="text" name="calibration_virified_by"/><br><br>
<hr>
Old id:                 <input type="text" name="id_old"/><br><br>
<hr>
Upload pictures:<br>
                        <input type="file" name="picture[]" multiple><br>
                        <input type="file" name="picture[]" multiple><br>
<hr>
Upload documents:<br>
                        <input type="file" name="document[]" multiple><br>
                        <input type="file" name="document[]" multiple><br>
<hr>
                        <input type="submit" name="Submit" value="Submit" />
</form>

</body> 
</html>

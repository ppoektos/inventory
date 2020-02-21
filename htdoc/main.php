<html>
<head>
    <title>Inventory main page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="my_style.css">
    <script src="jquery.min.js"></script>
    <script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 100
        });
        $("#typeahead").val("")
    });
    </script>
    <script>
    function showUser(str) {
        if (str == "") {
        document.getElementById("txtHint1").innerHTML = "";
        return;
        } else {    
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint1").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","filter.php?office="+str,true);
        xmlhttp.send();
        }
    }
    </script>
    <script>
    function showUser2(str) {
        if (str == "") {
        document.getElementById("txtHint1").innerHTML = "";
        return;
        } else {    
            if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint1").innerHTML = this.responseText;
            }
        };
        
        var e = document.getElementById("Branches");
        var str2 = e.options[e.selectedIndex].value;
        
        xmlhttp.open("GET","filter.php?office="+ str2 +"&order="+str,true);
        xmlhttp.send();
        }
    }
    </script>
</head>

<body>

<form>
<select name="Branches" id="Branches" onchange="showUser(this.value)">
  <option value="">Select office:</option>
  <option value="Office1">Office1</option>
  <option value="Office2">Office2</option>
  <option value="ALL">ALL</option>
</select>
<select name="Order" id="Order" onchange="showUser2(this.value)">
  <option value="">Order by:</option>
  <option value="local_id">Local Id</option>
  <option value="calibration_next">Calibration</option>
</select>
<br><br>
  <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search field">
</form>
<div id="txtHint1"></div>
<br>

<!--
<?php
include 'connector.php';

$sql = "select local_id AS ID, category AS Category, description AS Description,
location AS Location, calibration_class AS Calibration_class, status AS Status,
last_update AS Updated from items order by last_update desc";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $message  = 'Wrong query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message); }
?>

<h1 align="center">Main window</h1>

<table>
<tr>
  <th>Id</th>
  <th>Category</th>
  <th>Description</th>
  <th>Location</th>
  <th>Calibration_class</th>
  <th>Status</th>
  <th>Created</th>
</tr>
<?php

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
?>
</table>
-->

</body> 
</html>

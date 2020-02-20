<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connector.php';

$ID = isset($_GET["id"]) ? $_GET["id"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["local_id"]) ? $_POST["local_id"] : '';
    $category = isset($_POST["category"]) ? $_POST["category"] : '';
    $status = isset($_POST["status"]) ? $_POST["status"] : '';
    $description = isset($_POST["description"]) ? $_POST["description"] : '';
    $manufacture = isset($_POST["manufacture"]) ? $_POST["manufacture"] : '';
    $model = isset($_POST["model"]) ? $_POST["model"] : '';
    $serial = isset($_POST["serial"]) ? $_POST["serial"] : '';
    $location = isset($_POST["location"]) ? $_POST["location"] : '';
    $transport = isset($_POST["transport"]) ? $_POST["transport"] : '';
    $responsible = isset($_POST["responsible"]) ? $_POST["responsible"] : '';
    $supplier = isset($_POST["supplier"]) ? $_POST["supplier"] : '';
    $warranty = isset($_POST["warranty"]) ? $_POST["warranty"] : '';
    $purchase_value = isset($_POST["purchase_value"]) ? $_POST["purchase_value"] : '';
    $ownership = isset($_POST["ownership"]) ? $_POST["ownership"] : '';
    $purchase_date = isset($_POST["purchase_date"]) ? $_POST["purchase_date"] : '';
    $depreciation = isset($_POST["depreciation"]) ? $_POST["depreciation"] : '';
    $insurance_value = isset($_POST["insurance_value"]) ? $_POST["insurance_value"] : '';
    $insurance_date = isset($_POST["insurance_date"]) ? $_POST["insurance_date"] : '';
    $insurance_duration = isset($_POST["insurance_duration"]) ? $_POST["insurance_duration"] : '';
    $scrap = isset($_POST["scrap"]) ? $_POST["scrap"] : '';
    $liquidation = isset($_POST["liquidation"]) ? $_POST["liquidation"] : '';
    $calibration = isset($_POST["calibration"]) ? $_POST["calibration"] : '';
    $calibration_class = isset($_POST["calibration_class"]) ? $_POST["calibration_class"] : '';
    $calibration_interval = isset($_POST["calibration_interval"]) ? $_POST["calibration_interval"] : '';
    $calibration_last = isset($_POST["calibration_last"]) ? $_POST["calibration_last"] : '';
    $calibration_next = isset($_POST["calibration_next"]) ? $_POST["calibration_next"] : '';
    $calibration_virified_by = isset($_POST["calibration_virified_by"]) ? $_POST["calibration_virified_by"] : '';
    $id_old = isset($_POST["id_old"]) ? $_POST["id_old"] : '';
    $comment = isset($_POST["comment"]) ? $_POST["comment"] : '';
}

if (isset($_POST['Submit'])) {
    #$ = $_POST["transport"];
    #$picture = $_FILES["picture"]["name"];
    $uploaddir = 'uploads/' . $id . '/';
    if (!is_dir("$uploaddir")) { mkdir("$uploaddir", 0777, true); }

    $sql_add = "INSERT INTO items (local_id, category, status, description,
                                    manufacture, model, serial, location, transport, responsible,
                                    supplier, warranty, purchase_value, ownership, purchase_date,
                                    depreciation, insurance_value, insurance_date, insurance_duration,
                                    scrap, liquidation, calibration, calibration_class, calibration_interval,
                                    calibration_last, calibration_next, calibration_virified_by, id_old)
                            VALUES ('$id', '$category', '$status', '$description',
                                    '$manufacture', '$model', '$serial', '$location', '$transport',
                                    '$responsible', '$supplier', '$warranty', '$purchase_value',
                                    '$ownership', '$purchase_date', '$depreciation',
                                    '$insurance_value', '$insurance_date', '$insurance_duration',
                                    '$scrap', '$liquidation', '$calibration', '$calibration_class',
                                    '$calibration_interval', '$calibration_last', '$calibration_next', 
                                    '$calibration_virified_by', '$id_old')";

    $sql_add_log = "INSERT INTO history (item_id, log) VALUES ('$id','Item has been created')";
    
    if (mysqli_query($conn, $sql_add)) { echo "New item added successfully. <a href=\"index.html\">Main page</a><br>"; }
    else { echo "Error:" . $sql_add . "<br>" . mysqli_error($conn); }
    
    if (mysqli_query($conn, $sql_add_log)) { echo "History ivent created successfully.<br>"; }
    else { echo "Error:" . $sql_add_log . "<br>" . mysqli_error($conn); }

    $lenght_pictures = count($_FILES['picture']['name']);
    for($i=0; $i<$lenght_pictures; $i++) {
        $tmpFilePath = $_FILES["picture"]["tmp_name"][$i];
        $picture = $_FILES["picture"]["name"][$i];
        $sql_picture = "INSERT INTO images (item_id, filename) VALUES ('$id', '$picture')";
        if ($tmpFilePath != "") {
            if (mysqli_query($conn, $sql_picture))
                    { echo "Picture " . $picture . " added successfully.<br>"; }
            else    { echo "Error:" . $sql_picture . "<br>" . mysqli_error($conn); }

        $uploadfile = $uploaddir . basename($_FILES['picture']['name'][$i]);

        if (move_uploaded_file($tmpFilePath, $uploadfile))
            { echo "Picture " . $picture . " uploaded.<br>"; } 
        else    { echo '<pre>';
              echo "Error during uploading.\n";
              print_r($_FILES);
              print "</pre>"; }
        }
        }
        
    $lenght_documents = count($_FILES['document']['name']);
    for($i=0; $i<$lenght_pictures; $i++) {
        $tmpFilePath = $_FILES["document"]["tmp_name"][$i];
        $document = $_FILES["document"]["name"][$i];
        $sql_document = "INSERT INTO attachments (item_id, filename) VALUES ('$id', '$document')";
        if ($tmpFilePath != "") {
            if (mysqli_query($conn, $sql_document))
                    { echo "Document " . $document . " added successfully.<br>"; }
            else    { echo "Error:" . $sql_document . "<br>" . mysqli_error($conn); }

        $uploadfile = $uploaddir . $document;

        if (move_uploaded_file($tmpFilePath, $uploadfile))
                    { echo "Document " . $document . " uploaded.<br>"; } 
        else        { echo '<pre>';
                      echo "Error during uploading.\n";
                      print_r($_FILES);
                      print "</pre>"; }
        }
        }

mysqli_close($conn);
}

if (isset($_POST['Update'])) {

    $uploaddir = 'uploads/' . $ID . '/';
    if (!is_dir("$uploaddir")) { mkdir("$uploaddir", 0777, true); }

    $sql_update = "UPDATE items SET
                    category = IF('$category'='',category,'$category'),
                    status = IF('$status'='',status,'$status'),
                    description = IF('$description'='',description,'$description'),
                    manufacture = IF('$manufacture'='',manufacture,'$manufacture'),
                    model = IF('$model'='',model,'$model'),
                    serial = IF('$serial'='',serial,'$serial'),
                    location = IF('$location'='',location,'$location'),
                    transport = IF('$transport'='',transport,'$transport'),
                    responsible = IF('$responsible'='',responsible,'$responsible'),
                    supplier = IF('$supplier'='',supplier,'$supplier'),
                    warranty = IF('$warranty'='',warranty,'$warranty'),
                    purchase_value = IF('$purchase_value'='',purchase_value,'$purchase_value'),
                    ownership = IF('$ownership'='',ownership,'$ownership'),
                    purchase_date = IF('$purchase_date'='',purchase_date,'$purchase_date'),
                    depreciation = IF('$depreciation'='',depreciation,'$depreciation'),
                    insurance_value = IF('$insurance_value'='',insurance_value,'$insurance_value'),
                    insurance_date = IF('$insurance_date'='',insurance_date,'$insurance_date'),
                    insurance_duration = IF('$insurance_duration'='',insurance_duration,'$insurance_duration'),
                    scrap = IF('$scrap'='',scrap,'$scrap'),
                    liquidation = IF('$liquidation'='',liquidation,'$liquidation'),
                    calibration = IF('$calibration'='',calibration,'$calibration'),
                    calibration_class = IF('$calibration_class'='',calibration_class,'$calibration_class'),
                    calibration_interval = IF('$calibration_interval'='',calibration_interval,'$calibration_interval'),
                    calibration_last = IF('$calibration_last'='',calibration_last,'$calibration_last'),
                    calibration_next = IF('$calibration_next'='',calibration_next,'$calibration_next'),
                    calibration_virified_by = IF('$calibration_virified_by'='',calibration_virified_by,'$calibration_virified_by'),
                    id_old = IF('$id_old'='',id_old,'$id_old')
                WHERE local_id = '$ID'";

    $sql_add_log = "INSERT INTO history (item_id, log, comment) VALUES ('$ID','Item has been updated','$comment')";
    
    if (mysqli_query($conn, $sql_update)) { echo "Item updated successfully. <a href=\"index.html\">Main page</a><br>"; }
    else { echo "Error:" . $sql_update . "<br>" . mysqli_error($conn); }
    
    if (mysqli_query($conn, $sql_add_log)) { echo "History ivent created successfully. <a href=\"item.php?id=" . $ID . "\">View item</a><br>"; }
    else { echo "Error:" . $sql_add_log . "<br>" . mysqli_error($conn); }
    
    $lenght_pictures = count($_FILES['picture']['name']);
    for($i=0; $i<$lenght_pictures; $i++) {
        $tmpFilePath = $_FILES["picture"]["tmp_name"][$i];
        $picture = $_FILES["picture"]["name"][$i];
        $sql_picture = "INSERT INTO images (item_id, filename) VALUES ('$ID', '$picture')";
        if ($tmpFilePath != "") {
            if (mysqli_query($conn, $sql_picture))
                    { echo "Picture " . $picture . " added successfully.<br>"; }
            else    { echo "Error:" . $sql_picture . "<br>" . mysqli_error($conn); }

        $uploadfile = $uploaddir . basename($_FILES['picture']['name'][$i]);

        if (move_uploaded_file($tmpFilePath, $uploadfile))
            { echo "Picture " . $picture . " uploaded.<br>"; }
        else    { echo '<pre>';
              echo "Error during uploading.\n";
              print_r($_FILES);
              print "</pre>"; }
        }
        }

    $lenght_documents = count($_FILES['document']['name']);
    for($i=0; $i<$lenght_pictures; $i++) {
        $tmpFilePath = $_FILES["document"]["tmp_name"][$i];
        $document = $_FILES["document"]["name"][$i];
        $sql_document = "INSERT INTO attachments (item_id, filename) VALUES ('$ID', '$document')";
        if ($tmpFilePath != "") {
            if (mysqli_query($conn, $sql_document))
                    { echo "Document " . $document . " added successfully.<br>"; }
            else    { echo "Error:" . $sql_document . "<br>" . mysqli_error($conn); }

        $uploadfile = $uploaddir . $document;

        if (move_uploaded_file($tmpFilePath, $uploadfile))
                    { echo "Document " . $document . " uploaded.<br>"; } 
        else        { echo '<pre>';
                      echo "Error during uploading.\n";
                      print_r($_FILES);
                      print "</pre>"; }
        }
        }
}

?>

<?php
# target=\"_blank\"
    include 'connector.php';
    $key=$_GET["key"];
    $array = array();
    $sql1 = "select local_id from items where local_id LIKE '%{$key}%'";
    $result1 = mysqli_query($conn, $sql1);
    $sql2 = "select local_id, description from items where description LIKE '%{$key}%'";
    $result2 = mysqli_query($conn, $sql2);
    while ($row = mysql_fetch_assoc($result1))
    {
      #echo $row['local_id'];
      #$array[] = $row['local_id']
      $array[] = "<a href=\"item.php?id=" . $row['local_id'] . "\">" . $row['local_id'] . "</a>";
    }
    while ($row = mysqli_fetch_assoc($result2))
    {
      #echo $row['local_id'];
      #$array[] = $row['local_id']
      $array[] = "<a href=\"item.php?id=" . $row['local_id'] . "\">" . $row['description'] . "</a>";
    }
    echo json_encode($array);
?>

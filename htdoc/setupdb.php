<?php

include 'connector.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = [];

$attachments = "CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `item_id` int(8) NOT NULL,
  `item_type` text NOT NULL,
  `filename` text NOT NULL,
  `disk_filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8";



$history = "CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_field` date NOT NULL,
  `log` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8";



$images = "CREATE TABLE IF NOT EXISTS `images` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `item_id` int(8) NOT NULL,
  `filename` text NOT NULL,
  `disk_filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8";



$items = "CREATE TABLE IF NOT EXISTS `items` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `local_id` char(8) NOT NULL,
  `category` text NOT NULL,
  `status` text NOT NULL,
  `description` longtext NOT NULL,
  `manufacture` text NOT NULL,
  `model` text NOT NULL,
  `serial` text NOT NULL,
  `location` text NOT NULL,
  `transport` text NOT NULL,
  `room` int(11) NOT NULL,
  `responsible` text NOT NULL,
  `supplier` text NOT NULL,
  `purchase_date` date NOT NULL,
  `warranty` int(11) NOT NULL,
  `depreciation` int(11) NOT NULL,
  `purchase_value` int(11) NOT NULL,
  `insurance_value` int(11) NOT NULL,
  `insurance_date` date NOT NULL,
  `insurance_duration` int(11) NOT NULL,
  `ownership` text NOT NULL,
  `liquidation` text NOT NULL,
  `scrap` text NOT NULL,
  `calibration` text NOT NULL,
  `calibration_responsible` text NOT NULL,
  `calibration_class` text NOT NULL,
  `calibration_interval` int(11) NOT NULL,
  `calibration_last` date NOT NULL,
  `calibration_next` date NOT NULL,
  `calibration_virified_by` text NOT NULL,
  `id_old` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `local_id` (`local_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8";

$tables = [$attachments, $history, $images, $items];

foreach($tables as $k => $sql){
    $query = @$conn->query($sql);

    if(!$query)
       $errors[] = "Table $k : Creation failed ($conn->error)";
    else
       $errors[] = "Table $k : Creation done";
}


foreach($errors as $msg) {
   echo "$msg <br>";
}

$conn->close();
?>

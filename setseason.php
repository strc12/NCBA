<?php

require_once(__DIR__ . '/sessions.php');

include_once('connection.php');

	$stmt = $conn->prepare("Select Season FROM TblSeason WHERE current=1");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$_SESSION["Season"]=$row["Season"];
     
		}

    ?>
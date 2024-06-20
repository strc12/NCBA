<?php
session_start();
print_r($_POST);
echo("<br>");
print_r($_SESSION);

include_once ("connection.php");
$sql = "UPDATE TblMatches SET 
m1hpts = :m1hpts, m1apts = :m1apts,
m2hpts = :m2hpts, m2apts = :m2apts,
m3hpts = :m3hpts, m3apts = :m3apts,
m4hpts = :m4hpts, m4apts = :m4apts,
m5hpts = :m5hpts, m5apts = :m5apts,
m6hpts = :m6hpts, m6apts = :m6apts,
m7hpts = :m7hpts, m7apts = :m7apts,
m8hpts = :m8hpts, m8apts = :m8apts,
m9hpts = :m9hpts, m9apts = :m9apts,
m10hpts = :m10hpts, m10apts = :m10apts,
m11hpts = :m11hpts, m11apts = :m11apts,
m12hpts = :m12hpts, m12apts = :m12apts,
m13hpts = :m13hpts, m13apts = :m13apts,
m14hpts = :m14hpts, m14apts = :m14apts,
m15hpts = :m15hpts, m15apts = :m15apts,
m16hpts = :m16hpts, m16apts = :m16apts,
m17hpts = :m17hpts, m17apts = :m17apts,
m18hpts = :m18hpts, m18apts = :m18apts,
m19hpts = :m19hpts, m19apts = :m19apts,
m20hpts = :m20hpts, m20apts = :m20apts,
m21hpts = :m21hpts, m21apts = :m21apts,
m22hpts = :m22hpts, m22apts = :m22apts,
m23hpts = :m23hpts, m23apts = :m23apts,
m24hpts = :m24hpts, m24apts = :m23apts,
m25hpts = :m25hpts, m25apts = :m25apts,
m26hpts = :m26hpts, m26apts = :m26apts,
m27hpts = :m27hpts, m27apts = :m27apts 
 WHERE MatchID = :id";
$stmt = $conn->prepare($sql);
$params=[
    ':p1h' => $_POST['HomeP1ID'], 
    ':p2h' => $_POST['HomeP2ID'], 
    ':p3h' => $_POST['HomeP3ID'],
    ':p4h' => $_POST['HomeP4ID'],
    ':p5h' => $_POST['HomeP5ID'],
    ':p6h' => $_POST['HomeP6ID'],
    ':p1a' => $_POST['AwayP1ID'], 
    ':p2a' => $_POST['AwayP2ID'], 
    ':p3a' => $_POST['AwayP3ID'],
    ':p4a' => $_POST['AwayP4ID'],
    ':p5a' => $_POST['AwayP5ID'],
    ':p6a' => $_POST['AwayP6ID'],
    ':id'=> $_SESSION["curmatch"]
];
$stmt->execute($params);
?>
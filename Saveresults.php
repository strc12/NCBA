<script>
    sessionStorage.clear(); 
</script>
<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
print_r($_POST);
echo("<br>");
print_r($_SESSION);

include_once ("connection.php");
$sql = "UPDATE TblMatches SET 
m1h = :m1hpts, m1a = :m1apts,
m2h = :m2hpts, m2a = :m2apts,
m3h= :m3hpts, m3a= :m3apts,
m4h = :m4hpts, m4a = :m4apts,
m5h = :m5hpts, m5a = :m5apts,
m6h = :m6hpts, m6a = :m6apts,
m7h = :m7hpts, m7a = :m7apts,
m8h = :m8hpts, m8a = :m8apts,
m9h = :m9hpts, m9a = :m9apts,
m10h = :m10hpts, m10a = :m10apts,
m11h = :m11hpts, m11a = :m11apts,
m12h = :m12hpts, m12a = :m12apts,
m13h = :m13hpts, m13a = :m13apts,
m14h = :m14hpts, m14a = :m14apts,
m15h = :m15hpts, m15a = :m15apts,
m16h = :m16hpts, m16a = :m16apts,
m17h = :m17hpts, m17a = :m17apts,
m18h = :m18hpts, m18a = :m18apts,
m19h = :m19hpts, m19a = :m19apts,
m20h = :m20hpts, m20a = :m20apts,
m21h = :m21hpts, m21a = :m21apts,
m22h = :m22hpts, m22a = :m22apts,
m23h = :m23hpts, m23a = :m23apts,
m24h = :m24hpts, m24a = :m23apts,
m25h = :m25hpts, m25a = :m25apts,
m26h = :m26hpts, m26a = :m26apts,
m27h = :m27hpts, m27a = :m27apts,
resultsentered =1
WHERE MatchID = :id";
$stmt = $conn->prepare($sql);
$params=[
    ":m1hpts"=> $_POST["m1hpts"],
    ":m2hpts"=> $_POST["m2hpts"],
    ":m3hpts"=> $_POST["m3hpts"],
    ":m4hpts"=> $_POST["m4hpts"],
    ":m5hpts"=> $_POST["m5hpts"],
    ":m6hpts"=> $_POST["m6hpts"],
    ":m7hpts"=> $_POST["m7hpts"],
    ":m8hpts"=> $_POST["m8hpts"],
    ":m9hpts"=> $_POST["m9hpts"],
    ":m10hpts"=> $_POST["m10hpts"],
    ":m11hpts"=> $_POST["m11hpts"],
    ":m12hpts"=> $_POST["m12hpts"],
    ":m13hpts"=> $_POST["m13hpts"],
    ":m14hpts"=> $_POST["m14hpts"],
    ":m15hpts"=> $_POST["m15hpts"],
    ":m16hpts"=> $_POST["m16hpts"],
    ":m17hpts"=> $_POST["m17hpts"],
    ":m18hpts"=> $_POST["m18hpts"],
    ":m19hpts"=> $_POST["m19hpts"],
    ":m20hpts"=> $_POST["m20hpts"],
    ":m21hpts"=> $_POST["m21hpts"],
    ":m22hpts"=> $_POST["m22hpts"],
    ":m23hpts"=> $_POST["m23hpts"],
    ":m24hpts"=> $_POST["m24hpts"],
    ":m25hpts"=> $_POST["m25hpts"],
    ":m26hpts"=> $_POST["m26hpts"],
    ":m27hpts"=> $_POST["m27hpts"],
    ":m1apts"=> $_POST["m1apts"],
    ":m2apts"=> $_POST["m2apts"],
    ":m3apts"=> $_POST["m3apts"],
    ":m4apts"=> $_POST["m4apts"],
    ":m5apts"=> $_POST["m5apts"],
    ":m6apts"=> $_POST["m6apts"],
    ":m7apts"=> $_POST["m7apts"],
    ":m8apts"=> $_POST["m8apts"],
    ":m9apts"=> $_POST["m9apts"],
    ":m10apts"=> $_POST["m10apts"],
    ":m11apts"=> $_POST["m11apts"],
    ":m12apts"=> $_POST["m12apts"],
    ":m13apts"=> $_POST["m13apts"],
    ":m14apts"=> $_POST["m14apts"],
    ":m15apts"=> $_POST["m15apts"],
    ":m16apts"=> $_POST["m16apts"],
    ":m17apts"=> $_POST["m17apts"],
    ":m18apts"=> $_POST["m18apts"],
    ":m19apts"=> $_POST["m19apts"],
    ":m20apts"=> $_POST["m20apts"],
    ":m21apts"=> $_POST["m21apts"],
    ":m22apts"=> $_POST["m22apts"],
    ":m23apts"=> $_POST["m23apts"],
    ":m24apts"=> $_POST["m24apts"],
    ":m25apts"=> $_POST["m25apts"],
    ":m26apts"=> $_POST["m26apts"],
    ":m27apts"=> $_POST["m27apts"],
    ':id'=> $_SESSION["curmatch"]
];
$stmt->execute($params);
header('Location: index.php');
?>
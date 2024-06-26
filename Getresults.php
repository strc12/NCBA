<!DOCTYPE html>
<html>
<head>
<title>Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
<style>

td,th{
    text-align:center;
}
</style>
</head>
<body>

<?php
include ("setseason.php");
$q = intval($_GET['q']);

include_once ("connection.php");

$stmt = $conn->prepare("SELECT TblMatches.FixtureDate, 
TblMatches.HomeP1ID,TblMatches.HomeP2ID,
TblMatches.HomeP3ID,TblMatches.HomeP4ID,
TblMatches.HomeP5ID,TblMatches.HomeP6ID,TblMatches.AwayP1ID,TblMatches.AwayP2ID,
TblMatches.AwayP3ID,TblMatches.AwayP4ID,TblMatches.AwayP5ID,TblMatches.AwayP6ID,
TblMatches.m1h,TblMatches.m2h,TblMatches.m3h,TblMatches.m4h,
TblMatches.m5h,TblMatches.m6h,TblMatches.m7h,TblMatches.m8h,
TblMatches.m9h,TblMatches.m10h,TblMatches.m11h,TblMatches.m12h,
TblMatches.m13h,TblMatches.m14h,TblMatches.m15h,TblMatches.m16h,
TblMatches.m17h,TblMatches.m18h,TblMatches.m19h,TblMatches.m20h,
TblMatches.m21h,TblMatches.m22h,TblMatches.m23h,TblMatches.m24h,
TblMatches.m25h,TblMatches.m26h,TblMatches.m27h,
TblMatches.m1a,TblMatches.m2a,TblMatches.m3a,TblMatches.m4a,
TblMatches.m5a,TblMatches.m6a,TblMatches.m7a,TblMatches.m8a,
TblMatches.m9a,TblMatches.m10a,TblMatches.m11a,TblMatches.m12a,
TblMatches.m13a,TblMatches.m14a,TblMatches.m15a,TblMatches.m16a,
TblMatches.m17a,TblMatches.m18a,TblMatches.m19a,TblMatches.m20a,
TblMatches.m21a,TblMatches.m22a,TblMatches.m23a,TblMatches.m24a,
TblMatches.m25a,TblMatches.m26a,TblMatches.m27a,
TblMatches.HomeID as Hid, TblMatches.AwayID as Aid,  
awt.Clubname as AWC, ht.Clubname as HC, 
TblMatches.DivisionID,
home.Name as HN, away.Name as AWN,
Lg.Name as LGN, divs.Name as DIVN
FROM TblMatches 
INNER JOIN tblclubhasteam as home ON (TblMatches.HomeID = home.clubhasteamID) 
INNER JOIN tblclubhasteam as away ON (TblMatches.AwayID=away.clubhasteamID) 
INNER JOIN tblclub as awt ON (away.ClubID=awt.ClubID )
INNER JOIN tblclub as ht ON (home.ClubID=ht.ClubID) 
INNER JOIN tblDivision as divs ON (divs.DivisionID = TblMatches.DivisionID)
INNER JOIN tblleague as Lg ON (divs.LeagueID = Lg.LeagueID)
WHERE TblMatches.MatchID=:fid " );
$stmt->bindParam(':fid', $q);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($row);
echo("<h3>".$row['HC']." - ".$row['HN']." v ".$row['AWC']." - ".$row['AWN']."</H3>");
echo("<h3>".$row['LGN']." - ".$row['DIVN']."</H3>");

$Hometotal=$row["m1h"]+$row["m2h"]+$row["m3h"]+$row["m4h"]+$row["m5h"]+$row["m6h"]+$row["m7h"]+$row["m8h"]+$row["m9h"]+$row["m10h"]
+$row["m11h"]+$row["m12h"]+$row["m13h"]+$row["m14h"]+$row["m15h"]+$row["m16h"]+$row["m17h"]+$row["m18h"]+$row["m19h"]+$row["m20h"]
+$row["m21h"]+$row["m22h"]+$row["m23h"]+$row["m24h"]+$row["m25h"]+$row["m26h"]+$row["m27h"];
$Awaytotal=$row["m1a"]+$row["m2a"]+$row["m3a"]+$row["m4a"]+$row["m5a"]+$row["m6a"]+$row["m7a"]+$row["m8a"]+$row["m9a"]+$row["m10a"]
+$row["m11a"]+$row["m12a"]+$row["m13a"]+$row["m14a"]+$row["m15a"]+$row["m16a"]+$row["m17a"]+$row["m18a"]+$row["m19a"]+$row["m20a"]
+$row["m21a"]+$row["m22a"]+$row["m23a"]+$row["m24a"]+$row["m25a"]+$row["m26a"]+$row["m27a"];
echo($Hometotal);
echo($Awaytotal);
$homegametotal = 0;
$awaygametotal = 0;

// Number of matches
$matches = 27;

for ($i = 1; $i <= $matches; $i++) {
    if ($row["m{$i}h"] > $row["m{$i}a"]) {
        $homegametotal += 1;
    } else if ($row["m{$i}h"] < $row["m{$i}a"]) {
        $awaygametotal += 1;
    }
}
echo($homegametotal);
echo($awaygametotal);
$homerubbertotal = 0;
$awayrubbertotal = 0;

// Number of matches
$matches = 9;


for ($i = 1; $i <= $matches; $i++) {
    $hometemp =0;
    $awaytemp=0;

    for ($j = 1; $j <= 3; $j++) {

        if ($row["m{$i}h"] > $row["m{$i}a"]) {
            $hometemp += 1;
        } else if ($row["m{$i}h"] < $row["m{$i}a"]) {
            $awaytemp += 1;
        }
    if ($awaytemp<$hometemp){
        $homerubbertotal+=1;
    }else{
        $awayrubbertotal+1;
    }
}
}
echo("<br>");
echo($homerubbertotal);
echo($awayrubbertotal);
echo($row["FixtureDate"]."<br>");
echo("<table style = 'width:60%'  class='table-bordered table-condensed'>");
echo("<thead class='thead-dark'></thead><tr><th colspan='3'></th><th>Home</th><th>Away</th><th></th><th></th></tr>");
echo("<tr><th colspan='3'></th><th>".$row["HC"]." ".$row["HN"]."</th><th>".$row["AWC"]." ".$row["AWN"]."</th><th></th><th></th></tr></thead>");

echo("<tr></tr><td colspan='3'>Man1</td><td>".$row["HomeP1ID"]." ".$row["HomeP2ID"]."</td><td>".$row["HomeP1ID"]." ".$row["HomeP1ID"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Man2</td><td>".$row["M2f"]." ".$row["M2s"]."</td><td>".$row["AM2f"]." ".$row["AM2s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Man3</td><td>".$row["M3f"]." ".$row["M3s"]."</td><td>".$row["AM3f"]." ".$row["AM3s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Lady1</td><td>".$row["L1f"]." ".$row["L1s"]."</td><td>".$row["AL1f"]." ".$row["AL1s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Lady2</td><td>".$row["L2f"]." ".$row["L2s"]."</td><td>".$row["AL2f"]." ".$row["AL2s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Lady3</td><td>".$row["L3f"]." ".$row["L3s"]."</td><td>".$row["AL3f"]." ".$row["AL3s"]."</td><td></td><td></td></tr>");
echo("<tr><td></td><td></td><td></td><td></td><td></td></tr>");
echo("<tr></tr><td>".$row["M1f"]."</td><td>v</td><td>".$row["AM1f"]."</td><td>".$row["M1H1"]."</td><td>".$row["M1A1"]."</td>
<td>".($row["M1H1"] > $row["M1A1"]?1:0)."<td>".($row["M1H1"] < $row["M1A1"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");
echo("<tr></tr><td>".$row["L1f"]."</td><td>v</td><td>".$row["AL1f"]."</td><td>".$row["M2H1"]."</td><td>".$row["M2A1"]."</td>
<td>".($row["M2H1"] > $row["M2A1"]?1:0)."<td>".($row["M2H1"] < $row["M2A1"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["M2f"]." and ".$row["M3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AM2f"]." and ".$row["AM3f"]."</td>
<td>".$row["M3H1"]."</td><td>".$row["M3A1"]."</td><td>".($row["M3H1"] > $row["M3A1"]?1:0)."</td><td>".($row["M3H1"] < $row["M3A1"]?1:0)."</td></tr>
<td>".$row["M3H2"]."</td><td>".$row["M3A2"]."</td><td>".($row["M3H2"] > $row["M3A2"]?1:0)."</td><td>".($row["M3H2"] < $row["M3A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L2f"]." and ".$row["L3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL2f"]." and ".$row["AL3f"]."</td>
<td>".$row["M4H1"]."</td><td>".$row["M4A1"]."</td><td>".($row["M4H1"] > $row["M4A1"]?1:0)."</td><td>".($row["M4H1"] < $row["M4A1"]?1:0)."</td></tr>
<td>".$row["M4H2"]."</td><td>".$row["M4A2"]."</td><td>".($row["M4H2"] > $row["M4A2"]?1:0)."</td><td>".($row["M4H2"] < $row["M4A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["M1f"]." and ".$row["M2f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AM1f"]." and ".$row["AM2f"]."</td>
<td>".$row["M5H1"]."</td><td>".$row["M5A1"]."</td><td>".($row["M5H1"] > $row["M5A1"]?1:0)."</td><td>".($row["M5H1"] < $row["M5A1"]?1:0)."</td></tr>
<td>".$row["M5H2"]."</td><td>".$row["M5A2"]."</td><td>".($row["M5H2"] > $row["M5A2"]?1:0)."</td><td>".($row["M5H2"] < $row["M5A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L1f"]." and ".$row["L2f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL1f"]." and ".$row["AL2f"]."</td>
<td>".$row["M6H1"]."</td><td>".$row["M6A1"]."</td><td>".($row["M6H1"] > $row["M6A1"]?1:0)."</td><td>".($row["M6H1"] < $row["M6A1"]?1:0)."</td></tr>
<td>".$row["M6H2"]."</td><td>".$row["M6A2"]."</td><td>".($row["M6H2"] > $row["M6A2"]?1:0)."</td><td>".($row["M6H2"] < $row["M6A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L3f"]." and ".$row["M3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL3f"]." and ".$row["AM3f"]."</td>
<td>".$row["M7H1"]."</td><td>".$row["M7A1"]."</td><td>".($row["M7H1"] > $row["M7A1"]?1:0)."<td>".($row["M7H1"] < $row["M7A1"]?1:0)."</td></tr>
<td>".$row["M7H2"]."</td><td>".$row["M7A2"]."</td><td>".($row["M7H2"] > $row["M7A2"]?1:0)."<td>".($row["M7H2"] < $row["M7A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L1f"]." and ".$row["M1f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL1f"]." and ".$row["AM1f"]."</td>
<td>".$row["M8H1"]."</td><td>".$row["M8A1"]."</td><td>".($row["M8H1"] > $row["M8A1"]?1:0)."<td>".($row["M8H1"] < $row["M8A1"]?1:0)."</td></tr>
<td>".$row["M8H2"]."</td><td>".$row["M8A2"]."</td><td>".($row["M8H2"] > $row["M8A2"]?1:0)."<td>".($row["M8H2"] < $row["M8A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L3f"]." and ".$row["M2f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL3f"]." and ".$row["AM2f"]."</td>
<td>".$row["M9H1"]."</td><td>".$row["M9A1"]."</td><td>".($row["M9H1"] > $row["M9A1"]?1:0)."<td>".($row["M9H1"] < $row["M9A1"]?1:0)."</td></tr>
<td>".$row["M9H2"]."</td><td>".$row["M9A2"]."</td><td>".($row["M9H2"] > $row["M9A2"]?1:0)."<td>".($row["M9H2"] < $row["M9A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L2f"]." and ".$row["M3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL2f"]." and ".$row["AM3f"]."</td>
<td>".$row["M10H1"]."</td><td>".$row["M10A1"]."</td><td>".($row["M10H1"] > $row["M10A1"]?1:0)."<td>".($row["M10H1"] < $row["M10A1"]?1:0)."</td></tr>
<td>".$row["M10H2"]."</td><td>".$row["M10A2"]."</td><td>".($row["M10H2"] > $row["M10A2"]?1:0)."<td>".($row["M10H2"] < $row["M10A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");
echo("<tr><td></td><td></td><td>Totals</td><td>".$Hometotal."</td><td>".$Awaytotal."</td><td>".$homegametotal."</td><td>".$awaygametotal."</td></tr>");
echo("</table>");
$conn=null; 


?>

</body>
</html>
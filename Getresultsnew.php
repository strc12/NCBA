<!DOCTYPE html>
<html lang="en">
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <style>
    #result {
            z-index: 1;
            position: relative; /* Ensure it's positioned relative to its parent */
        }

        /* Ensure container has a higher z-index */
        .container-fluid {
            z-index: 1; /* Higher than navbar */
            position: relative; /* Establish stacking context */
        }
        td, th {
            text-align: center;
        }
    </style>
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<?php
include ("setseason.php");
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


include_once ("connection.php");
// Check if the form is submitted to update the item
$q=$_GET['q'];

$stmt1=$conn->prepare("SELECT TblLeague.LeagueID from  TblMatches 
INNER JOIN TblDivision on TblMatches.DivisionID = TblDivision.DivisionID
INNER JOIN TblLeague on TblLeague.LeagueID = TblDivision.LeagueID
where MatchID=:mid");
$stmt1->bindParam(':mid', $q);
$stmt1->execute();
$row = $stmt1->fetch(PDO::FETCH_ASSOC);

$league=$row["LeagueID"];
/* unset($_SESSION["curleague"]);
$_SESSION["curleague"]=$league; */
if ($league==4){
    #Ladies
    
    $stmt=$conn->prepare("SELECT TblMatches.Fixturedate, 
    TblMatches.m1h,TblMatches.m1a,
    TblMatches.m2h,TblMatches.m2a,
    TblMatches.m3h,TblMatches.m3a,
    TblMatches.m4h,TblMatches.m4a,
    TblMatches.m5h,TblMatches.m5a,
    TblMatches.m6h,TblMatches.m6a,
    TblMatches.m7h,TblMatches.m7a,
    TblMatches.m8h,TblMatches.m8a,
    TblMatches.m9h,TblMatches.m9a,
    TblMatches.m10h,TblMatches.m10a,
    TblMatches.m11h,TblMatches.m11a,
    TblMatches.m12h,TblMatches.m12a,
    TblMatches.m13h,TblMatches.m13a,
    TblMatches.m14h,TblMatches.m14a,
    TblMatches.m15h,TblMatches.m15a,
    TblMatches.m16h,TblMatches.m16a,
    TblMatches.m17h,TblMatches.m17a,
    TblMatches.m18h,TblMatches.m18a,
    
    TblMatches.HomeID as Home, TblMatches.AwayID as Away,  
    P1.Forename as P1f, P1.Surname as P1s, 
    P2.Forename as P2f, P2.Surname as P2s,
    P3.Forename as P3f, P3.Surname as P3s,
    P4.Forename as P4f, P4.Surname as P4s,
    
    AP1.Forename as AP1f, AP1.Surname as AP1s, 
    AP2.Forename as AP2f, AP2.Surname as AP2s,
    AP3.Forename as AP3f, AP3.Surname as AP3s,
    AP4.Forename as AP4f, AP4.Surname as AP4s,
    
    awc.CLubname as AWC, hc.Clubname as HC,
    awt.Name as AWT, ht.Name as HT

    FROM TblMatches 
    INNER JOIN  TblPlayers as P1 on HomeP1ID = P1.PlayerID
    INNER JOIN  TblPlayers as P2 on HomeP2ID = P2.PlayerID
    INNER JOIN  TblPlayers as P3 on HomeP3ID = P3.PlayerID
    INNER JOIN  TblPlayers as P4 on HomeP4ID = P4.PlayerID
    
    INNER JOIN  TblPlayers as AP1 on AwayP1ID = AP1.PlayerID
    INNER JOIN  TblPlayers as AP2 on AwayP2ID = AP2.PlayerID
    INNER JOIN  TblPlayers as AP3 on AwayP3ID = AP3.PlayerID
    INNER JOIN  TblPlayers as AP4 on AwayP4ID = AP4.PlayerID
   
    INNER JOIN TblClubhasteam as ht ON (TblMatches.HomeID = ht.ClubhasteamID) 
    INNER JOIN TblClubhasteam as awt ON (TblMatches.AwayID=awt.ClubhasteamID) 
    INNER JOIN TblClub as awc ON awt.ClubID=awc.ClubID 
    INNER JOIN TblClub as hc ON ht.ClubID=hc.ClubID 
    WHERE TblMatches.MatchID=:id" );
    $stmt->bindParam(':id', $q);
    $stmt->execute();
    }else{
    
    $stmt=$conn->prepare("SELECT TblMatches.Fixturedate, 
    TblMatches.m1h,TblMatches.m1a,
    TblMatches.m2h,TblMatches.m2a,
    TblMatches.m3h,TblMatches.m3a,
    TblMatches.m4h,TblMatches.m4a,
    TblMatches.m5h,TblMatches.m5a,
    TblMatches.m6h,TblMatches.m6a,
    TblMatches.m7h,TblMatches.m7a,
    TblMatches.m8h,TblMatches.m8a,
    TblMatches.m9h,TblMatches.m9a,
    TblMatches.m10h,TblMatches.m10a,
    TblMatches.m11h,TblMatches.m11a,
    TblMatches.m12h,TblMatches.m12a,
    TblMatches.m13h,TblMatches.m13a,
    TblMatches.m14h,TblMatches.m14a,
    TblMatches.m15h,TblMatches.m15a,
    TblMatches.m16h,TblMatches.m16a,
    TblMatches.m17h,TblMatches.m17a,
    TblMatches.m18h,TblMatches.m18a,
    TblMatches.m19h,TblMatches.m19a,
    TblMatches.m20h,TblMatches.m20a,
    TblMatches.m21h,TblMatches.m21a,
    TblMatches.m22h,TblMatches.m22a,
    TblMatches.m23h,TblMatches.m23a,
    TblMatches.m24h,TblMatches.m24a,
    TblMatches.m25h,TblMatches.m25a,
    TblMatches.m26h,TblMatches.m26a,
    TblMatches.m27h,TblMatches.m27a,
    TblMatches.HomeID as Home, TblMatches.AwayID as Away,  
    P1.Forename as P1f, P1.Surname as P1s, 
    P2.Forename as P2f, P2.Surname as P2s,
    P3.Forename as P3f, P3.Surname as P3s,
    P4.Forename as P4f, P4.Surname as P4s,
    P5.Forename as P5f, P5.Surname as P5s,
    P6.Forename as P6f, P6.Surname as P6s,
    AP1.Forename as AP1f, AP1.Surname as AP1s, 
    AP2.Forename as AP2f, AP2.Surname as AP2s,
    AP3.Forename as AP3f, AP3.Surname as AP3s,
    AP4.Forename as AP4f, AP4.Surname as AP4s,
    AP5.Forename as AP5f, AP5.Surname as AP5s,
    AP6.Forename as AP6f, AP6.Surname as AP6s,
    awc.CLubname as AWC, hc.Clubname as HC,
    awt.Name as AWT, ht.Name as HT

    FROM TblMatches 
    INNER JOIN  TblPlayers as P1 on HomeP1ID = P1.PlayerID
    INNER JOIN  TblPlayers as P2 on HomeP2ID = P2.PlayerID
    INNER JOIN  TblPlayers as P3 on HomeP3ID = P3.PlayerID
    INNER JOIN  TblPlayers as P4 on HomeP4ID = P4.PlayerID
    INNER JOIN  TblPlayers as P5 on HomeP5ID = P5.PlayerID
    INNER JOIN  TblPlayers as P6 on HomeP6ID = P6.PlayerID
    INNER JOIN  TblPlayers as AP1 on AwayP1ID = AP1.PlayerID
    INNER JOIN  TblPlayers as AP2 on AwayP2ID = AP2.PlayerID
    INNER JOIN  TblPlayers as AP3 on AwayP3ID = AP3.PlayerID
    INNER JOIN  TblPlayers as AP4 on AwayP4ID = AP4.PlayerID
    INNER JOIN  TblPlayers as AP5 on AwayP5ID = AP5.PlayerID
    INNER JOIN  TblPlayers as AP6 on AwayP6ID = AP6.PlayerID
    INNER JOIN TblClubhasteam as ht ON (TblMatches.HomeID = ht.ClubhasteamID) 
    INNER JOIN TblClubhasteam as awt ON (TblMatches.AwayID=awt.ClubhasteamID) 
    INNER JOIN TblClub as awc ON awt.ClubID=awc.ClubID 
    INNER JOIN TblClub as hc ON ht.ClubID=hc.ClubID 
    WHERE TblMatches.MatchID=:id" );
    $stmt->bindParam(':id', $q);
    $stmt->execute();

    }
    
$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<div class="container-fluid" style="margin-top:40px">
    <h3>Scores</h3>
    <?php

    if ($league==3){
        echo("Doubles");
    
    }else if ($league==4){
        echo("Ladies");
    }else if ($league==2){
        echo("Mixed");
    }else{
        echo("Open");
    }
   
    ?>
    <table style="width:80%" class="table-bordered table-condensed">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2"><?php echo $row['HC'] . " " . $row['HT']; ?></th>
            <th rowspan="2"> </th>
            <th rowspan="2"><?php echo $row['AWC'] . " " . $row['AWT']; ?></th>
            <th colspan="2">Points</th>
            <th colspan="2">Rubbers</th>
            <th colspan="2">Games</th>
        </tr>
        <tr>
            <td><?php echo $row['HC'] . " " . $row['HT']; ?></td>
            <td><?php echo $row['AWC'] . " " . $row['AWT']; ?></td>
            <td><?php echo $row['HC'] . " " . $row['HT']; ?></td>
            <td><?php echo $row['AWC'] . " " . $row['AWT']; ?></td>
            <td><?php echo $row['HC'] . " " . $row['HT']; ?></td>
            <td><?php echo $row['AWC'] . " " . $row['AWT']; ?></td>
        </tr>
        <?php
       if ($league==2){
        #mixed
        $pairs = [
            1 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            2 => ['P2f', 'P2s', 'P5f', 'P5s', 'AP2f', 'AP2s', 'AP5f', 'AP5s'],
            3 => ['P3f', 'P3s', 'P6f', 'P6s', 'AP3f', 'AP3s', 'AP6f', 'AP6s'],
            4 => ['P2f', 'P2s', 'P5f', 'P5s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            5 => ['P3f', 'P3s', 'P6f', 'P6s', 'AP2f', 'AP2s', 'AP5f', 'AP5s'],
            6 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP3f', 'AP3s', 'AP6f', 'AP6s'],
            7 => ['P3f', 'P3s', 'P6f', 'P6s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            8 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP2f', 'AP2s', 'AP5f', 'AP5s'],
            9 => ['P2f', 'P2s', 'P5f', 'P5s', 'AP3f', 'AP3s', 'AP6f', 'AP6s']
        ];
    }else if ($league==4){
        #Ladies
        $pairs = [
            1 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
            2 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
            3 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            4 => ['P2f', 'P2s', 'P3f', 'P3s', 'AP2f', 'AP2s', 'AP3f', 'AP3s'],
            5 => ['P2f', 'P2s', 'P4f', 'P4s', 'AP2f', 'AP2s', 'AP4f', 'AP4s'],
            6 => ['P1f', 'P1s', 'P3f', 'P3s', 'AP1f', 'AP1s', 'AP3f', 'AP3s'] 
        ];
    }else if ($league==3){
        #doubles
        $pairs = [
            1 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            2 => ['P2f', 'P2s', 'P5f', 'P5s', 'AP2f', 'AP2s', 'AP5f', 'AP5s'],
            3 => ['P3f', 'P3s', 'P6f', 'P6s', 'AP3f', 'AP3s', 'AP6f', 'AP6s'],
            4 => ['P2f', 'P2s', 'P5f', 'P5s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            5 => ['P3f', 'P3s', 'P6f', 'P6s', 'AP2f', 'AP2s', 'AP5f', 'AP5s'],
            6 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP3f', 'AP3s', 'AP6f', 'AP6s'],
            7 => ['P3f', 'P3s', 'P6f', 'P6s', 'AP1f', 'AP1s', 'AP4f', 'AP4s'],
            8 => ['P1f', 'P1s', 'P4f', 'P4s', 'AP2f', 'AP2s', 'AP5f', 'AP5s'],
            9 => ['P2f', 'P2s', 'P5f', 'P5s', 'AP3f', 'AP3s', 'AP6f', 'AP6s']
        ];
    }else{
        #open
        $pairs = [
            1 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
            2 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
            3 => ['P5f', 'P5s', 'P6f', 'P6s', 'AP5f', 'AP5s', 'AP6f', 'AP6s'],
            4 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
            5 => ['P5f', 'P5s', 'P6f', 'P6s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
            6 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP5f', 'AP5s', 'AP6f', 'AP6s'],
            7 => ['P5f', 'P5s', 'P6f', 'P6s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
            8 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
            9 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP5f', 'AP5s', 'AP6f', 'AP6s']
        ];
    }
    
    #format of open and mixed? need alternative for Doubles/ladies
    $nomatches=count($pairs);
    $_SESSION["nomatches"]=$nomatches;
    
        for ($k = 1; $k <= $nomatches; $k++) {
        ?>
            <tr>
                <td rowspan="3"><?php echo $k; ?></td>
                <td rowspan="3"><?php echo $row[$pairs[$k][0]] . " " . $row[$pairs[$k][1]] . " & " . $row[$pairs[$k][2]] . " " . $row[$pairs[$k][3]]; ?></td>
                <td rowspan="3">v</td>
                <td rowspan="3"><?php echo $row[$pairs[$k][4]] . " " . $row[$pairs[$k][5]] . " & " . $row[$pairs[$k][6]] . " " . $row[$pairs[$k][7]]; ?></td>
                <?php
                for ($j = 0; $j <= 2; $j++) {
                    $v = 3 * $k - 2 + $j;
                ?>
                    <td id="m<?php echo $v; ?>h" name="m<?php echo $v; ?>h" onchange="totals()"><?php echo $row["m{$v}h"]; ?></td>
                    <td id="m<?php echo $v; ?>a" name="m<?php echo $v; ?>a" onchange="totals()" type="text"><?php echo $row["m{$v}a"]; ?></td>
                    <td id="m<?php echo $v; ?>hr">
                        <?php if ($row["m{$v}a"] < $row["m{$v}h"]) {
                            echo 1;
                        } else {
                            echo 0;
                        } ?>
                    </td>
                    <td id="m<?php echo $v; ?>ar">
                        <?php if ($row["m{$v}a"] > $row["m{$v}h"]) {
                            echo 1;
                        } else {
                            echo 0;
                        } ?>
                    </td>
                    <?php if ($j == 0) { ?>
                        <td rowspan="3" id="m<?php echo  $k; ?>hg"></td>
                        <td rowspan="3" id="m<?php echo  $k; ?>ag"></td>
                    </tr>
                    <?php } else { ?>
                        </tr>
                    <?php }
                }
            } ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Totals</td>
            <td id="homePointsTotal"></td>
            <td id="awayPointsTotal"></td>
            <td id="homeRubbersTotal"></td>
            <td id="awayRubbersTotal"></td>
            <td id="homeGamesTotal"></td>
            <td id="awayGamesTotal"></td>
        </tr>
    </table>

</div>
<script>
    function calculate() {
    var homePointsTotal = 0;
    var homeRubbersTotal = 0;
    var awayPointsTotal = 0;
    var awayRubbersTotal = 0;
    var homeGamesTotal = 0;
    var awayGamesTotal = 0;
    const element1 = document.querySelector('#m19h');
        
    if (element1) {
        count=9;
    }else{
        count=6;

    }
    // Iterate through each match
    for (var i = 1; i <= count; i++) {
        var homeRubbers = 0;
        var awayRubbers = 0;
        var homeGames = 0;
        var awayGames = 0;
        
            // Calculate rubbers and games for each match
            for (var j = 0; j <= 2; j++) {
                var v = 3 * i - 2 + j;
                
            
                
                var homeValue = parseFloat(document.getElementById('m' + v + 'hr').innerText);
                var awayValue = parseFloat(document.getElementById('m' + v + 'ar').innerText);
                //console.log(homeValue,awayValue);
                if (!isNaN(homeValue) && !isNaN(awayValue)) {
                    homeGames += homeValue;
                    awayGames += awayValue;
                }

                if (homeValue > awayValue) {
                    homeRubbers++;
                } else if (homeValue < awayValue) {
                    awayRubbers++;
                }
                
                homePointsTotal += parseFloat(document.getElementById('m' + v + 'h').innerText);
                awayPointsTotal += parseFloat(document.getElementById('m' + v + 'a').innerText);
                
            }

         
            homeRubbersTotal += homeRubbers;
            awayRubbersTotal += awayRubbers;
            

            // Update match result display
            if (homeRubbers > awayRubbers) {
                document.getElementById('m' + i + 'hg').innerText = "1";
                document.getElementById('m' + i + 'ag').innerText = "0";
                homeGamesTotal += 1;
            } else {
                document.getElementById('m' + i + 'hg').innerText = "0";
                document.getElementById('m' + i + 'ag').innerText = "1";
                awayGamesTotal += 1;
            }
            console.log(homeGamesTotal, awayGamesTotal);
    }
    // Update total displays
    document.getElementById('homePointsTotal').innerText = homePointsTotal;
    document.getElementById('homeRubbersTotal').innerText = homeRubbersTotal;
    document.getElementById('awayPointsTotal').innerText = awayPointsTotal;
    document.getElementById('awayRubbersTotal').innerText = awayRubbersTotal;
    document.getElementById('homeGamesTotal').innerText = homeGamesTotal;
    document.getElementById('awayGamesTotal').innerText = awayGamesTotal;
}
$(document).ready(function() {
    // Use jQuery to trigger the calculation when page loads
    calculate();
});

</script>
</body>
</html>
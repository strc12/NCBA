<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<div class="container-fluid">
<?php


// Prepare the initial query with multiple joins
$stmt = $conn->prepare("
    SELECT 
        TblLeague.LeagueID AS LeagueID, 
        TblLeague.Name AS LeagueName, 
        TblDivision.DivisionID AS DivisionID, 
        TblDivision.Name AS DivisionName, 
        TblClub.ClubID AS ClubID, 
        TblClub.Clubname AS ClubName, 
        TblClubhasteam.ClubhasteamID AS TeamID,
        TblClubhasteam.Name AS TeamName,
        TblDivision.Divisionrank as Rank
    FROM TblLeague
    LEFT JOIN TblDivision ON TblLeague.LeagueID = TblDivision.LeagueID
    LEFT JOIN TblClubhasteam ON TblDivision.DivisionID = TblClubhasteam.DivisionID
    LEFT JOIN TblClub ON TblClubhasteam.ClubID = TblClub.ClubID
    ORDER BY LeagueID ASC, Rank ASC
");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organize the data by League and Division
$leagues = [];
foreach ($data as $row) {
    $leagueID = $row['LeagueID'];
    $divisionID = $row['DivisionID'];
    $teamID = $row['TeamID'];

    // Organize leagues
    if (!isset($leagues[$leagueID])) {
        $leagues[$leagueID] = [
            'Name' => $row['LeagueName'],
            'Divisions' => []
        ];
    }

    // Organize divisions within each league
    if (!isset($leagues[$leagueID]['Divisions'][$divisionID])) {
        $leagues[$leagueID]['Divisions'][$divisionID] = [
            'Name' => $row['DivisionName'],
            'Teams' => []
        ];
    }

    // Add teams to the division
    if ($row['ClubName'] && $row['TeamName']) {
        $leagues[$leagueID]['Divisions'][$divisionID]['Teams'][$teamID] = [
            'ClubName' => $row['ClubName'],
            'TeamName' => $row['TeamName'],
            'TeamID' => $row['TeamID']
        ];
    }
}

// Output the organized data and process matches
echo("<h1>END OF SEASON LEAGUES</h1>");
foreach ($leagues as $league) {
    echo "<h2>" . htmlspecialchars($league['Name']) . "</h2>";

    foreach ($league['Divisions'] as $division) {
        echo "<h4>" . htmlspecialchars($division['Name']) . "</h4>";

        $leagueA = [];  // To store team results

        foreach ($division['Teams'] as $team) {
            $tid = $team["TeamID"];
            $stmt = $conn->prepare("
                SELECT TblMatches.Fixturedate, 
                TblMatches.m1h, TblMatches.m1a,
                TblMatches.m2h, TblMatches.m2a,
                TblMatches.m3h, TblMatches.m3a,
                TblMatches.m4h, TblMatches.m4a,
                TblMatches.m5h, TblMatches.m5a,
                TblMatches.m6h, TblMatches.m6a,
                TblMatches.m7h, TblMatches.m7a,
                TblMatches.m8h, TblMatches.m8a,
                TblMatches.m9h, TblMatches.m9a,
                TblMatches.m10h, TblMatches.m10a,
                TblMatches.m11h, TblMatches.m11a,
                TblMatches.m12h, TblMatches.m12a,
                TblMatches.m13h, TblMatches.m13a,
                TblMatches.m14h, TblMatches.m14a,
                TblMatches.m15h, TblMatches.m15a,
                TblMatches.m16h, TblMatches.m16a,
                TblMatches.m17h, TblMatches.m17a,
                TblMatches.m18h, TblMatches.m18a,
                TblMatches.m19h, TblMatches.m19a,
                TblMatches.m20h, TblMatches.m20a,
                TblMatches.m21h, TblMatches.m21a,
                TblMatches.m22h, TblMatches.m22a,
                TblMatches.m23h, TblMatches.m23a,
                TblMatches.m24h, TblMatches.m24a,
                TblMatches.m25h, TblMatches.m25a,
                TblMatches.m26h, TblMatches.m26a,
                TblMatches.m27h, TblMatches.m27a,
                TblMatches.HomeID as Home, TblMatches.AwayID as Away,  
                awc.Clubname as AWC, hc.Clubname as HC,
                awt.Name as AWT, ht.Name as HT
                FROM TblMatches 
                INNER JOIN TblClubhasteam as ht ON (TblMatches.HomeID = ht.ClubhasteamID) 
                INNER JOIN TblClubhasteam as awt ON (TblMatches.AwayID = awt.ClubhasteamID) 
                INNER JOIN TblClub as awc ON awt.ClubID = awc.ClubID 
                INNER JOIN TblClub as hc ON ht.ClubID = hc.ClubID 
                WHERE (TblMatches.HomeID = :id OR TblMatches.AwayID = :id) AND resultsentered = 1
            ");

            $stmt->bindParam(':id', $tid);
            $stmt->execute();

            $totpts = 0;
            $totrubbers = 0;
            $totrubberslost = 0;
            $totptsagainst = 0;
            $countm = 0;
            $totgames = 0;
            $totgameslost = 0;
            $points=0;
            if ($data["LeagueID"]=4){
                $mat=18;
            }else{
                $mat=27;
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $countm += 1;
                $Awaytotal = 0;
                $Hometotal = 0;
                #check re ladies
                for ($i = 1; $i <= $mat; $i++) {
                    $Awaytotal += $row["m" . $i . "a"];
                    $Hometotal += $row["m" . $i . "h"];
                }

                if ((int)$row["Home"] == $tid) {
                    $totpts += $Hometotal;
                    $totptsagainst += $Awaytotal;
                    $homerubbertotal = 0;
                    $rubberslost = 0;
                    $awaygamestotal = 0;
                    $homegamestotal = 0;
                    $count = 0;
                    $hrtemp = 0;
                    $artemp = 0;

                    for ($i = 1; $i <= $mat; $i++) {
                        if ($row["m" . $i . "h"] > $row["m" . $i . "a"]) {
                            $homerubbertotal += 1;
                            $hrtemp += 1;
                        } else if ($row["m" . $i . "h"] < $row["m" . $i . "a"]) {
                            $rubberslost += 1;
                            $artemp += 1;
                        }
                        $count += 1;
                        if ($count == 3) {
                            $count = 0;
                            if ($hrtemp > $artemp) {
                                $homegamestotal += 1;
                            } else {
                                $awaygamestotal += 1;
                            }
                            $hrtemp = 0;
                            $artemp = 0;
                        }
                    }

                    $totrubbers += $homerubbertotal;
                    $totrubberslost += $rubberslost;
                    $totgames += $homegamestotal;
                    $totgameslost += $awaygamestotal;
                } else if ((int)$row["Away"] == $tid) {
                    $totpts += $Awaytotal;
                    $totptsagainst += $Hometotal;
                    $awayrubbertotal = 0;
                    $rubberslost = 0;
                    $awaygamestotal = 0;
                    $homegamestotal = 0;
                    $count = 0;
                    $hrtemp = 0;
                    $artemp = 0;

                    for ($i = 1; $i <= $mat; $i++) {
                        if ($row["m" . $i . "h"] < $row["m" . $i . "a"]) {
                            $awayrubbertotal += 1;
                            $artemp += 1;
                        } else if ($row["m" . $i . "h"] > $row["m" . $i . "a"]) {
                            $rubberslost += 1;
                            $hrtemp += 1;
                        }
                        $count += 1;
                        if ($count == 3) {
                            $count = 0;
                            if ($hrtemp > $artemp) {
                                $awaygamestotal += 1;
                            } else {
                                $homegamestotal += 1;
                            }
                            $hrtemp = 0;
                            $artemp = 0;
                        }
                    }

                    $totrubbers += $awayrubbertotal;
                    $totrubberslost += $rubberslost;
                    $totgames += $homegamestotal;
                    $totgameslost += $awaygamestotal;
                }
                if ($totgames>$totgameslost){
                    $points+=2;     
                }
                
            }
            
            $stmt = $conn->prepare("
                SELECT * FROM TblClubhasteam
                
                WHERE ClubhasteamID = :id 
            ");

            $stmt->bindParam(':id', $tid);
            $stmt->execute();
            $docked = 0;
            while ($dock = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
            if ($dock["dock"]==1){
                $points=$points-1;
                $docked=1;
            }
        }
           
            $teamres = [
                'name' => $team["ClubName"]." ".$team["TeamName"],
                'played' => $countm,
                'gameswon' => $totgames,
                'gameslost' => $totgameslost,
                'rubberswon' => $totrubbers,
                'rubberslost' => $totrubberslost,
                'pointsfor' => $totpts,
                'pointsagainst' => $totptsagainst,
                'points'=>$points,
                'dock'=>$docked,
                'id'=>$team["TeamID"]
            ];
          
            $leagueA[] = $teamres;
        }
        uasort($leagueA, 'cmp'); // Sort the results

        // Display the results in a table
        #print_r($leagueA);
        
        echo "<table style='width:80%' class='table table-bordered table-danger table-condensed table-striped text-center'>";
        echo "<thead class='thead-dark'>
                <tr>
                    <th>Promote</th> <!-- New header for the checkbox -->
                    <th>Relegate</th> <!-- New header for the checkbox -->
                    <th>Team</th>
                    <th>Played</th>
                    <th>Games won</th>
                    <th>Games lost</th>
                    <th>Rubbers won</th>
                    <th>Rubbers lost</th>
                    <th>Points for</th>
                    <th>Points against</th>
                    <th>Points</th>
                    <th>Points docked</th>
                </tr>
              </thead>";
        echo "<tbody>"; // Start the body of the table
        echo("<form action='promoterelegate.php' method='POST'>");
        foreach ($leagueA as $team) {
            echo "<tr>";
            // Add a checkbox for each row with a unique name or id
            echo "<td><input type='checkbox' name='promote_team[]' value='" . htmlspecialchars($team['id']) . "'></td>"; 
            echo "<td><input type='checkbox' name='relegate_team[]' value='" . htmlspecialchars($team['id']) . "'></td>";
            echo "<td>" . htmlspecialchars($team['name']) . "</td>";
            echo "<td>" . $team['played'] . "</td>";
            echo "<td>" . $team['gameswon'] . "</td>";
            echo "<td>" . $team['gameslost'] . "</td>";
            echo "<td>" . $team['rubberswon'] . "</td>";
            echo "<td>" . $team['rubberslost'] . "</td>";
            echo "<td>" . $team['pointsfor'] . "</td>";
            echo "<td>" . $team['pointsagainst'] . "</td>";
            echo "<td>" . $team['points'] . "</td>";
        
            // Handle the "Points docked" column with conditional content
            if ($team['dock'] == 1) {
                echo "<td>*</td>";
            } else {
                echo "<td></td>";    
            }
           
            echo "</tr>";
        }
        
        echo "</tbody>"; // End the body of the table
        echo "</table><br>";
        
       
    }   
    

}
echo('<input type="submit" class="btn btn-primary" value="Promote/relegate ALL divisions">');
        echo("</form>");

//callback function for usort- declared outside loop to prevent recalling
function cmp($a, $b){
   if ($a["points"]==$b['points']){

    if ($a["gameswon"]<$b["gameslost"]){
            return -1;
        }else{
            return 1;
        }
    }else if ($a["points"]<$b['points']){
        return 1;
    }else{
        return -1;
        }
   }
   
?>
</div>
</div>

</body>
</html>
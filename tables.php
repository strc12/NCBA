<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/favicon.png" />
</head>

<body>
  <!-- Navigation bar -->
  <div id="result">
    <?php include_once("navbar.php"); ?>
  </div>

  <div class="container-fluid">
    <?php
    // Fetch leagues, divisions, clubs, and teams with joins
    $stmt = $conn->prepare("
      SELECT 
        TblLeague.LeagueID AS LeagueID, TblLeague.Name AS LeagueName,
        TblDivision.DivisionID AS DivisionID, TblDivision.Name AS DivisionName,
        TblClub.ClubID AS ClubID, TblClub.Clubname AS ClubName,
        TblClubhasteam.ClubhasteamID AS TeamID, TblClubhasteam.Name AS TeamName
      FROM TblLeague
      LEFT JOIN TblDivision ON TblLeague.LeagueID = TblDivision.LeagueID
      LEFT JOIN TblClubhasteam ON TblDivision.DivisionID = TblClubhasteam.DivisionID
      LEFT JOIN TblClub ON TblClubhasteam.ClubID = TblClub.ClubID
    ");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $leagues = [];
    // Organize data into nested array of leagues -> divisions -> teams
    foreach ($data as $row) {
      $leagueID = $row['LeagueID'];
      $divisionID = $row['DivisionID'];
      $teamID = $row['TeamID'];

      if (!isset($leagues[$leagueID])) {
        $leagues[$leagueID] = ['Name' => $row['LeagueName'], 'Divisions' => []];
      }
      if (!isset($leagues[$leagueID]['Divisions'][$divisionID])) {
        $leagues[$leagueID]['Divisions'][$divisionID] = ['Name' => $row['DivisionName'], 'Teams' => []];
      }
      if ($row['ClubName'] && $row['TeamName']) {
        $leagues[$leagueID]['Divisions'][$divisionID]['Teams'][$teamID] = [
          'ClubName' => $row['ClubName'],
          'TeamName' => $row['TeamName'],
          'TeamID' => $row['TeamID']
        ];
      }
    }

    /**
     * Comparison function to sort teams by:
     * 1. Matches won (descending)
     * 2. Games difference (descending)
     * 3. Points difference (descending)
     */
    function cmp($a, $b)
    {
      // Compare matches won
      if ($a["matcheswon"] != $b["matcheswon"]) {
        return $b["matcheswon"] <=> $a["matcheswon"];
      }

      // Compare games difference
      $gameDiffA = $a["gameswon"] - $a["gameslost"];
      $gameDiffB = $b["gameswon"] - $b["gameslost"];
      if ($gameDiffA != $gameDiffB) {
        return $gameDiffB <=> $gameDiffA;
      }

      // Compare points difference
      $pointDiffA = $a["pointsfor"] - $a["pointsagainst"];
      $pointDiffB = $b["pointsfor"] - $b["pointsagainst"];
      return $pointDiffB <=> $pointDiffA;
    }

    // Loop through each league
    foreach ($leagues as $league) {
      echo "<h2>" . htmlspecialchars($league['Name']) . "</h2>";

      // Loop through each division within the league
      foreach ($league['Divisions'] as $division) {
        echo "<h4>" . htmlspecialchars($division['Name']) . "</h4>";

        $leagueA = []; // Array to hold teams' statistics for this division

        // Loop through each team in the division
        foreach ($division['Teams'] as $team) {
          $tid = $team["TeamID"];

          // Fetch all matches involving the current team with results entered for the current season
          $stmt = $conn->prepare("
            SELECT 
            TblMatches.MatchID as mid,
              TblMatches.Fixturedate, TblMatches.HomeID as Home, TblMatches.AwayID as Away, TblMatches.resultsentered,
              TblMatches.m1h, TblMatches.m1a, TblMatches.m2h, TblMatches.m2a, TblMatches.m3h, TblMatches.m3a,
              TblMatches.m4h, TblMatches.m4a, TblMatches.m5h, TblMatches.m5a, TblMatches.m6h, TblMatches.m6a,
              TblMatches.m7h, TblMatches.m7a, TblMatches.m8h, TblMatches.m8a, TblMatches.m9h, TblMatches.m9a,
              TblMatches.m10h, TblMatches.m10a, TblMatches.m11h, TblMatches.m11a, TblMatches.m12h, TblMatches.m12a,
              TblMatches.m13h, TblMatches.m13a, TblMatches.m14h, TblMatches.m14a, TblMatches.m15h, TblMatches.m15a,
              TblMatches.m16h, TblMatches.m16a, TblMatches.m17h, TblMatches.m17a, TblMatches.m18h, TblMatches.m18a,
              TblMatches.m19h, TblMatches.m19a, TblMatches.m20h, TblMatches.m20a, TblMatches.m21h, TblMatches.m21a,
              TblMatches.m22h, TblMatches.m22a, TblMatches.m23h, TblMatches.m23a, TblMatches.m24h, TblMatches.m24a,
              TblMatches.m25h, TblMatches.m25a, TblMatches.m26h, TblMatches.m26a, TblMatches.m27h, TblMatches.m27a
            FROM TblMatches 
            WHERE (TblMatches.HomeID = :id OR TblMatches.AwayID = :id) AND (resultsentered = 1) AND (TblMatches.Season=:curseas)
          ");
          $stmt->bindParam(':id', $tid);
          $stmt->bindParam(':curseas', $_SESSION["Season"]);
          $stmt->execute();
            echo($tid."<br>");
          // Initialize stats counters
          $played = 0;
          $matcheswon = 0;
          $matcheslost = 0;
          $gameswon = 0;
          $gameslost = 0;
          $rubberswon = 0;
          $rubberslost = 0;
          $pointsfor = 0;
          $pointsagainst = 0;
          $points = 0;

          // Number of matches per fixture (varies by league)
          $mat = ($data["LeagueID"] == 4) ? 18 : 27;
    
          // Process each match involving the team
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              #print_r($row['Home']);
              #echo("<br>");
            $played++; // Count this match as played

            // Totals for points scored in this match
            $awaytotal = 0;
            $hometotal = 0;

            // Count of rubbers (individual sub-matches) won and lost in this match
            $rubberWin = 0;
            $rubberLose = 0;

            // Games won at home and away (in groups of 3 games)
            $homegames = 0;
            $awaygames = 0;

            // Counters for grouping games in sets of 3
            $count = 0;
            $homeTemp = 0;
            $awayTemp = 0;

            // Iterate through each sub-match in the fixture
            for ($i = 1; $i <= $mat; $i++) {
              $h = $row["m" . $i . "h"];
              $a = $row["m" . $i . "a"];
              $hometotal += $h;
              $awaytotal += $a;

              // Determine rubber win/loss depending on if team is home or away
              echo($row["mid"]."sd<br>");
              if ($row['Home'] == $tid) {
                if ($h > $a) $rubberWin++;
                elseif ($a > $h) $rubberLose++;
              } else {
                if ($a > $h) $rubberWin++;
                elseif ($h > $a) $rubberLose++;
              }

              $count++;
              if ($h > $a) $homeTemp++;
              elseif ($a > $h) $awayTemp++;

              // Every 3 games count as a game won by either home or away
              if ($count == 3) {
                if ($homeTemp > $awayTemp) $homegames++;
                else $awaygames++;
                // Reset counters for next set of 3 games
                $count = 0;
                $homeTemp = 0;
                $awayTemp = 0;
              }
            }
            echo($homegames.$awaygames."bob<br>");
            // Accumulate total points and games won/lost based on home or away team
            if ($row['Home'] == $tid) {
              $pointsfor += $hometotal;
              $pointsagainst += $awaytotal;
              $gameswon += $homegames;
              $gameslost += $awaygames;
              if ($homegames > $awaygames) {
                // Team won the match
                $matcheswon++;
                
                
                
                } elseif ($homegames < $awaygames) {
                // Team lost the match
                $matcheslost++;
                }
            } else {
              $pointsfor += $awaytotal;
              $pointsagainst += $hometotal;
              $gameswon += $awaygames;
              $gameslost += $homegames;
              if ($homegames > $awaygames) {
              // Team won the match
              $matcheslost++;
             
              
              
            } elseif ($homegames < $awaygames) {
              // Team lost the match
              $matcheswon++;
            }
            }

            // Accumulate rubbers
            $rubberswon += $rubberWin;
            $rubberslost += $rubberLose;

            // Check match result to increment wins/losses and points
            
            echo($matcheswon."-".$matcheslost."<br>");
          }

          // Check if the team is docked points (e.g. penalty)
          $docked = 0;
          $points=$matcheswon*2;
          $stmt = $conn->prepare("SELECT dock FROM TblClubhasteam WHERE ClubhasteamID = :id");
          $stmt->bindParam(':id', $tid);
          $stmt->execute();
          if ($dock = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($dock["dock"] == 1) {
              $points -= 1; // Deduct a point for docking
              $docked = 1;
            }
          }

          // Collect the calculated stats for this team
          $leagueA[] = [
            'name' => $team["ClubName"] . " " . $team["TeamName"],
            'played' => $played,
            'matcheswon' => $matcheswon,
            'matcheslost' => $matcheslost,
            'gameswon' => $gameswon,
            'gameslost' => $gameslost,
            'rubberswon' => $rubberswon,
            'rubberslost' => $rubberslost,
            'pointsfor' => $pointsfor,
            'pointsagainst' => $pointsagainst,
            'points' => $points,
            'dock' => $docked
          ];
        }

        // Sort the teams in the division using the comparison function
        usort($leagueA, 'cmp');

        // Output the table header
        echo "<table style='width:80%' class='table table-bordered table-danger table-condensed table-striped text-center'>";
        echo "<thead class='thead-dark'>
                <tr>
                  <th>Team</th>
                  <th>Played</th>
                  <th>Matches won</th>
                  <th>Matches lost</th>
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

        // Output each team's stats as table rows
        foreach ($leagueA as $team) {
          echo "<tr>
                  <td>" . htmlspecialchars($team['name']) . "</td>
                  <td>" . $team['played'] . "</td>
                  <td>" . $team['matcheswon'] . "</td>
                  <td>" . $team['matcheslost'] . "</td>
                  <td>" . $team['gameswon'] . "</td>
                  <td>" . $team['gameslost'] . "</td>
                  <td>" . $team['rubberswon'] . "</td>
                  <td>" . $team['rubberslost'] . "</td>
                  <td>" . $team['pointsfor'] . "</td>
                  <td>" . $team['pointsagainst'] . "</td>
                  <td>" . $team['points'] . "</td>
                  <td>" . ($team['dock'] ? "*" : "") . "</td>
                </tr>";
        }

        echo "</table><br>";
      }
    }
    ?>
  </div>
</body>

</html>

<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }


try {
    include "setseason.php";
    #print_r($_SESSION);
    $season=$_SESSION["Season"];
    $newseason = (intval(substr($season, 0, $h = intdiv(strlen($season), 2))) + 1) . (intval(substr($season, $h)) + 1);

    include_once ("connection.php");
    #update current season
    $updateQuery = "UPDATE TblSeason SET current = 0 WHERE current = 1";
    $conn->exec($updateQuery);
    # add in new season
    $insertQuery = "INSERT INTO TblSeason (Season, current) VALUES (?, 1)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->execute([$newseason]);
    // Get all divisions
    $divisionStmt = $conn->query("SELECT DivisionID, Name FROM TblDivision");
    $divisions = $divisionStmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($divisions as $division) {
        $divisionID = $division['DivisionID'];
        $divisionName = $division['Name'];

        #echo "============================\n";
        #echo "Division: $divisionName (ID: $divisionID)\n";
       # echo "============================\n";

        // Get teams in this division
        $teamStmt = $conn->prepare("
            SELECT cht.ClubhasteamID, c.ClubName 
            FROM TblClubhasteam cht
            JOIN TblClub c ON c.ClubID = cht.ClubID
            WHERE cht.DivisionID = ?
        ");
        $teamStmt->execute([$divisionID]);
        $teams = $teamStmt->fetchAll(PDO::FETCH_KEY_PAIR); // TeamID => ClubName

        $teamIDs = array_keys($teams);
        $numTeams = count($teamIDs);

        // Prepare insert statement
        $insertStmt = $conn->prepare("
            INSERT INTO TblMatches (HomeID, AwayID, DivisionID, Season)
            VALUES (?, ?, ?, ?)
        ");

        // Generate home-and-away matches
        for ($i = 0; $i < $numTeams; $i++) {
            for ($j = 0; $j < $numTeams; $j++) {
                if ($i != $j) {
                    $homeTeamID = $teamIDs[$i];
                    $awayTeamID = $teamIDs[$j];

                    // Check if match already exists
                    $checkStmt = $conn->prepare("
                        SELECT COUNT(*) FROM TblMatches 
                        WHERE HomeID = ? AND AwayID = ? AND DivisionID = ? AND Season = ?
                    ");
                    $checkStmt->execute([$homeTeamID, $awayTeamID, $divisionID, $newseason]);
                    $exists = $checkStmt->fetchColumn();

                    if ($exists == 0) {
                        $insertStmt->execute([$homeTeamID, $awayTeamID, $divisionID, $newseason]);
                    }
                }
            }
        }

        // Retrieve and print matches for this division
        /* $matchStmt = $conn->prepare("
            SELECT 
                m.HomeID, m.AwayID,
                hc.ClubName AS HomeTeamName,
                ac.ClubName AS AwayTeamName
            FROM TblMatches as m
            JOIN TblClubhasteam as hcht ON m.HomeID = hcht.ClubhasteamID
            JOIN TblClub as hc ON hcht.ClubID = hc.ClubID
            JOIN TblClubhasteam as acht ON m.AwayID = acht.ClubhasteamID
            JOIN TblClub as ac ON acht.ClubID = ac.ClubID
            WHERE m.DivisionID = ? AND m.Season = ?
            ORDER BY HomeTeamName, AwayTeamName
            
        ");
        $matchStmt->execute([$divisionID, $season]);
        $matches = $matchStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($matches as $match) {
            echo "{$match['HomeTeamName']} vs {$match['AwayTeamName']}<br>";
        } */

        #echo "<br>";
    }

    #echo "Fixtures created and displayed successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo("<script>
        alert('Fixtures Created');
        window.location.href='Leagueadmin.php'; 
    </script>"); #alert followed by redirect
      
$_SESSION["promrel"]=0;
?>
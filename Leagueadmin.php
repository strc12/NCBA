<?php
session_start(); // Start the session

// Check if 'adloggedin' is not set or not equal to 1
if (!isset($_SESSION['adloggedin']) || $_SESSION['adloggedin'] != 1) {
    // Redirect to login page or show an error
    header("Location: login.php");
    exit;
}
?>
<html>
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script>
    function showresult(str) {
        if (str == "") {
            document.getElementById("clubinfo").innerHTML = "";
            return;
        } else { 
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("clubinfo").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","clubadmin.php?q="+str,true);
            xmlhttp.send();
        }
       
    }
</script>
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    if(session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
    include_once("navbar.php");
    ?>

</div>
    <div class="container mt-5">
            <h1 class="text-center mb-4">League Admin for Creating/Editing Leagues/Divisions/Clubs</h1>

            <!-- Access Restriction Message -->
            <div class="alert alert-warning" role="alert">
                Restricted Access: Only Jermaine and Rob
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="edit-club-tab" data-bs-toggle="tab" href="#edit-club" role="tab" aria-controls="edit-club" aria-selected="true">Edit Club Data</a>
                </li>
                
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="add-division-tab" data-bs-toggle="tab" href="#add-division" role="tab" aria-controls="add-division" aria-selected="false">Add Division</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="add-discipline-tab" data-bs-toggle="tab" href="#add-discipline" role="tab" aria-controls="add-discipline" aria-selected="false">Add Discipline</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="add-club-tab" data-bs-toggle="tab" href="#add-club" role="tab" aria-controls="add-club" aria-selected="false">Add Club</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="dock-points-tab" data-bs-toggle="tab" href="#dock-points" role="tab" aria-controls="dock-points" aria-selected="false">Dock Points</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="setupseason-tab" data-bs-toggle="tab" href="#setupseason" role="tab" aria-controls="setupseason" aria-selected="false">Setup Season</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="viewfixtures-tab" data-bs-toggle="tab" href="#viewfixtures" role="tab" aria-controls="viewfixtures" aria-selected="false">View Fixtures</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="editfixtures-tab" data-bs-toggle="tab" href="#editfixtures" role="tab" aria-controls="editfixtures" aria-selected="false">Edit Fixtures</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="addresults-tab" data-bs-toggle="tab" href="#addresults" role="tab" aria-controls="addresults" aria-selected="false">Add results</a>
                </li>
            </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Edit Club Data Tab -->
            <div class="tab-pane fade show active" id="edit-club" role="tabpanel" aria-labelledby="edit-club-tab">
                
                <h2 class="my-4">Club management</h2>
                <form action="updateclubdetails.php" method="POST">
                    <div class="mb-3">
                        
                        <?php
                        include_once ("connection.php");

                        // Fetch items from the database
                        $sql = "SELECT ClubID, Clubname FROM TblClub";
                        $stmt = $conn->query($sql);
                        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        ?>


                            <h2>Select an club to manage</h2>
                            <select id="clubs" onchange="showresult(this.value)">
                            <option>Select Club to edit</option>
                            
                                    <?php foreach ($items as $item): ?>
                                        <option value="<?php echo htmlspecialchars($item['ClubID']) ?>" <?php echo (isset($_GET['ClubID']) && $_GET['ClubID'] == $item['ClubID']) ? 'selected' : '' ?>>
                                            <?php echo htmlspecialchars($item['Clubname']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            <!-- </form> -->

                        <div id="clubinfo">

                        </div>   
                        <script>
                        $("#clubs").on("change", function(){
                            var selected=$(this).val();
                            $("#clubinfo").html("You selected: " + selected);
                        })</script>      
                                
                    </div>
                    
                </form>
            </div>
            <!-- Add Division Tab -->
            <div class="tab-pane fade" id="add-division" role="tabpanel" aria-labelledby="add-division-tab">
            <h3 class="my-4">Current Divisions</h3>
                                <?php
                    echo '<div class="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    
                                    <th scope="col">League</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Rank</th>
                                </tr>
                            </thead>
                            <tbody>';
                    include_once('connection.php');
                    $stmt = $conn->prepare("SELECT 
                    TblDivision.Divisionrank as DR, 
                    TblDivision.name as DN,
                    TblLeague.name as LN
                    FROM TblDivision 
                    INNER JOIN TblLeague on (TblLeague.LeagueID = TblDivision.LeagueID)");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        #print_r($row);
                        echo '<tr>
                            
                            <td>'.$row["LN"].'</td>
                            <td>'.$row["DN"].'</td>
                            <td>'.$row["DN"].'</td>
                        </tr>';
                    }
                    echo '</tbody></table></div>';
                    ?>
                <h2 class="my-4">Add Division</h2>
                <form action="addDivision.php" method="POST">
                    <div class="mb-3">
                        <label for="typeofleague" class="form-label">Select League to Add Division To</label>
                        <select id="typeofleague" name="typeofleague" class="form-select">
                            <?php
                                include_once('connection.php');
                                $stmt = $conn->prepare("SELECT * FROM TblLeague");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='".$row["LeagueID"]."'>".$row["Name"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Divisionname" class="form-label">New Division Name</label>
                        <input type="text" id="Divisionname" name="Divisionname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Rank" class="form-label">Division Rank</label>
                        <input type="number" id="Rank" name="Rank" min="1" max="10" step="1" value="1" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Division to League</button>
                </form>
            </div>

            <!-- Add Discipline Tab -->
            <div class="tab-pane fade" id="add-discipline" role="tabpanel" aria-labelledby="add-discipline-tab">
                <h2 class="my-4">Add Discipline</h2>
                <div class="mb-3">
                    <h4>Current Disciplines:</h4>
                    <?php
                        include_once('connection.php');
                        $stmt = $conn->prepare("SELECT * FROM TblLeague");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<p>".$row["Name"]." - ".$row["Details"]."</p>";
                        }
                    ?>
                </div>
                <form action="addLeague.php" method="POST">
                    <div class="mb-3">
                        <label for="LeagueName" class="form-label">New Discipline Name</label>
                        <input type="text" id="LeagueName" name="LeagueName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Details" class="form-label">New Discipline Details</label>
                        <input type="text" id="Details" name="Details" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Discipline</button>
                </form>
            </div>

            <!-- Add Club Tab -->
            <div class="tab-pane fade" id="add-club" role="tabpanel" aria-labelledby="add-club-tab">
                <h2 class="my-4">Add New Club</h2>
                <form action="addclub.php" method="POST">
                    <!-- Club Name -->
                    <div class="mb-3">
                        <label for="clubname" class="form-label">Club Name</label>
                        <input type="text" id="clubname" name="clubname" class="form-control">
                    </div>

                    <!-- Location -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" name="location" class="form-control">
                    </div>

                    <!-- Contact Person -->
                    <div class="mb-3">
                        <label for="contactname" class="form-label">Contact Name</label>
                        <input type="text" id="contactname" name="contactname" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="contactnumber" class="form-label">Contact Number</label>
                        <input type="text" id="contactnumber" name="contactnumber" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="contactemail" class="form-label">Contact Email</label>
                        <input type="email" id="contactemail" name="contactemail" class="form-control">
                    </div>

                    <!-- Club Secretary Section -->
                    <div class="mb-3">
                        <h5>Club Secretary</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="clubsecretaryname" class="form-label">Name</label>
                                <input type="text" id="clubsecretaryname" name="clubsecretaryname" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="clubsecretarynumber" class="form-label">Phone</label>
                                <input type="text" id="clubsecretarynumber" name="clubsecretarynumber" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="clubsecretaryemail" class="form-label">Email</label>
                                <input type="text" id="clubsecretaryemail" name="clubsecretaryemail" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Match Secretary Section -->
                    <div class="mb-3">
                        <h5>Match Secretary</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="matchsecretaryname" class="form-label">Name</label>
                                <input type="text" id="matchsecretaryname" name="matchsecretaryname" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="matchsecretarynumber" class="form-label">Phone</label>
                                <input type="text" id="matchsecretarynumber" name="matchsecretarynumber" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="matchsecretaryemail" class="form-label">Email</label>
                                <input type="text" id="matchsecretaryemail" name="matchsecretaryemail" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Junior/Senior -->
                    <div class="mb-3">
                        <input type="checkbox" id="junior" name="junior" value="Junior">
                        <label for="junior"> Junior</label>
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" id="senior" name="senior" value="Senior">
                        <label for="senior"> Senior</label>
                    </div>

                    <!-- Clubnight -->
                    <div class="mb-3">
                        <label for="clubnight" class="form-label">Clubnight(s) and Times</label>
                        <input type="text" id="clubnight" name="clubnight" class="form-control">
                    </div>

                    <!-- Matchnight -->
                    <div class="mb-3">
                        <label for="matchnight" class="form-label">Match Night(s) and Times</label>
                        <input type="text" id="matchnight" name="matchnight" class="form-control">
                    </div>

                    <!-- Online Presence Section -->
                    <div class="mb-3">
                        <h5>Online Presence</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" id="website" name="website" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" id="instagram" name="instagram" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Club</button>
                </form>

            </div>

            <!-- Dock Points Tab -->
            <div class="tab-pane fade" id="dock-points" role="tabpanel" aria-labelledby="dock-points-tab">
                <h2 class="my-4">Dock Points</h2>
                <form action="dockpoints.php" method="POST">
                    <div class="mb-3">
                        <label for="teamtodock" class="form-label">Select Team to Dock Points</label>
                        <select id="teamtodock" name="teamtodock" class="form-select">
                            <?php
                                include_once('connection.php');
                                $stmt = $conn->prepare("SELECT TblClubhasteam.ClubhasteamID as teamID, TblClubhasteam.Name as team, TblClub.Clubname as club FROM TblClubhasteam
                                INNER JOIN TblClub ON (TblClub.ClubID = TblClubhasteam.ClubID)
                                ORDER BY club ASC, team ASC ");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='".$row["teamID"]."'>".$row["club"]." ".$row["team"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Dock Point</button>
                </form>
            </div>
            <!-- Setup new season Tab -->
            <div class="tab-pane fade" id="setupseason" role="tabpanel" aria-labelledby="setupseason-tab">
                <h2 class="my-4">Setup season</h2>
                <?php
                echo ("<h3>Current season - ".substr($_SESSION['Season'],0,2)."-".substr($_SESSION['Season'],2,4)."</h3>");
                #if ($_SESSION["promrel"]==0) {
                    echo('
                <form action="setupseason.php" method="POST">
                    <div class="mb-3">
                        <p>Perform the promotions/relegations</p>
                                
                    </div>
                    <button type="submit" class="btn btn-primary">Go to relegations and promotions page</button>
                </form>');
                #}
                ?>
                <?php
                if (isset ($_SESSION["promrel"]) && $_SESSION["promrel"]==1){
                    echo('
                <form action="generatefixtures.php" method="POST">
                    <div class="mb-3">
                        <p>Create all the fixtures ready to be populated by dates</p>
                                
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Fixtures</button>
                </form>');
                }
                ?>
            </div>
            <!-- View Fixtures Tab -->
            <div class="tab-pane fade" id="viewfixtures" role="tabpanel" aria-labelledby="viewfixtures-tab">
                <h2 class="my-4">View Fixtures</h2>
                
                    <div class="mb-3">
                <?php   

                $stmt = $conn->query("
                    SELECT 
                        l.Name as LN,
                        d.Name as DN,
                        D.Divisionrank as RK,
                        m.FixtureDate,
                        hc.Clubname AS HomeTeam,
                        ac.Clubname AS AwayTeam
                    FROM TblMatches m
                    JOIN TblDivision d ON m.DivisionID = d.DivisionID
                    JOIN TblLeague l ON d.LeagueID = l.LeagueID
                    JOIN TblClubhasteam hcht ON m.HomeID = hcht.ClubhasteamID
                    JOIN TblClub hc ON hcht.ClubID = hc.ClubID
                    JOIN TblClubhasteam acht ON m.AwayID = acht.ClubhasteamID
                    JOIN TblClub ac ON acht.ClubID = ac.ClubID
                    ORDER BY LN DESC, RK, (m.FixtureDate IS NULL OR m.FixtureDate = '0000-00-00'), m.FixtureDate
                ");

                $fixtures = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                    

                    <?php
                    $currentLeague = '';
                    $currentDivision = '';
                    $divisionOpen = false;

                    foreach ($fixtures as $fixture) {
                        // League changed
                        if ($fixture['LN'] !== $currentLeague) {
                            // Close previous division div if open
                            if ($divisionOpen) {
                                echo "</div>"; 
                                $divisionOpen = false;
                            }
                            $currentLeague = $fixture['LN'];
                            echo "<h2 class='mt-4'>{$currentLeague}</h2>";
                            // Reset division on league change
                            $currentDivision = '';
                        }

                        // Division changed
                        if ($fixture['DN'] !== $currentDivision) {
                            // Close previous division div if open
                            if ($divisionOpen) {
                                echo "</div>";
                            }
                            $currentDivision = $fixture['DN'];
                            echo "<h4 class='mt-3 ms-3 text-primary'>{$currentDivision}</h4>";
                            echo "<div class='ms-4'>";
                            $divisionOpen = true;
                        }

                        // Format date or red "No Date"
                        $dateRaw = $fixture['FixtureDate'];

                        // Validate date properly
                        if (!empty($dateRaw) && $dateRaw !== '0000-00-00' && strtotime($dateRaw) !== false) {
                            $date = date("d M Y", strtotime($dateRaw));
                        } else {
                            $date = "<span class='text-danger'>No Date</span>";
                        }
                        #$date = $fixture['FixtureDate'] ? date("d M Y", strtotime($fixture['FixtureDate'])) : "<span class='text-danger'>No Date</span>";

                        // Print fixture
                        echo "<p class='ms-4'>{$fixture['HomeTeam']} vs {$fixture['AwayTeam']} — {$date}</p>";
                    }

                    // Close the last division div if open
                    if ($divisionOpen) {
                        echo "</div>";
                    }
                    ?>
                    </div>





            </div>
             <!-- edit Fixtures Tab -->
            <div class="tab-pane fade" id="editfixtures" role="tabpanel" aria-labelledby="editfixtures-tab">
                <h2 class="my-4">Edit Fixtures</h2>
                
                    <div class="mb-3">
                    <form action="updatefixtures.php" method="POST">
                    <br>
                    <p>Date not added in Red</p>
                    <?php
                
                    include_once ("connection.php");
                    if (!isset($_SESSION["adloggedin"])){
                    $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
                    leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
                    away.DivisionID as ad , DIVIS.Name as DIVN , leag.Name as LN FROM TblMatches 
                    INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
                    INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
                    INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
                    INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
                    INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
                    INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
                    WHERE Season=:SEAS  AND awt.ClubID=:club OR ht.ClubID=:club ORDER BY ad ASC,HN ASC,Fixturedate ASC " );
                
                    $stmt->bindParam(':club', $_SESSION["clubid"]);
                    $stmt->bindParam(':SEAS', $_SESSION["Season"]);
                    }else{
                        $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
                        leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
                        away.DivisionID as ad , DIVIS.Name as DIVN , leag.Name as LN FROM TblMatches 
                        INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
                        INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
                        INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
                        INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
                        INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
                        INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
                        WHERE Season=:SEAS   ORDER BY ad ASC, HN asc,Fixturedate ASC " );
                
                    $stmt->bindParam(':SEAS', $_SESSION["Season"]);
                
                    }
                    
                    $stmt->execute();
                    
                $currentLeague = "";
                $currentDivision = "";
                echo "<div class='table-responsive' style='max-width:90vw; margin:auto;'>";
                echo "<table class='table'>";
                echo "<tbody>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  

                    // Check if league changed
                    if ($row['LN'] !== $currentLeague) {
                        $currentLeague = $row['LN'];
                        // Print league header row
                        echo "<tr><th colspan='2' style='background:#007bff; color:white;'>League: " . htmlspecialchars($currentLeague) . "</th></tr>";
                        // Reset current division when league changes
                        $currentDivision = "";
                    }

                    // Check if division changed
                    if ($row['DIVN'] !== $currentDivision) {
                        $currentDivision = $row['DIVN'];
                        // Print division header row
                        echo "<tr><th colspan='2' style='background:#6c757d; color:white;'>Division: " . htmlspecialchars($currentDivision) . "</th></tr>";
                    }

                    echo("<tr>");
                    if (empty($row["Fixturedate"]) || $row["Fixturedate"] == "0000-00-00") {
                    echo("<td style='color:#FF0000'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                        <td><input class='form-control' type='date' name='".$row['MatchID']."' size='9' value=''></td>");
                } else if (isset($_SESSION["adloggedin"])) {
                    echo("<td>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                        <td><input class='form-control' type='date' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");
                } else if ($row["AWC"] == $_SESSION["clubname"] || $row["HC"] == $_SESSION["clubname"]) {
                    echo("<td>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                        <td><input class='form-control' type='date' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");
                } else {
                    echo("<td style='color:#C0C0C0'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                        <td><input disabled class='form-control' type='date' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");   
                }
                    echo("</tr>");
                }

                echo "</tbody></table></div>";
                ?>
                    <div class="text-center">
                <input class="btn btn-primary mb-2" type="submit" value="Update fixtures">
                </div>




            </div>
                    
                
            </div>
        </div>
            <!-- Tabs Content -->
            <div class="tab-content mt-3" id="myTabContent">
                <!-- Edit Club Data Tab -->
                <div class="tab-pane fade show active" id="edit-club" role="tabpanel" aria-labelledby="edit-club-tab">             
                    <h2 class="my-4">Club management</h2>
                    <form action="updateclubdetails.php" method="POST">
                        <div class="mb-3"> 
                            <?php
                            include_once ("connection.php");
                            // Fetch items from the database
                            $sql = "SELECT ClubID, Clubname FROM TblClub";
                            $stmt = $conn->query($sql);
                            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                                <h2>Select an club to manage</h2>
                                <select id="clubs" onchange="showresult(this.value)">
                                <option>Select Club to edit</option>                           
                                        <?php foreach ($items as $item): ?>
                                            <option value="<?php echo htmlspecialchars($item['ClubID']) ?>" <?php echo (isset($_GET['ClubID']) && $_GET['ClubID'] == $item['ClubID']) ? 'selected' : '' ?>>
                                                <?php echo htmlspecialchars($item['Clubname']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                <!-- </form> -->
                            <div id="clubinfo">
                            </div>   
                            <script>
                            $("#clubs").on("change", function(){
                                var selected=$(this).val();
                                $("#clubinfo").html("You selected: " + selected);
                            })</script>                                    
                        </div>                  
                    </form>
                </div>
                <!-- Add Division Tab -->
                <div class="tab-pane fade" id="add-division" role="tabpanel" aria-labelledby="add-division-tab">
                    <h3 class="my-4">Current Divisions</h3>
                    <?php
                        echo '<div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>                                
                                        <th scope="col">League</th>
                                        <th scope="col">Division</th>
                                        <th scope="col">Rank</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        include_once('connection.php');
                        $stmt = $conn->prepare("SELECT 
                        TblDivision.Divisionrank as DR, 
                        TblDivision.name as DN,
                        TblLeague.name as LN
                        FROM TblDivision 
                        INNER JOIN TblLeague on (TblLeague.LeagueID = TblDivision.LeagueID)");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            #print_r($row);
                            echo '<tr>                         
                                <td>'.$row["LN"].'</td>
                                <td>'.$row["DN"].'</td>
                                <td>'.$row["DN"].'</td>
                            </tr>';
                        }
                        echo '</tbody></table></div>';
                        ?>
                    <h2 class="my-4">Add Division</h2>
                    <form action="addDivision.php" method="POST">
                        <div class="mb-3">
                            <label for="typeofleague" class="form-label">Select League to Add Division To</label>
                            <select id="typeofleague" name="typeofleague" class="form-select">
                                <?php
                                    include_once('connection.php');
                                    $stmt = $conn->prepare("SELECT * FROM TblLeague");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='".$row["LeagueID"]."'>".$row["Name"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Divisionname" class="form-label">New Division Name</label>
                            <input type="text" id="Divisionname" name="Divisionname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="Rank" class="form-label">Division Rank</label>
                            <input type="number" id="Rank" name="Rank" min="1" max="10" step="1" value="1" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Division to League</button>
                    </form>
                </div>
                <!-- Add Discipline Tab -->
                <div class="tab-pane fade" id="add-discipline" role="tabpanel" aria-labelledby="add-discipline-tab">
                    <h2 class="my-4">Add Discipline</h2>
                    <div class="mb-3">
                        <h4>Current Disciplines:</h4>
                        <?php
                            include_once('connection.php');
                            $stmt = $conn->prepare("SELECT * FROM TblLeague");
                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<p>".$row["Name"]." - ".$row["Details"]."</p>";
                            }
                        ?>
                    </div>
                    <form action="addLeague.php" method="POST">
                        <div class="mb-3">
                            <label for="LeagueName" class="form-label">New Discipline Name</label>
                            <input type="text" id="LeagueName" name="LeagueName" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="Details" class="form-label">New Discipline Details</label>
                            <input type="text" id="Details" name="Details" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Discipline</button>
                    </form>
                </div>
                <!-- Add Club Tab -->
                <div class="tab-pane fade" id="add-club" role="tabpanel" aria-labelledby="add-club-tab">
                    <h2 class="my-4">Add New Club</h2>
                    <form action="addclub.php" method="POST">
                        <!-- Club Name -->
                        <div class="mb-3">
                            <label for="clubname" class="form-label">Club Name</label>
                            <input type="text" id="clubname" name="clubname" class="form-control">
                        </div>
                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" class="form-control">
                        </div>
                        <!-- Contact Person -->
                        <div class="mb-3">
                            <label for="contactname" class="form-label">Contact Name</label>
                            <input type="text" id="contactname" name="contactname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="contactnumber" class="form-label">Contact Number</label>
                            <input type="text" id="contactnumber" name="contactnumber" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="contactemail" class="form-label">Contact Email</label>
                            <input type="email" id="contactemail" name="contactemail" class="form-control">
                        </div>
                        <!-- Club Secretary Section -->
                        <div class="mb-3">
                            <h5>Club Secretary</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="clubsecretaryname" class="form-label">Name</label>
                                    <input type="text" id="clubsecretaryname" name="clubsecretaryname" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="clubsecretarynumber" class="form-label">Phone</label>
                                    <input type="text" id="clubsecretarynumber" name="clubsecretarynumber" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="clubsecretaryemail" class="form-label">Email</label>
                                    <input type="text" id="clubsecretaryemail" name="clubsecretaryemail" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Match Secretary Section -->
                        <div class="mb-3">
                            <h5>Match Secretary</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="matchsecretaryname" class="form-label">Name</label>
                                    <input type="text" id="matchsecretaryname" name="matchsecretaryname" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="matchsecretarynumber" class="form-label">Phone</label>
                                    <input type="text" id="matchsecretarynumber" name="matchsecretarynumber" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="matchsecretaryemail" class="form-label">Email</label>
                                    <input type="text" id="matchsecretaryemail" name="matchsecretaryemail" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Junior/Senior -->
                        <div class="mb-3">
                            <input type="checkbox" id="junior" name="junior" value="Junior">
                            <label for="junior"> Junior</label>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" id="senior" name="senior" value="Senior">
                            <label for="senior"> Senior</label>
                        </div>
                        <!-- Clubnight -->
                        <div class="mb-3">
                            <label for="clubnight" class="form-label">Clubnight(s) and Times</label>
                            <input type="text" id="clubnight" name="clubnight" class="form-control">
                        </div>
                        <!-- Matchnight -->
                        <div class="mb-3">
                            <label for="matchnight" class="form-label">Match Night(s) and Times</label>
                            <input type="text" id="matchnight" name="matchnight" class="form-control">
                        </div>
                        <!-- Online Presence Section -->
                        <div class="mb-3">
                            <h5>Online Presence</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" id="website" name="website" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" id="instagram" name="instagram" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" id="facebook" name="facebook" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Club</button>
                    </form>
                </div>
                <!-- Dock Points Tab -->
                <div class="tab-pane fade" id="dock-points" role="tabpanel" aria-labelledby="dock-points-tab">
                    <h2 class="my-4">Dock Points</h2>
                    <form action="dockpoints.php" method="POST">
                        <div class="mb-3">
                            <label for="teamtodock" class="form-label">Select Team to Dock Points</label>
                            <select id="teamtodock" name="teamtodock" class="form-select">
                                <?php
                                    include_once('connection.php');
                                    $stmt = $conn->prepare("SELECT TblClubhasteam.ClubhasteamID as teamID, TblClubhasteam.Name as team, TblClub.Clubname as club FROM TblClubhasteam
                                    INNER JOIN TblClub ON (TblClub.ClubID = TblClubhasteam.ClubID)
                                    ORDER BY club ASC, team ASC ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='".$row["teamID"]."'>".$row["club"]." ".$row["team"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Dock Point</button>
                    </form>
                </div>
                <!-- Setup new season Tab -->
                <div class="tab-pane fade" id="setupseason" role="tabpanel" aria-labelledby="setupseason-tab">
                    <h2 class="my-4">Setup season</h2>
                    <?php
                    echo ("<h3>Current season - ".substr($_SESSION['Season'],0,2)."-".substr($_SESSION['Season'],2,4)."</h3>");
                    #if ($_SESSION["promrel"]==0) {
                        echo('
                    <form action="setupseason.php" method="POST">
                        <div class="mb-3">
                            <p>Perform the promotions/relegations</p>
                                    
                        </div>
                        <button type="submit" class="btn btn-primary">Go to relegations and promotions page</button>
                    </form>');
                    #}
                    ?>
                    <?php
                    if (isset ($_SESSION["promrel"]) && $_SESSION["promrel"]==1){
                        echo('
                    <form action="generatefixtures.php" method="POST">
                        <div class="mb-3">
                            <p>Create all the fixtures ready to be populated by dates</p>
                                    
                        </div>
                        <button type="submit" class="btn btn-primary">Generate Fixtures</button>
                    </form>');
                    }
                    ?>
                </div>
                <!-- View Fixtures Tab -->
                <div class="tab-pane fade" id="viewfixtures" role="tabpanel" aria-labelledby="viewfixtures-tab">
                    <h2 class="my-4">View Fixtures</h2>
                        <div class="mb-3">
                    <?php   
                    $stmt = $conn->query("
                        SELECT 
                            l.Name as LN,
                            d.Name as DN,
                            d.Divisionrank as RK,
                            m.Fixturedate,
                            hc.Clubname AS HomeTeam,
                            ac.Clubname AS AwayTeam,
                            hcht.Name as HN,
                            acht.Name as AN
                        FROM TblMatches m
                        JOIN TblDivision d ON m.DivisionID = d.DivisionID
                        JOIN TblLeague l ON d.LeagueID = l.LeagueID
                        JOIN TblClubhasteam hcht ON m.HomeID = hcht.ClubhasteamID
                        JOIN TblClub hc ON hcht.ClubID = hc.ClubID
                        JOIN TblClubhasteam acht ON m.AwayID = acht.ClubhasteamID
                        JOIN TblClub ac ON acht.ClubID = ac.ClubID
                        ORDER BY LN DESC, RK, (m.Fixturedate IS NULL OR m.Fixturedate = '0000-00-00'), m.Fixturedate,hcht.Name
                    ");
                    $fixtures = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <?php
                        $currentLeague = '';
                        $currentDivision = '';
                        $divisionOpen = false;
                        foreach ($fixtures as $fixture) {  
                            // League changed
                            if ($fixture['LN'] !== $currentLeague) {
                                // Close previous division div if open
                                if ($divisionOpen) {
                                    echo "</div>"; 
                                    $divisionOpen = false;
                                }
                                $currentLeague = $fixture['LN'];
                                echo "<h2 class='mt-4'>{$currentLeague}</h2>";
                                // Reset division on league change
                                $currentDivision = '';
                            }
                            // Division changed
                            if ($fixture['DN'] !== $currentDivision) {
                                // Close previous division div if open
                                if ($divisionOpen) {
                                    echo "</div>";
                                }
                                $currentDivision = $fixture['DN'];
                                echo "<h4 class='mt-3 ms-3 text-primary'>{$currentDivision}</h4>";
                                echo "<div class='ms-4'>";
                                $divisionOpen = true;
                            }
                            // Format date or red "No Date"
                            $dateRaw = $fixture['Fixturedate'];
                            // Validate date properly
                            if (!empty($dateRaw) && $dateRaw !== '0000-00-00' && strtotime($dateRaw) !== false) {
                                $date = date("d M Y", strtotime($dateRaw));
                            } else {
                                $date = "<span class='text-danger'>No Date</span>";
                            }
                            // Print fixture
                            echo "<p class='ms-4'>{$fixture['HN']} vs {$fixture['AN']} — {$date}</p>";
                        }
                        // Close the last division div if open
                        if ($divisionOpen) {
                            echo "</div>";
                        }
                        ?>
                        </div>
                </div>
                <!-- edit Fixtures Tab -->
                <div class="tab-pane fade" id="editfixtures" role="tabpanel" aria-labelledby="editfixtures-tab">
                    <h2 class="my-4">Edit Fixtures</h2>
                        <div class="mb-3">
                        <form action="updatefixtures.php" method="POST">
                        <br>
                        <p>Date not added in Red</p>
                        <?php
                        include_once ("connection.php");
                        if (!isset($_SESSION["adloggedin"])){
                        $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
                        leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
                        away.DivisionID as ad , DIVIS.Name as DIVN, DIVIS.Divisionrank as RK, leag.Name as LN FROM TblMatches 
                        INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
                        INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
                        INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
                        INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
                        INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
                        INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
                        WHERE Season=:SEAS  AND awt.ClubID=:club OR ht.ClubID=:club ORDER BY LN ASC,RK ASC, HN ASC,Fixturedate ASC " );
                        $stmt->bindParam(':club', $_SESSION["clubid"]);
                        $stmt->bindParam(':SEAS', $_SESSION["Season"]);
                        }else{
                            $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
                            leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
                            away.DivisionID as ad , DIVIS.Name as DIVN ,DIVIS.Divisionrank as RK, leag.Name as LN FROM TblMatches 
                            INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
                            INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
                            INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
                            INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
                            INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
                            INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
                            WHERE Season=:SEAS   ORDER BY LN ASC, RK ASC, HN asc,Fixturedate ASC " );
                        $stmt->bindParam(':SEAS', $_SESSION["Season"]);
                        }
                        $stmt->execute();  
                    $currentLeague = "";
                    $currentDivision = "";
                    echo "<div class='table-responsive' style='max-width:90vw; margin:auto;'>";
                    echo "<table class='table'>";
                    echo "<tbody>";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
                        print_r($_row);
                        // Check if league changed
                        if ($row['LN'] !== $currentLeague) {
                            $currentLeague = $row['LN'];
                            // Print league header row
                            echo "<tr><th colspan='2' style='background:#007bff; color:white;'>League: " . htmlspecialchars($currentLeague) . "</th></tr>";
                            // Reset current division when league changes
                            $currentDivision = "";
                        }
                        // Check if division changed
                        if ($row['DIVN'] !== $currentDivision) {
                            $currentDivision = $row['DIVN'];
                            // Print division header row
                            echo "<tr><th colspan='2' style='background:#6c757d; color:white;'>Division: " . htmlspecialchars($currentDivision) . "</th></tr>";
                        }
                        echo("<tr>");
                        if (empty($row["Fixturedate"]) || $row["Fixturedate"] == "0000-00-00") {
                        echo("<td style='color:#FF0000'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                            <td><input class='form-control' type='date' name='".$row['MatchID']."' size='9' value=''></td>");
                    } else if (isset($_SESSION["adloggedin"])) {
                        echo("<td>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                            <td><input class='form-control' type='date' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");
                    } else if ($row["AWC"] == $_SESSION["clubname"] || $row["HC"] == $_SESSION["clubname"]) {
                        echo("<td>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                            <td><input class='form-control' type='date' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");
                    } else {
                        echo("<td style='color:#C0C0C0'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td>
                            <td><input disabled class='form-control' type='date' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");   
                    }
                        echo("</tr>");
                    }
                    echo "</tbody></table></div>";
                    ?>
                        <div class="text-center">
                            <input class="btn btn-primary mb-2" type="submit" value="Update fixtures">
                        </div>
                        </form>
                    </div>
                </div>
                <!-- Add Result Tab -->
                <div class="tab-pane fade" id="addresults" role="tabpanel" aria-labelledby="addresults-tab">
                    <h2 class="my-4">Add/edit Results - Red played</h2>
                    <div class="container-fluid">
                        <form action="selectplayers.php" method="POST">
                            <label>Fixture: </label>
                             <select name="match">
                                <option>Select match</option> 
                            <?php
                            #include_once ("connection.php");
                           # print_r($_SESSION);
                            
                                $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
                                leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
                                away.DivisionID as ad , DIVIS.Name as DIVN ,DIVIS.Divisionrank as rk,resultsentered FROM TblMatches 
                                INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
                                INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
                                INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
                                INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
                                INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
                                INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
                                WHERE Season=:SEAS   ORDER BY resultsentered ASC, LN ASC,rk ASC, Fixturedate ASC " );
                                
                                $stmt->bindParam(':SEAS', $_SESSION["Season"]); 
                                
                            
                                $stmt->execute();
                                
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo '<option value="'.$row["MatchID"].'"'
                                    . ($row["resultsentered"] == 1 ? ' style="color:red;"' : '') . '>'
                                    . $row["LN"] . " " . $row["DIVN"] . " - " . $row["HN"] . " v " . $row["AWN"];

                                if (!empty($row["Fixturedate"]) && $row["Fixturedate"] != '0000-00-00') {
                                    echo " - " . date("d M y", strtotime($row["Fixturedate"]));
                                }

echo '</option>';
                                }
                            $conn=null;
                            ?>
                                
                            </select>
                            <input type="submit" value="Select match">
                        </form>

                    </div>
                </div>        
            
    </div>
   
</body>
</html>
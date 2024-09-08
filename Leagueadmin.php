<html>
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
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Edit Club Data Tab -->
            <div class="tab-pane fade show active" id="edit-club" role="tabpanel" aria-labelledby="edit-club-tab">
                <a href="editclub.php" class="btn btn-secondary">Edit Club Data</a>
            </div>

            <!-- Add Division Tab -->
            <div class="tab-pane fade" id="add-division" role="tabpanel" aria-labelledby="add-division-tab">
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
                    <div class="mb-3">
                        <label for="clubname" class="form-label">Club Name</label>
                        <input type="text" id="clubname" name="clubname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" name="location" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" id="website" name="website" class="form-control">
                    </div>
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
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="junior" name="junior" value="Junior">
                        <label for="junior"> Junior</label>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="senior" name="senior" value="Senior">
                        <label for="senior"> Senior</label>
                    </div>
                    <div class="mb-3">
                        <label for="clubnight" class="form-label">Clubnight(s) and Times</label>
                        <input type="text" id="clubnight" name="clubnight" class="form-control">
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
            <div class="tab-pane fade" id="setupseason" role="tabpanel" aria-labelledby="setupseason-tab">
                <h2 class="my-4">Setup season</h2>
                <form action="setupseason.php" method="POST">
                    <div class="mb-3">
                        <p>This wil archive the old data, perform the promotions/relegations and then create all the fixtures ready to be populated by dates</p>
                                
                    </div>
                    <button type="submit" class="btn btn-primary">Go to relegations and promotions page</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
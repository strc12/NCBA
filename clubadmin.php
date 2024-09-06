<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // The request is using the POST method
        
        $id=$_SESSION['clubid'];
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (empty($_GET)) {
            // No query parameters are provided
            
            $id=$_SESSION['clubid'];
            include_once("navbar.php");
            echo("admin");
        } else {
            // Query parameters are provided
            echo("not");
            $id=intval($_GET['q']);
        }
        // The request is using the GET method
    }
    print_r($_SESSION);
    echo($id);
    ?>

</div>

<?php
include_once("connection.php");
$stmt = $conn->prepare("SELECT * FROM TblClub WHERE ClubID = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$club = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-5">
        <h2 class="text-center mb-4">Club Admin</h2>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="update-club-tab" data-bs-toggle="tab" href="#update-club" role="tab" aria-controls="update-club" aria-selected="true">Update Club Details</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="add-player-tab" data-bs-toggle="tab" href="#add-player" role="tab" aria-controls="add-player" aria-selected="false">Add Player</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="edit-players-tab" data-bs-toggle="tab" href="#edit-players" role="tab" aria-controls="edit-players" aria-selected="false">Edit Players</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Update Club Details Tab -->
            <div class="tab-pane fade show active" id="update-club" role="tabpanel" aria-labelledby="update-club-tab">
                <form action="updateclubdetails.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($club['ClubID']); ?>">
                    <div class="mb-3">
                        <label for="clubname" class="form-label">Club Name</label>
                        <input type="text" id="clubname" name="clubname" class="form-control" value="<?php echo htmlspecialchars($club['Clubname']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($club['Location']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" id="website" name="website" class="form-control" value="<?php echo htmlspecialchars($club['Website']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contactname" class="form-label">Contact Name</label>
                        <input type="text" id="contactname" name="contactname" class="form-control" value="<?php echo htmlspecialchars($club['Contactname']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contactnumber" class="form-label">Contact Number</label>
                        <input type="text" id="contactnumber" name="contactnumber" class="form-control" value="<?php echo htmlspecialchars($club['Contactnumber']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contactemail" class="form-label">Contact Email</label>
                        <input type="text" id="contactemail" name="contactemail" class="form-control" value="<?php echo htmlspecialchars($club['Contactemail']); ?>">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="junior" name="junior" value="Junior" <?php if ($club['Junior'] == 1) echo 'checked'; ?>>
                        <label for="junior"> Junior</label>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="senior" name="senior" value="Senior" <?php if ($club['Junior'] != 1) echo 'checked'; ?>>
                        <label for="senior"> Senior</label>
                    </div>
                    <div class="mb-3">
                        <label for="clubnight" class="form-label">Clubnight(s) and Times</label>
                        <textarea id="clubnight" name="clubnight" class="form-control" rows="4"><?php echo htmlspecialchars($club['Clubnight']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </form>
            </div>

            <!-- Add Player Tab -->
            <div class="tab-pane fade" id="add-player" role="tabpanel" aria-labelledby="add-player-tab">
                <h3 class="my-4">Add Player</h3>
                <form action="addplayer.php" method="POST">
                    <input type="hidden" name="clubid" value="<?php echo htmlspecialchars($id); ?>">
                    <div class="mb-3">
                        <label for="forename" class="form-label">Forename</label>
                        <input type="text" id="forename" name="forename" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" id="surname" name="surname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <input type="radio" id="M" name="gender" value="M">
                        <label for="M">M</label><br>
                        <input type="radio" id="F" name="gender" value="F">
                        <label for="F">F</label>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add New Player</button>
                </form>
            </div>

            <!-- Edit Players Tab -->
            <div class="tab-pane fade" id="edit-players" role="tabpanel" aria-labelledby="edit-players-tab">
                <h3 class="my-4">Edit Players in Club</h3>
                <?php
                    echo '<div class="table-responsive">
                        <h4 class="mb-4">Registered Players</h4>
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Member</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>';
                    include_once('connection.php');
                    $stmt = $conn->prepare("SELECT * FROM TblPlayers WHERE ClubID=:cid ORDER BY active DESC, Gender, Surname ASC, Forename ASC");
                    $stmt->bindParam(':cid', $id);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>
                            <td>'.$row["Forename"].' '.$row["Surname"].'</td>
                            <td>'.$row["DOB"].'</td>
                            <td>'.$row["Gender"].'</td>
                            <td>'.($row["active"] == 1 ? 'Member' : 'Non-Member').'</td>
                            <td>
                                <form action="editplayer.php" method="post">
                                    <input type="hidden" name="clubid" value="'.$id.'">
                                    <input type="hidden" name="id" value="'.$row["PlayerID"].'">
                                    <button type="submit" class="btn '.($row['active'] == 1 ? 'btn-primary' : 'btn-danger').'">Edit</button>
                                </form>
                            </td>
                        </tr>';
                    }
                    echo '</tbody></table></div>';
                ?>
            </div>
        </div>
    </div>


</body>
</html>
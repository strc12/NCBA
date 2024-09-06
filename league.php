<!DOCTYPE html>
<html lang="en">
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

<!-- Navigation Bar -->
<div id="result">
    <?php include_once("navbar.php"); ?>
</div>

<div class="container mt-5">
  <h1 class="text-center mb-4">League Composition</h1>

  <?php
  $stmtA = $conn->prepare("SELECT * FROM TblLeague");
  $stmtA->execute();
  $leagues = $stmtA->fetchAll(\PDO::FETCH_ASSOC);

  foreach ($leagues as $league) {
      echo '<div class="card mb-4">';
      echo '<div class="card-header bg-primary text-white">';
      echo '<h3 class="card-title mb-0">' . $league["Name"] . '</h3>';
      echo '</div>';
      echo '<div class="card-body">';

      $stmtb = $conn->prepare("SELECT * FROM TblDivision WHERE LeagueID=:div");
      $stmtb->bindParam(':div', $league["LeagueID"]);
      $stmtb->execute();
      $divisions = $stmtb->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($divisions as $division) {
          echo '<div class="mb-3">';
          echo '<h4 class="text-secondary">' . $division["Name"] . '</h4>';
          echo '<ul class="list-group list-group-flush">';

          $stmt1 = $conn->prepare("SELECT TblClub.Clubname as CN, TblClubhasteam.name as TN , TblClubhasteam.DivisionID as TD FROM TblClub 
            INNER JOIN TblClubhasteam  ON TblClub.ClubID=TblClubhasteam.ClubID 
            WHERE TblClubhasteam.DivisionID=:Division 
            AND TblClubhasteam.current=1");
          $stmt1->bindParam(':Division', $division["DivisionID"]);
          $stmt1->execute();

          while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
              echo '<li class="list-group-item">' . $row1["CN"] . ' - ' . $row1["TN"] . '</li>';
          }
          echo '</ul>';
          echo '</div>';
      }
      echo '</div>';
      echo '</div>';
  }
  ?>
</div>

</body>
</html>
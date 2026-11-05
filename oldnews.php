<?php
require_once(__DIR__ . '/sessions.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
 
    include_once(__DIR__."/setseason.php");

    include_once(__DIR__ . "/navbar.php");

    
    ?>

</div>
<br>
<div class="container mt-5">
  <?php
  include_once(__DIR__ .'/connection.php');

  $stmt = $conn->prepare("SELECT * FROM TblNews ORDER BY dateadded DESC ");
  $stmt->execute();
  #$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

while ($news = $stmt->fetch(PDO::FETCH_ASSOC)) {
    
    echo '
    <div class="card shadow-sm">
      <div class="row g-0 d-flex align-items-stretch">
        <div class="col-md-6 d-flex flex-column">
          <div class="card-body d-flex flex-column h-100 justify-content-between">
            <div>';
           
            if($news["Active"]==1){
                echo '<h1 class="text-danger fw-bold">News</h1>';
                }else{
                echo '<h1 class="text-secondary fw-bold">Old News</h1>';
                }
              echo'
              <h1 class="card-title mb-3">' . htmlspecialchars($news["Heading"]) . '</h1>
              <p class="card-text fs-5 mb-3">' . nl2br(htmlspecialchars($news["Details"])) . '</p>';

    if (!empty($news["Link"])) {
      echo '<a href="' . htmlspecialchars($news["Link"]) . '" target="_blank" rel="noopener noreferrer" class="btn btn-primary mb-3">' . htmlspecialchars($news["Linktext"]) . '</a>';
    }
            

    echo '</div>
            <p class="text-muted mb-0 mt-auto">Added on ' . htmlspecialchars($news["Dateadded"]) . '</p>
          </div>
        </div>';

    if (!empty($news["Picture"])) {
      echo '
        <div class="col-md-5 d-flex align-items-center justify-content-center p-2">
          <img src="./news/' . htmlspecialchars($news["Picture"]) . '" 
               class="img-fluid rounded w-100"
               style="height: 100%; object-fit: contain;"
               alt="News image">
        </div>';
    }

    echo '</div>
    </div><br>';
  }
  ?>
</div>
</div>



</body>
</html>

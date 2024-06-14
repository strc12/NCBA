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
    include_once("navbar.php");
    ?>

</div>

<h1>League composition</h1>
<?php
$stmtA = $conn->prepare("SELECT * FROM tblleague");
$stmtA->execute();
$leagues = $stmtA->fetchAll(\PDO::FETCH_ASSOC);

foreach ( $leagues as $league){
    echo("<h3>".$league["Name"]."</h3>");
    
    $stmtb = $conn->prepare("SELECT * FROM TblDivision WHERE LeagueID=:div ");
    $stmtb->bindParam(':div', $league["LeagueID"]);
    $stmtb->execute();
    $divisions = $stmtb->fetchAll(\PDO::FETCH_ASSOC);
    #print_r($divisions);
    foreach($divisions as $division){
      echo("<h4>".$division["Name"]."</h4>");
      $stmt1 = $conn->prepare("SELECT tblclub.Clubname as CN, tblclubhasteam.name as TN , tblclubhasteam.DivisionID as TD FROM tblclub 
      INNER JOIN tblclubhasteam  ON tblclub.ClubID=tblclubhasteam.ClubID 
      WHERE tblclubhasteam.DivisionID=:Division 
      AND tblclubhasteam.current=1" );
      $stmt1->bindParam(':Division', $division["DivisionID"]);
      $stmt1->execute();
      while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
      {
          #print_r($row1);
          echo($row1["CN"]." - ".$row1["TN"]."<br>");
      }
      echo("<br>");
    }
    echo("<br>");
}
   
?>
</div>


</body>
</html>
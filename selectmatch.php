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
<div class="container-fluid">
<form action="selectplayers.php" method="POST">
    <label>Fixture: </label>
    <select name="match">
        <option>Select match</option>
    <?php
    include_once ("connection.php");
    $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, tblmatches.DivisionID as DID, 
    leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
    away.DivisionID as ad , DIVIS.Name as DIVN FROM tblmatches 
    INNER JOIN tblclubhasteam as home ON (Tblmatches.HomeID = home.ClubhasteamID) 
    INNER JOIN tblclubhasteam as away ON (Tblmatches.AwayID=away.ClubhasteamID) 
    INNER JOIN Tbldivision as DIVIS ON (tblmatches.DivisionID = DIVIS.DivisionID) 
    INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LEagueID) 
    INNER JOIN tblclub as awt ON away.ClubID=awt.ClubID 
    INNER JOIN tblclub as ht ON home.ClubID=ht.ClubID 
    WHERE Season=:SEAS  and resultsentered=1 AND awt.clubID=:club OR ht.clubid=:club ORDER BY ad ASC,fixturedate ASC " );

    $stmt->bindParam(':club', $_SESSION["clubid"]);
    $stmt->bindParam(':SEAS', $_SESSION["Season"]);
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo("<option value=".$row["MatchID"].'>'.$row["HC"]." ".$row["HN"]." v ".$row["AWC"]." ".$row["AWN"]." ".$row["ad"]." - ".date("d M y",(strtotime($row["fixtdate"])))." ~ ".$row["LN"]." ".$row["DIVN"]."</option><br>");
    }
    $conn=null;
    ?>
        
    </select>
    <input type="submit" value="Select match">
</form>
</div>
</body>
</html>
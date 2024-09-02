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
    
    if (isset($_SESSION["clubid"])){
    $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
    leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
    away.DivisionID as ad , DIVIS.Name as DIVN ,resultsentered FROM TblMatches 
    INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
    INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
    INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
    INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
    INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
    INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
    WHERE Season=:SEAS  and resultsentered is Null AND (awt.ClubID=:club OR ht.Clubid=:club) ORDER BY Fixturedate DESC, ad ASC " );

    $stmt->bindParam(':club', $_SESSION["clubid"]);
    $stmt->bindParam(':SEAS', $_SESSION["Season"]);
    }else{
        $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, TblMatches.DivisionID as DID, 
        leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
        away.DivisionID as ad , DIVIS.Name as DIVN ,resultsentered FROM TblMatches 
        INNER JOIN TblClubhasteam as home ON (TblMatches.HomeID = home.ClubhasteamID) 
        INNER JOIN TblClubhasteam as away ON (TblMatches.AwayID=away.ClubhasteamID) 
        INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
        INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LeagueID) 
        INNER JOIN TblClub as awt ON away.ClubID=awt.ClubID 
        INNER JOIN TblClub as ht ON home.ClubID=ht.ClubID 
        WHERE Season=:SEAS and resultsentered is Null  ORDER BY Fixturedate DESC, ad ASC " );
           
        $stmt->bindParam(':SEAS', $_SESSION["Season"]); 
    }
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo("<option value=".$row["MatchID"].'>'.$row["HC"]." ".$row["HN"]." v ".$row["AWC"]." ".$row["AWN"]." ".$row["ad"]." - ".date("d M y",(strtotime($row["Fixturedate"])))." ~ ".$row["LN"]." ".$row["DIVN"]."</option><br>");
    }
    $conn=null;
    ?>
        
    </select>
    <input type="submit" value="Select match">
</form>
<?php

?>
</div>
</body>
<script>
    sessionStorage.clear(); 
</script>
</html>
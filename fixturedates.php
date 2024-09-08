<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
?>
<!DOCTYPE html>
<html>
<head>

    <title>Fixtures</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script>
  $(function() {
    $("#navigation").load("navbar.php");
    });
</script>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:10px">
    <form action="updatefixtures.php" method="POST">
    <br>
    <h3>Current Fixtures</h3>
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
     WHERE Season=:SEAS  AND awt.ClubID=:club OR ht.ClubID=:club ORDER BY ad ASC,Fixturedate ASC " );
 
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
         WHERE Season=:SEAS   ORDER BY ad ASC, Fixturedate ASC " );
 
     $stmt->bindParam(':SEAS', $_SESSION["Season"]);
  
     }
    
    $stmt->execute();
    
   
    
    echo("<table><tbody>");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {   
        
        echo("<tr>");
        
        if(($row["Fixturedate"])=="0000-00-00" ){#no date in yet
            echo("<td style='color:#FF0000'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td><td><input class='form-control' type='date' id='' name='".$row['MatchID']."' size='9' value='".$row["Fixturedate"]."'></td>");
        }else if (isset($_SESSION["adloggedin"])){
            echo("<td style='color:#FF0000'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td><td><input class='form-control' type='date'id='' name='".$row['MatchID']."'size='9' value='".$row["Fixturedate"]."'></td>");
        }else if ($row["AWC"]== $_SESSION["clubname"] ||$row["HC"]== $_SESSION["clubname"]){//logged in club only
       
            echo ("<td>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td><td><input class='form-control' type='date'id='' name='".$row['MatchID']."'size='9' value='".$row["Fixturedate"]."'></td>");
        }else{ //already entered not currently logged in
            echo("<td style='color:#C0C0C0'>".$row['LN']." ".$row['DIVN']." - ".$row['HC']." ".$row['HN']." v ".$row['AWC']." ".$row['AWN']."</td><td><input disabled class='form-control' type='date'id='' name='".$row['MatchID']."'size='9' value='".$row["Fixturedate"]."'></td>");   
        }
        echo("</tr>");

    }
    

    $conn=null;
    ?>
    </tbody>
    <input class="btn btn-primary mb-2" type="submit" value="Update fixtures"> 
    </table>
</div>
</body>
</html>
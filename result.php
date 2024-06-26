<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <script>
    function showresult(str) {
        if (str == "") {
            document.getElementById("results").innerHTML = "";
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
                    document.getElementById("results").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","Getresultsnew.php?q="+str,true);
            xmlhttp.send();
        }
    }
    </script>
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<div class="container-fluid">
<label>Fixture: </label>
<select id="matches" onchange="showresult(this.value)">
    <option>Select match</option>
   <?php
   include_once ("connection.php");
   if (isset($_SESSION["Clubid"])){
    $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, tblmatches.DivisionID as DID, 
    leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
    away.DivisionID as ad , DIVIS.Name as DIVN FROM tblmatches 
    INNER JOIN tblclubhasteam as home ON (Tblmatches.HomeID = home.ClubhasteamID) 
    INNER JOIN tblclubhasteam as away ON (Tblmatches.AwayID=away.ClubhasteamID) 
    INNER JOIN Tbldivision as DIVIS ON (tblmatches.DivisionID = DIVIS.DivisionID) 
    INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LEagueID) 
    INNER JOIN tblclub as awt ON away.ClubID=awt.ClubID 
    INNER JOIN tblclub as ht ON home.ClubID=ht.ClubID 
    WHERE Season=:SEAS and resultsentered=1 AND awt.clubID=:club OR ht.clubid=:club ORDER BY ad ASC,Fixturedate ASC " );

    $stmt->bindParam(':club', $_SESSION["clubid"]);
    $stmt->bindParam(':SEAS', $_SESSION["Season"]);
    }else{
        $stmt = $conn->prepare("SELECT MatchID,HomeID, AwayID, Season, Fixturedate, tblmatches.DivisionID as DID, 
        leag.name as LN, awt.Clubname as AWC, ht.Clubname as HC, home.DivisionID as hd, away.Name as AWN, home.Name as HN, 
        away.DivisionID as ad , DIVIS.Name as DIVN FROM tblmatches 
        INNER JOIN tblclubhasteam as home ON (Tblmatches.HomeID = home.ClubhasteamID) 
        INNER JOIN tblclubhasteam as away ON (Tblmatches.AwayID=away.ClubhasteamID) 
        INNER JOIN Tbldivision as DIVIS ON (tblmatches.DivisionID = DIVIS.DivisionID) 
        INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LEagueID) 
        INNER JOIN tblclub as awt ON away.ClubID=awt.ClubID 
        INNER JOIN tblclub as ht ON home.ClubID=ht.ClubID 
        WHERE Season=:SEAS and resultsentered=1 ORDER BY ad ASC,Fixturedate ASC " );

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
</form>
</div>
<?php

?>
<div id="results"></div>
<script>
$("#matches").on("change", function(){
    var selected=$(this).val();
    $("#results").html("You selected: " + selected);
  })</script>
</div>
</body>
</html>
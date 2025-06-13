<html>
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
<?php

#print_r($_POST);
echo("<br>");
if(session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if (isset($_POST["promote_team"])){
    $up=$_POST["promote_team"];
    foreach ($up as $team) {
        $stmt = $conn->prepare("SELECT 
    DV.LeagueID AS DLID,
    DV.Name AS LN,
    DV.Divisionrank AS DR,
    MinDiv.MinDR,  -- Get the maximum Divisionrank from the subquery
    TblClubhasteam.DivisionID,
    CL.Clubname AS CN,
    TblClubhasteam.Name AS FN,
    TblClubhasteam.ClubhasteamID AS CID
    FROM TblClubhasteam 
    INNER JOIN TblClub AS CL ON CL.ClubID = TblClubhasteam.ClubID
    INNER JOIN TblDivision AS DV ON DV.DivisionID = TblClubhasteam.DivisionID
    INNER JOIN (
        SELECT 
            LeagueID, 
            MIN(Divisionrank) AS MinDR  -- Calculate the maximum Divisionrank for each LeagueID
        FROM TblDivision
        GROUP BY LeagueID
    ) AS MinDiv ON DV.LeagueID = MinDiv.LeagueID
    WHERE TblClubhasteam.ClubhasteamID = :team;");

    $stmt->bindParam(':team', $team);
    
   
   $stmt->execute();
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
   {
    
        echo("Current div is ".$row["LN"]." - ".$row["DR"]."<br>");
        if ($row["DR"]-1>=$row["MinDR"]){
            echo("Promoting ".$row["CN"].$row["FN"]." to Division ".($row["DR"]-1)."<br>");# need to change so uses division rank withing LeagueID
            $dlid=$row['DLID'];
           $sql = "SELECT * FROM TblDivision 
           WHERE  LeagueID= :dlid  and Divisionrank=:dr";
            #$sql = "UPDATE TblClubhasteam SET DivisionID = :DivID
            #WHERE ClubhasteamID = :id";
           $stmt = $conn->prepare($sql);
           $params=[
               ':dr' => $row["DR"]-1, 
               ':dlid'=>$row['DLID']
           ];
           $stmt->execute($params);
           while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC)){
            #echo("<br>");
            #print_r($row1);
            $sql1 = "UPDATE TblClubhasteam SET DivisionID = :DivID
            WHERE ClubhasteamID = :id";
           $stmt1 = $conn->prepare($sql1);
           $params=[
               ':DivID' => $row1["DivisionID"], 
               ':id'=>$row ["CID"]
               
           ];
           $stmt1->execute($params);
           }
          
        } else{
            echo($row["CN"].$row["FN"]." is already in the top Division <br>");
        }
       
       echo("<br>");
   }
} 
}else{
    echo("No promotions");
}

if (isset($_POST["relegate_team"])){
    $down=$_POST["relegate_team"];
    foreach ($down as $team) {
    $stmt = $conn->prepare("SELECT 
    DV.LeagueID AS DLID,
    DV.Name AS LN,
    DV.Divisionrank AS DR,
    MaxDiv.MaxDR,  -- Get the maximum Divisionrank from the subquery
    TblClubhasteam.DivisionID,
    CL.Clubname AS CN,
    TblClubhasteam.Name AS FN,
    TblClubhasteam.ClubhasteamID AS CID
    FROM TblClubhasteam 
    INNER JOIN TblClub AS CL ON CL.ClubID = TblClubhasteam.ClubID
    INNER JOIN TblDivision AS DV ON DV.DivisionID = TblClubhasteam.DivisionID
    INNER JOIN (
        SELECT 
            LeagueID, 
            MAX(Divisionrank) AS MaxDR  -- Calculate the maximum Divisionrank for each LeagueID
        FROM TblDivision
        GROUP BY LeagueID
    ) AS MaxDiv ON DV.LeagueID = MaxDiv.LeagueID
    WHERE TblClubhasteam.ClubhasteamID = :team;");

        $stmt->bindParam(':team', $team);


    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo("Current div is ".$row["LN"]." - ".$row["DR"]."<br>");
            
        if ($row["DR"]+1>=$row["MaxDR"]){
            echo("Relegating ".$row["CN"].$row["FN"]." to Division ".($row["DR"]+1)."<br>");
            $sql = "SELECT * FROM TblDivision 
           WHERE  LeagueID= :dlid  and Divisionrank=:dr";
            #$sql = "UPDATE TblClubhasteam SET DivisionID = :DivID
            #WHERE ClubhasteamID = :id";
           $stmt = $conn->prepare($sql);
           $params=[
               ':dr' => $row["DR"]+1, 
               ':dlid'=>$row['DLID']
           ];
           $stmt->execute($params);
           while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC)){
            #echo("<br>");
            #print_r($row1);
            $sql1 = "UPDATE TblClubhasteam SET DivisionID = :DivID
            WHERE ClubhasteamID = :id";
           $stmt1 = $conn->prepare($sql1);
           $params=[
               ':DivID' => $row1["DivisionID"], 
               ':id'=>$row ["CID"]
               
           ];
           $stmt1->execute($params);
           }
          
        }else{
            echo($row["CN"].$row["FN"]. " is already in the bottom division no relegation<br>");
        }
    
    echo("<br>");
    }
    }
}else{
    echo("No relegations");
}

include_once "connection.php";
 
#relegation

   $conn=null;
$_SESSION["promrel"]=1;
?>
</div>
</body>
</html>
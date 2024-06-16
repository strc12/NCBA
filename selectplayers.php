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
    
    function popdropdown($club,$sex,$position){
        include ('connection.php');//hides connection details

        $stmt1=$conn->prepare("SELECT $position FROM tblmatches where MatchID = :mid");#looks up the field to see if alread set value
        $stmt1->bindParam(':mid', $_SESSION["curmatch"]);
        $stmt1->execute(); 
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
            $playerID=($row[$position]);
        }

        echo "<select name='$position' id='$position'>";
        
       
        if ($sex=="B"){
            $stmt=$conn->prepare("SELECT Forename, Surname, Gender, PlayerID,active FROM tblplayers where ClubID = :cid AND active=1 Order By Gender ASC, Surname ASC, Forename ASC");
            $stmt->bindParam(':cid', $club);
            $stmt->execute();  
        }else{
            echo("yo");
            $stmt=$conn->prepare("SELECT Forename, Surname, Gender, PlayerID FROM tblplayers where ClubID = :cid AND Gender= :sex AND active=1 Order By  Surname ASC, Forename ASC");
            $stmt->bindParam(':cid', $club);
            $stmt->bindParam(':sex', $sex);
            $stmt->execute();  
            
        } 
        echo "<option value='' selected disabled>Please select a Player...</option>";
    // GOING THROUGH THE DATA
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {	if ($playerID == $row['PlayerID']) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
                //code for drop down list
                echo '<option value="' . $row['PlayerID'] . '"' . $selected . '>' . $row['Forename'] ." ". $row['Surname'] .'</option>';
                
        }
        echo("</select>");
    }

?>

</div>
<?php
#print_R($_POST);
include_once ("connection.php");
   $stmt = $conn->prepare("SELECT leag.Name as leagn, leag.LeagueID, tblmatches.DivisionID, DIVIS.Name as divn,
   cla.ClubID as awc, clh.ClubID as hc, cla.Clubname as awcn, clh.Clubname as hcn,
   hteam.Name as htn,  ateam.Name as awtn
   from tblmatches
   INNER JOIN Tbldivision as DIVIS ON (tblmatches.DivisionID = DIVIS.DivisionID) 
   INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LEagueID) 
   INNER JOIN tblclubhasteam as hteam On(hteam.clubhasteamID =tblmatches.HomeID)
   INNER JOIN tblclubhasteam as ateam On(ateam.clubhasteamID =tblmatches.AwayID)
   INNER JOIN tblclub as clh on (clh.clubID= hteam.clubID)
   INNER JOIN tblclub as cla on (cla.clubID= ateam.clubID)
   WHERE Season=:SEAS  AND tblmatches.matchID=:match" );

   $stmt->bindParam(':match', $_POST["match"]);
   $stmt->bindParam(':SEAS', $_SESSION["Season"]);
   $stmt->execute();
   
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
   {
    print_r($row);
    print_r($_SESSION);
       $_SESSION["curleague"]=$row["LeagueID"];
       $_SESSION["curmatch"]=$_POST["match"];
       $home=$row["hc"];
       $away=$row["awc"];
       $ht=$row["hcn"].' '.$row["htn"];
       $at=$row["awcn"].' '.$row["awtn"];
       $_SESSION["home"]=$ht;
       $_SESSION["away"]=$at;
   }
   $conn=null;
   echo$home."- ".$away;
   #could make this more flexible fr format chagnes but hard coded for time being
   
    echo'<form action ="scoresheet.php" method="POST" onsubmit="return validateForm()">' ;
    echo("<input type='hidden'  name='FixID' value=".$_SESSION["curmatch"].">");
    ?>
    <h3>Players</h3><table style = "width:60%"  class="table-striped table-bordered table-condensed"><tr><th colspan="2"><?php echo($ht);?> Players</th><th colspan="2"><?php echo($at);?> Players</th></tr>
    <tr>
    <td>Player 1</td>
    <td><?php popdropdown($home,'B','HomeP1ID');?></td>
    <td>Player 1</td>
    <td><?php popdropdown($away,'B','AwayP1ID');?></td>
    </tr>

    <tr>
    <td>Player 2</td>
    <td><?php popdropdown($home,'B','HomeP2ID');?></td>
    <td>Player 2</td>
    <td><?php popdropdown($away,'B','AwayP2ID');?></td>
    </tr>

    <tr>
    <td>Player 3</td>
    <td><?php popdropdown($home,'B','HomeP3ID');?></td>
    <td>Player 3</td>
    <td><?php popdropdown($away,'B','AwayP3ID');?></td>
    </tr>
    <?php if($_SESSION["curleague"]==1){
        ?>
        <tr>
        <td>Player 1</td>
        <td><?php popdropdown($home,'B','HomeP4ID');?></td>
        <td>Player 1</td>
        <td><?php popdropdown($away,'B','AwayP4ID');?></td>
        </tr>

        <tr>
        <td>Player 2</td>
        <td><?php popdropdown($home,'B','HomeP5ID');?></td>
        <td>Player 2</td>
        <td><?php popdropdown($away,'B','AwayP5ID');?></td>
        </tr>

        <tr>
        <td>Player 3</td>
        <td><?php popdropdown($home,'B','HomeP6ID');?></td>
        <td>Player 3</td>
        <td><?php popdropdown($away,'B','AwayP6ID');?></td>
        </tr>
    <?php }else{ ?>
        <tr>
        <td>Lady 1</td>
        <td><?php popdropdown($home,'F','HomeP4ID');?></td>
        <td>Lady 1</td>
        <td><?php popdropdown($away,'F','AwayP4ID');?></td>
        </tr>

        <tr>
        <td>Lady 2</td>
        <td><?php popdropdown($home,'F','HomeP5ID');?></td>
        <td>Lady 2</td>
        <td><?php popdropdown($away,'F','AwayP5ID');?></td>
        </tr>

        <tr>
        <td>Lady 3</td>
        <td><?php popdropdown($home,'F','HomeP6ID');?></td>
        <td>Lady 3</td>
        <td><?php popdropdown($away,'F','AwayP6ID');?></td>
        </tr>
    <?php } ?>
        <tr><td colspan="4"><input class="btn btn-primary mb-2" type="submit" value="Submit players"></td></tr>
    </table>

    
    </form>

   


</div>


</body>
</html>
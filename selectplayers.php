<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
?>
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
    
    function popdropdown($club,$sex,$position){
        include ('connection.php');//hides connection details
        $char = 'x';

        $pos = strpos($position, $char);
        
        if ($pos!=5 ){
            $stmt1=$conn->prepare("SELECT $position FROM TblMatches where MatchID = :mid");#looks up the field to see if already set value
            $stmt1->bindParam(':mid', $_SESSION["curmatch"]);
            $stmt1->execute(); 
            while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
                $playerID=($row[$position]);
            }
        }
        echo "<select name='$position' id='$position'>";
        
       
        if ($sex=="B"){
            $stmt=$conn->prepare("SELECT Forename, Surname, Gender, PlayerID,active FROM TblPlayers where ClubID = :cid AND active=1 Order By Gender DESC, Surname ASC, Forename ASC");
            $stmt->bindParam(':cid', $club);
            $stmt->execute();  
        }else{
            $stmt=$conn->prepare("SELECT Forename, Surname, Gender, PlayerID FROM TblPlayers where ClubID = :cid AND Gender= :sex AND active=1 Order By  Surname ASC, Forename ASC");
            $stmt->bindParam(':cid', $club);
            $stmt->bindParam(':sex', $sex);
            $stmt->execute();  
            
        } 
        echo "<option value='' selected disabled>Please select a Player...</option>";
    // GOING THROUGH THE DATA
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         	if ($playerID == $row['PlayerID']) {
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

include_once ("connection.php");
   $stmt = $conn->prepare("SELECT leag.Name as leagn, leag.LeagueID, TblMatches.DivisionID, DIVIS.Name as divn,
   cla.ClubID as awc, clh.ClubID as hc, cla.Clubname as awcn, clh.Clubname as hcn,
   hteam.Name as htn,  ateam.Name as awtn
   from TblMatches
   INNER JOIN TblDivision as DIVIS ON (TblMatches.DivisionID = DIVIS.DivisionID) 
   INNER JOIN TblLeague as leag ON (DIVIS.LeagueID = leag.LEagueID) 
   INNER JOIN TblClubhasteam as hteam On(hteam.ClubhasteamID =TblMatches.HomeID)
   INNER JOIN TblClubhasteam as ateam On(ateam.ClubhasteamID =TblMatches.AwayID)
   INNER JOIN TblClub as clh on (clh.ClubID= hteam.ClubID)
   INNER JOIN TblClub as cla on (cla.ClubID= ateam.ClubID)
   WHERE Season=:SEAS  AND TblMatches.MatchID=:match" );

   $stmt->bindParam(':match', $_POST["match"]);
   $stmt->bindParam(':SEAS', $_SESSION["Season"]);
   $stmt->execute();
   
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
   {
       $_SESSION["curleague"]=$row["LeagueID"];
       $_SESSION["curmatch"]=$_POST["match"];
       $home=$row["hc"];
       $away=$row["awc"];
       $ht=$row["hcn"].' '.$row["htn"];
       $at=$row["awcn"].' '.$row["awtn"];
       $_SESSION["home"]=$ht;
       $_SESSION["away"]=$at;
       $ln=$row["leagn"];
       $dn=$row["divn"];
       
   }
   $conn=null;
   echo $ht."- ".$at."<br>";
   echo($ln." ".$dn);
   #could make this more flexible for format changes but hard coded for time being
   
    echo'<form action ="scoresheet.php" method="POST" onsubmit="return validateForm()">' ;
    echo("<input type='hidden'  name='FixID' value=".$_SESSION["curmatch"].">");
    ?>
    <h3>Players</h3><table style = "width:60%"  class="table-striped table-bordered table-condensed"><tr><th colspan="2"><?php echo($ht);?> Players</th><th colspan="2"><?php echo($at);?> Players</th></tr>
    <?php if ($_SESSION["curleague"] == 4) { ?>
    <tr>
        <td>Lady 1</td>
        <td><?php popdropdown($home, 'F', 'HomeP1ID'); ?></td>
        <td>Lady 1</td>
        <td><?php popdropdown($away, 'F', 'AwayP1ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 2</td>
        <td><?php popdropdown($home, 'F', 'HomeP2ID'); ?></td>
        <td>Lady 2</td>
        <td><?php popdropdown($away, 'F', 'AwayP2ID'); ?></td>
    </tr>
<?php } else { ?>
    <tr>
        <td>Player 1</td>
        <td><?php popdropdown($home, 'B', 'HomeP1ID'); ?></td>
        <td>Player 1</td>
        <td><?php popdropdown($away, 'B', 'AwayP1ID'); ?></td>
    </tr>
    <tr>
        <td>Player 2</td>
        <td><?php popdropdown($home, 'B', 'HomeP2ID'); ?></td>
        <td>Player 2</td>
        <td><?php popdropdown($away, 'B', 'AwayP2ID'); ?></td>
    </tr>
    <tr>
        <td>Player 3</td>
        <td><?php popdropdown($home, 'B', 'HomeP3ID'); ?></td>
        <td>Player 3</td>
        <td><?php popdropdown($away, 'B', 'AwayP3ID'); ?></td>
    </tr>
<?php }

if ($_SESSION["curleague"] == 1) { ?>
    <tr>
        <td>Player 4</td>
        <td><?php popdropdown($home, 'B', 'HomeP4ID'); ?></td>
        <td>Player 4</td>
        <td><?php popdropdown($away, 'B', 'AwayP4ID'); ?></td>
    </tr>
    <tr>
        <td>Player 5</td>
        <td><?php popdropdown($home, 'B', 'HomeP5ID'); ?></td>
        <td>Player 5</td>
        <td><?php popdropdown($away, 'B', 'AwayP5ID'); ?></td>
    </tr>
    <tr>
        <td>Player 6</td>
        <td><?php popdropdown($home, 'B', 'HomeP6ID'); ?></td>
        <td>Player 6</td>
        <td><?php popdropdown($away, 'B', 'AwayP6ID'); ?></td>
    </tr>
<?php } elseif ($_SESSION["curleague"] == 4) { ?>
    <tr>
        <td>Lady 3</td>
        <td><?php popdropdown($home, 'F', 'HomeP3ID'); ?></td>
        <td>Lady 3</td>
        <td><?php popdropdown($away, 'F', 'AwayP3ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 4</td>
        <td><?php popdropdown($home, 'F', 'HomeP4ID'); ?></td>
        <td>Lady 4</td>
        <td><?php popdropdown($away, 'F', 'AwayP4ID'); ?></td>
    </tr>
<?php } else { ?>
    <tr>
        <td>Lady 1</td>
        <td><?php popdropdown($home, 'F', 'HomeP4ID'); ?></td>
        <td>Lady 1</td>
        <td><?php popdropdown($away, 'F', 'AwayP4ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 2</td>
        <td><?php popdropdown($home, 'F', 'HomeP5ID'); ?></td>
        <td>Lady 2</td>
        <td><?php popdropdown($away, 'F', 'AwayP5ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 3</td>
        <td><?php popdropdown($home, 'F', 'HomeP6ID'); ?></td>
        <td>Lady 3</td>
        <td><?php popdropdown($away, 'F', 'AwayP6ID'); ?></td>
    </tr>
<?php }

if ($_SESSION["curleague"] == 3) { ?>
    <tr>
        <td colspan='4' class='text-center'>Mixed pair 1</td>
    </tr>
    <tr>
        <td>Player 1</td>
        <td><?php popdropdown($home, 'B', 'Homemx1ID'); ?></td>
        <td>Player 1</td>
        <td><?php popdropdown($away, 'B', 'Awaymx1ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 1</td>
        <td><?php popdropdown($home, 'F', 'Homemx1lID'); ?></td>
        <td>Lady 1</td>
        <td><?php popdropdown($away, 'F', 'Awaymx1lID'); ?></td>
    </tr>
    <tr>
        <td colspan='4' class='text-center'>Mixed Pair 2</td>
    </tr>
    <tr>
        <td>Player 2</td>
        <td><?php popdropdown($home, 'B', 'Homemx2ID'); ?></td>
        <td>Player 2</td>
        <td><?php popdropdown($away, 'B', 'Awaymx2ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 2</td>
        <td><?php popdropdown($home, 'F', 'Homemx2lID'); ?></td>
        <td>Lady 2</td>
        <td><?php popdropdown($away, 'F', 'Awaymx2lID'); ?></td>
    </tr>
    <tr>
        <td colspan='4' class='text-center'>Mixed Pair 3</td>
    </tr>
    <tr>
        <td>Player 3</td>
        <td><?php popdropdown($home, 'B', 'Homemx3ID'); ?></td>
        <td>Player 3</td>
        <td><?php popdropdown($away, 'B', 'Awaymx3ID'); ?></td>
    </tr>
    <tr>
        <td>Lady 3</td>
        <td><?php popdropdown($home, 'F', 'Homemx3lID'); ?></td>
        <td>Lady 3</td>
        <td><?php popdropdown($away, 'F', 'Awaymx3lID'); ?></td>
    </tr>
<?php } ?>


    
        <tr><td colspan="4"><input class="btn btn-primary mb-2" type="submit" value="Submit players"></td></tr>
    </table>

    
    </form>

   


</div>


</body>
</html>
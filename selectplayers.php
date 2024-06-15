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

	echo "<select name='$position' id='$position'>";
    
	include ('connection.php');//hides connection details
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
	{	
			//code for drop down list
			echo '<option value="' . $row['UserID'] . '">' . $row['Forename'] ." ". $row['Surname'] .'</option>';
			
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
    <td><?php popdropdown($home,'B','ph1');?></td>
    <td>Player 1</td>
    <td><?php popdropdown($away,'B','pa1');?></td>
    </tr>

    <tr>
    <td>Player 2</td>
    <td><?php popdropdown($home,'B','ph2');?></td>
    <td>Player 2</td>
    <td><?php popdropdown($away,'B','pa2');?></td>
    </tr>

    <tr>
    <td>Player 3</td>
    <td><?php popdropdown($home,'B','ph3');?></td>
    <td>Player 3</td>
    <td><?php popdropdown($away,'B','pa3');?></td>
    </tr>
    <?php if($_SESSION["curleague"]==1){
        ?>
        <tr>
        <td>Player 1</td>
        <td><?php popdropdown($home,'B','ph4');?></td>
        <td>Player 1</td>
        <td><?php popdropdown($away,'B','pa4');?></td>
        </tr>

        <tr>
        <td>Player 2</td>
        <td><?php popdropdown($home,'B','ph5');?></td>
        <td>Player 2</td>
        <td><?php popdropdown($away,'B','pa5');?></td>
        </tr>

        <tr>
        <td>Player 3</td>
        <td><?php popdropdown($home,'B','ph6');?></td>
        <td>Player 3</td>
        <td><?php popdropdown($away,'B','pa6');?></td>
        </tr>
    <?php }else{ ?>
        <tr>
        <td>Lady 1</td>
        <td><?php popdropdown($home,'F','ph4');?></td>
        <td>Lady 1</td>
        <td><?php popdropdown($away,'F','pa4');?></td>
        </tr>

        <tr>
        <td>Lady 2</td>
        <td><?php popdropdown($home,'F','ph5');?></td>
        <td>Lady 2</td>
        <td><?php popdropdown($away,'F','pa5');?></td>
        </tr>

        <tr>
        <td>Lady 3</td>
        <td><?php popdropdown($home,'F','ph6');?></td>
        <td>Lady 3</td>
        <td><?php popdropdown($away,'F','pa6');?></td>
        </tr>
    <?php } ?>
        <tr><td colspan="4"><input class="btn btn-primary mb-2" type="submit" value="Submit players"></td></tr>
    </table>

    
    </form>

   


</div>


</body>
</html>
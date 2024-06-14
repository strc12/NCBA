<?php
#page to generate all fixtures - not visible
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
#header("Location:index.php");
include_once("setup.php");#to reset seasons every time whilst testing
include_once("setseason.php");

include_once ("connection.php");

#need to put in something to confirm this..
#if ($_SESSION["SEASON"]!=$_POST["seasoncode"]){
    //need to check if seasonname already exists before doing this to prevent extra matches being created
    #Calcs new season name
    $year=date('Y');
    $year=substr($year, -2);
    $y1=$year+1;
    $seas=$year.$y1;
    
    $cur=1;
    if ($seas!=$_SESSION["Season"]){
        #adds new season if needed
        $stmt=$conn->prepare("UPDATE TblSeason SET current=0 WHERE current=1"); #Archive current season
        $stmt->execute();
        $stmt1=$conn->prepare("INSERT INTO Tblseason (Season,current) VALUES (:season, :cur)");
        $stmt1->bindParam(':season', $seas);
        $stmt1->bindParam(':cur', $cur);
        $stmt1->execute();
        $_SESSION["Season"]=$seas;#updates current season session variable

        $stmtA = $conn->prepare("SELECT * FROM tblleague");
        $stmtA->execute();
        $leagues = $stmtA->fetchAll(\PDO::FETCH_ASSOC);
        
        foreach ( $leagues as $league){
            echo($league["LeagueID"]);
            echo("<br>");
            $stmtb = $conn->prepare("SELECT * FROM TblDivision WHERE LeagueID=:div ");
            $stmtb->bindParam(':div', $league["LeagueID"]);
            $stmtb->execute();
            $divisions = $stmtb->fetchAll(\PDO::FETCH_ASSOC);
            #print_r($divisions);
            foreach ( $divisions as $division){
                echo($division["DivisionID"].$division["Name"]);
                echo("<br>");
                $stmtc = $conn->prepare("SELECT * FROM TblClubhasteam WHERE DivisionID=:div and current=1");
                $stmtc->bindParam(':div', $division["DivisionID"]);
                $stmtc->execute();
                $teams = $stmtc->fetchAll(\PDO::FETCH_ASSOC);
                print_r($teams);
                $arrlength = count($teams);

                for($x = 0; $x < $arrlength; $x++) {
                    for($y = 0; $y<$arrlength; $y++){
                        
                        if ($teams[$x]['ClubhasteamID']!=$teams[$y]['ClubhasteamID']){
                            
                            echo($teams[$x]['Name']." v ".($teams[$y]['Name'])."<br>");
                            $stmt = $conn->prepare("INSERT INTO TblMatches (MatchID,HomeID, AwayID,FixtureDate,Season,DivisionID)VALUES(NULL,:Home,:Away,NULL,:season,:div)");
                            $stmt->bindParam(':Home', $teams[$x]['ClubhasteamID']);
                            $stmt->bindParam(':Away', $teams[$y]['ClubhasteamID']);
                            $stmt->bindParam(':div', $division["DivisionID"]);
                            $stmt->bindParam(':season', $_SESSION['Season']);
                            $stmt->execute(); 
                        }
                    }
        
    }
            }
        }
    }
    /*$stmtA = $conn->prepare("SELECT * FROM teams WHERE division='A'");
    $stmtA->execute();
    $result = $stmtA->fetchAll(\PDO::FETCH_ASSOC);
    $arrlength = count($result);

    for($x = 0; $x < $arrlength; $x++) {
        for($y = 0; $y<$arrlength; $y++){
            
            if ($result[$x]['TeamID']!=$result[$y]['TeamID']){
                $stmt = $conn->prepare("INSERT INTO fixtures (FixtureID,HomeID, AwayID,FixtDate,Season)VALUES(NULL,:Home,:Away,NULL,:season)");
                $stmt->bindParam(':Home', $result[$x]['TeamID']);
                $stmt->bindParam(':Away', $result[$y]['TeamID']);
                $stmt->bindParam(':season', $_POST['seasoncode']);
                $stmt->execute(); 
            }
        }
        
    }
    $stmtB = $conn->prepare("SELECT * FROM teams WHERE division='B'");
    $stmtB->execute();
    $result = $stmtB->fetchAll(\PDO::FETCH_ASSOC);
    $arrlength = count($result);

    for($x = 0; $x < $arrlength; $x++) {
        for($y = 0; $y<$arrlength; $y++){
            
            if ($result[$x]['TeamID']!=$result[$y]['TeamID']){
                $stmt = $conn->prepare("INSERT INTO fixtures (FixtureID,HomeID, AwayID,FixtDate,Season)VALUES(NULL,:Home,:Away,NULL,:season)");
                $stmt->bindParam(':Home', $result[$x]['TeamID']);
                $stmt->bindParam(':Away', $result[$y]['TeamID']);
                $stmt->bindParam(':season', $_POST['seasoncode']);
                $stmt->execute(); 
            }
        }
        
}
echo ("fixtures created");    
$_SESSION["SEASON"]=  $_POST['seasoncode'];
}else{
    echo("nothing to do");
}  

 */

?>
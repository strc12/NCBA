<?php
session_start();
//print_r($_POST);
//print_r($_SESSION);

include_once ("connection.php");
// Check if the form is submitted to update the item

    $sql = "UPDATE TblMatches SET HomeP1ID = :p1h, HomeP2ID = :p2h, HomeP3ID = :p3h, HomeP4ID = :p4h, HomeP5ID = :p5h, HomeP6ID=:p6h,
    AwayP1ID = :p1a, AwayP2ID = :p2a, AwayP3ID = :p3a, AwayP4ID = :p4a, AwayP5ID = :p5a, AwayP6ID=:p6a
     WHERE MatchID = :id";
    $stmt = $conn->prepare($sql);
    $params=[
        ':p1h' => $_POST['HomeP1ID'], 
        ':p2h' => $_POST['HomeP2ID'], 
        ':p3h' => $_POST['HomeP3ID'],
        ':p4h' => $_POST['HomeP4ID'],
        ':p5h' => $_POST['HomeP5ID'],
        ':p6h' => $_POST['HomeP6ID'],
        ':p1a' => $_POST['AwayP1ID'], 
        ':p2a' => $_POST['AwayP2ID'], 
        ':p3a' => $_POST['AwayP3ID'],
        ':p4a' => $_POST['AwayP4ID'],
        ':p5a' => $_POST['AwayP5ID'],
        ':p6a' => $_POST['AwayP6ID'],
        ':id'=> $_SESSION["curmatch"]
    ];
    $stmt->execute($params);


?>
<?php



?>
<?php
include_once ("connection.php");
$stmt=$conn->prepare("SELECT TblMatches.FixtureDate, 
TblMatches.m1h,TblMatches.m1a,
TblMatches.m2h,TblMatches.m2a,
TblMatches.m3h,TblMatches.m3a,
TblMatches.m4h,TblMatches.m4a,
TblMatches.m5h,TblMatches.m5a,
TblMatches.m6h,TblMatches.m6a,
TblMatches.m7h,TblMatches.m7a,
TblMatches.m8h,TblMatches.m8a,
TblMatches.m9h,TblMatches.m9a,
TblMatches.m10h,TblMatches.m10a,
TblMatches.m11h,TblMatches.m11a,
TblMatches.m12h,TblMatches.m12a,
TblMatches.m13h,TblMatches.m13a,
TblMatches.m14h,TblMatches.m14a,
TblMatches.m15h,TblMatches.m15a,
TblMatches.m16h,TblMatches.m16a,
TblMatches.m17h,TblMatches.m17a,
TblMatches.m18h,TblMatches.m18a,
TblMatches.m19h,TblMatches.m19a,
TblMatches.m20h,TblMatches.m20a,
TblMatches.m21h,TblMatches.m21a,
TblMatches.m22h,TblMatches.m22a,
TblMatches.m23h,TblMatches.m23a,
TblMatches.m24h,TblMatches.m24a,
TblMatches.m25h,TblMatches.m25a,
TblMatches.m26h,TblMatches.m26a,
TblMatches.m27h,TblMatches.m27a,
TblMatches.HomeID as Home, TblMatches.AwayID as Away,  
P1.Forename as P1f, P1.Surname as P1s, 
P2.Forename as P2f, P2.Surname as P2s,
P3.Forename as P3f, P3.Surname as P3s,
P4.Forename as P4f, P4.Surname as P4s,
P5.Forename as P5f, P5.Surname as P5s,
P6.Forename as P6f, P6.Surname as P6s,
AP1.Forename as AP1f, AP1.Surname as AP1s, 
AP2.Forename as AP2f, AP2.Surname as AP2s,
AP3.Forename as AP3f, AP3.Surname as AP3s,
AP4.Forename as AP4f, AP4.Surname as AP4s,
AP5.Forename as AP5f, AP5.Surname as AP5s,
AP6.Forename as AP6f, AP6.Surname as AP6s,
awc.CLubname as AWC, hc.Clubname as HC,
awt.Name as AWT, ht.Name as HT

FROM tblMatches 
INNER JOIN  TblPlayers as P1 on HomeP1ID = P1.PlayerID
INNER JOIN  TblPlayers as P2 on HomeP2ID = P2.PlayerID
INNER JOIN  TblPlayers as P3 on HomeP3ID = P3.PlayerID
INNER JOIN  TblPlayers as P4 on HomeP4ID = P4.PlayerID
INNER JOIN  TblPlayers as P5 on HomeP5ID = P5.PlayerID
INNER JOIN  TblPlayers as P6 on HomeP6ID = P6.PlayerID
INNER JOIN  TblPlayers as AP1 on AwayP1ID = AP1.PlayerID
INNER JOIN  TblPlayers as AP2 on AwayP2ID = AP2.PlayerID
INNER JOIN  TblPlayers as AP3 on AwayP3ID = AP3.PlayerID
INNER JOIN  TblPlayers as AP4 on AwayP4ID = AP4.PlayerID
INNER JOIN  TblPlayers as AP5 on AwayP5ID = AP5.PlayerID
INNER JOIN  TblPlayers as AP6 on AwayP6ID = AP6.PlayerID
INNER JOIN TblClubhasteam as ht ON (TblMatches.HomeID = ht.ClubhasteamID) 
INNER JOIN TblClubhasteam as awt ON (TblMatches.AwayID=awt.ClubhasTeamID) 
INNER JOIN TblClub as awc ON awt.ClubID=awc.ClubID 
INNER JOIN TblClub as hc ON ht.ClubID=hc.ClubID 
WHERE tblMatches.MatchID=:id" );
$stmt->bindParam(':id', $_SESSION['curmatch']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//print_r($row);
echo("<br>");
//print_r($_SESSION);

?>
<!DOCTYPE HTML>
<HTML>
<Head>
<title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <script>
        // removes session variable counter
    //sessionStorage.removeItem("counter");
    
    /* function totalscores(){
        var homegamestotal=0;
        var awaygamestotal=0;
        var homepointstotal=0;
        var awaypointstotal=0;
        
        homepointstotal=parseInt(document.getElementById('m1hpts').value)+parseInt(document.getElementById('m2hpts').value)+parseInt(document.getElementById('m3hpts').value)+parseInt(document.getElementById('m3ahpts').value)+parseInt(document.getElementById('m4hpts').value)+parseInt(document.getElementById('m4ahpts').value
        )+parseInt(document.getElementById('m5hpts').value)+parseInt(document.getElementById('m5ahpts').value)+parseInt(document.getElementById('m6hpts').value)+parseInt(document.getElementById('m6ahpts').value)+parseInt(document.getElementById('m7hpts').value)+parseInt(document.getElementById('m7ahpts').value
        )+parseInt(document.getElementById('m8hpts').value)+parseInt(document.getElementById('m8ahpts').value)+parseInt(document.getElementById('m9hpts').value)+parseInt(document.getElementById('m9ahpts').value)+parseInt(document.getElementById('m10hpts').value)+parseInt(document.getElementById('m10ahpts').value);
        console.log(homepointstotal);
        awaypointstotal=parseInt(document.getElementById('m1apts').value)+parseInt(document.getElementById('m2apts').value)+parseInt(document.getElementById('m3apts').value)+parseInt(document.getElementById('m3aapts').value)+parseInt(document.getElementById('m4apts').value)+parseInt(document.getElementById('m4aapts').value
        )+parseInt(document.getElementById('m5apts').value)+parseInt(document.getElementById('m5aapts').value)+parseInt(document.getElementById('m6apts').value)+parseInt(document.getElementById('m6aapts').value)+parseInt(document.getElementById('m7apts').value)+parseInt(document.getElementById('m7aapts').value
        )+parseInt(document.getElementById('m8apts').value)+parseInt(document.getElementById('m8aapts').value)+parseInt(document.getElementById('m9apts').value)+parseInt(document.getElementById('m9aapts').value)+parseInt(document.getElementById('m10apts').value)+parseInt(document.getElementById('m10aapts').value);
        console.log(awaypointstotal);
        homegamestotal=parseInt(document.getElementById('m1h1').innerText)+parseInt(document.getElementById('m2h1').innerText)+parseInt(document.getElementById('m3h1').innerText)+parseInt(document.getElementById('m3ah1').innerText)+parseInt(document.getElementById('m4h1').innerText)+parseInt(document.getElementById('m4ah1').innerText
        )+parseInt(document.getElementById('m5h1').innerText)+parseInt(document.getElementById('m5ah1').innerText)+parseInt(document.getElementById('m6h1').innerText)+parseInt(document.getElementById('m6ah1').innerText)+parseInt(document.getElementById('m7h1').innerText)+parseInt(document.getElementById('m7ah1').innerText
        )+parseInt(document.getElementById('m8h1').innerText)+parseInt(document.getElementById('m8ah1').innerText)+parseInt(document.getElementById('m9h1').innerText)+parseInt(document.getElementById('m9ah1').innerText)+parseInt(document.getElementById('m10h1').innerText)+parseInt(document.getElementById('m10ah1').innerText);
        console.log(homegamestotal);
        console.log(document.getElementById('m1a1').innerText);
        awaygamestotal=parseInt(document.getElementById('m1a1').innerText)+parseInt(document.getElementById('m2a1').innerText)+parseInt(document.getElementById('m3a1').innerText)+parseInt(document.getElementById('m3aa1').innerText)+parseInt(document.getElementById('m4a1').innerText)+parseInt(document.getElementById('m4aa1').innerText
        )+parseInt(document.getElementById('m5a1').innerText)+parseInt(document.getElementById('m5aa1').innerText)+parseInt(document.getElementById('m6a1').innerText)+parseInt(document.getElementById('m6aa1').innerText)+parseInt(document.getElementById('m7a1').innerText)+parseInt(document.getElementById('m7aa1').innerText
        )+parseInt(document.getElementById('m8a1').innerText)+parseInt(document.getElementById('m8aa1').innerText)+parseInt(document.getElementById('m9a1').innerText)+parseInt(document.getElementById('m9aa1').innerText)+parseInt(document.getElementById('m10a1').innerText)+parseInt(document.getElementById('m10aa1').innerText);
        console.log(awaygamestotal);
        document.getElementById('awaypointstotals').innerHTML=awaypointstotal;
        document.getElementById('homepointstotals').innerHTML=homepointstotal;
        document.getElementById('homegamestotals').innerHTML=homegamestotal;
        document.getElementById('awaygamestotals').innerHTML=awaygamestotal;
        document.getElementById("subres").style.display='block';
        sessionStorage.clear();
    } */

   /*  function checkfilled(){
    //alert (document.getElementById('m1h1').innerHTML);
        if (document.getElementById('m1a1').innerText=='' || document.getElementById('m2a1').innerText=='' 
        || document.getElementById('m3a1').innerText=='' || document.getElementById('m3aa1').innerText=='' 
        || document.getElementById('m4a1').innerText=='' || document.getElementById('m4aa1').innerText==''
        || document.getElementById('m5a1').innerText=='' || document.getElementById('m5aa1').innerText=='' 
        || document.getElementById('m6a1').innerText=='' || document.getElementById('m6aa1').innerText=='' 
        || document.getElementById('m7a1').innerText=='' || document.getElementById('m7aa1').innerText==''
        || document.getElementById('m8a1').innerText=='' || document.getElementById('m8aa1').innerText=='' 
        || document.getElementById('m9a1').innerText=='' || document.getElementById('m9aa1').innerText=='' 
        || document.getElementById('m10a1').innerText=='' || document.getElementById('m10aa1').innerText==''
        )
        {
            
            return 1;
        }else{
        
            return 0;
        }
    } */
function prepopulate(id){
    //fills in values if already entered and stored in the session variables
    //console.log(Object.keys(sessionStorage));
    //console.log(Object(sessionStorage));
    if(sessionStorage.getItem(id)) {
    document.getElementById(id).value = sessionStorage.getItem(id);
    } else {
    document.getElementById(id).value = '';
    }
    document.getElementById(id).addEventListener('input', function() {
    sessionStorage.setItem(id, this.value);
    }); 
    
}
function prepopres(id){
    //console.log(Object.keys(sessionStorage));
    //console.log(Object(sessionStorage));
    /* if (sessionStorage.counter==null){
    sessionStorage.counter=1;
    } */
    //console.log(id);
    if(sessionStorage.getItem(id)) {
    document.getElementById(id).innerText = sessionStorage.getItem(id);
    } else {
    document.getElementById(id).innerText = '';
    }
    document.getElementById(id).addEventListener('input', function() {
    sessionStorage.setItem(id, this.innerText);
    });  
    //sessionStorage.counter=Number(sessionStorage.counter)+1;
    
}
function games(match1, match2, home, away, box) {
    // Validate scores
    var homeElement = document.getElementById(match1);
    var awayElement = document.getElementById(match2);
    $trd=box*3;//identifier for 3 boxes
    if (!homeElement || !awayElement) {
        console.error('Element not found');
        return;
    }
    var homescore = parseInt(homeElement.value);
    var awayscore = parseInt(awayElement.value);
    if (isNaN(homescore) || isNaN(awayscore)) {
        console.error('Invalids scores');
        return;
    }          
    var homeElementDisplay = document.getElementById(home);
    var awayElementDisplay = document.getElementById(away);
    if (!homeElementDisplay || !awayElementDisplay) {
        console.error('Home/Away elements not found');
        return;
    }
    if (homescore > awayscore && (homescore >= 21 || awayscore >= 21)) {
        homeElementDisplay.innerText = "1";
        awayElementDisplay.innerText = "0";
        sessionStorage.setItem(match1.slice(0, match1.length - 3) + "r", "1");
        sessionStorage.setItem(match2.slice(0, match2.length - 3) + "r", "0");
    } else if (homescore < awayscore && (homescore >= 21 || awayscore >= 21)) {
        homeElementDisplay.innerText = "0";
        awayElementDisplay.innerText = "1";
        sessionStorage.setItem(match1.slice(0, match1.length - 3) + "r", "0");
        sessionStorage.setItem(match2.slice(0, match2.length - 3) + "r", "1");
    }
    const homeresults = ["m"+($trd-2)+"hr", "m"+($trd-1)+"hr", "m"+$trd+"hr"];
    const awayresults = ["m"+($trd-2)+"ar", "m"+($trd-1)+"ar", "m"+$trd+"ar"];
    //console.log(awayresults);
    function resultsdone(keys) {
        let count = 0;

        for (let key of keys) {
            if (sessionStorage.getItem(key)) {
                count++;
            }
        }
        return count >= 2;
    }
    function getSessionStorageValues(keys) {
        return keys.map(key => parseFloat(sessionStorage.getItem(key))).filter(value => !isNaN(value));
    }
    //console.log(Object(sessionStorage));
    if (homeresults.length>=2) {
        const homevalues = getSessionStorageValues(homeresults);
        const awayvalues = getSessionStorageValues(awayresults);
        //console.log('Home:',homevalues);
        //console.log('Away:',awayvalues);
        // Example calculation: sum of all values
        const sumh = homevalues.reduce((acc, value) => acc + value, 0);
        const suma = awayvalues.reduce((acc, value) => acc + value, 0);
        //console.log()
       // console.log('Sumh:', sumh);
       // console.log('Suma:', suma);
        if (sumh==2){
            hg="m"+($trd-2)+"hg";
            let element = document.getElementById(hg);
            element.innerText=1;
            ag="m"+($trd-2)+"ag";
            let element1 = document.getElementById(ag);
            element1.innerText=0;
            sessionStorage.setItem(ag, "0");
            sessionStorage.setItem(hg, "1");
            //console.log(ag);
           // console.log(hg);
       
        }else if (suma==2){
            hg="m"+($trd-2)+"hg";
            let element = document.getElementById(hg);
            element.innerText=0;
            ag="m"+($trd-2)+"ag";
            let element1 = document.getElementById(ag);
            element1.innerText=1;
            sessionStorage.setItem(ag, "1");
            sessionStorage.setItem(hg, "0");
           
        }


    } 
    totals();
   // console.log(Object(sessionStorage));
}

    /*  if (typeof checkfilled === 'function' && checkfilled() != 1) {
        document.getElementById("but").style.display = 'block';
    } else {
        document.getElementById("but").style.display = 'none';
    }  */   

</script>
  <script>
  $(function() {
    $("#navigation").load("navbar.php");
    });
</script>
<style>
    td,th[colspan="2"], th[rowspan="2"]{
    text-align:center;
    }
</style>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:40px">
<h3>Scores</h3>
<?php
if ($_SESSION["curleague"]==3){
    echo("doubles");

}else if ($_SESSION["curleague"]==4){
    echo("Ladies");
}else{
    $tot=1;
?>
<form action ="Confirmresults.php" method="POST">
<?php echo("<input type='hidden'  name='FixID' value=".$_SESSION['curmatch'].">");?>
<table style = "width:80%" class="table-bordered table-condensed">
<tr>
<th rowspan="2">No</th>
<th rowspan="2"><?php echo $row['HC']." ".$row['HT'];?></th>
<th rowspan="2"> </th>
<th rowspan="2"><?php echo $row['AWC']." ".$row['AWT'];?></th>
<th colspan = "2">Points</th>
<th colspan="2">Rubbers</th>
<th colspan="2">Games</th>
</tr>

<tr>
<td><?php echo $row['HC']." ".$row['HT'];?></td>
<td><?php echo $row['AWC']." ".$row['AWT'];?></td>
<td><?php echo $row['HC']." ".$row['HT'];?></td>
<td><?php echo $row['AWC']." ".$row['AWT'];?></td>
<td><?php echo $row['HC']." ".$row['HT'];?></td>
<td><?php echo $row['AWC']." ".$row['AWT'];?></td>
</tr>
<?php
$pairs = [
    1 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
    2 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
    3 => ['P5f', 'P5s', 'P6f', 'P6s', 'AP5f', 'AP5s', 'AP6f', 'AP6s'],
    4 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
    5 => ['P5f', 'P5s', 'P6f', 'P6s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
    6 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP5f', 'AP5s', 'AP6f', 'AP6s'],
    7 => ['P5f', 'P5s', 'P6f', 'P6s', 'AP1f', 'AP1s', 'AP2f', 'AP2s'],
    8 => ['P1f', 'P1s', 'P2f', 'P2s', 'AP3f', 'AP3s', 'AP4f', 'AP4s'],
    9 => ['P3f', 'P3s', 'P4f', 'P4s', 'AP5f', 'AP5s', 'AP6f', 'AP6s']
];
#format of open and mixed? need alternative for Doubles/ladies
for ($k = 1;$k<=9; $k++){
?>
     <tr>
        <td rowspan="3"><?php echo $k;?></td>
        <td rowspan="3"><?php echo $row[$pairs[$k][0]] . " " . $row[$pairs[$k][1]] . " & " . $row[$pairs[$k][2]] . " " . $row[$pairs[$k][3]];?></td>
        <td rowspan="3">v</td>
        <td rowspan="3"><?php echo $row[$pairs[$k][4]] . " " . $row[$pairs[$k][5]] . " & " . $row[$pairs[$k][6]] . " " . $row[$pairs[$k][7]];?></td>
<?php
    for ($j = 0;$j<=2; $j++){
        $v=3*$k-2+$j;
        ?>
        <td><input autocomplete="off" id="m<?php echo $v;?>hpts" name="m<?php echo $v;?>hpts" 
       onchange="totals()" 
        type="text" ><script>prepopulate("m<?php echo $v;?>hpts");</script>
        </td>
        <td><input autocomplete="off" id="m<?php echo $v;?>apts" name="m<?php echo $v;?>apts" 
        onchange="totals()" 
        type="text" ><script>prepopulate("m<?php echo $v;?>apts");</script>
        </td>
        <!-- <td><input autocomplete="off" id="m<?php echo $v;?>hpts" name="m<?php echo $v;?>hpts" 
        onchange="games(this.id,document.getElementById('m<?php echo $v;?>apts').id,document.getElementById('m<?php echo $v;?>hr').id,document.getElementById('m<?php echo $v;?>ar').id,<?php echo $k;?>)" 
        type="text" ><script>prepopulate("m<?php echo $v;?>hpts");</script>
        </td>
        <td><input autocomplete="off" id="m<?php echo $v;?>apts" name="m<?php echo $v;?>apts" 
        onchange="games(document.getElementById('m<?php echo $v;?>hpts').id,this.id,document.getElementById('m<?php echo $v;?>hr').id,document.getElementById('m<?php echo $v;?>ar').id,<?php echo $k;?>)"
        type="text" ><script>prepopulate("m<?php echo $v;?>apts");</script>
        </td> -->
        <td id="m<?php echo $v;?>hr"><script>prepopres("m<?php echo $v;?>hr");</script></td>
        <td id="m<?php echo $v;?>ar"><script>prepopres("m<?php echo $v;?>ar");</script></td>
        <?php
            if ($j == 0) {
                ?>
                <td rowspan="3" id="m<?php echo $v;?>hg"><script>prepopres("m<?php echo $v;?>hg");</script></td>
                <td rowspan="3" id="m<?php echo $v;?>ag"><script>prepopres("m<?php echo $v;?>ag");</script></td>
                </tr>
        <?php
        }else{
            echo '<tr>';
        }?>
<?php
}}
?>

<tr>
<td></td>
<td></td>
<td></td>
<td>Totals</td>
<td id="hptot"><script>prepopres("hptot");</script></td>
<td id="aptot"><script>prepopres("aptot");</script></td>
<td id="hrtot"><script>prepopres("hrtot");</script></td>
<td id="artot"><script>prepopres("artot");</script></td>
<td id="hgtot"><script>prepopres("hgtot");</script></td>
<td id="agtot"><script>prepopres("agtot");</script></td>
</table>

<input id="subres" type="submit" value="Submit"  style="display:none;">



</form>
<?php
}
?>
</div>


<script>
    function totals(){
    rubbers = [
        ['m1hr', 'm2hr', 'm3hr', 'm4hr', 'm5hr', 'm6hr', 'm7hr', 'm8hr','m9hr','m10hr','m11hr','m12hr','m13hr','m14hr','m15hr','m16hr','m17hr','m18hr','m19hr','m20hr','m21hr','m22hr','m23hr','m24hr','m25hr','m26hr','m27hr'],
        ['m1ar', 'm2ar', 'm3ar', 'm4ar', 'm5ar', 'm6ar', 'm7ar', 'm8ar','m9ar','m10ar','m11ar','m12ar','m13ar','m14ar','m15ar','m16ar','m17ar','m18ar','m19ar','m20ar','m21ar','m22ar','m23ar','m24ar','m25ar','m26ar','m27ar']
    ];
    game=[
        ['m1hg', 'm4hg', 'm7hg', 'm10hg', 'm13hg', 'm16hg', 'm19hg', 'm22hg', 'm25hg'],
        ['m1ag', 'm4ag', 'm7ag', 'm10ag', 'm13ag', 'm16ag', 'm19ag', 'm22ag', 'm25ag']
    ];
    points=[
        ['m1hpts', 'm2hpts', 'm3hpts', 'm4hpts', 'm5hpts', 'm6hpts', 'm7hpts', 'm8hpts','m9hpts','m10hpts','m11hpts','m12hpts','m13hpts','m14hpts','m15hpts','m16hpts','m17hpts','m18hpts','m19hpts','m20hpts','m21hpts','m22hpts','m23hpts','m24hpts','m25hpts','m26hpts','m27hpts'],
        ['m1apts', 'm2apts', 'm3apts', 'm4apts', 'm5apts', 'm6apts', 'm7apts', 'm8apts','m9apts','m10apts','m11apts','m12apts','m13apts','m14apts','m15apts','m16apts','m17apts','m18apts','m19apts','m20apts','m21apts','m22apts','m23apts','m24apts','m25apts','m26apts','m27apts']
    ];
    matches=[
        ["m1hr","m2hr","m3hr"],
        ["m1ar","m2ar","m3ar"],
        ["m4hr","m5hr","m6hr"],
        ["m4ar","m5ar","m6ar"],
        ["m7hr","m8hr","m9hr"],
        ["m7ar","m8ar","m9ar"],
        ["m10hr","m11hr","m12hr"],
        ["m10ar","m11ar","m12ar"],
        ["m13hr","m14hr","m15hr"],
        ["m13ar","m14ar","m15ar"]
    ];
    // calc rubber win/loss
    let hr=0;
    let ar=0;
    for (k = 0;k<=points[0].length; k++){
        if(sessionStorage.getItem(points[0][k])>sessionStorage.getItem(points[1][k]) && sessionStorage.getItem(points[1][k])!='' ){
            hr=1;
            ar=0;
            let homeRubbers = document.getElementById(rubbers[0][k]);
            if(homeRubbers){
                homeRubbers.innerText = hr;
            }
            let awayRubbers = document.getElementById(rubbers[1][k]);
            if(awayRubbers){
                awayRubbers.innerText = ar;
            }
            sessionStorage.setItem(rubbers[0][k], hr);
            sessionStorage.setItem(rubbers[1][k], ar);
            
        }else if(sessionStorage.getItem(points[0][k])<sessionStorage.getItem(points[1][k]) && sessionStorage.getItem(points[0][k])!=''){
            hr=0;
            ar=1;
            let homeRubbers = document.getElementById(rubbers[0][k]);
            homeRubbers.innerText = hr;
            let awayRubbers = document.getElementById(rubbers[1][k]);
            awayRubbers.innerText = ar;
            sessionStorage.setItem(rubbers[0][k], hr);
            sessionStorage.setItem(rubbers[1][k], ar);
        }else if (sessionStorage.getItem(points[1][k])!='' || sessionStorage.getItem(points[0][k])!=''){
            let homeRubbers = document.getElementById(rubbers[0][k]);
            if(homeRubbers){
                homeRubbers.innerText = '';
            }
        
            let awayRubbers = document.getElementById(rubbers[1][k]);
            if(awayRubbers){
                awayRubbers.innerText = '';
            }
            sessionStorage.removeItem(rubbers[0][k]);
            sessionStorage.removeItem(rubbers[1][k]);
            
        }
        
    }
    //calc games won

    
    for (k = 0;k<=game[0].length; k++){
        let hg=0;
        let ag=0;
        for(d=0;d<=2;d++){
            if(sessionStorage.getItem(rubbers[0][k+d])>sessionStorage.getItem(rubbers[1][k+d]) && (sessionStorage.getItem(rubbers[1][k+d])!='')){
                hg+=1;
            }else if(sessionStorage.getItem(rubbers[0][k+d])<sessionStorage.getItem(rubbers[1][k+d]) && (sessionStorage.getItem(rubbers[0][k+d])!='')){
                ag+=1;
            }
        }
        
        if (hg>ag && hg==2){
            alert("h",k);
            let homegames = document.getElementById(game[0][k]);
            homegames.innerText = 1;
            let awaygames = document.getElementById(game[1][k]);
            awaygames.innerText = 0;
            sessionStorage.setItem(game[0][k], 1);
            sessionStorage.setItem(game[1][k], 0);
        }else if(hg<ag && ag==2){
            alert("a",k);
            let homegames = document.getElementById(game[0][k]);
            homegames.innerText = 0;
            let awaygames = document.getElementById(game[1][k]);
            awaygames.innerText = 1;
            sessionStorage.setItem(game[0][k], 0);
            sessionStorage.setItem(game[1][k], 1);
        }else{
            alert(k);
            let homegames = document.getElementById(game[0][k]);
            let awaygames = document.getElementById(game[1][k]);
            if(homegames){
                homegames.innerText = '';
            }
            if(awaygames){
                awaygames.innerText = '';
            }
        }
        
    }
        
    
   
    console.log("hr",hr);
    console.log("ar",ar);
    let hrtot=0;
    let artot=0;
    //rubbers total
    for (k = 0;k<=rubbers[0].length; k++){
        if(sessionStorage.getItem(rubbers[0][k])!=null){
            
            hrtot+=parseInt(sessionStorage.getItem(rubbers[0][k]));
        }
        if(sessionStorage.getItem(rubbers[1][k])!=null){
            artot+=parseInt(sessionStorage.getItem(rubbers[1][k]));
        }
         
    }
    let homeRubbersTotalElement = document.getElementById('hrtot');
    homeRubbersTotalElement.innerText = hrtot;
    let awayRubbersTotalElement = document.getElementById('artot');
    awayRubbersTotalElement.innerText = artot;

    //games totals
    let hgtot=0;
    let agtot=0;
    for (k = 0;k<=game[1].length; k++){
        if(sessionStorage.getItem(game[0][k])!=null){
                hgtot+=parseInt(sessionStorage.getItem(game[0][k]));
        }
        if(sessionStorage.getItem(game[1][k])!=null){
            agtot+=parseInt(sessionStorage.getItem(game[1][k]));
        }
    }
    let homegamesTotalElement = document.getElementById('hgtot');
    homegamesTotalElement.innerText = hgtot;
    let awaygamesTotalElement = document.getElementById('agtot');
    awaygamesTotalElement.innerText = agtot;
    
    //points totals
    let hptot=0;
    let aptot=0;
    for (k = 0;k<=points[0].length; k++){
        console.log(k," ",sessionStorage.getItem(points[0][k]));
        if(sessionStorage.getItem(points[0][k])!=null && sessionStorage.getItem(points[0][k])!=''){
            hptot+=parseInt(sessionStorage.getItem(points[0][k]));
        }
        if(sessionStorage.getItem(points[1][k])!=null && sessionStorage.getItem(points[0][k])!=''){
            aptot+=parseInt(sessionStorage.getItem(points[1][k]));
        }
    }
    let homepointsTotalElement = document.getElementById('hptot');
    homepointsTotalElement.innerText = hptot;
    
    let awaypointsTotalElement = document.getElementById('aptot');
    awaypointsTotalElement.innerText = aptot;
    
    //save for prepop
    sessionStorage.setItem('hptot', hptot);
    sessionStorage.setItem('aptot', aptot);
    sessionStorage.setItem('hrtot', hrtot);
    sessionStorage.setItem('artot', artot);
    sessionStorage.setItem('hgtot', hgtot);
    sessionStorage.setItem('agtot', agtot);
}

    //at end to allow page to fully populate
    //console.log(sessionStorage.counter);
   // if (sessionStorage.counter==37) {
   //    document.getElementById("but").style.display='block';
        
   // }else{
    //    document.getElementById("but").style.display='none';
    //}-->
</script>
</body>
</html>
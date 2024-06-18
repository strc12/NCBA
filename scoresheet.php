<?php
session_start();
print_r($_POST);
print_r($_SESSION);

include_once ("connection.php");
// Check if the form is submitted to update the item

    $sql = "UPDATE tblmatches SET HomeP1ID = :p1h, HomeP2ID = :p2h, HomeP3ID = :p3h, HomeP4ID = :p4h, HomeP5ID = :p5h, HomeP6ID=:p6h,
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
$stmt=$conn->prepare("SELECT tblmatches.FixtureDate, 
tblmatches.m1h,tblmatches.m1a,
tblmatches.m2h,tblmatches.m2a,
tblmatches.m3h,tblmatches.m3a,
tblmatches.m4h,tblmatches.m4a,
tblmatches.m5h,tblmatches.m5a,
tblmatches.m6h,tblmatches.m6a,
tblmatches.m7h,tblmatches.m7a,
tblmatches.m8h,tblmatches.m8a,
tblmatches.m9h,tblmatches.m9a,
tblmatches.m10h,tblmatches.m10a,
tblmatches.m11h,tblmatches.m11a,
tblmatches.m12h,tblmatches.m12a,
tblmatches.m13h,tblmatches.m13a,
tblmatches.m14h,tblmatches.m14a,
tblmatches.m15h,tblmatches.m15a,
tblmatches.m16h,tblmatches.m16a,
tblmatches.m17h,tblmatches.m17a,
tblmatches.m18h,tblmatches.m18a,
tblmatches.m19h,tblmatches.m19a,
tblmatches.m20h,tblmatches.m20a,
tblmatches.m21h,tblmatches.m21a,
tblmatches.m22h,tblmatches.m22a,
tblmatches.m23h,tblmatches.m23a,
tblmatches.m24h,tblmatches.m24a,
tblmatches.m25h,tblmatches.m25a,
tblmatches.m26h,tblmatches.m26a,
tblmatches.m27h,tblmatches.m27a,
tblmatches.HomeID as Home, tblmatches.AwayID as Away,  
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

print_r($row);
echo("<br>");
print_r($_SESSION);

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
    sessionStorage.removeItem("counter");
    
    function totalscores(){
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
    }
    function checkfilled(){
    //alert (document.getElementById('m1h1').innerHTML);
        if (document.getElementById('m1a1').innerText=='' || document.getElementById('m2a1').innerText=='' 
        || document.getElementById('m3a1').innerText=='' || document.getElementById('m3aa1').innerText=='' 
        || document.getElementById('m4a1').innerText=='' || document.getElementById('m4aa1').innerText==''
        || document.getElementById('m5a1').innerText=='' || document.getElementById('m5aa1').innerText=='' 
        || document.getElementById('m6a1').innerText=='' || document.getElementById('m6aa1').innerText=='' 
        || document.getElementById('m7a1').innerText=='' || document.getElementById('m7aa1').innerText==''
        || document.getElementById('m8a1').innerText=='' || document.getElementById('m8aa1').innerText=='' 
        || document.getElementById('m9a1').innerText=='' || document.getElementById('m9aa1').innerText=='' 
        || document.getElementById('m10a1').innerText=='' || document.getElementById('m10aa1').innerText=='')
        {
            
            return 1;
        }else{
        
            return 0;
        }
    }
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
    console.log(Object.keys(sessionStorage));
    console.log(Object(sessionStorage));
    if (sessionStorage.counter==null){
    sessionStorage.counter=1;
    }
    if(sessionStorage.getItem(id)) {
    document.getElementById(id).innerText = sessionStorage.getItem(id);
    } else {
    document.getElementById(id).innerText = '';
    }
    document.getElementById(id).addEventListener('input', function() {
    sessionStorage.setItem(id, this.innerText);
    });  
    sessionStorage.counter=Number(sessionStorage.counter)+1;
    
}
/* function games(match1,match2, home,away,box){
        //validate scores - 
        var homescore=parseInt(document.getElementById(match1).value);
        var awayscore=parseInt(document.getElementById(match2).value);
        if (!sessionStorage.getItem(box)) {
        sessionStorage.setItem(box, 0);
    }
        function toggleInputs() {
        var boxValue = parseInt(sessionStorage.getItem(box), 10);
        var m3apts = document.getElementById("m3apts");
        var m3hpts = document.getElementById("m3hpts");
        
        if (boxValue === 1) {
            m3apts.disabled = true;
            m3hpts.disabled = true;
        } else if (boxValue === 0) {
            m3apts.disabled = false;
            m3hpts.disabled = false;
        }
    }
    
    toggleInputs();
        
        
        
        if(homescore>30 || homescore<0){
            alert("invalid score Home team " + homescore);
            document.getElementById(match1).value='';
            document.getElementById(home).innerHTML = ""; 
            document.getElementById(away).innerHTML = "";
            document.getElementById(match1).focus();
        }else if (awayscore>30 || awayscore<0){
            alert("invalid score Away team " + awayscore);
            document.getElementById(match2).value='';
            document.getElementById(home).innerHTML = ""; 
            document.getElementById(away).innerHTML = "";
            document.getElementById(match2).focus();
        }else if (awayscore<21 && homescore<21){
            alert("No one to 21 yet!");
            document.getElementById(match2).value='';
            document.getElementById(match1).value='';
            document.getElementById(home).innerHTML = ""; 
            document.getElementById(away).innerHTML = "";
            document.getElementById(match1).focus();
        /* }else if (awayscore!=21 && homescore!=21  && homescore!==homescore && awayscore!==awayscore){//checks if 21 has been entered in one only and also stops NAN  errors
            alert("No winner!");
            document.getElementById(match2).value='';
            document.getElementById(match1).value='';
            document.getElementById(home).innerHTML = ""; 
            document.getElementById(away).innerHTML = "";
            document.getElementById(match1).focus(); */
        /* }else if (awayscore!=21 && homescore!=21  && homescore!==homescore && awayscore!==awayscore){//checks if 21 has been entered in one only and also stops NAN  errors
            alert("No winner!");
            document.getElementById(match2).value='';
            document.getElementById(match1).value='';
            document.getElementById(home).innerHTML = ""; 
            document.getElementById(away).innerHTML = "";
            document.getElementById(match1).focus(); */
        /* }else if (homescore==21 && awayscore==21){
            alert("can't have two winners")
            document.getElementById(match2).value='';
            document.getElementById(match1).value='';
            document.getElementById(home).innerHTML = ""; 
            document.getElementById(away).innerHTML = "";
            document.getElementById(match1).focus(); 
        }else if(homescore>awayscore&&(homescore>=21 ||awayscore>=21)){
            document.getElementById(home).innerHTML = "1"; 
            document.getElementById(away).innerHTML = "0";
      
            sessionStorage[match1.slice(0,match1.length -3)+1]="1";
            sessionStorage[match2.slice(0,match2.length -3)+1]="0";
            sessionStorage.setItem(box,variable + 1);
            
            alert(sessionStorage[box]);
          
        }else if (homescore<awayscore&&(homescore>=21 ||awayscore>=21)){
            document.getElementById(home).innerHTML = "0";
            document.getElementById(away).innerHTML = "1";  
            
            sessionStorage[match1.slice(0,match1.length -3)+1]="0";
            sessionStorage[match2.slice(0,match2.length -3)+1]="1";
            var variable = parseInt(sessionStorage.getItem(box),10);
            sessionStorage.setItem(box,variable - 1);
            
            alert(sessionStorage[box]);
        } 
    if (checkfilled()!=1) {
        // need to make this work for prepopulated too
        document.getElementById("but").style.display='block';
        
    }else{
        document.getElementById("but").style.display='none';
    }
    console.log(Object(sessionStorage));
    if (sessionStorage[box]==0){
        document.getElementById("m3apts").disabled = false;
    }else{
        document.getElementById("m3apts").disabled = true;
    }
    toggleInputs();
} */
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
    const awayresults = ["m"+($trd-2)+"ha", "m"+($trd-1)+"ha", "m"+$trd+"ha"];
    console.log(homeresults);
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
    if (resultsdone(homeresults)||resultsdone(awayresults)) {
        const homevalues = getSessionStorageValues(homeresults);
        const awayvalues = getSessionStorageValues(awayresults);
        console.log('Home:',homevalues);
        console.log('Away:',awayvalues);
        // Example calculation: sum of all values
        const sumh = homevalues.reduce((acc, value) => acc + value, 0);
        const suma = awayvalues.reduce((acc, value) => acc + value, 0);
        console.log()
        console.log('Sumh:', sumh);
        console.log('Suma:', suma);
        if (sumh==2){
            $hg="m"+($trd-2)+"hg";
            $hg.innerText=1;
            $ag="m"+($trd-2)+"ag";
            $ag.innerText=0;
            console.log($ag);
            console.log($hg);
            document.getElementById("m"+$trd+"hpts").disabled = true;
            document.getElementById("m"+$trd+"apts").disabled = true;
        }else if (suma==2){
            m1hg.innerText=0;
            m1ag.innerText=1;
            document.getElementById("m"+$trd+"hpts").disabled = true;
            document.getElementById("m"+$trd+"apts").disabled = true;
        }

    // Additional calculations can be performed here
    } 
}

    /* if (typeof checkfilled === 'function' && checkfilled() != 1) {
        document.getElementById("but").style.display = 'block';
    } else {
        document.getElementById("but").style.display = 'none';
    } */
    
    console.log(Object(sessionStorage));
    
    /* if (sessionStorage.getItem(box) == 0) {
        var m3apts = document.getElementById("m3apts");
        if (m3apts) m3apts.disabled = false;
    } else {
        var m3apts = document.getElementById("m3apts");
        if (m3apts) m3apts.disabled = true;
    } */
    


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
        onchange="games(this.id,document.getElementById('m<?php echo $v;?>apts').id,document.getElementById('m<?php echo $v;?>hr').id,document.getElementById('m<?php echo $v;?>ar').id,<?php echo $k;?>)" 
        type="text" ><script>prepopulate("m<?php echo $v;?>hpts");</script>
        </td>
        <td><input autocomplete="off" id="m<?php echo $v;?>apts" name="m<?php echo $v;?>apts" 
        onchange="games(document.getElementById('m<?php echo $v;?>hpts').id,this.id,document.getElementById('m<?php echo $v;?>hr').id,document.getElementById('m<?php echo $v;?>ar').id,<?php echo $k;?>)"
        type="text" ><script>prepopulate("m<?php echo $v;?>apts");</script>
        </td>
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
<td id="homepointstotals"></td>
<td id="awaypointstotals"></td>
<td id="homegamestotals"></td>
<td id="awaygamestotals"></td>
</table>

<input id="subres" type="submit" value="Submit"  style="display:none;">



</form>
<?php
}
?>
</div>

<div id="but" style="display:none;">
    <button  onclick="totalscores()">Calculate totals</button>
</div>
<script>
    //at end to allow page to fully populate
    console.log(sessionStorage.counter);
    if (sessionStorage.counter==37) {
        document.getElementById("but").style.display='block';
        
    }else{
        document.getElementById("but").style.display='none';
    }
</script>
</body>
</html>
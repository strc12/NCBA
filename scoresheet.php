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
P1.Forename as M1f, P1.Surname as M1s, 
P2.Forename as M2f, P2.Surname as M2s,
P3.Forename as M3f, P3.Surname as M3s,
P4.Forename as L1f, P4.Surname as L1s,
P5.Forename as L2f, P5.Surname as L2s,
P6.Forename as L3f, P6.Surname as L3s,
AP1.Forename as AM1f, AP1.Surname as AM1s, 
AP2.Forename as AM2f, AP2.Surname as AM2s,
AP3.Forename as AM3f, AP3.Surname as AM3s,
AP4.Forename as AL1f, AP4.Surname as AL1s,
AP5.Forename as AL2f, AP5.Surname as AL2s,
AP6.Forename as AL3f, AP6.Surname as AL3s,
awc.CLubname as AWC, hc.Clubname as HC

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
function games(match1,match2, home,away,box){
        //validate scores - 
        var homescore=parseInt(document.getElementById(match1).value);
        var awayscore=parseInt(document.getElementById(match2).value);
      
        
        console.log(Object.keys(sessionStorage));
        console.log(Object(sessionStorage));
        
        
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
            document.getElementById(match1).focus(); */
        }else if(homescore>awayscore&&(homescore>=21 ||awayscore>=21)){
            document.getElementById(home).innerHTML = "1"; 
            document.getElementById(away).innerHTML = "0";
      
            sessionStorage[match1.slice(0,match1.length -3)+1]="1";
            sessionStorage[match2.slice(0,match2.length -3)+1]="0";
          
        }else if (homescore<awayscore&&(homescore>=21 ||awayscore>=21)){
            document.getElementById(home).innerHTML = "0";
            document.getElementById(away).innerHTML = "1";  
            
            sessionStorage[match1.slice(0,match1.length -3)+1]="0";
            sessionStorage[match2.slice(0,match2.length -3)+1]="1";
            
        } 
    if (checkfilled()!=1) {
        // need to make this work for prepopulated too
        document.getElementById("but").style.display='block';
        
    }else{
        document.getElementById("but").style.display='none';
    }
    }

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

<form action ="Confirmresults.php" method="POST">
<?php echo("<input type='hidden'  name='FixID' value=".$_SESSION['curmatch'].">");?>
<table style = "width:80%" class="table-bordered table-condensed">
<tr>
<th rowspan="2">No</th>
<th rowspan="2"><?php echo $row['HS']." ".$row['hd'];?></th>
<th rowspan="2"> </th>
<th rowspan="2"><?php echo $row['AWS']." ".$row['ad'];?></th>
<th colspan = "2">Points</th>
<th colspan="2">Games</th>
</tr>

<tr>
<td><?php echo $row['HS'];?></td>
<td><?php echo $row['AWS'];?></td>
<td><?php echo $row['HS'];?></td>
<td><?php echo $row['AWS'];?></td>
</tr>

<tr>
<td>1</td>
<td><?php echo $row['L1f']." ".$row['L1s'];?></td>
<td>v</td>
<td><?php echo $row['AL1f']." ".$row['AL1s'];?></td>
<td><input autocomplete="off" id="m1hpts" name="m1hpts" onchange="games(this.id,document.getElementById('m1apts').id,document.getElementById('m1h1').id,document.getElementById('m1a1').id)" type="text" ><script>prepopulate("m1hpts");</script></td>
<td><input autocomplete="off" id="m1apts" name="m1apts" onchange="games(document.getElementById('m1hpts').id,this.id,document.getElementById('m1h1').id,document.getElementById('m1a1').id)"type="text" ><script>prepopulate("m1apts");</script></td>
<td id="m1h1"><script>prepopres("m1h1");</script></td>
<td id="m1a1"><script>prepopres("m1a1");</script></td>
</tr>

<tr>
<td>2</td>
<td><?php echo $row['M1f']." ".$row['M1s'];?></td>
<td>v</td>
<td><?php echo $row['AM1f']." ".$row['AM1s'];?></td>
<td><input autocomplete="off" id="m2hpts" name="m2hpts" onchange="games(this.id,document.getElementById('m2apts').id,document.getElementById('m2h1').id,document.getElementById('m2a1').id)" type="text" ><script>prepopulate("m2hpts");</script></td>
<td><input autocomplete="off" id="m2apts" name="m2apts" onchange="games(document.getElementById('m2hpts').id,this.id,document.getElementById('m2h1').id,document.getElementById('m2a1').id)"type="text" ><script>prepopulate("m2apts");</script></td>
<td id="m2h1"><script>prepopres("m2h1");</script></td>
<td id="m2a1"><script>prepopres("m2a1");</script></td>
</tr>

<tr>
<td rowspan="2">3</td>
<td rowspan="2"><?php echo $row['M2f']." ".$row['M2s']." & ",$row['M3f']." ".$row['M3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AM2f']." ".$row['AM2s']." & ",$row['AM3f']." ".$row['AM3s'];?></td>
<td><input autocomplete="off" id="m3hpts" name="m3hpts" onchange="games(this.id,document.getElementById('m3apts').id,document.getElementById('m3h1').id,document.getElementById('m3a1').id)" type="text" ><script>prepopulate("m3hpts");</script></td>
<td><input autocomplete="off" id="m3apts" name="m3apts" onchange="games(document.getElementById('m3hpts').id,this.id,document.getElementById('m3h1').id,document.getElementById('m3a1').id)"type="text" ><script>prepopulate("m3apts");</script></td>
<td id="m3h1"><script>prepopres("m3h1");</script></td>
<td id="m3a1"><script>prepopres("m3a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m3ahpts" name="m3ahpts" onchange="games(this.id,document.getElementById('m3aapts').id,document.getElementById('m3ah1').id,document.getElementById('m3aa1').id)" type="text" ><script>prepopulate("m3ahpts");</script></td>
<td><input autocomplete="off" id="m3aapts" name="m3aapts" onchange="games(document.getElementById('m3ahpts').id,this.id,document.getElementById('m3ah1').id,document.getElementById('m3aa1').id)"type="text" ><script>prepopulate("m3aapts");</script></td>
<td id="m3ah1"><script>prepopres("m3ah1");</script></td>
<td id="m3aa1"><script>prepopres("m3aa1");</script></td>
</tr>

<tr>
<td rowspan="2">4</td>
<td rowspan="2"><?php echo $row['L2f']." ".$row['L2s']." & ",$row['L3f']." ".$row['L3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL2f']." ".$row['AL2s']." & ",$row['AL3f']." ".$row['AL3s'];?></td>
<td><input autocomplete="off" id="m4hpts" name="m4hpts" onchange="games(this.id,document.getElementById('m4apts').id,document.getElementById('m4h1').id,document.getElementById('m4a1').id)" type="text" ><script>prepopulate("m4hpts");</script></td>
<td><input autocomplete="off" id="m4apts" name="m4apts" onchange="games(document.getElementById('m4hpts').id,this.id,document.getElementById('m4h1').id,document.getElementById('m4a1').id)"type="text" ><script>prepopulate("m4apts");</script></td>
<td id="m4h1"><script>prepopres("m4h1");</script></td>
<td id="m4a1"><script>prepopres("m4a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m4ahpts" name="m4ahpts" onchange="games(this.id,document.getElementById('m4aapts').id,document.getElementById('m4ah1').id,document.getElementById('m4aa1').id)" type="text" ><script>prepopulate("m4ahpts");</script></td>
<td><input autocomplete="off" id="m4aapts" name="m4aapts" onchange="games(document.getElementById('m4ahpts').id,this.id,document.getElementById('m4ah1').id,document.getElementById('m4aa1').id)"type="text" ><script>prepopulate("m4aapts");</script></td>
<td id="m4ah1"><script>prepopres("m4ah1");</script></td>
<td id="m4aa1"><script>prepopres("m4aa1");</script></td>
</tr>

<tr>
<td rowspan="2">5</td>
<td rowspan="2"><?php echo $row['M1f']." ".$row['M1s']." & ",$row['M2f']." ".$row['M2s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AM1f']." ".$row['AM1s']." & ",$row['AM2f']." ".$row['AM2s'];?></td>
<td><input autocomplete="off" id="m5hpts" name="m5hpts" onchange="games(this.id,document.getElementById('m5apts').id,document.getElementById('m5h1').id,document.getElementById('m5a1').id)" type="text" ><script>prepopulate("m5hpts");</script></td>
<td><input autocomplete="off" id="m5apts" name="m5apts" onchange="games(document.getElementById('m5hpts').id,this.id,document.getElementById('m5h1').id,document.getElementById('m5a1').id)"type="text" ><script>prepopulate("m5apts");</script></td>
<td id="m5h1"><script>prepopres("m5h1");</script></td>
<td id="m5a1"><script>prepopres("m5a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m5ahpts" name="m5ahpts" onchange="games(this.id,document.getElementById('m5aapts').id,document.getElementById('m5ah1').id,document.getElementById('m5aa1').id)" type="text" ><script>prepopulate("m5ahpts");</script></td>
<td><input autocomplete="off" id="m5aapts" name="m5aapts" onchange="games(document.getElementById('m5ahpts').id,this.id,document.getElementById('m5ah1').id,document.getElementById('m5aa1').id)"type="text" ><script>prepopulate("m5aapts");</script></td>
<td id="m5ah1"><script>prepopres("m5ah1");</script></td>
<td id="m5aa1"><script>prepopres("m5aa1");</script></td>
</tr>

<tr>
<td rowspan="2">6</td>
<td rowspan="2"><?php echo $row['L1f']." ".$row['L1s']." & ",$row['L2f']." ".$row['L2s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL1f']." ".$row['AL1s']." & ",$row['AL2f']." ".$row['AL2s'];?></td>
<td><input autocomplete="off" id="m6hpts" name="m6hpts" onchange="games(this.id,document.getElementById('m6apts').id,document.getElementById('m6h1').id,document.getElementById('m6a1').id)" type="text" ><script>prepopulate("m6hpts");</script></td>
<td><input autocomplete="off" id="m6apts" name="m6apts" onchange="games(document.getElementById('m6hpts').id,this.id,document.getElementById('m6h1').id,document.getElementById('m6a1').id)"type="text" ><script>prepopulate("m6apts");</script></td>
<td id="m6h1"><script>prepopres("m6h1");</script></td>
<td id="m6a1"><script>prepopres("m6a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m6ahpts" name="m6ahpts"  onchange="games(this.id,document.getElementById('m6aapts').id,document.getElementById('m6ah1').id,document.getElementById('m6aa1').id)" type="text" ><script>prepopulate("m6ahpts");</script></td>
<td><input autocomplete="off" id="m6aapts" name="m6aapts" onchange="games(document.getElementById('m6ahpts').id,this.id,document.getElementById('m6ah1').id,document.getElementById('m6aa1').id)"type="text" ><script>prepopulate("m6aapts");</script></td>
<td id="m6ah1"><script>prepopres("m6ah1");</script></td>
<td id="m6aa1"><script>prepopres("m6aa1");</script></td>
</tr>

<tr>
<td rowspan="2">7</td>
<td rowspan="2"><?php echo $row['L3f']." ".$row['L3s']." & ",$row['M3f']." ".$row['M3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL3f']." ".$row['AL3s']." & ",$row['AM3f']." ".$row['AM3s'];?></td>
<td><input autocomplete="off" id="m7hpts" name="m7hpts" onchange="games(this.id,document.getElementById('m7apts').id,document.getElementById('m7h1').id,document.getElementById('m7a1').id)" type="text" ><script>prepopulate("m7hpts");</script></td>
<td><input autocomplete="off" id="m7apts" name="m7apts" onchange="games(document.getElementById('m7hpts').id,this.id,document.getElementById('m7h1').id,document.getElementById('m7a1').id)"type="text" ><script>prepopulate("m7apts");</script></td>
<td id="m7h1"><script>prepopres("m7h1");</script></td>
<td id="m7a1"><script>prepopres("m7a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m7ahpts" name="m7ahpts" onchange="games(this.id,document.getElementById('m7aapts').id,document.getElementById('m7ah1').id,document.getElementById('m7aa1').id)" type="text" ><script>prepopulate("m7ahpts");</script></td>
<td><input autocomplete="off" id="m7aapts" name="m7aapts" onchange="games(document.getElementById('m7ahpts').id,this.id,document.getElementById('m7ah1').id,document.getElementById('m7aa1').id)"type="text" ><script>prepopulate("m7aapts");</script></td>
<td id="m7ah1"><script>prepopres("m7ah1");</script></td>
<td id="m7aa1"><script>prepopres("m7aa1");</script></td>
</tr>

<tr>
<td rowspan="2">8</td>
<td rowspan="2"><?php echo $row['L1f']." ".$row['L1s']." & ",$row['M1f']." ".$row['M1s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL1f']." ".$row['AL1s']." & ",$row['AM1f']." ".$row['AM1s'];?></td>
<td><input autocomplete="off" id="m8hpts" name="m8hpts" onchange="games(this.id,document.getElementById('m8apts').id,document.getElementById('m8h1').id,document.getElementById('m8a1').id)" type="text" ><script>prepopulate("m8hpts");</script></td>
<td><input autocomplete="off" id="m8apts" name="m8apts" onchange="games(document.getElementById('m8hpts').id,this.id,document.getElementById('m8h1').id,document.getElementById('m8a1').id)"type="text" ><script>prepopulate("m8apts");</script></td>
<td id="m8h1"><script>prepopres("m8h1");</script></td>
<td id="m8a1"><script>prepopres("m8a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m8ahpts"  name="m8ahpts" onchange="games(this.id,document.getElementById('m8aapts').id,document.getElementById('m8ah1').id,document.getElementById('m8aa1').id)" type="text" ><script>prepopulate("m8ahpts");</script></td>
<td><input autocomplete="off" id="m8aapts"  name="m8aapts"onchange="games(document.getElementById('m8ahpts').id,this.id,document.getElementById('m8ah1').id,document.getElementById('m8aa1').id)"type="text" ><script>prepopulate("m8aapts");</script></td>
<td id="m8ah1"><script>prepopres("m8ah1");</script></td>
<td id="m8aa1"><script>prepopres("m8aa1");</script></td>
</tr>

<tr>
<td rowspan="2">9</td>
<td rowspan="2"><?php echo $row['L3f']." ".$row['L3s']." & ",$row['M2f']." ".$row['M2s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL3f']." ".$row['AL3s']." & ",$row['AM2f']." ".$row['AM2s'];?></td>
<td><input autocomplete="off" id="m9hpts" name="m9hpts" onchange="games(this.id,document.getElementById('m9apts').id,document.getElementById('m9h1').id,document.getElementById('m9a1').id)" type="text" ><script>prepopulate("m9hpts");</script></td>
<td><input autocomplete="off" id="m9apts" name="m9apts" onchange="games(document.getElementById('m9hpts').id,this.id,document.getElementById('m9h1').id,document.getElementById('m9a1').id)"type="text" ><script>prepopulate("m9apts");</script></td>
<td id="m9h1"><script>prepopres("m9h1");</script></td>
<td id="m9a1"><script>prepopres("m9a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m9ahpts" name="m9ahpts" onchange="games(this.id,document.getElementById('m9aapts').id,document.getElementById('m9ah1').id,document.getElementById('m9aa1').id)" type="text" ><script>prepopulate("m9ahpts");</script></td>
<td><input autocomplete="off" id="m9aapts" name="m9aapts" onchange="games(document.getElementById('m9ahpts').id,this.id,document.getElementById('m9ah1').id,document.getElementById('m9aa1').id)"type="text" ><script>prepopulate("m9aapts");</script></td>
<td id="m9ah1"><script>prepopres("m9ah1");</script></td>
<td id="m9aa1"><script>prepopres("m9aa1");</script></td>
</tr>

<tr>
<td rowspan="2">10</td>
<td rowspan="2"><?php echo $row['L2f']." ".$row['L2s']." & ",$row['M3f']." ".$row['M3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL2f']." ".$row['AL2s']." & ",$row['AM3f']." ".$row['AM3s'];?></td>
<td><input autocomplete="off" id="m10hpts" name="m10hpts" onchange="games(this.id,document.getElementById('m10apts').id,document.getElementById('m10h1').id,document.getElementById('m10a1').id)" type="text" ><script>prepopulate("m10hpts");</script></td>
<td><input autocomplete="off" id="m10apts" name="m10apts"onchange="games(document.getElementById('m10hpts').id,this.id,document.getElementById('m10h1').id,document.getElementById('m10a1').id)"type="text" ><script>prepopulate("m10apts");</script></td>
<td id="m10h1"><script>prepopres("m10h1");</script></td>
<td id="m10a1"><script>prepopres("m10a1");</script></td>
</tr>

<tr>
<td><input autocomplete="off" id="m10ahpts" name="m10ahpts"  onchange="games(this.id,document.getElementById('m10aapts').id,document.getElementById('m10ah1').id,document.getElementById('m10aa1').id)" type="text" ><script>prepopulate("m10ahpts");</script></td>
<td><input autocomplete="off" id="m10aapts" name="m10aapts" onchange="games(document.getElementById('m10ahpts').id,this.id,document.getElementById('m10ah1').id,document.getElementById('m10aa1').id)"type="text" ><script>prepopulate("m10aapts");</script></td>
<td id="m10ah1"><script>prepopres("m10ah1");</script></td>
<td id="m10aa1"><script>prepopres("m10aa1");</script></td>
</tr>
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
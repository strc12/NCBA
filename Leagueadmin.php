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
    ?>

</div>
<h1>League Admin for creating/editing leagues/Divisions/Clubs</h1>
restrict access to Jermaine/Rob

<a href="editclub.php"><h2>Edit club data</h2></a>

<h1>Divisions</h1>
?add list of current divisions here?
  <form action="addDivision.php" method="POST" >
    Select League to add division to
    <select name="typeofleague">
        <?php
         include_once('connection.php');
         $stmt = $conn->prepare("SELECT * FROM TblLEague");
         $stmt->execute();
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
             {
                 echo("<option value='".$row["LeagueID"]."'>".$row["Name"]."</options>");
          
             }
        
        ?>
          </select><br>
    New Division name:<input type="text" name="Divisionname"><br>
  	<input type="submit" value="Add division to league">
	</form>
    <h1>Divisions</h1>
  <form action="addLeague.php" method="POST" >
    Current disciplines are
        <?php
         include_once('connection.php');
         $stmt = $conn->prepare("SELECT * FROM TblLeague");
         $stmt->execute();
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
             {
                 echo("<p>".$row["Name"]."-".$row["Details"]."</p>");
          
             }
        
        ?>
    
    New Discipline name:<input type="text" name="LeagueName"><br>
    New Discipline Details:<input type="text" name="Details"><br>
  	<input type="submit" value="Add discipline">
	</form>   

<h1>Add Club New Club</h1>
    
<form action="addclub.php" method="POST">
  	Clubname:<input type="text" name="clubname"><br>
    Location:<input type="text" name="location"><br>
    website:<input type="text" name="website"><br>
    contactname:<input type="text" name="contactname"><br>
    contactnumber:<input type="text" name="contactnumber"><br>
    contactemail:<input type="text" name="contactemail"><br>
    password:<input type="password" name="password"><br>
    <input type="checkbox" id="junior" name="junior" value="Junior">
    <label for="junior"> Junior</label><br>
    <input type="checkbox" id="senior" name="senior" value="Senior">
    <label for="senior"> Senior</label><br>
    Clubnight(s) and times:<input type="text" name="clubnight"><br>
  	<input type="submit" value="Add Club">
	</form>
 
</body>
</html>
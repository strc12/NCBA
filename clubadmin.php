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
<h1>Clubs</h1>
<?php
include_once("connection.php");
$stmt = $conn->prepare("SELECT * FROM TblClub WHERE ClubID = :id");
$stmt->bindParam(':id', $_SESSION['clubid']);
$stmt->execute();
$club = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
<h1>Club Admin</h1>
<h3>Club Information</h3>
<hr>
    
    <form action="editclub.php" method="POST">
        Clubname:<input type="text" name="clubname" value="<?php echo htmlspecialchars($club['Clubname']); ?> "disabled><br>
        Location:<input type="text" name="location" value="<?php echo htmlspecialchars($club['Location']); ?>"><br>
        website:<input type="text" name="website" value="<?php echo htmlspecialchars($club['Website']); ?>"><br>
        contact name:<input type="text" name="contactname" value="<?php echo htmlspecialchars($club['Contactname']); ?>"><br>
        contact number:<input type="text" name="contactnumber" value="<?php echo htmlspecialchars($club['Contactnumber']); ?>"><br>
        contact email:<input type="text" name="contactemail" value="<?php echo htmlspecialchars($club['Contactemail']); ?>"><br>
        <input type="checkbox" id="junior" name="junior" value="Junior" <?php if ($club['Junior']==1) echo 'checked'; ?>>
        <label for="junior"> Junior</label><br>
        <input type="checkbox" id="senior" name="senior" value="Senior" <?php if ($club['Junior']!=1) echo 'checked'; ?>>
        <label for="senior"> Senior</label><br>
        Clubnight(s) and times: <br>
        <textarea name="clubnight" rows="4" cols="50"><?php echo htmlspecialchars($club['Clubnight']); ?></textarea>
        <br>
        <input type="submit" value="UpdateDetails">
    </form>
</div>
<div class="container">
<h3>Add player</h3>
<hr>
    
    <form action="addplayer.php" method="POST">
        Forename:<input type="text" name="forename"><br>
        Surname:<input type="text" name="surname" ><br>
        Gender:<br>
        <input type="radio" id="M" name="gender" value="M">
        <label for="M">M</label><br>
        <input type="radio" id="F" name="gender" value="F">
        <label for="F">F</label><br>
        Date of Birth:<input type="text" name="contactname"> <br>
        
        <input type="submit" value="Add New Player">
    </form>
</div>
<div class="container">
  <h3>To edit players in club</h3>
  <hr>
<?php
    echo('<div class="container mt-5">
    <h2 class="mb-4">Registered Players</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col">Member</th>
                <th scope="col">Edit</th>
                
            </tr>
        </thead>
        <tbody>');
    include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM TblPlayers WHERE ClubID=:cid  ORDER BY active DESC, Gender, Surname ASC, Forename ASC ");
    $stmt->bindParam(':cid', $_SESSION["clubid"]);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
            echo("<tr>");
			echo("<td>".$row["Forename"].' '.$row["Surname"].' </td><td>'.$row["DOB"].'</td> <td>'.$row["Gender"]."</td>
            <td>");
            if($row["active"]==1){
                echo("Member");
            }else{
                echo("Non-Member");
            }

            echo("</td>
            <td>
            <form action='editplayer.php' method='post'>
                        <input type='hidden' name='id' value='".$row["PlayerID"]."'>
                        <button type='submit' ");
            if($row['active']==1){
                echo("class='btn btn-primary'");
            }else{
                echo("class='btn btn-danger'");
            }
            echo(">Edit</button>
                    </form>
            </td>");
            echo("</tr>");
		}
    echo("</table>");
?>   



</div>


</body>
</html>
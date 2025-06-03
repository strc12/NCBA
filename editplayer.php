<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script>



    document.addEventListener("DOMContentLoaded", function() {
        // Check if the current URL has a query string (indicating a GET request)
        if (window.location.search) {
            // Disable all form elements
            var formToDisable = document.getElementById("clubselect");
            // Loop through all child elements of the form and disable them
            for (var i = 0; i < formToDisable.elements.length; i++) {
                formToDisable.elements[i].disabled = true;
            }
    }});
</script>

 </head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<div class="Container-fluid">
<h1>Player management</h1>


<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
include_once ("connection.php");
// Fetch items from the database
$sql = "SELECT *, CLUB.Clubname as CN FROM TblPlayers INNER JOIN TblClub as CLUB on (TblPlayers.ClubID=CLUB.ClubID)WHERE PlayerID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $_POST['id']]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item["active"]==1){
        $active=True;
        }else{
            $active=False;
        }
echo("<h3>Current Club - ".$item["CN"]."</h3>"); 
?>

<form action="updateplayerdetails.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['ClubID']) ?>">
            
                <input type="hidden" name="playerid" value="<?php echo htmlspecialchars($item['PlayerID']) ?>"><br>
                
                <label for="Forename">Forename:</label>
                <input type="text" name="Forename" value="<?php echo htmlspecialchars($item['Forename']) ?>"><br>
                <label for="Surname">Surname:</label>
                <input type="text" name="Surname" value="<?php echo htmlspecialchars($item['Surname']) ?>"><br>
                <label for="Gender">Gender:</label>
                <input type="text" name="Gender" value="<?php echo htmlspecialchars($item['Gender']) ?>"><br>
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" value="<?php echo htmlspecialchars($item['DOB']) ?>"><br>
                <label for="member">Member</label>
                <input class="form-check-input" type="checkbox" name="member" value="<?php echo htmlspecialchars($item['active']) ?>" <?php echo $active ? 'checked' : '';?>><br>
                <input type="submit" value="Update" name="update">
            </form>

</body>
</html>

           
        
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
// Helper function to safely escape and fallback on N/A
function safe($value) {
    return htmlspecialchars($value ?? 'N/A');
}
    ?>

</div>
<div class="container-fluid">
<h1>Clubs</h1>
</div>
<div class="container-fluid">
  
  <hr>
<?php
    include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM TblClub ORDER BY Clubname ASC");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{           
            echo "<h4 class='text-center'>" . safe($row["Clubname"]) . "</h4>";
            
            echo '<div class="container mt-2">
                <div class="table-container">
                    <table class="table text-center table-borderless" style="table-layout: fixed; width: 100%;">
                        <tr>
                            <td colspan="3" style="word-wrap: break-word; word-break: break-word;"><span class="fw-bold">Venue</span><br>' . safe($row["Location"]) . '</td>
                        </tr>
                        <tr>
                            <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Clubnight</span><br>' . safe($row["Clubnight"]) . '</td>
                            <td style="word-wrap: break-word; word-break: break-word; width: 33%;"></td>
                            <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Match Night</span><br>' . safe($row["Matchnight"]) . '</td>
                            
                        </tr>
                        <tr>
                            <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Contact Name</span><br>' . safe($row["Contactname"]) . '</td>
                            <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Contact Number</span><br>' . safe($row["Contactnumber"]) . '</td>
                            <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Email</span><br>' . safe($row["Contactemail"]) . '</td>
                        </tr>';
            
            if (!empty($row["Clubsecretaryname"])) {
                echo '<tr>
                    <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Club Secretary Name</span><br>' . safe($row["Clubsecretaryname"]) . '</td>
                    <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Club Secretary Number</span><br>' . safe($row["Clubsecretarynumber"]) . '</td>
                    <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Club Secretary Email</span><br>' . safe($row["Clubsecretaryemail"]) . '</td>
                </tr>';
            }
            
            if (!empty($row["Matchsecretaryname"])) {
                echo '<tr>
                    <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Match Secretary Name</span><br>' . safe($row["Matchsecretaryname"]) . '</td>
                    <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Match Secretary Number</span><br>' . safe($row["Matchsecretarynumber"]) . '</td>
                    <td style="word-wrap: break-word; word-break: break-word; width: 33%;"><span class="fw-bold">Match Secretary Email</span><br>' . safe($row["Matchsecretaryemail"]) . '</td>
                </tr>';
            }
            
            echo '<tr>
                <td style="word-wrap: break-word; word-break: break-word; width: 33%;">';
            
            if (!empty($row['Instagram'])) {
                $ig = ltrim($row['Instagram'], '@');
                echo "<a href='https://www.instagram.com/" . htmlspecialchars($ig) . "' target='_blank' rel='noopener noreferrer'><img src='./images/Instagram_Logo_2023.png' class='imsmall'></a>";
            }
            
            echo '</td><td style="word-wrap: break-word; word-break: break-word; width: 33%;">';
            
            if (!empty($row['Facebook'])) {
                echo "<a href='" . htmlspecialchars($row['Facebook']) . "' target='_blank' rel='noopener noreferrer'><img src='./images/Facebook_Logo_2023.png' class='imsmall'></a>";
            }
            
            echo '</td><td style="word-wrap: break-word; word-break: break-word; width: 33%;">';
            
            if (!empty($row['Website'])) {
                echo "<a href='https://" . htmlspecialchars($row['Website']) . "' target='_blank' rel='noopener noreferrer'><img src='./images/Web.png' class='imsmall'></a>";
            }
            
            echo '</td></tr></table></div></div>';
            
            


     echo("<hr>");
		}
   
?>   



</div>


</body>
</html>
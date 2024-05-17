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
<div class="container">
  Can tidy this up to be in prettier format - do we need other details held?
  <br>
  <hr>
<?php
    include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM TblClub");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo("<h3>".$row["Clubname"].' </h3>'.$row["Location"].'<br> '.$row["Clubnight"]."<br><br>");
     
		}
?>   



</div>


</body>
</html>
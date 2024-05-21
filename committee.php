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
<h1>Committee</h1>
<div class="container">
<div class="row">
  <div class="col-sm-2">Melissa Davey - Chair</div>
  <div class="col-sm-2">Steve Willis -Head coach </div>
  <div class="col-sm-2">Karen Sturgess - Secretary</div>
  <div class="col-sm-2">Simon Sturgess - Assistant Coach</div>
  <div class="col-sm-2">Rob Cunniffe - Schools Representative</div>
  <div class="col-sm-2">Jermaine Lovelace - League Representative</div>
</div>
<div class="row">
  <div class="col-sm-2">Becky Rice - Vice Chair</div>
  <div class="col-sm-2">Hon Wai Lee - Treasurer</div>
  <div class="col-sm-2">Sachin Sharma - Social Media</div>
  <div class="col-sm-2">Lucy Sturgess - Fixtures Secretary</div>
  <div class="col-sm-2">Parent Liasion U19</div>
  <div class="col-sm-2">Parent Liasion U17</div>
</div>
</div>
<div class="container">
  Minutes of meetings
  <br>
  <hr>
<?php
    include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Minutes'");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
            $path="/documents/".$row["filename"];
			echo("<a href='.$path.' target='_blank'><h3>".$row["filename"].' </h3></a><br>');
     
		}
?>   



</div>


</body>
</html>
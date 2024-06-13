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
<h1>Leagues</h1>
<div class="container">
  To add edit deage disciplines
  <br>
  <hr>
<?php

    echo('<div class="container mt-5">
    <h2 class="mb-4">Disciplinee</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Details</th>
                <th scope="col">Active</th>
                <th scope="col">Edit</th>
                
            </tr>
        </thead>
        <tbody>');
    include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM TblLeague WHERE ORDER BY active DESC, Gender, Surname ASC, Forename ASC ");
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
                        <button type='submit' class='btn btn-primary'>Edit</button>
                    </form>
            </td>");
            echo("</tr>");
		}
    echo("</table>");
?>   



</div>


</body>
</html>
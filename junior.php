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

<div class="container-fluid">
<h2 class='text-center'>Junior Clubs</h2>
  <hr>
<?php
    include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM TblClub WHERE junior <>0 ORDER BY Clubname ASC ");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
      echo("<h4 class='text-center'>".$row["Clubname"]."</h4>");
      echo('<div class="container mt-2 ">
      <div class="table-container ">
          <table class="table text-center table-borderless">
             
                  <tr>
                      <td ><span class="fw-bold">Venue</span><br>'.$row["Location"].'</td>
                      <td colspan="2" ><span class="fw-bold">Clubnight</span><br>'.$row["Clubnight"].'</td>
                      
                  </tr>
                  <tr>
                      <td><span class="fw-bold">Contact Name</span><br>'.$row["Contactname"].'</td>
                      <td><span class="fw-bold">Contact Number</span><br>'.$row["Contactnumber"].'</td>
                      <td><span class="fw-bold">Email</span><br>'.$row["Contactemail"].'</td>
                  </tr>
                  <tr >
                      <td >');
                      if (!empty($row['Instagram'])){
      
                      $ig=ltrim($row['Instagram'],'@');
                      echo("<a href='https://www.instagram.com/".$ig."'><img src='./images/Instagram_Logo_2023.png' class='imsmall'></a>");
                          };
                      echo('</td>
                      <td>');
                      if (!empty($row['Facebook'])){
                      echo("<a href='".$row['Facebook']."'><img src='./images/Facebook_Logo_2023.png' class='imsmall'></a>");
                      }
                    echo('</td>
                      <td>');
                      echo("<a href='".$row['Website']."'><img src='./images/Web.png' class='imsmall'></a>");
                      echo('</td>
                  </tr>
             
          </table>
      </div>
  </div>');
     echo("<hr>");
		}
   
?>   



</div>

</body>
</html>
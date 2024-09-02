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

<div class="container">
<h1>Committee</h1>
<H2>Meet the committee</h2><br>
<div class="row">
  <?php
  include_once('connection.php');
  $stmt = $conn->prepare("SELECT * FROM TblCommittee");
	$stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Determine the number of results
$numResults = count($results);

// Define number of columns per row
$columnsPerRow = 3; // Change this to your desired number of columns

// Calculate the Bootstrap column class
$bootstrapColClass = 12 / $columnsPerRow;

// Start generating HTML
echo '<div class="container">';
echo '<div class="row">';

$count = 0;
foreach ($results as $result) {
    // Open a new row if count is a multiple of columns per row
    if ($count % $columnsPerRow == 0 && $count != 0) {
        echo '</div><div class="row">';
    }

    // Generate the column content
    echo '<div class="col-md-' . $bootstrapColClass . '">';
echo '<div class="card">';

// Center the image inside the card using utility classes
echo '<div class="d-flex justify-content-center align-items-center" style="width: 100%;">';
echo '<img src="./comm/' . htmlspecialchars($result['Pic']) . '" class="card-img-top img-fluid  m-5" ">';
echo '</div>';

echo '<div class="card-body text-center">'; // Center align text inside card-body
// Customize the content as per your database fields
echo '<h5 class="card-title">' . htmlspecialchars($result['Name']) . '</h5>';
echo '<p class="card-text">' . htmlspecialchars($result['Post']) . '</p>';
echo '</div>'; // Close card-body
echo '</div>'; // Close card
echo '</div>'; // Close column

    

    $count++;
}

// Close the last row if it's not completed
if ($count % $columnsPerRow != 0) {
    echo '</div>';
}

echo '</div>';
echo '</div>';
?>
<br>
<div class="container">
  <h2>Minutes of meetings</h2>
  <br>
  <hr>
<?php
  
	$stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Minutes'");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
      
            $path="/documents/".$row["filename"];
			echo("<a href='.$path.' target='_blank'><h3>".$row["title"].' </h3></a><br>');
     
		}
    echo("<h2>Other Documents </h2><hr>");
    $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Other'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        
              $path="/documents/".$row["filename"];
        echo("<a href='.$path.' target='_blank'><h3>".$row["title"].' </h3></a><br>');
       
      }
?>   



</div>


</body>
</html>
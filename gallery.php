<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
  <link href="styles.css" rel="stylesheet">
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<h1>Gallery</h1>
? easy if images all the same orientation/size...<br>
could make an interface for Admin to upload more photos and just keep x most current visible?<br>
could 
<!-- Carousel wrapper -->
<div class="container-fluid">
<div class="row">
  <?php
  $ori="Landscape";
  include_once('connection.php');
  $stmt = $conn->prepare("SELECT * FROM tblimages  ORDER BY TYPE asc");
 # $stmt->bindParam(':ori', $ori);WHERE type =:ori
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
    echo '<div class="card ">';
    echo '<div class="card-body mx-auto text-center">';
    // Customize the content as per your database fields
    echo '<H3> '.htmlspecialchars($result['filename'])."</h3>";
    echo '<img src="./gallery/'.htmlspecialchars($result['filename']).'" class=" img-fluid" style="width: 80%;">';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    $count++;
}

// Close the last row if it's not completed
if ($count % $columnsPerRow != 0) {
    echo '</div>';
}

echo '</div>';
echo '</div>';
?>
</div>



</body>
</html>
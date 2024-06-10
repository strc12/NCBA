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
<div class="Container">
<h1>Team management</h1>


<?php
include_once ("connection.php");
// Check if the form is submitted to update the item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $Clubname = $_POST['Clubname'];
    $Location = $_POST['Location'];
    $Website = $_POST['Website'];
    $Contactname = $_POST['Contactname'];
    $Contactemail = $_POST['Contactemail'];
    $Clubnight = $_POST['Clubnight'];
    $Contactnumber = $_POST['Contactnumber'];
    print_R($_POST);
    if (isset($_POST['Junior'])) {
        $checkboxes = $_POST['Junior'];
        if ((in_array("1", $checkboxes)) && (in_array("2", $checkboxes))) {
            $Junior = 2;#both
        } elseif (in_array("1", $checkboxes)) {
            $Junior = 1;#Junior only
        }else{
            $Junior=0;#Senior only
        }
 
    }else{
        $Junior=0;#default to senior f none selected
    }
    echo($Junior);
    
    $sql = "UPDATE tblclub SET clubname = :name, location = :Location, Website = :Website, Contactname =:Contactname, 
    Contactemail = :Contactemail, Clubnight = :Clubnight,
    Contactnumber = :Contactnumber, Junior = :Junior WHERE clubID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $Clubname, ':Location' => $Location, ':id' => $id,
     ':Website' => $Website, ':Contactname' => $Contactname, ':Contactemail' => $Contactemail, ':Clubnight' => $Clubnight,
      ':Contactnumber' => $Contactnumber, ':Junior' => $Junior]);

    echo "Record updated successfully<br>";
}

// Fetch items from the database
$sql = "SELECT clubID, clubname FROM tblclub";
$stmt = $conn->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


    <h1>Select an Item to Edit</h1>
    <form action="" method="get">
        <select name="id">
            <?php foreach ($items as $item): ?>
                <option value="<?php echo htmlspecialchars($item['clubID']) ?>" <?php echo (isset($_GET['clubID']) && $_GET['clubID'] == $item['clubID']) ? 'selected' : '' ?>>
                    <?php echo htmlspecialchars($item['clubname']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Edit">
    </form>

    <?php if (isset($_GET['id'])): ?>
        <?php
        $id = $_GET['id'];
        echo($id);
        $sql = "SELECT * FROM tblclub WHERE clubID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($item);
        if ($item):
        ?>
            <h2>Edit Item</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['ClubID']) ?>">
                <label for="Clubname">Name:</label>
                <input type="text" name="Clubname" value="<?php echo htmlspecialchars($item['Clubname']) ?>"><br>
                <label for="Location">Location:</label>
                <textarea name="Location"><?php echo htmlspecialchars($item['Location']) ?></textarea><br>
                <label for="Website">Name:</label>
                <input type="text" name="Website" value="<?php echo htmlspecialchars($item['Website']) ?>"><br>
                <label for="Contactname">Name:</label>
                <input type="text" name="Contactname" value="<?php echo htmlspecialchars($item['Contactname']) ?>"><br>
                <label for="Contactnumber">Name:</label>
                <input type="text" name="Contactnumber" value="<?php echo htmlspecialchars($item['Contactnumber']) ?>"><br>
                <label for="Contactemail">Name:</label>
                <input type="text" name="Contactemail" value="<?php echo htmlspecialchars($item['Contactemail']) ?>"><br>
                <label for="Clubnight">Description:</label>
                <textarea name="Clubnight"><?php echo htmlspecialchars($item['Clubnight']) ?></textarea><br>
                <label>
                <input type="checkbox" name="Junior[]" value="1" <?php if ($item['Junior'] == 1 || $item['Junior'] == 2) { echo 'checked'; } else { echo ''; } ?>>
                Junior section
                <input type="checkbox" name="Junior[]" value="2"<?php if ($item['Junior'] == 0||$item['Junior'] == 2) { echo 'checked'; } else { echo ''; } ?>>
                Senior section
                </label><br>
                <input type="submit" value="Update">
            </form>
        <?php else: ?>
            <p>No item found.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

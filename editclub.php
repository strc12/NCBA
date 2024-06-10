<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
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
<div class="Container">
<h1>Team management</h1>


<?php
include_once ("connection.php");

// Fetch items from the database
$sql = "SELECT clubID, clubname FROM tblclub";
$stmt = $conn->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


    <h1>Select an Item to Edit</h1>
    <form action="" method="get" id="clubselect">
    <select name="id">
    
            <?php foreach ($items as $item): ?>
                <option value="<?php echo htmlspecialchars($item['clubID']) ?>" <?php echo (isset($_GET['clubID']) && $_GET['clubID'] == $item['clubID']) ? 'selected' : '' ?>>
                    <?php echo htmlspecialchars($item['clubname']) ?>
                </option>
            <?php endforeach; ?>
        </select>

     
        <input type="submit" value="Edit" name="edity">
    </form>

    
    <?php if (isset($_GET['id'])): ?>
        <?php
       
        $id = $_GET['id'];
        #echo($id);
        $sql = "SELECT * FROM tblclub WHERE clubID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        #print_r($item);
        if ($item):
        ?>
            <h2>Edit Item</h2>
            <form action="updateclubdetails.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['ClubID']) ?>">
                <label for="Clubname">Name:</label>
                <input type="text" name="Clubname" value="<?php echo htmlspecialchars($item['Clubname']) ?>"><br>
                <label for="Location">Location:</label>
                <textarea name="Location"><?php echo htmlspecialchars($item['Location']) ?></textarea><br>
                <label for="Website">Website:</label>
                <input type="text" name="Website" value="<?php echo htmlspecialchars($item['Website']) ?>"><br>
                <label for="Contactname">Contact Name:</label>
                <input type="text" name="Contactname" value="<?php echo htmlspecialchars($item['Contactname']) ?>"><br>
                <label for="Contactnumber">Contact Number:</label>
                <input type="text" name="Contactnumber" value="<?php echo htmlspecialchars($item['Contactnumber']) ?>"><br>
                <label for="Contactemail">Contact E-mail:</label>
                <input type="text" name="Contactemail" value="<?php echo htmlspecialchars($item['Contactemail']) ?>"><br>
                <label for="Clubnight">Club Night details:</label>
                <textarea name="Clubnight"><?php echo htmlspecialchars($item['Clubnight']) ?></textarea><br>
                <label>
                <input type="checkbox" name="Junior[]" value="1" <?php if ($item['Junior'] == 1 || $item['Junior'] == 2) { echo 'checked'; } else { echo ''; } ?>>
                Junior section
                <input type="checkbox" name="Junior[]" value="2"<?php if ($item['Junior'] == 0||$item['Junior'] == 2) { echo 'checked'; } else { echo ''; } ?>>
                Senior section
                </label><br>
                <input type="submit" value="Update" name="update">
            </form>
        <?php else: ?>
            <p>No item found.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

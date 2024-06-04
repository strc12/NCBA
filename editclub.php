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
<h2>For Admin users only</h2>
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
<?php
include_once ("connection.php");
// Check if the form is submitted to update the item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE tblclub SET clubname = :name, location = :description WHERE clubID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $name, ':description' => $description, ':id' => $id]);

    echo "Record updated successfully<br>";
}

// Fetch items from the database
$sql = "SELECT clubID, clubname FROM tblclub";
$stmt = $conn->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
</head>
<body>
    <h1>Select an Item to Edit</h1>
    <form action="" method="get">
        <select name="id">
            <?php foreach ($items as $item): ?>
                <option value="<?= htmlspecialchars($item['clubID']) ?>" <?= (isset($_GET['clubID']) && $_GET['clubID'] == $item['clubID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($item['clubname']) ?>
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
                <input type="hidden" name="id" value="<?php htmlspecialchars($item['ClubID']) ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php htmlspecialchars($item['Clubname']) ?>"><br>
                <label for="description">Description:</label>
                <textarea name="description"><?= htmlspecialchars($item['Location']) ?></textarea><br>
                <input type="submit" value="Update">
            </form>
        <?php else: ?>
            <p>No item found.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

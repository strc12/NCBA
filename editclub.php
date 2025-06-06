<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script>
    function showresult(str) {
        if (str == "") {
            document.getElementById("clubinfo").innerHTML = "";
            return;
        } else { 
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("clubinfo").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","clubadmin.php?q="+str,true);
            xmlhttp.send();
        }
       
    }


    /* document.addEventListener("DOMContentLoaded", function() {
        // Check if the current URL has a query string (indicating a GET request)
        if (window.location.search) {
            // Disable all form elements
            var formToDisable = document.getElementById("clubselect");
            // Loop through all child elements of the form and disable them
            for (var i = 0; i < formToDisable.elements.length; i++) {
                formToDisable.elements[i].disabled = true;
            }
    }}); */
</script>

 </head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<div class="Container-fluid">
<h1>Club management</h1>


<?php
include_once ("connection.php");

// Fetch items from the database
$sql = "SELECT ClubID, Clubname FROM TblClub";
$stmt = $conn->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


    <h2>Select an Item to Edit</h2>
    <select id="clubs" onchange="showresult(this.value)">
    <option>Select Club</option>
    
            <?php foreach ($items as $item): ?>
                <option value="<?php echo htmlspecialchars($item['ClubID']) ?>" <?php echo (isset($_GET['ClubID']) && $_GET['ClubID'] == $item['ClubID']) ? 'selected' : '' ?>>
                    <?php echo htmlspecialchars($item['Clubname']) ?>
                </option>
            <?php endforeach; ?>
        </select>

    <!-- </form> -->

<div id="clubinfo">

</div>   
  <script>
$("#clubs").on("change", function(){
    var selected=$(this).val();
    $("#clubinfo").html("You selected: " + selected);
  })</script>  
</body>
</html>

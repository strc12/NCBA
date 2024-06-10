
<?php
include_once ("connection.php");
// Check if the form is submitted to update the item

    $id = $_POST['id'];
    $Clubname = $_POST['Clubname'];
    $Location = $_POST['Location'];
    $Website = $_POST['Website'];
    $Contactname = $_POST['Contactname'];
    $Contactemail = $_POST['Contactemail'];
    $Clubnight = $_POST['Clubnight'];
    $Contactnumber = $_POST['Contactnumber'];
    #print_R($_POST);
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
    
    $sql = "UPDATE tblclub SET clubname = :name, location = :Location, Website = :Website, Contactname =:Contactname, 
    Contactemail = :Contactemail, Clubnight = :Clubnight,
    Contactnumber = :Contactnumber, Junior = :Junior WHERE clubID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $Clubname, ':Location' => $Location, ':id' => $id,
     ':Website' => $Website, ':Contactname' => $Contactname, ':Contactemail' => $Contactemail, ':Clubnight' => $Clubnight,
      ':Contactnumber' => $Contactnumber, ':Junior' => $Junior]);
    echo("<script>
        alert('Details Updated');
        window.location.href='editclub.php';
    </script>");#alert followed by redirect
      
      ?>

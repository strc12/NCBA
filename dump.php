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
            <h2>Edit Club information</h2>
            <form action="updateclubdetails.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['ClubID']) ?>">
                <label for="clubname">Name:</label>
                <input type="text" name="clubname" value="<?php echo htmlspecialchars($item['Clubname']) ?>"><br>
                <label for="location">Location:</label>
                <textarea name="location"><?php echo htmlspecialchars($item['Location']) ?></textarea><br>
                <label for="website">Website:</label>
                <input type="text" name="website" value="<?php echo htmlspecialchars($item['Website']) ?>"><br>
                <label for="contactname">Contact Name:</label>
                <input type="text" name="contactname" value="<?php echo htmlspecialchars($item['Contactname']) ?>"><br>
                <label for="contactnumber">Contact Number:</label>
                <input type="text" name="contactnumber" value="<?php echo htmlspecialchars($item['Contactnumber']) ?>"><br>
                <label for="contactemail">Contact E-mail:</label>
                <input type="text" name="contactemail" value="<?php echo htmlspecialchars($item['Contactemail']) ?>"><br>
                <label for="clubnight">Club Night details:</label>
                <textarea name="clubnight"><?php echo htmlspecialchars($item['Clubnight']) ?></textarea><br>
                <label>
                <input type="checkbox" name="junior[]" value="1" <?php if ($item['Junior'] == 1 || $item['Junior'] == 2) { echo 'checked'; } else { echo ''; } ?>>
                Junior section
                <input type="checkbox" name="junior[]" value="2"<?php if ($item['Junior'] == 0||$item['Junior'] == 2) { echo 'checked'; } else { echo ''; } ?>>
                Senior section
                </label><br>
                <input type="submit" value="Update" name="update">
            </form>
            <div class="container">
        <h3>Add player</h3>
        <hr>
            
            <form action="addplayer.php" method="POST">
                Forename:<input type="text" name="forename"><br>
                Surname:<input type="text" name="surname" ><br>
                Gender:<br>
                <input type="radio" id="M" name="gender" value="M">
                <label for="M">M</label><br>
                <input type="radio" id="F" name="gender" value="F">
                <label for="F">F</label><br>
                Date of Birth:<input type="text" name="contactname"> <br>
                
                <input type="submit" value="Add New Player">
            </form>
        </div>
        <div class="container">
        <h3>To edit players in club</h3>
        <hr>
        <?php
            echo('<div class="container mt-5">
            <h2 class="mb-4">Registered Players</h2>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Member</th>
                        <th scope="col">Edit</th>
                        
                    </tr>
                </thead>
                <tbody>');
            $stmt = $conn->prepare("SELECT * FROM TblPlayers WHERE ClubID=:cid  ORDER BY active DESC, Gender, Surname ASC, Forename ASC ");
            $stmt->bindParam(':cid', $id);
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
                                <button type='submit' ");
                    if($row['active']==1){
                        echo("class='btn btn-primary'");
                    }else{
                        echo("class='btn btn-danger'");
                    }
                    echo(">Edit</button>
                            </form>
                    </td>");
                    echo("</tr>");
                }
            echo("</table>");
        ?>   



        </div>

        <?php else: ?>
            <p>No item found.</p>
        <?php endif; ?>
    <?php endif; ?>
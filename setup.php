<?php 
    // note this does not use connection.php as connection made at the time of creation
   $servername = 'localhost';
   $username = 'root';
   $password= '';
//note no Database mentioned here!!

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS NCB";
    $conn->exec($sql);
    //next 3 lines optional only needed really if you want to go on an do more SQL here!
    $sql = "USE NCB";
    $conn->exec($sql);
    echo "DB created successfully";
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblClub;
    CREATE TABLE TblClub 
    (ClubID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Clubname VARCHAR(20) NOT NULL,
    Location VARCHAR(200) NOT NULL,
    Website VARCHAR(200),
    Contactname VARCHAR(200) NOT NULL,
    Contactnumber VARCHAR(200),
    Clubnight VARCHAR(200),
    Contactemail VARCHAR(200),
    Password VARCHAR(200))");
    
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblClub(ClubID,Clubname,location,Website,Contactname,Contactnumber,Clubnight,Contactemail,password)VALUES 
    (NULL,'Apollo BC','Moulton School, Moulton','www.apollo.co.uk','Bob','0798989899','Wednesday 3:70-9:30pm','x@y.com','password'),
    (NULL,'Bugbrooke BC','Campion School & Language College, Kislingbury Rd, Bugbrooke, NN7 3QG','www.apollo.co.uk','Bob','0798989899','Thursday - 7.30 - 9.30pm','x@y.com','password')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();

} 
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn=Null;
?>
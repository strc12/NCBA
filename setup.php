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

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblAdmin;
    CREATE TABLE TblAdmin 
    (AdminID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(20) NOT NULL,
    Password VARCHAR(200) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor();
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    $stmt5 = $conn->prepare("INSERT INTO TblAdmin(AdminID,Username,Password)VALUES 
    (NULL,'Rob',:pw)");
    $stmt5->bindParam(':pw', $hashed_password);
    $stmt5->execute();
    $stmt5->closeCursor();


    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblClub;
    CREATE TABLE TblClub 
    (ClubID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Clubname VARCHAR(20) NOT NULL,
    Location LONGTEXT NOT NULL,
    Website VARCHAR(200),
    Contactname VARCHAR(200) NOT NULL,
    Contactnumber VARCHAR(200),
    Clubnight LONGTEXT NOT NULL,
    Contactemail VARCHAR(200),
    Password VARCHAR(200),
    Junior INT(1))");#0 - adult only, 1 junior 2, both
    
    $stmt1->execute();
    $stmt1->closeCursor();
    
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    $stmt5 = $conn->prepare("INSERT INTO TblClub(ClubID,Clubname,location,Website,Contactname,Contactnumber,Clubnight,Contactemail,password,junior)VALUES 
    (NULL,'Apollo BC','Moulton School, Moulton','www.apollo.co.uk','Bob','0798989899','Wednesday 3:70-9:30pm','x@y.com',:pw,0),
    (NULL,'Bugbrooke BC','Campion School & Language College, Kislingbury Rd, Bugbrooke, NN7 3QG','www.apollo.co.uk','Bob','0798989899','Thursday - 7.30 - 9.30pm','x@y.com',:pw,1),
    (NULL,'Wellingborough BC','Monday Venue is Manor School in Raunds, Mountbatten Way, NN9 6PA, Wednesday Venue is Sharnbrook Academy, School Approach, Odell Road, Sharnbrook, MK44 1JL','www.wellingboroughbc.co.uk','Rachael Maywood','07709470567','Jnrs Monday 6-8pm,Snrs Monday 8-10pm, Snrs Wednesday 7.30-9.30pm','info@wellingboroughbc.co.uk',:pw,2)
    ");
    $stmt5->bindParam(':pw', $hashed_password);
    $stmt5->execute();
    $stmt5->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblMedia;
    CREATE TABLE TblMedia 
    (MediaID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    details LONGTEXT NOT NULL,
    dateadded DATE DEFAULT (current_timestamp()),
    type VARCHAR(200))");
   
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblImages;
    CREATE TABLE TblImages 
    (ImageID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename LONGTEXT NOT NULL,
    dateadded DATE DEFAULT (current_timestamp()),
    description VARCHAR (500) DEFAULT '',
    type VARCHAR(200),
    current INT(1) DEFAULT 1)");
   
    $stmt1->execute();
    $stmt1->closeCursor();
    #current 1 - current, 0 is archived
    $stmt5 = $conn->prepare("INSERT INTO TblImages(ImageID,filename,dateadded,description,type,current)VALUES 
    (NULL,'1.jpg', '24-05-22','Christmas elf','Square',1),
    (NULL,'3.jpg', '24-05-22','','Square',1),
    (NULL,'7.jpg', '24-05-22','U19 Restricted winners 2024','Portrait',0)
   
    ");
    $stmt5->execute();
    $stmt5->closeCursor();

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblDocs;
    CREATE TABLE TblDocs 
    (DocID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title varchar(200) NOT NULL,
    filename VARCHAR(300) NOT NULL,
    dateadded DATE DEFAULT (current_timestamp()),
    type VARCHAR(200))");
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblDocs(DocID,title,filename,dateadded,type)VALUES 
    (NULL,'16th November 2023','16thNovember2023.pdf', NULL,'Minutes')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblCommittee;
    CREATE TABLE TblCommittee 
    (CommitteeID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Post VARCHAR(50) NOT NULL,
    Pic VARCHAR(200))");
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblCommittee(CommitteeID,Name,Post,Pic)VALUES 
    (NULL,'Rob Cunniffe','Schools representative','Rob.jpg')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();

    # tables for league scoring
    #already have club
    #club has team
    #Club has team - to store team details i.e kettering A, oundle ladies Towster doubles A
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblClubhasteam;
    CREATE TABLE TblClubhasteam 
    (ClubhasteamID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ClubID INT(4) NOT NULL,
    DivisionID VARCHAR(50) NOT NULL,
    Name VARCHAR(200) NOT NULL)");
    
    $stmt1->execute();
    $stmt1->closeCursor();
    #player - name gender
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblPlayers;
    CREATE TABLE TblPlayers 
    (PlayerID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Gender VARCHAR(50) NOT NULL,
    Forename VARCHAR(50) NOT NULL,
    Surname VARCHAR(200) NOT NULL,
    DOB DATE,
    ClubID INT(4) NOT NULL)");
    
    $stmt1->execute();
    $stmt1->closeCursor();
    #player belongs to club for club has team?? 
    
   
    #league - e.g. open or ladies or doubles
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblLeague;
    CREATE TABLE TblLeague 
    (LeagueID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Details VARCHAR(50) NOT NULL)");
    
    $stmt1->execute();
    $stmt1->closeCursor();
    #division - division with in league 1st 2ns 3rd etc
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblDivision;
    CREATE TABLE TblDivision 
    (DivisionID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    LeaGueID INT(4) NOT NULL)");
    
    $stmt1->execute();
    $stmt1->closeCursor();
    #matches - link team (H and A) with league and division
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblMatch;
    CREATE TABLE TblMatch 
    (MatchID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    DivisionID VARCHAR(50) NOT NULL,
    HomeID INT(4) NOT NULL,
    AwayID INT(4) NOT NULL,
    Fixturedate DATE,
    HomeP1ID INT(4) ,
    HomeP2ID INT(4) ,
    HomeP3ID INT(4) ,
    HomeP4ID INT(4) ,
    HomeP5ID INT(4) ,
    HomeP6ID INT(4) ,
    AqayP1ID INT(4) ,
    AWAYP2ID INT(4) ,
    AwayP3ID INT(4) ,
    AwayP4ID INT(4) ,
    AwayP5ID INT(4) ,
    AwayP6ID INT(4) ,
    m1h int(2),
    m1a int(2),
    m2h int(2),
    m2a int(2),
    m3h int(2),
    m3a int(2),
    m4h int(2),
    m4a int(2),
    m5h int(2),
    m5a int(2),
    m6h int(2),
    m6a int(2),
    m7h int(2),
    m7a int(2),
    m8h int(2),
    m8a int(2),
    m9h int(2),
    m9a int(2),
    m10h int(2),
    m10a int(2),
    m11h int(2),
    m11a int(2),
    m12h int(2),
    m12a int(2),
    m13h int(2),
    m13a int(2),
    m14h int(2),
    m14a int(2),
    m15h int(2),
    m15a int(2),
    m16h int(2),
    m16a int(2),
    m17h int(2),
    m17a int(2),
    m18h int(2),
    m18a int(2),
    m19h int(2),
    m19a int(2),
    m20h int(2),
    m20a int(2),
    m21h int(2),
    m21a int(2),
    m22h int(2),
    m22a int(2),
    m23h int(2),
    m23a int(2),
    m24h int(2),
    m24a int(2),
    m25h int(2),
    m25a int(2),
    m26h int(2),
    m26a int(2),
    m27h int(2),
    m27a int(2))
    ");#all potential scores home and away (27 a side)
    #need to limit for Ladies and doubles
    
    $stmt1->execute();
    $stmt1->closeCursor();

    #mixed, levels and doubles need different formats?? - all have same number of games??? Ladies team of 4...
    #might need different scorecards for each league

} 
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn=Null;
?>
<?php 
    // note this does not use connection.php as connection made at the time of creation
    //c0ed1vt5u.mysql.service.one.com:3306
   $servername = 'localhost';
   $username = 'root';
   $password= '';
//note no Database mentioned here!!

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS ncb";
    $conn->exec($sql);
    //next 3 lines optional only needed really if you want to go on an do more SQL here!
    $sql = "USE ncb";
    $conn->exec($sql);
    echo "DB created successfully";
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblSeason;
    CREATE TABLE TblSeason 
    (Season INT(4) UNSIGNED PRIMARY KEY,
    current INT(1) )");#format 2223(season 2022-2023) - 1 current 0 archived
    $stmt1->execute();
    $stmt1->closeCursor();
    
    $stmt5 = $conn->prepare("INSERT INTO TblSeason(Season,current)VALUES 
    (2425,1)
    ");
    $stmt5->execute();
    $stmt5->closeCursor();

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblAdmin;
    CREATE TABLE TblAdmin 
    (AdminID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(20) NOT NULL,
    Password VARCHAR(200) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor();
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    $stmt5 = $conn->prepare("INSERT INTO TblAdmin(AdminID,Username,Password)VALUES 
    (NULL,'Rob',:pw),
    (NULL,'Mel',:pw),
    (NULL,'Jermaine',:pw)");
    $stmt5->bindParam(':pw', $hashed_password);
    $stmt5->execute();
    $stmt5->closeCursor();


    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblClub;
    CREATE TABLE TblClub 
    (ClubID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Clubname VARCHAR(40) NOT NULL,
    Location LONGTEXT NOT NULL,
    Website VARCHAR(200),
    Instagram VARCHAR(200),
    Facebook VARCHAR (500),
    Contactname VARCHAR(200) NOT NULL,
    Contactnumber VARCHAR(200),
    Contactemail VARCHAR(200),
    Clubsecretaryname VARCHAR(200),
    Clubsecretarynumber VARCHAR(200),
    Clubsecretaryemail VARCHAR(200),
    Matchsecretaryname VARCHAR(200),
    Matchsecretarynumber VARCHAR(200),
    Matchsecretaryemail VARCHAR(200),
    Clubnight LONGTEXT,
    Matchnight LONGTEXT,
    Password VARCHAR(200),
    Junior INT(1))");#0 - adult only, 1 junior 2, both
    
    $stmt1->execute();
    $stmt1->closeCursor();
    
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    


    $stmt5 = $conn->prepare("INSERT INTO tblClub (Clubname,Location,Website,Instagram,Facebook,Contactname,Contactnumber, Contactemail,
    Clubsecretaryname,Clubsecretarynumber,Clubsecretaryemail,Matchsecretaryname,Matchsecretarynumber,Matchsecretaryemail,Clubnight,Matchnight,Password,Junior)
VALUES
(
    'All Stars',
    'Sharnbrook - Sharnbrook Academy, School Approach, Odell Road, Sharnbrook, MK44 1JL',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    'Christina Stimpson', NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'Apollo BC',
    'Moulton - Moulton School, Moulton, NN3 7SD',
    'http://www.apollobadmintonclub.co.uk/index.html',
    NULL, NULL,
    'Billy Eyles', NULL, NULL,
    NULL, NULL, NULL,
    'Ian Miles', NULL, NULL,
    'Wednesday 7:30-9:30pm',
    'Wednesday 7:30-9:30pm',
    :pw, 0
),
(
    'Bugbrooke BC',
    'Bugbrooke - Campion School & Language College, Kislingbury Road, Bugbrooke, NN7 3QG',
    NULL, NULL, NULL,
    'James Conway', NULL, NULL,
    'Neil Setterfield', NULL, NULL,
    'James Conway', NULL, NULL,
    'Thursday 7:30-9:30pm',
    'Thursday 7:30-9:30pm',
    :pw, 0
),
(
    'Central BC',
    'Wellingborough - Hindu Community Centre, 148 Highfield Road, Wellingborough, NN8 1PL',
    'http://www.centralbadmintonclub.co.uk',
    NULL, NULL,
    'Steven Mayes', NULL, NULL,
    'Steven Mayes', NULL, NULL,
    'Steven Mayes', NULL, NULL,
    'Wednesday 7:30pm',
    'Friday 7:30pm',
    :pw, 0
),
(
    'Centre',
    'Roade - Willison Centre (Elizabeth Woodville School)',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'DKWAY',
    'Northampton - NHS',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'Duston BC',
    'Duston - Duston School',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'Harborough Feathers BC',
    'Market Harborough - Market Harborough Leisure Centre, Northampton Road, LE16 9HF',
    'http://www.harborough-feathers.co.uk',
    NULL, NULL,
    'Nat Jackson', NULL, NULL,
    NULL, NULL, NULL,
    'Eleanor Bowditch', NULL, NULL,
    NULL,
    'Friday 8:00-10:00pm',
    :pw, 0
),
(
    'Kettering BC',
    'Kettering - Bishop Stopford School, Headlands, Kettering, NN15 6BJ',
    'http://www.ketteringbadmintonclub.co.uk',
    NULL, NULL,
    'Simon Hawes', NULL, NULL,
    'Simon Hawes', NULL, NULL,
    'Lyndsey Blow', NULL, NULL,
    'Friday 7:00-10:00pm',
    'Wednesday 7:00-9:00pm',
    :pw, 1
),
(
    'Mereway BC',
    'Wootton - Caroline Chisholm School',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'Pyghtle BC',
    'Moulton - Moulton College, John Ashby Sports Hall',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'Soaring Shuttles BC',
    'Wootton - Caroline Chisholm School',
    NULL, NULL, NULL,
    'Not provided', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, :pw, 0
),
(
    'Thrapston BC',
    'Raunds - Raunds Manor Sports Hall, Mountbatten Way, Raunds, NN9 6PA',
    'http://www.thrapstonbadminton.co.uk',
    NULL, NULL,
    'Tim Kellett', NULL, NULL,
    'Tim Kellett', NULL, NULL,
    'Tim Kellett', NULL, NULL,
    'Wednesday 8:00-10:00pm',
    'Thursday 8:15-10:15pm',
    :pw, 0
),
(
    'Towcester BC',
    'Towcester - Towcester Centre for Leisure, Springfields, Towcester, NN12 6UW',
    NULL, NULL,
    'https://www.facebook.com/TowcesterBadmintonClub',
    'Emily Fisk', NULL, NULL,
    'Emily Fisk', NULL, NULL,
    'Emily Fisk', NULL, NULL,
    'Tuesday 7:30-10:00pm',
    'Tuesday 7:30-10:00pm',
    :pw, 0
),
(
    'UON (University of Northampton)',
    'Northampton - Sports Dome, University of Northampton, 2 University Drive, Northampton, NN1 5PH',
    NULL, NULL, NULL,
    'Will Turner', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL,
    'Wednesday 7:00-9:00pm',
    :pw, 0
),
(
    'Wellingborough Badminton',
    'Sharnbrook (also sessions at Raunds) - Sharnbrook Academy and Manor School',
    'http://www.wellingboroughbc.co.uk',
    NULL, NULL,
    'Rachael Maywood', NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    'Monday 8:00-10:00pm at Manor School; Wednesday 7:30-9:30pm at Sharnbrook Academy',
    'Wednesday 7:30-9:30pm',
    :pw, 1
),
(
    'Smash Masters',
    NULL,NULL,
    NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL, NULL, NULL,
    NULL,
    NULL,
    :pw, 1
)
;
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
   #test
    $stmt1->execute();
    $stmt1->closeCursor();
    #current 1 - current, 0 is archived
    // $stmt5 = $conn->prepare("INSERT INTO TblImages(ImageID,filename,dateadded,description,type,current)VALUES 
    // (NULL,'1.jpg', '24-05-22','Christmas elf','Square',1),
    // (NULL,'3.jpg', '24-05-22','','Square',1),
    // (NULL,'7.jpg', '24-05-22','U19 Restricted winners 2024','Portrait',0)
   
    // ");
    // $stmt5->execute();
    // $stmt5->closeCursor();

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblDocs;
    CREATE TABLE TblDocs 
    (DocID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title varchar(200) NOT NULL,
    filename VARCHAR(300) NOT NULL,
    dateadded DATE DEFAULT (current_timestamp()),
    type VARCHAR(200))");
    $stmt1->execute();
    $stmt1->closeCursor();
    #$stmt5 = $conn->prepare("INSERT INTO TblDocs(DocID,title,filename,dateadded,type)VALUES 
    #(NULL,'16th November 2023','16thNovember2023.pdf', NULL,'Minutes')
   # ");
    #$stmt5->execute();
    #$stmt5->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblCommittee;
    CREATE TABLE TblCommittee 
    (CommitteeID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Post VARCHAR(50) NOT NULL,
    Email VARCHAR(200),
    Pic VARCHAR(200))");
    $stmt1->execute();
    $stmt1->closeCursor();
    // $stmt5 = $conn->prepare("INSERT INTO TblCommittee(CommitteeID,Name,Post,Pic)VALUES 
    // (NULL,'Rob Cunniffe','Schools representative','Rob.jpg')
    // ");
    // $stmt5->execute();
    // $stmt5->closeCursor();

    # tables for league scoring
    #already have club
    #club has team
    #Club has team - to store team details i.e kettering A, oundle ladies Towster doubles A
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblClubhasteam;
    CREATE TABLE TblClubhasteam 
    (ClubhasteamID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ClubID INT(4) NOT NULL,
    DivisionID VARCHAR(50) NOT NULL,
    Name VARCHAR(200) NOT NULL,
    current INT(1) DEFAULT 0,
    dock INT(1) DEFAULT 0)");
    #
    $stmt1->execute();
    $stmt1->closeCursor();
    
    $stmt5 = $conn->prepare("INSERT INTO tblClubhasteam
    (ClubID, DivisionID, Name, `current`, dock)
VALUES
    -- All Stars (ClubID 1)
    (1, 6, 'Rushden All Stars Ladies A', 1, 0),
    (1, 2, 'Rushden All Stars Men''s A', 1, 0),
    (1, 4, 'Rushden All Stars Mixed A', 1, 0),

    -- Apollo BC (ClubID 2)
    (2, 1, 'Apollo Men''s A', 1, 0),
    (2, 3, 'Apollo Men''s B', 1, 0),

    -- Bugbrooke BC (ClubID 3)
    (3, 2, 'Bugbrooke Men''s', 1, 0),
    (3, 3, 'Bugbrooke Men''s B', 1, 0),

    -- Harborough Feathers BC (ClubID 8)
    (8, 5, 'Harborough Feathers Doubles', 1, 0),

    -- Kettering BC (ClubID 9)
    (9, 5, 'Kettering Doubles', 1, 0),
    (9, 6, 'Kettering Ladies', 1, 0),
    (9, 1, 'Kettering Men''s A', 1, 0),
    (9, 2, 'Kettering Men''s B', 1, 0),
    (9, 4, 'Kettering Mixed', 1, 0),

    -- Mereway BC (ClubID 10)
    (10, 1, 'Mereway Men''s A', 1, 0),
    (10, 2, 'Mereway Men''s B', 1, 0),
    (10, 4, 'Mereway Mixed', 1, 0),
    (10, 5, 'Mereway Doubles', 1, 0),

    -- Pyghtle BC (ClubID 11)
    (11, 5, 'Pyghtle Doubles', 1, 0),
    (11, 1, 'Pyghtle Men''s A', 1, 0),
    (11, 2, 'Pyghtle Men''s B', 1, 0),

    -- Soaring Shuttles BC (ClubID 12)
    (12, 1, 'Soaring Shuttles Men''s', 1, 0),

    -- Thrapston BC (ClubID 13)
    (13, 3, 'Thrapston Men''s', 1, 0),

    -- Towcester BC (ClubID 14)
    (14, 5, 'Towcester Doubles A', 1, 0),
    (14, 6, 'Towcester Ladies', 1, 0),
    (14, 1, 'Towcester Men''s A', 1, 0),
    (14, 2, 'Towcester Men''s B', 1, 0),
    (14, 4, 'Towcester Mixed A', 1, 0),

    -- UON (ClubID 15)
    (15, 3, 'UON Men''s A', 1, 0),
    (15, 4, 'UON Mixed', 1, 0),

    -- Wellingborough Badminton (ClubID 16)
    (16, 3, 'Wellingborough', 1, 0),

    -- Smash Masters (ClubID 17)
    (17, 3, 'Smash Masters A', 1, 0)");
    
    $stmt5->execute();
    $stmt5->closeCursor();

    #player - name gender
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblPlayers;
    CREATE TABLE TblPlayers 
    (PlayerID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Gender VARCHAR(50) NOT NULL,
    Forename VARCHAR(50) NOT NULL,
    Surname VARCHAR(200) NOT NULL,
    DOB DATE,
    ClubID INT(4) NOT NULL,
    active TINYINT DEFAULT 1)");#DOB for Junior identification?
    #do we need registration date?? and deregistration date?
    $stmt1->execute();
    $stmt1->closeCursor();
    #player belongs to club for club has team?? 
    // $stmt5 = $conn->prepare("INSERT INTO TblPlayers(PlayerID,Gender,Forename,Surname,DOB,ClubID,active)VALUES 
    // (NULL,'M','Fred','Smith','24-05-02',1,1),
    // (NULL,'M','Fred1','Smith1','24-05-02',1,1),
    // (NULL,'M','Fred2','Smith2','24-05-02',1,1),
    // (NULL,'F','Freda','Smith','24-05-02',1,1),
    // (NULL,'F','Freda1','Smith','24-05-02',1,1),
    // (NULL,'F','Freda2','Smith','24-05-02',1,1),
    // (NULL,'M','Freddy','Smith','24-05-02',2,1),
    // (NULL,'M','Freddy1','Smith','24-05-02',2,1),
    // (NULL,'M','Freddy2','Smith','24-05-02',2,1),
    // (NULL,'F','Frederica','Smith','24-05-02',2,1),
    // (NULL,'F','Frederica1','Smith','24-05-02',2,1),
    // (NULL,'F','Frederica2','Smith','24-05-02',2,1),
    // (NULL,'F','Fred','Smith','24-05-02',3,1)
    // ");
    // $stmt5->execute();
    // $stmt5->closeCursor();
   
    #league - e.g. open or ladies or doubles
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblLeague;
    CREATE TABLE TblLeague 
    (LeagueID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Details VARCHAR(50) NOT NULL)");
    
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblLeague(LeagueID,Name,Details)VALUES 
    (NULL,'Open','Open doubles'),
    (NULL,'Mixed','Mixed doubles'),
    (NULL,'Doubles','Doubles league - Mixed, Ladies and Mens'),
    (NULL,'Ladies','Ladies league - 4 players - six games')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
    #division - division with in league 1st 2ns 3rd etc
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblDivision;
    CREATE TABLE TblDivision 
    (DivisionID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    LeagueID INT(4) NOT NULL,
    Divisionrank INT(1) NOT NULL)");
    
    $stmt1->execute();
    $stmt1->closeCursor();

    $stmt5 = $conn->prepare("INSERT INTO TblDivision(DivisionID,Name,LeagueID,Divisionrank)VALUES 
    (NULL,'OPEN 1st',1,1),
    (NULL,'OPEN 2nd',1,2),
    (NULL,'OPEN 3rd',1,3),
    (NULL,'MIXED 1st',2,1),
    (NULL,'DOUBLES 1st',3,1),
    (NULL,'LADIES 1st',4,1)");
    

    // ");#type picked from tblleague 
    $stmt5->execute();
    $stmt5->closeCursor();
    

    #matches - link team (H and A) with league and division
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblMatches;
    CREATE TABLE TblMatches 
    (MatchID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    DivisionID VARCHAR(50) NOT NULL,
    HomeID INT(4) NOT NULL,
    AwayID INT(4) NOT NULL,
    Fixturedate DATE,
    Season INT(4),
    HomeP1ID INT(4) ,
    HomeP2ID INT(4) ,
    HomeP3ID INT(4) ,
    HomeP4ID INT(4) ,
    HomeP5ID INT(4) ,
    HomeP6ID INT(4) ,
    AwayP1ID INT(4) ,
    AwayP2ID INT(4) ,
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
    m27a int(2),
    resultsentered int(1))
    ");#all potential scores home and away (27 a side)
    #need to limit for Ladies and doubles
    
    $stmt1->execute();
    $stmt1->closeCursor();

    #mixed, levels and doubles need different formats?? - all have same number of games??? Ladies team of 4...
    #might need different scorecards for each league
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblNews;
    CREATE TABLE TblNews 
    (NewsID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Heading VARCHAR(250) NOT NULL,
    Details VARCHAR(500) NOT NULL,
    Dateadded DATE DEFAULT (current_timestamp()),
    Link VARCHAR(200),
    Linktext VARCHAR(200),
    Picture VARCHAR(300),
    Active BOOLEAN DEFAULT True)");
    
    $stmt1->execute();
    $stmt1->closeCursor();
} 
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn=Null;
?>
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
<h1>Admin for adding to website</h1>
<p> need to have ability to edit here too and separate into different parts</p>

<h1>Add social media feed</h1>
<form action="addmedia.php" method="POST">
  	Embed code:<input type="text" name="embedcode"><br>
    Type:<input type="text" name="type"><br>	
  	<input type="submit" value="Add Media">
	</form>
  <h1>Add Club info feed</h1>
    
<form action="addclub.php" method="POST">
  	Clubname:<input type="text" name="clubname"><br>
    Location:<input type="text" name="location"><br>
    website:<input type="text" name="website"><br>
    contactname:<input type="text" name="contactname"><br>
    contactnumber:<input type="text" name="contactnumber"><br>
    contactemail:<input type="text" name="contactemail"><br>
    password:<input type="password" name="password"><br>
    <input type="checkbox" id="junior" name="junior" value="Junior">
    <label for="junior"> Junior</label><br>
    <input type="checkbox" id="senior" name="senior" value="Senior">
    <label for="senior"> Senior</label><br>
    Clubnight(s) and times:<input type="text" name="clubnight"><br>
  	<input type="submit" value="Add Club">
	</form>
  <h1>Documents</h1>
  <form action="adddocument.php" method="POST" enctype="multipart/form-data">
    Title of document:<input type="text" name="title"><br>
    <select name="typeofdoc">
    <option value="Minutes">Minutes</option>
    <option value="Agenda">Agenda</option>
    <option value="Other">Other</option>
</select>
    File: <input type="file" id="doc" name="doc" accept="documents/*"><br>
    Date <input type="date" id="dateofupload" name="dateofupload">
  	<input type="submit" value="Add Document">
	</form>
  <h1>Committee</h1>
  <form action="addcommittee.php" method="POST" enctype="multipart/form-data">
  	Name:<input type="text" name="name"><br>
    Post <input type="text" id="post" name="post">
    image: <input type="file" id="comm" name="comm" accept=".jpg, .jpeg"><br>
  	<input type="submit" value="Add committee member">
	</form>
</body>
</html>
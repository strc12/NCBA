<!DOCTYPE html>
<html lang="en">
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<!--Navigation bar-->
<div id="result">
    <?php
    include_once("navbar.php");
    ?>

</div>
<br>
<div class="container mt-3">
  <div class="row">
    <div class="col-sm-4 mt-4">
    <img src="images/shuttlepile1.png" class="rounded responsive">
    </div>
    <div class="col-sm-8">
        <div class="mt-4 p-5 bg-light text-dark rounded">
        <h1 >Welcome to Northants County Badminton Association</h1> 
        <p>We cover all aspects of Badminton for Juniors and Seniors -<br>
        Junior County,<br>
        Seniors County,<br>
        Masters County (under construction),<br>
        League, and Clubs.<br>
        With a warm welcome extended to all levels and abilities. </p> 
      </div>
    </div>
  </div>
  
</div>
<div class="container">
  <h1 class="text-center p-3 mb-5 mt-3">Join the Northants County Badminton Association</h1>
  <div class="row">
    <div class="col-sm-4 text-center ">
    <img src="images/shuttle.png">
    <h2 class="p-3">Play with skilled players</h2>
    <p>Improve your game by playing with our skilled and experienced players<p>

    </div>
    
    <div class="col-sm-4 text-center">
    <img src="images/shuttle.png">
    <h2 class="p-3">Participate in tournaments</h2>
    <p>Showcase your talent and compete with other players in our exciting tournaments.</p>

    </div>
  
    <div class="col-sm-4 text-center">
    <img src="images/shuttle.png">
    <h2 class="p-4">Join a vibrant badminton community</h2>
    <p>Become part of a supportive and friendly community of badminton enthusiasts.</p>

    </div>
   
  </div>
</div>
<div class="container">
  <h1>Where to Find us</h1>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8603.64306355196!2d-0.7243395375532741!3d52.30139139078685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4877a1142249bab3%3A0xe40742334642f9ee!2sWeavers%20Leisure%20Centre!5e0!3m2!1sen!2suk!4v1716374406027!5m2!1sen!2suk" 
    width=100% height=400px style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>
<div class="container">
  <h1>Contact Us</h1>
      <form action="send_email.php" method="post">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
          <br>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <br>
          <label for="message">Message:</label>
          <textarea id="message" name="message" required></textarea>
          <br>
          <input type="submit" value="Send">
      </form>

</div>

</body>
</html>

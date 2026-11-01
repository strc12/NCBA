<?php
require_once(__DIR__ . '/sessions.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="styles.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body, html {
            height: 100%;
        }
        .bg {
            background-image: url('https://source.unsplash.com/random');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .card {
            border-radius: 15px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    
    <div class="bg d-flex justify-content-center align-items-center">
    <form action="loginprocess.php" method= "POST">
        <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Club Name</label>
                        <input type="text" class="form-control" name="clubname" placeholder="Enter your Club name">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                    </div>
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
            
        </div>
        </form>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


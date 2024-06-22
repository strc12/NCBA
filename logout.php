<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
if(isset($_SESSION['clubid']))
{
    session_destroy();
}

header("Location: index.php");

?>
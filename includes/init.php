<?php

// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Global config can go here later
date_default_timezone_set('Europe/London');
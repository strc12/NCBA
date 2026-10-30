<?php

require_once __DIR__ . '/init.php';

$pageTitle = $pageTitle ?? 'My Website';

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title><?= htmlspecialchars($pageTitle) ?></title>

<!-- Bootstrap 5 -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="/assets/css/style.css">

</head>

<body>

<?php require __DIR__ . '/navbar.php'; ?>

<div class="container py-4">
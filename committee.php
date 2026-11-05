<?php
require_once(__DIR__ . '/sessions.php');
$basePath = dirname($_SERVER['SCRIPT_NAME']);

$basePath = rtrim($basePath, '/');
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
        /* Document and email links */
        .page-content a,
        .page-content a:visited {
            color: #3ecb0d;
            text-decoration: none;
            font-weight: bold;
        }

        .page-content a:hover,
        .page-content a:focus {
            color: #3ecb0d;
            text-decoration: underline;
            font-weight: bold;
        }

        /* Committee cards */
        .page-content .card {
            border: 2px solid #198754;
            border-radius: 8px;
            width: 100%;
            height: 100%;
            transition: all 0.25s ease-in-out;
        }

        /* Card hover effect */
        .page-content .card:hover {
            box-shadow: 0 6px 18px rgba(25, 135, 84, 0.35);
            transform: translateY(-5px);
            border-color: #146c43;
        }

        /* Spacing between committee cards */
        .page-content .committee-column {
            margin-bottom: 24px;
        }

        /* Document heading size */
        .page-content .documents h4 {
            font-size: 1.25rem;
        }

    </style>
</head>

<body>

    <!-- Navigation bar -->
    <div id="result">
        <?php
        include_once("navbar.php");
        ?>
    </div>

    <div class="page-content">

        <div class="container-fluid">

            <h1 class="text-center">Contact us</h1>
            <h3 class="text-center">Committee Members are accessible through the emails below.<br>Please use your full name and club (if applicable when contacting us)</h3>
            <h4 class="text-center">Address- NSCBA 11 Hunsbury Close, Northampton, NN14 9UE</h4>

            <br>

            <?php
            include_once('connection.php');

            $stmt = $conn->prepare("SELECT * FROM TblCommittee");
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Number of columns per row
            $columnsPerRow = 4;

            // Bootstrap column width
            $bootstrapColClass = 12 / $columnsPerRow;

            echo '<div class="container">';
            echo '<div class="row">';

            $count = 0;

            foreach ($results as $result) {

                // Start a new row
                if ($count % $columnsPerRow == 0 && $count != 0) {
                    echo '</div><div class="row">';
                }

                // Committee column
                echo '<div class="col-md-' . $bootstrapColClass . ' d-flex committee-column">';

                // Card
                echo '<div class="card w-100 h-100">';

                // Committee image
                echo '<div class="d-flex justify-content-center align-items-center">';

                echo '<img src="./comm/' . htmlspecialchars($result['Pic']) . '"
                    class="img-fluid my-3"
                    style="width: 100%; max-width: 150px; height: auto;">';

                echo '</div>';

                // Card content
                echo '<div class="card-body text-center">';

                echo '<h5 class="card-title">' . htmlspecialchars($result['Name']) . '</h5>';

                echo '<p class="card-text">' . htmlspecialchars($result['Post']) . '</p>';

                // Email address or blank space
                if (!empty($result['Email'])) {

                    echo '<p class="card-text"><a href="mailto:' .
                        htmlspecialchars($result['Email'], ENT_QUOTES, 'UTF-8') .
                        '">' .
                        htmlspecialchars($result['Email']) .
                        '</a></p>';

                } else {

                    echo '<p class="card-text">&nbsp;</p>';

                }

                echo '</div>'; // Card body
                echo '</div>'; // Card
                echo '</div>'; // Column

                $count++;
            }

            echo '</div>'; // Row
            echo '</div>'; // Container
            ?>

            <br>

            <!-- MINUTES OF MEETINGS -->
            <div class="container-fluid documents">

                <h2>Minutes of meetings</h2>
                <hr>

                <?php
                $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Minutes'");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $path = $basePath ."/documents/" . $row["filename"];

                    echo '<a href="' . htmlspecialchars($path) . '" target="_blank"><h4>' .
                        htmlspecialchars($row["title"]) .
                        '</h4></a>';
                }
                ?>

                <hr>

                <div class="row">

                    <!-- COLUMN 1: ADOPTED POLICIES -->
                    <div class="col-md-4">

                        <h2>Adopted Policies</h2>
                        <hr>

                        <?php
                        $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Adopted Policies'");
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $path = $basePath ."/documents/" . $row["filename"];

                            echo '<a href="' . htmlspecialchars($path) . '" target="_blank"><h4>' .
                                htmlspecialchars($row["title"]) .
                                '</h4></a>';
                        }
                        ?>

                    </div>


                    <!-- COLUMN 2: SENIORS -->
                    <div class="col-md-4">

                        <h2>Seniors Documents</h2>
                        <hr>

                        <?php
                        $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Seniors'");
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $path = $basePath ."/documents/" . $row["filename"];

                            echo '<a href="' . htmlspecialchars($path) . '" target="_blank"><h4>' .
                                htmlspecialchars($row["title"]) .
                                '</h4></a>';
                        }
                        ?>

                        <h3>Archived Seniors</h3>
                        <hr>

                        <?php
                        $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Archive Seniors'");
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $path = $basePath ."/documents/" . $row["filename"];

                            echo '<a href="' . htmlspecialchars($path) . '" target="_blank"><h4>' .
                                htmlspecialchars($row["title"]) .
                                '</h4></a>';
                        }
                        ?>

                    </div>


                    <!-- COLUMN 3: JUNIORS -->
                    <div class="col-md-4">

                        <h2>Juniors Documents</h2>
                        <hr>

                        <?php
                        $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Juniors'");
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $path = $basePath ."/documents/" . $row["filename"];

                            echo '<a href="' . htmlspecialchars($path) . '" target="_blank"><h4>' .
                                htmlspecialchars($row["title"]) .
                                '</h4></a>';
                        }
                        ?>

                        <h3>Archived Juniors</h3>
                        <hr>

                        <?php
                        $stmt = $conn->prepare("SELECT * FROM TblDocs WHERE type='Archive Juniors'");
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $path = $basePath ."/documents/" . $row["filename"];

                            echo '<a href="' . htmlspecialchars($path) . '" target="_blank"><h4>' .
                                htmlspecialchars($row["title"]) .
                                '</h4></a>';
                        }
                        ?>

                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>

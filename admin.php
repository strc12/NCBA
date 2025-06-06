<head>
  <title>NSCBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
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
<div class="container mt-5">
        <h1 class="text-center mb-4">Admin Page for Adding to Website</h1>
        
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="images-tab" data-bs-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">Images</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="social-media-tab" data-bs-toggle="tab" href="#social-media" role="tab" aria-controls="social-media" aria-selected="false">Social Media Feed</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="documents-tab" data-bs-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="committee-tab" data-bs-toggle="tab" href="#committee" role="tab" aria-controls="committee" aria-selected="false">Committee</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="News-tab" data-bs-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="false">News</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="editNews-tab" data-bs-toggle="tab" href="#editNews" role="tab" aria-controls="editNews" aria-selected="false">Edit News</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Images Tab -->
            <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
                <form action="addimages.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="typeofdoc" class="form-label">Type of Image</label>
                        <select id="typeofdoc" name="typeofdoc" class="form-select">
                            <option value="Square">Square</option>
                            <option value="Portrait">Portrait</option>
                            <option value="Landscape">Landscape</option>
                            <option value="Panorama">Panorama</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <input type="text" id="desc" name="desc" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="dateofupload" class="form-label">Date</label>
                        <input type="date" id="dateofupload" name="dateofupload" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="imagey" class="form-label">Image</label>
                        <input type="file" id="imagey" name="imagey" class="form-control" accept=".jpg, .jpeg, .jfif">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Gallery Image</button>
                </form>
            </div>

            <!-- Social Media Feed Tab -->
            <div class="tab-pane fade" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
                <form action="addmedia.php" method="POST">
                    <div class="mb-3">
                        <label for="embedcode" class="form-label">Embed Code</label>
                        <input type="text" id="embedcode" name="embedcode" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" id="type" name="type" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Media</button>
                </form>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                <form action="adddocument.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title of Document</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="typeofdoc" class="form-label">Type of Document</label>
                        <select id="typeofdoc" name="typeofdoc" class="form-select">
                            <option value="Minutes">Minutes</option>
                            <option value="Agenda">Agenda</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="doc" class="form-label">File</label>
                        <input type="file" id="doc" name="doc" class="form-control" accept="documents/*">
                    </div>
                    <div class="mb-3">
                        <label for="dateofupload" class="form-label">Date</label>
                        <input type="date" id="dateofupload" name="dateofupload" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Document</button>
                </form>
            </div>

            <!-- Committee Tab -->
            <div class="tab-pane fade" id="committee" role="tabpanel" aria-labelledby="committee-tab">
                <form action="addcommittee.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="post" class="form-label">Post</label>
                        <input type="text" id="post" name="post" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="comm" class="form-label">Image</label>
                        <input type="file" id="comm" name="comm" class="form-control" accept=".jpg, .jpeg">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Committee Member</button>
                </form>
            </div>
            <!-- News Tab -->
            <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
                NOTE THIS WILL SHOW ON THE FRONT PAGE OF THE SITE AND ONLY THE MOST RECENT ONE
                <form action="addnews.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="heading" class="form-label">Title</label>
                        <input type="text" id="heading" name="heading" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <input type="text" id="details" name="details" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link URL</label>
                        <input type="text" id="link" name="link" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="linktext" class="form-label">Link text</label>
                        <input type="text" id="linktext" name="linktext" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="imagey" class="form-label">Image</label>
                        <input type="file" id="imagey" name="imagey" class="form-control" accept=".jpg, .jpeg, .jfif">
                    </div>
                    <button type="submit" class="btn btn-primary">Add News item</button>
                </form>
            </div>
            <!-- EditNews Tab -->
            <div class="tab-pane fade" id="editnews" role="tabpanel" aria-labelledby="editnews-tab">
                <p>To make news active/inactive or edit (if recycling)</p>

                <!-- Existing News Items -->
                <h5>Edit Existing News</h5>
                <?php
                include_once('connection.php');
                $stmt = $conn->prepare("SELECT * FROM TblNews ORDER BY Active DESC, Dateadded DESC");
                $stmt->execute();
                $newsItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($newsItems as $item) {
                    echo '
                    <form action="editnews.php" method="POST" enctype="multipart/form-data" class="border p-3 mb-3 rounded">
                        <input type="hidden" name="id" value="' . htmlspecialchars($item['NewsID']) . '">
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" name="heading" value="' . htmlspecialchars($item['Heading']) . '" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Details</label>
                            <input type="text" name="details" value="' . htmlspecialchars($item['Details']) . '" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Link URL</label>
                            <input type="text" name="link" value="' . htmlspecialchars($item['Link']) . '" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Link Text</label>
                            <input type="text" name="linktext" value="' . htmlspecialchars($item['Linktext']) . '" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Current Image</label>
                            <img src="./news/' . htmlspecialchars($item["Picture"]) . '" class="img-fluid rounded w-60" style="max-height: 200px;" alt="News image">


                            <input type="file" name="imagey" class="form-control" accept=".jpg, .jpeg, .jfif">
                            <small>Current: ' . htmlspecialchars($item['Picture']) . '</small>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="active" id="active' . $item['NewsID'] . '" ' . ($item['Active'] ? 'checked' : '') . '>
                            <label class="form-check-label" for="active' . $item['NewsID'] . '">Active</label>
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>';
                }
                ?>
            </div>
</div>
</body>
</html>
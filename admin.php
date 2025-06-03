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
        </div>
</div>
</body>
</html>
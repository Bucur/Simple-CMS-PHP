<?php

session_start();
session_regenerate_id(TRUE);

require 'database.php';
//include_once 'functions.php';
$url = "http://cms.devbloom.ro/";

// set timeout period in seconds
$inactive = 86400;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive) {
     session_destroy();
     header("Location: logout.php");
    }
}
$_SESSION['timeout'] = time();

if( isset($_SESSION['user_id']) ) {

	$records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0) {
		$user = $results;
	}
}
?>
<!doctype html>
<html lang="ro">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">
    <meta name="robots" content="noindex, nofollow">

    <title>Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
  <?php if( !empty($user) ): ?>

    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">CMS PHP</a>

       <ul class="navbar-nav px-3">
         <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
         </li>
        </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">

        <?php include_once('nav-admin.php'); ?>


     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard / Upload image</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="<?php echo $url; ?>" target="_blank">
                  <button class="btn btn-sm btn-outline-secondary">Visit site</button>
                </a>
              </div>
            </div>
          </div>
<?php
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
	?>

				<form action="upload.php" method="post" enctype="multipart/form-data">
				    Select image to upload:<br>
				    <input type="file" class="btn btn-default" name="fileToUpload" id="fileToUpload">
				    <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
				</form>

        </main>
      </div>
    </div>

<?php else : ?>

<h1>Directory access is forbidden.</h1>

<?php endif; ?>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>

    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="../assets/js/feather.min.js"></script>
    <script>
      feather.replace()
    </script>


  </body>
</html>

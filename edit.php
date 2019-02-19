<?php

session_start();
session_regenerate_id(TRUE);

//require_once 'CSRF.php';
require 'database.php';

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

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
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
    <title>Dashboard edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.png">
    <meta name="robots" content="noindex, nofollow">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xmpmzvxql49m2b7v7i63lyc6oucl7lxp0mh3zu9s7e4bp2xt"></script> 
  </head>
  <body style="padding: 40px 0">

  <?php if( !empty($user) ): ?>

    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">

            <?php include_once('nav-admin.php'); ?>

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Sign out</button>
              </div>
            </div>
          </div>


<h2>Edit Pages</h2>

<div class="col-md-3"></div>
  <div class="col-md-12 well">
    
    <div class="col-md-3"></div>
    <div class="col-md-8">
      <?php

        if(isset($_GET['id'])) {
        // require_once 'database.php';
          $id = $_GET['id'];
          $sql = $conn->prepare("SELECT * FROM `pages` WHERE `id`='$id'");
          $sql->execute();
          $row = $sql->fetch();
        }
      ?>
      <form method="POST" action="update.php?id=<?php echo $id?>">

        <div class="form-group">
          <label>Titlu</label>
          <input class="form-control" type="text" name="title" id="title" value="<?php echo $row['title']?>"  />
        </div>

        <div class="form-group">
         <label for="title">Description: max 160 characters</label>
          <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['description']?>" required />
        </div>

        <div class="form-group">
          <label>Url</label>
          <input class="form-control" type="text" name="slug" id="slug" value="<?php echo $row['slug']?>" />
        </div>

        <div class="form-group">
          <label>Continut</label> 
          
        <textarea class="form-control" type="text" rows="5" id="pagetext" name="pagetext"><?php echo $row['pagetext'] ?></textarea>
        </div>

        

        <div class="form-group">
          <button class="btn btn-warning form-control" type="submit" name="update">Update</button>
        </div>

      </form>
      <?php
        $conn = null;
      ?>
    </div>
  </div>

        </main>
      </div>
    </div>

<?php else : ?>

<h1>No access</h1>

<?php endif; ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>

    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="assets/js/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script>tinymce.init({ 
  selector:'textarea',
  theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]

 });</script>

  </body>
</html>
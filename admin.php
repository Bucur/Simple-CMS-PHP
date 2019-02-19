<?php
session_start();
session_regenerate_id(TRUE);

require 'database.php';
include_once 'functions.php';

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
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xmpmzvxql49m2b7v7i63lyc6oucl7lxp0mh3zu9s7e4bp2xt"></script>

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
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="<?php echo $url; ?>" target="_blank">
                <button class="btn btn-sm btn-outline-secondary">Vezi site</button></a>
              </div>
            </div>
          </div>


      <div class="wrapper">

        <ul class="tabs clearfix" data-tabgroup="first-tab-group">
          <li><a href="#tab1" class="active">Pagini</a></li>
          <li><a href="#tab2">Adauga pagina noua</a></li>
        </ul>
        <section id="first-tab-group" class="tabgroup">
          <div id="tab1">

            <table class="table table-bordered">
              <thead class="alert-danger">
                <tr>
                  <th>Titu:</th>
                  <th>Descriere: max 160 characters</th>
                  <th>Permalink page</th>
                  <th>Actiune</th>
                </tr>
              </thead>
              <tbody class="alert-warning">
                <?php
                  require 'database.php';
                  $sql = $conn->prepare("SELECT * FROM `pages` ORDER BY `id` DESC");
                  $sql->execute();
                  while($row = $sql->fetch()){
                ?>
                <tr>
                  <td><?php echo $row['title']?></td>
                  <td><?php echo $row['description']?></td>
                  <td><?php echo $row['slug']?></td>
                  <td><a href="edit.php?id=<?php echo $row['id']?>">Edit</a> | <a href="delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Esti sigur ca vrei sa stergi?');">Delete</a></td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>


          </div>
          <div id="tab2">

            <form method="POST" action="add.php">

                <div class="form-group">
                  <label>Nume</label>
                  <input class="form-control" type="text" id="title" name="title" placeholder="Enter title" required/>
                </div>

                <div class="form-group">
                 <label for="title">Descriere: max 160 characters</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" />
                </div>

                <div class="form-group">
                  <label>Url (this is added in to the URL, no spaces allowed)</label>
                  <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter permalink" required />
                </div>

                <div class="form-group">
                  <label>Continut</label>
                  <textarea class="form-control" type="text" rows="5" id="pagetext" name="pagetext" placeholder="Enter text / html"></textarea>

                </div>

                <div class="form-group">
                  <button class="btn btn-primary form-control" type="submit" name="save">Save</button>
                </div>

              </form>


          </div>
        </section>
        </div>

        </main>
      </div>
    </div>

<?php else: ?>
	<h1>Please Login</h1>
<?php endif; ?>

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

<script>
$('.tabgroup > div').hide();
$('.tabgroup > div:first-of-type').show();
$('.tabs a').click(function(e){
  e.preventDefault();
    var $this = $(this),
        tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
        others = $this.closest('li').siblings().children('a'),
        target = $this.attr('href');
    others.removeClass('active');
    $this.addClass('active');
    $(tabgroup).children('div').hide();
    $(target).show();

});
  </script>

<script>
    $(document).ready(function(){
     $("#addnew").click(function(){
        $("#content-editor").toggle();
      });
   });

</script>


  </body>
</html>

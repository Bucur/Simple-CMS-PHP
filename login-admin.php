<?php

// pornim mecanisul de sesiuni
session_start();  //if you are copying this code, this line makes it work.
session_regenerate_id(true);

require "database.php";

if (isset($_SESSION['user_id']) ){
	header("Location: admin.php");
	exit;
}

if(!empty($_POST['email']) && !empty($_POST['password'])):

  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

 if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
   $_SESSION['user_id'] = $results['id'];
   header("Location: admin.php");
 } else {
   $message = 'Invalid email sau parola';
 }
  endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Dashboard</title>
	<link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <meta name="robots" content="noindex, nofollow">
</head>
<body>

<div class="wrapper">

	<?php if(!empty($message)) : ?>
		<p><?php $message ?></p>
	<?php endif; ?>

	<form class="login" action="login-admin.php" method="POST" accept-charset="utf-8">
      <p class="title">Log in</p>
      <input type="text" placeholder="Email" name="email" required autofocus/>
      <i class="fa fa-user"></i>
      <input type="password" placeholder="Password" name="password" required />
      <i class="fa fa-key"></i>
      <button><i class="spinner"></i><span class="state">Log in</span></button>
  </form>


</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
<script>
var working = false;
$('.login').on('submit', function(e) {
  e.preventDefault();
  if (working) return;
  working = true;
  var $this = $(this),
  $state = $this.find('button > .state');
  $this.addClass('loading');
  $state.html('Authenticating');
  setTimeout(function() {
    $this.addClass('ok');
    $state.html('Welcome back!');
    setTimeout(function() {
      $state.html('Log in');
      $this.removeClass('ok loading');
      working = false;
    }, 4000);
  }, 3000);
});
</script>

</body>
</html>
<?php
// trebuie stergem aceasta sesiune
// deoarece ea va continua sa persiste
//csrf::flushKeys();

if (isset($_SESSION['user_id']['error'])) {
    session_unset($_SESSION['user_id']);
}

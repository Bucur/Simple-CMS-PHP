<?php
	if(ISSET($_GET['id'])){
		require_once 'database.php';
		$id = $_GET['id'];
		$sql = $conn->prepare("DELETE from `pages` WHERE `id`='$id'");
		$sql->execute();
		header('location:admin.php');
	}
?>